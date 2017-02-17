<?php
session_start();
//If the session user_id is not set from the login page, kick the user out to login
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
}
include('../includes/db_connect.php');
//post record count
$post_count = $db->query("SELECT * FROM posts");
//* is everything
//comment count
$comment_count = $db->query("SELECT * FROM comments");
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/style.css"/>
  </head>
  <body>
    <div id="container">
      <div id="menu">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="new_post.php">Create New Post</a></li>
          <li><a href="#">Delete Post</a></li>
          <li><a href="logout.php">Logout</a></li>
          <li><a href="#">Blog Homepage</a></li>
        </ul>
      </div>
      <div id="mainContent">
        <table>
          <tr>
            <td>Total Blog Post</td>
            <td><?php echo $post_count->num_rows; ?></td>
          </tr>
          <tr>
            <td>Total Comments</td>
            <td><?php echo $comment_count->num_rows ?></td>
          </tr>
        </table>

      </div>
    </div>
  </body>
</html>
