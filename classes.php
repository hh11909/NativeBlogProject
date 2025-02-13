<?php
  abstract class User{
    public $id;
    public $name;
    public $email;
    protected $password;
    public $role;
    public $phone;
    public $image;
    public $isBanned;
    public $created_at;
    public $updated_at;

    function __construct($id,$name,$email,$password,$role,$phone,$image,$isBanned,$created_at,$updated_at)
    {
      $this->id=$id;
      $this->name=$name;
      $this->email=$email;
      $this->password=$password;
      $this->role=$role;
      $this->phone=$phone;
      $this->image=$image;
      $this->isBanned=$isBanned;
      $this->created_at=$created_at;
      $this->updated_at=$updated_at;
    }
    
    
    public static function login($email,$password){
      $user=null;
      $qry="SELECT * FROM USERS WHERE email='$email' AND password='$password'";
      require_once("config.php");
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      if($arr=mysqli_fetch_assoc($result)){
        switch($arr["role"]){
          case 'subscriber':
            $user= new Subscriber($arr["id"],$arr["name"],$arr["email"],$arr["password"],$arr["role"],$arr["phone"],$arr["image"],$arr["isBanned"],$arr["created_at"],$arr["updated_at"]);
            break;
            case 'admin':
            $user= new Admin($arr["id"],$arr["name"],$arr["email"],$arr["password"],$arr["role"],$arr["phone"],$arr["image"],$arr["isBanned"],$arr["created_at"],$arr["updated_at"]);

            break;
          }
        }
        mysqli_close($cn);
        return $user;
        
      }
      public static function store_post($title,$content,$imageName,$user_id){
        $qry="INSERT INTO POSTS (title,content,image,user_id) VALUES ('$title','$content','$imageName','$user_id')";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;
      }
      public static function my_posts($user_id){
        $qry="SELECT * FROM POSTS WHERE user_id=$user_id ORDER BY created_at DESC";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }
      
      public function update_profile_picture($user_image,$user_id){
        $qry="UPDATE USERS SET image = '$user_image' WHERE id=$user_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;
      }
      public function store_comment($comment,$post_id,$user_id){
        $qry="INSERT INTO comments (comment,post_id,user_id) VALUES ('$comment','$post_id','$user_id')";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;
      }
      public function get_post_comments($post_id){
        $qry="SELECT * FROM COMMENTS JOIN USERS ON COMMENTS.user_id = USERS.id WHERE post_id = $post_id ORDER BY COMMENTS.created_at DESC LIMIT 10";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }
      public function get_user_comments($user_id){
        $qry="SELECT * FROM COMMENTS JOIN USERS ON COMMENTS.user_id = USERS.id WHERE user_id = $user_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }
      public static function store_like($post_id,$user_id){
        $qry="INSERT INTO LIKES (post_id,user_id) VALUES ($post_id,$user_id)";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;

      }
      public static function delete_like($post_id,$user_id){
        $qry="DELETE FROM LIKES WHERE post_id=$post_id AND user_id=$user_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;

      }
      public function my_likes($user_id){
        $qry="SELECT * FROM LIKES WHERE user_id=$user_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }

      public static function post_likes($post_id){
        $qry="SELECT * FROM LIKES WHERE post_id=$post_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }
      public static function home_like($post_id,$user_id){
        $qry="SELECT * FROM LIKES WHERE post_id=$post_id AND user_id=$user_id";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
        mysqli_close($cn);
        return $data;
      }

      public static function home_posts(){
        $qry="SELECT * FROM USERS JOIN POSTS ON POSTS.user_id=USERS.id ORDER BY POSTS.created_at DESC";
        require_once("config.php");
        $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
        $result=mysqli_query($cn,$qry);
        mysqli_close($cn);
        return $result;

      }
    }
  
  class Subscriber extends User{
    public $role ="subscriber";
    public static function register($name,$email,$password,$phone){
      $qry="INSERT INTO USERS(name,email,password,phone) VALUES('$name','$email','$password','$phone')";
      require_once('config.php');
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      mysqli_close($cn);
      return $result;
    }
  }

  class Admin extends User{
    public $role = "admin";
    public function get_all_users(){
      $qry="SELECT * FROM USERS ORDER BY created_at";
      require_once('config.php');
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
      mysqli_close($cn);
      return $data;
    }
    public static function delete_account($user_id){
      $qry="DELETE FROM USERS WHERE id=$user_id";
      require_once('config.php');
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      mysqli_close($cn);
      return $result;
    }
    public static function ban_account($user_id){
      $qry="UPDATE USERS SET isBanned=!(select isBanned from users where id =$user_id) WHERE id=$user_id";
      require_once('config.php');
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      mysqli_close($cn);
      return $result;
    }
    public static function total_posts(){
      $qry="SELECT * FROM POSTS ORDER BY created_at DESC";
      require_once("config.php");
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
      mysqli_close($cn);
      return $data;
    }
    public static function total_likes(){
      $qry="SELECT * FROM LIKES ";
      require_once("config.php");
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
      mysqli_close($cn);
      return $data;
    }
    public function total_comments(){
      $qry="SELECT * FROM COMMENTS ";
      require_once("config.php");
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      $data=mysqli_fetch_all($result,MYSQLI_ASSOC);
      mysqli_close($cn);
      return $data;
    }
    public static function delete_post($post_id){
      $qry="DELETE FROM POSTS WHERE id=$post_id";
      require_once("config.php");
      $cn=mysqli_connect(DB_HOST_NAME,DB_USER_NAME,DB_USER_PASSWORD,DB_NAME);
      $result=mysqli_query($cn,$qry);
      mysqli_close($cn);
      return $result;

    }

  }