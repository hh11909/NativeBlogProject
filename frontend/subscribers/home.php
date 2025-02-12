<?php
require_once("header.php");
$myPosts=$user->home_posts();

?>
<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Welcome <?= $user->name ?></h1>
        <p class="lead text-body-secondary">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Main call to action</a>
          <a href="#" class="btn btn-secondary my-2">Secondary action</a>
        </p>
      </div>
    </div>
  </section>

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
                            <h6 class="mb-0"><?=$post["name"]?></h6> <span><?=$post["created_at"]?></span>
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
                <img src=" <?php echo(!empty($user->image))?$user->image:"http://bootdey.com/img/Content/avatar/avatar1.png" ?>" alt="avatar" width="25"
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
require_once("footer.php");
?>

