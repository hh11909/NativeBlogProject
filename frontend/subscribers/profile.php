<?php
  require_once("header.php");
  $myPosts=$user->my_posts($user->id);
  
?>
<main>
  <section class="w-100 px-4 py-5" style="background-color: #9de2ff; border-radius: .5rem .5rem 0 0;">
    <div class="row d-flex justify-content-center">
      <div class="col col-md-9 col-lg-7 col-xl-6">
        <div class="card" style="border-radius: 15px;">
          <div class="card-body p-4">
            <div class="d-flex">
              <div class="flex-shrink-0 text-center">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <?php
                  if(!empty($_GET["msg"])&&$_GET["msg"]=="uius"){
                    ?>
                    <div
                      class="alert alert-success position-sticky sticky-top"
                      role="alert"
                    >
                      <strong>Alert Heading</strong> User image updated successfully!
                    </div>
                    <?php  
                  }
                  else if(!empty($_GET["msg"])&&$_GET["msg"]=="required_image"){
                    ?>
                    <div
                      class="alert alert-danger position-sticky sticky-top"
                      role="alert"
                    >
                      <strong>Alert Heading</strong> required image!
                    </div>
                  <?php
                  }
                  ?>

                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" style="width:180px;height:180px;" src=<?php echo(!empty($user->image))?$user->image:"http://bootdey.com/img/Content/avatar/avatar1.png" ?> alt="">
                    <!-- Profile picture upload button-->
                    <form action="store_user_image.php" method="post" enctype="multipart/form-data">
                      <div>
                        <input name="image" type="file" >
                      </div>
                      <div>
                        <button
                          type="submit"
                          class="btn btn-primary"
                        >
                          Save
                        </button>
                      </div>
                      
                    </form>
                </div>
            </div>
              </div>
              <div class="flex-grow-1 ms-3">
                <h5 class="mb-1"><?=$user->name?></h5>
                <p class="mb-2 pb-1"><?=$user->role?></p>
                <div class="d-flex justify-content-start rounded-3 p-2 mb-2 bg-body-tertiary">
                  <div>
                    <p class="small text-muted mb-1">Articles</p>
                    <p class="mb-0">41</p>
                  </div>
                  <div class="px-3">
                    <p class="small text-muted mb-1">Followers</p>
                    <p class="mb-0">976</p>
                  </div>
                  <div>
                    <p class="small text-muted mb-1">Rating</p>
                    <p class="mb-0">8.5</p>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>.
  <div class="container">
    <?php
    if(!empty($_GET["msg"])&& $_GET["msg"]=="done"){
      ?>
      <div
        class="alert alert-success position-sticky sticky-top"
        role="alert"
      >
        <strong>Alert Heading</strong> post added successfully!
      </div>
      <?php  
    }
    else if(!empty($_GET["msg"])&& $_GET["msg"]=="required_fields"){
      ?>
      <div
        class="alert alert-danger position-sticky sticky-top"
        role="alert"
      >
        <strong>Alert Heading</strong> required fields!
      </div>
    <?php
    }
    ?>
    
    <div class="row">
      <div class="col-6 offset-3 bg-info mt-5 rounded">
        <h2 class="text-white fw-light text-center"> Share Your Idea</h2>
      </div>
      <div class="col-6 offset-3 bg-info my-5 rounded">
       <form action="storePost.php" method="post" enctype="multipart/form-data">
         <div class="my-3">
           <label for="" class="form-label">Title</label>
           <input
             type="text"
             name="title"
             id=""
             class="form-control"
             placeholder=""
             aria-describedby="helpId"
             />
           </div>
          <div class="mb-3">
            <label for="" class="form-label">Content</label>
            <textarea
              type="text"
              name="content"
              id=""
              class="form-control"
              placeholder=""
              aria-describedby="helpId"
            ></textarea>
          </div>
           <div class="mb-3">
             <label for="" class="form-label">Image</label>
             <input
               type="file"
               name="image"
               id=""
               class="form-control"
               placeholder=""
               aria-describedby="helpId"
             />
             
             <small id="helpId" class="text-muted">Help text</small>
             
           </div>
             <button
               type="submit"
               class="btn btn-primary my-3"
             >
               Submit
             </button>
       </form action="storePost.php" method="post">
          
        
      </div>
    </div>
  </div>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

    <div class="row">
    <?php
    foreach($myPosts as $post){
    ?>
        <div class="col-6 offset-3 my-3">
          <div class="card">
          <div class="d-flex justify-content-between">
                    <div class="d-flex flex-row align-items-center p-3">
                        <img style="width:50px;height:50px;border-radius:50px;" src="<?php echo(!empty($user->image))?$user->image:"http://bootdey.com/img/Content/avatar/avatar1.png"?>" alt=""> 
                        <div class="ms-2 c-details">
                            <h6 class="mb-0"><?=$user->name?></h6> <span><?=$post["created_at"]?></span>
                        </div>
                    </div>
                </div>
            <?php
            if(!empty($post["image"])){
            ?>
            <img class="card-img-top" src="<?=$post["image"]?>" alt="<?=$post["title"]?>" />
            <?php
            }
            ?>
            <div class="card-body">
              <h4 class="card-title"><?=$post["title"]?></h4>
              <p class="card-text"><?=$post["content"]?></p>
              <hr>
              <div class="d-flex justify-content-between align-items-center">
                      <form class="d-inline-block" action="handle_like.php" method="post">
                        <input type="hidden" name="post_id" value="<?=$post["id"]?>">
                        <input type="hidden" name="user_id" value="<?=$post["user_id"]?>">
                        <button type="submit" class="btn btn-toggle align-items-center ms-2 "><?= (!empty($user->home_like($post["id"],$user->id)))?"<span style='color:green;'>liked</span>":"<span style='color:blue;'>like</span>" ?> </button>
                        <?=count(user::post_likes($post["id"]))?>
                      </form>
                        <div class="d-flex flex-row muted-color">
                          <?=count($user->get_post_comments($post["id"]))?>
                        <span>&nbsp comments</span>
                      </div><!--####################### -->
                    </div>
            </div>
            <div class="row d-flex justify-content-center">
  <div class="col">
    <div class="card shadow-0 border">
      <div class="card-body p-4">
        <form action="store_comment.php" method="post">
          <div data-mdb-input-init class="form-outline mb-4">
            <input type="text" id="addANote" name="comment" class="form-control" placeholder="Type comment..." />
            <input type="hidden" name="post_id" value="<?=$post["id"]?>">
            <button type="submit" class="btn btn-toggle my-1 " for="addANote">+ Add a note</button>
          </div>
        </form>

        
      <?php
        $comments=$user->get_post_comments($post["id"]);
        foreach($comments as $comment){
      ?>
        <div class="card mb-4">
          <div class="card-body">
            <p><?=$comment["comment"]?></p>
            <div class="d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center">
                <img src=" <?php echo(!empty($comment["image"]))?$comment["image"]:"http://bootdey.com/img/Content/avatar/avatar1.png" ?>" alt="avatar" width="25"
                  height="25" />
                <p class="small mb-0 ms-2"><?= $comment["name"]?></p>
              </div>
              <div class="d-flex flex-row align-items-center text-body">
                <i class="fas fa-thumbs-up mx-2 fa-xs" style="margin-top: -0.16rem;"></i>
                <p class="small mb-0"><?=$comment["created_at"]?></p>
              </div>
            </div>
          </div>
        </div>
      <?php
        }
      ?>

      </div>
    </div>
  </div>
</div>
          </div>
          
        </div>
    <?php
     }
    ?>
  </div>
    </div>
  </div>
</main>

<?php
  require_once("footer.php")
?>