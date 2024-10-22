<?php
  include 'action.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD WITH EMAIL & SMS NOTIFICATION</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script type='text/javascript' src='scripts/simple.js'></script>
 
        <!-- Include meta tag to ensure proper rendering and touch zooming -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Include jQuery Mobile stylesheets -->
        <link rel="stylesheet" href="../jquery/jquery.mobile-1.4.5.min.css">

        <!-- Include the jQuery library -->
        <script src="../jquery/jquery-1.11.3.js"></script>

        <!-- Include the jQuery Mobile library -->
        <script src="../jquery/jquery.mobile-1.4.5.min.js">
    </script>
    <style>
      @media pirnt{
  #printButton{
    display: none;
   
  }
}
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center text-dark mt-2">CRUD WITH EMAIL & SMS NOTIFICATION</h3>
            <hr>
            <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?php echo  $_SESSION['res_type']; ?> alert-dismissible text-center">
              <b><?php echo  $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?>
        </div>
    </div>
     
    <div class="row justify-content-center">
      <div class="col-md-6 mt-3 bg-info p-4 rounded">
        <h2 class="bg-light p-2 rounded text-center text-dark">ID : <?php echo  $vid; ?></h2>
        <div class="text-center">
          <img src="<?php echo  $vPhoto; ?>" width="200" class="img-thumbnail">
        </div>
        <h4 class="text-light">FullName : <?php echo  $vFullname; ?></h4>
        <h4 class="text-light">Email : <?php echo  $vEmail; ?></h4>
        <h4 class="text-light">Contact : <?php echo  $vContact; ?></h4>
        <center>
        <br><button class="btn btn-sm btn-flat btn-success" id ="printButton"onclick="window.print()">Print</button>
        </center>
      
      </div>
      <center>
        <a href="crud.php"> <p> Back</p></a>
      </center>
    </div>
</div>
</body>
</html>