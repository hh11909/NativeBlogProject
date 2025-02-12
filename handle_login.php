<?php
  session_start();
  $errors=[];
  if(empty($_REQUEST["email"]))$errors["email"]="Email is required!";
  if(empty($_REQUEST["password"]))$errors["password"]="password is required!";

  $email=htmlspecialchars(filter_var($_REQUEST["email"],FILTER_SANITIZE_EMAIL));
  $password=htmlspecialchars($_REQUEST["password"]);
  if(!empty($_REQUEST["email"])&&!filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL))$errors["email"]="Invalid Email format! please add aa@bb.cc";
  if(empty($errors)){
    require_once("classes.php");
    $user= User::login($email,md5($password));
    if(!empty($user)){
      if($user->isBanned==false){
        if($user->role=="subscriber"){
            $_SESSION["user"]=serialize($user);
            header("location:frontend/subscribers/home.php");
          }
          else{
            $_SESSION["user"]=serialize($user);
            header("location:frontend/admins/home.php");
          }
      }
      else{
        header("location:index.php?msg=banned");
      }
    }
    else{
      $errors["email"]="you are not registered!<a href='register.php'>Register now!</a>";
      $_SESSION["errors"]=$errors;
      header("location:index.php?msg=no_user");
    }
  }
  else{
    $_SESSION["errors"]=$errors;
    header("location:index.php?msg=empty_field");
  }
  

?>