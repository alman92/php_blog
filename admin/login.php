<?php
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
