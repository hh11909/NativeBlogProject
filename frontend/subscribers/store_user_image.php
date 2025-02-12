<?php
  session_start();
  if(!empty($_FILES["image"]["name"])){ 
    require_once("../../classes.php");
    $user=unserialize($_SESSION["user"]);
    $user->image="../../images/users/".$_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"],$user->image);
    $user->update_profile_picture($user->image,$user->id);
    $_SESSION["user"]=serialize($user);
    header("location:profile.php?msg=uius");
  }
  else{
    header("location:profile.php?msg=required_image");
  }

?>