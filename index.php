<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('location:home1.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>user login </h3>
      <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
      <input type="email" name="email" placeholder="Enter Email" class="box" required>
      <input type="password" name="password" id="pwd" placeholder="Enter Password" class="box" required>
      <input type ="checkbox" id="chk"> Show Password  <br>
      <input type="submit" name="submit" value="login now" class="btn">
      <br><a href="admin.php">Admin Login</a>
      <p>Don't Have an Account? <a href="register.php">Register now</a></p>
   </form>
   <script>
      const pwd = document.getElementById('pwd');
      const chk = document.getElementById('chk');

      chk.onchange = function(e) {
         pwd.type = chk.checked ?"text":"password";
      };
   </script>
</div>

</body>
</html>