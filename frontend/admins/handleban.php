<?php
  session_start();
  require_once("../../classes.php");
  $user=unserialize($_SESSION["user"]);
  $user->ban_account($_REQUEST["user_id"]);
  header("location:home.php?msg=bandone");
?>