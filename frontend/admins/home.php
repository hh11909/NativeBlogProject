<?php
require_once("header.php");
?>


    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 min-vh-100">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center gap-1">
            <svg class="bi"><use xlink:href="#calendar3"/></svg>
            This week
          </button>
        </div>
      </div>
      <div class="container py-5">
  <div class="row row-cols-1 row-cols-md-4 g-4">
    <div class="col">
      <div class="card h-100 text-center shadow">
        <div class="card-body">
          <div class="display-4 text-primary mb-2 pe-4">
            <i class="bi bi-people"></i>
          </div>
          <h2 class="card-title mb-3"><?=count($user->get_all_users())?></h2>
          <p class="card-text text-muted">Total Users</p>
        </div>
      </div>
    </div>
    
    <div class="col">
      <div class="card h-100 text-center shadow">
        <div class="card-body">
          <div class="display-4 text-success mb-2 text-center pe-4">
            <i class="bi bi-postcard "></i>
          </div>
          <h2 class="card-title mb-3"><?=count($user->total_posts())?></h2>
          <p class="card-text text-muted">Total Posts</p>
        </div>
      </div>
    </div>
    
    <div class="col">
      <div class="card h-100 text-center shadow">
        <div class="card-body">
          <div class="display-4 text-warning mb-2 pe-4">
            <i class="bi bi-star"></i>
          </div>
          <h2 class="card-title mb-3"><?=count($user->total_likes())?></h2>
          <p class="card-text text-muted">Total Likes</p>
        </div>
      </div>
    </div>
    
    <div class="col">
      <div class="card h-100 text-center shadow">
        <div class="card-body">
          <div class="display-4 text-danger mb-2 pe-4">
            <i class="bi bi-chat"></i>
          </div>
          <h2 class="card-title mb-3"><?=count($user->total_comments())?></h2>
          <p class="card-text text-muted">Total Comments</p>
        </div>
      </div>
    </div>
  </div>
</div>

      <h2>All users</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email</th>
              <th scope="col">Role</th>
              <th scope="col">Phone</th>
              <th scope="col">posts</th>
              <th scope="col">likes</th>
              <th scope="col">comments</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($allUsers as $users){
            ?>
            <tr>
              <td><?=$users["id"]?></td>
              <td><?=$users["name"]?></td>
              <td><?=$users["email"]?></td>
              <td><?=$users["role"]?></td>
              <td><?=$users["phone"]?></td>
              <td><?=count($user->my_posts($users["id"]))?></td>
              <td><?=count($user->my_likes($users["id"]))?></td>
              <td><?=count($user->get_user_comments($users["id"]))?></td>
              <?php if($user->id!=$users["id"]){
                ?>
              
              <td>

                <form action="handleban.php" method="post" class="d-inline-block">
                  <input name="user_id" value="<?=$users["id"]?>" type="hidden">
                  <button
                  type="submit"
                  class="btn <?=(!$users["isBanned"])?"btn-danger":"btn-warning"?>"
                >
                  <?=(!$users["isBanned"])?"BAN":"UNBAN"?>
                </button>
              </form>               

                <form action="deleteaccount.php" method="post" class="d-inline-block">
                  <input name="user_id" value="<?=$users["id"]?>" type="hidden">
                  <button
                  type="submit"
                  class="btn btn-danger"
                  >
                  DELETE ACCOUNT
                </button>
              </form>               
              </td>
              <?php 
              }
              ?>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <h2>All Posts</h2>
      <div class="table-responsive small">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">owner ID</th>
              <th scope="col">title</th>
              <th scope="col">likes</th>
              <th scope="col">comments</th>
              <th scope="col">created at</th>
              <th scope="col">updated at</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($posts as $post){
            ?>
            <tr>
              <td><?=$post["id"]?></td>
              <td><?=$post["user_id"]?></td>
              <td><?=$post["title"]?></td>
              <td><?=count($user->post_likes($post["id"]))?></td>
              <td><?=count($user->get_post_comments($post["id"]))?></td>
              <td><?=$post["created_at"]?></td>
              <td><?=$post["updated_at"]?></td>
              <?php if($user->id!=$users["id"]){
                ?>
              
              <td>             
                <form action="deletepost.php" method="post" class="d-inline-block">
                  <input name="post_id" value="<?=$post["id"]?>" type="hidden">
                  <button
                  type="submit"
                  class="btn btn-danger"
                  >
                  DELETE
                </button>
              </form>               
              </td>
              <?php 
              }
              ?>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
<?php
require_once("footer.php");
?>