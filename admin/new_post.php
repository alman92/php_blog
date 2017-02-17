<?php
  session_start();
  include('../includes/db_connect.php');
  if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit();
  }
  if(isset($_POST['submit'])){
    //get the blog data
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category = $_POST['category'];
    $title = $db->real_escape_string($title);
    $body = $db->real_escape_string($body);
    $user_id = $_SESSION['user_id'];
    $date = date('Y-m-d G:i:s'); //year-month-day hour:minutes:seconds
    $body = htmlentities($body); //save space in the database
    //If statement to check and see if all information is filled in
    if($title && $body && $category){
      $query = $db->query("INSERT INTO posts (user_id, title, body, category_id, posted) VALUES('$user_id', $title', $body', $category', '$date')");
      //Posts user input into database
      if($query){
        echo "post added";
      }else {
        echo "error";
      }
    }else{
      echo "missing data";
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
     <div id="wrapper">
       <div id="content">
         <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
         <br>
           Title:<input type="text" name="title"/>
           <br>
           <label for="body">Body:</label><textarea name="body" rows="10" cols="50"></textarea>
         <br>
           Category: <select name="category">
             <?php
              $query = $db->query("SELECT * FROM categories");
              while($row=$query->fetch_object()){
                echo "<option value='".$row->category_id."'>".$row->category."</option>";
              }
              ?>
           </select>
           <input type="submit" name="submit" value="Submit">
         </form>
       </div>
     </div>

   </body>
 </html>
