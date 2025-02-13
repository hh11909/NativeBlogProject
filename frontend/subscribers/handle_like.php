<?php
  session_start();
  require_once("../../classes.php");
  $user=unserialize($_SESSION["user"]);
  $like=$user->my_likes($user->id);
    $_SESSION["like"]=$like;
  if(empty($_SESSION["like"])){
    $user->store_like($_REQUEST["post_id"],$user->id);
      }
      else{
        $isLiked=0;
        foreach($_SESSION["like"] as $storedLike){
          if((($storedLike["user_id"]==$user->id) && ($storedLike["post_id"]==$_REQUEST["post_id"]))){
            $isLiked=1;
        $user->delete_like($_REQUEST["post_id"],$user->id);
      }        
    }
    if($isLiked==0){
        $user->store_like($_REQUEST["post_id"],$user->id);
      }
    }
    $like=$user->my_likes($user->id);
    $_SESSION["like"]=$like;
    header("location:home.php");
    ?>