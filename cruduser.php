<?php
  include 'actions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD WITH EMAIL  NOTIFICATION</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <style>
    @media print{
  #printButton{
    display: none;
   
  }
}
  </style>
</head>
<body>
  <center>
<img src="src.jfif" width="70px" height="70px">	
</center>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center text-dark mt-2">CRUD WITH EMAIL NOTIFICATION</h3>
            <hr>
            <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?php echo  $_SESSION['res_type']; ?> alert-dismissible text-center">
              <b><?php echo  $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?>
        </div>
    </div>
        <div class="col-md-8">
            <?php
              $query = 'SELECT * FROM crud';
              $stmt = $conn->prepare($query);
              $stmt->execute();
              $result = $stmt->get_result();
            ?>
            <div class="card">
            <div class="card-header">
                Record
            </div>
            <div class="card-body">
            <table class="table table-bordered table-striped table-hover" id="data-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Image</th>
                  <th>Fullname</th>
                  <th>Email</th>
                  <th>Contact</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                  <td><?php echo  $row['id']; ?></td>
                  <td><img src="<?php echo  $row['Photo']; ?>" width="100"></td>
                  <td><?php echo  $row['Fullname']; ?></td>
                  <td><?php echo  $row['Email']; ?></td>
                  <td><?php echo  $row['Contact']; ?></td>
                  <td>
                  <a href="editcrud.php?edit=<?php echo  $row['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                    <br><a href="detailsuser.php?details=<?php echo  $row['id']; ?>" class="btn btn-primary btn-sm">Details</a> | |
                    <button class="btn btn-sm btn-flat btn-success" id ="printButton"onclick="window.print()">Print</button>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#data-table').DataTable({
      paging: true
    });
  });
  
</script>
<center>
    <a href="index.php"><h2>Log Out</h2></a>
</center>
</body>
</html>