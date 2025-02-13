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
    </main>
    <?php
require_once("footer.php");
?>