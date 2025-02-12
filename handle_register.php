<?php
session_start();
  $errors=[];
  if(empty($_REQUEST["name"]))$errors["name"]="name is required!";
  if(empty($_REQUEST["email"]))$errors["email"]="email is required!";
  if(empty($_REQUEST["pw"])||empty($_REQUEST["pc"]))$errors["pw"]="password and password confirmation is required!";
  if($_REQUEST["pw"]!=$_REQUEST["pc"])$errors["pc"]="password confirmation must be equal to password!";
  if(!empty($_REQUEST["phone"])&&(strlen($_REQUEST["phone"])<11||strlen($_REQUEST["phone"])>13))$errors["phone"]="please enter valid phone number!";

  $name=htmlspecialchars(trim($_REQUEST["name"]));
  $email=htmlspecialchars(filter_var($_REQUEST["email"],FILTER_SANITIZE_EMAIL));
  $password=htmlspecialchars($_REQUEST["pw"]);
  $password_confirmation=htmlspecialchars($_REQUEST["pc"]);
  $phone=htmlspecialchars(trim($_REQUEST["phone"]));


  if(!empty($_REQUEST["email"])&&!filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL))$errors["email"]="Invalid Email format! please add aa@bb.cc";
  if(empty($errors)){
    try{      
      require_once('classes.php');
      $result=Subscriber::register($name,$email,md5($password),$phone);
      header("location:index.php?msg='sr'");
    }
    catch (\Throwable $th){
      header("location:register.php?msg=ar");
    }

  }
  
  else{
    $_SESSION["errors"]=$errors;
    header("location:register.php");
  }

?>