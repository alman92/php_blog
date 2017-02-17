<?php
  //session starts at login and stays logged in
  session_start();
  if(isset($_POST['submit'])){
    //get usename and password and store in variable
    $user = $_POST['username'];
    $password = $_POST['password'];
    //include database connection
    include("../includes/db_connect.php");
    if(empty($user) || empty($password)){
      echo "Missing Login Information";
    }else{
      $user = strip_tags($user);
      //^^prevent hacking
      $user = $db->real_escape_string($user);
      //^^prevents bad sql injectons
      $password = strip_tags($password);
      $password = $db->real_escape_string($password);
      //password must match encryption technique set up in mysql
      $password = md5($password);
      //query's the sql database where user info matches
      $query = $db->query("SELECT user_id, username FROM user WHERE username='$user' AND password='$password'");
      if($query->num_rows ===1){
        while($row = $query->fetch_object()){
          $_SESSION['user_id'] = $row->user_id;
        }
        header('Location: index.php');
        exit();
      }else {
        echo "Yadda";
      }
    }
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script src="jquery-3.1.1.min.js"></script>
  </head>
  <body>
    <div id="container">
      <form action="login.php" method="post">
        <p>
          <label>Username</label><input type="text" name="username"/>
        </p>
        <p>
          <label>Password</label><input type="password" name="password"/>
        </p>
        <input type="submit" name="submit" value="Login"/>
      </form>
    </div>

  </body>
</html>
