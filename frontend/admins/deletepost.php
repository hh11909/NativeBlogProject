<?php
  session_start();
  require_once("../../classes.php");
  $user=unserialize($_SESSION["user"]);
  $user->delete_post($_REQUEST["post_id"]);
  header("location:home.php?msg=deldone")
?>