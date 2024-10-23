<?php
  include 'actions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CRUD WITH EMAIL NOTIFICATION</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
 
    
  <style>
* {
  box-sizing: border-box;
}

.row::after {
  content: "";
  clear: both;
  display: table;
}

[class*="col-"] {
  float: left;
  padding: 15px;
}

html {
  font-family: "Lucida Sans", sans-serif;
}

.header {
  background-color: #9933cc;
  color: #ffffff;
  padding: 15px;
}

.menu ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
}

.menu li {
  padding: 8px;
  margin-bottom: 7px;
  background-color: #33b5e5;
  color: #ffffff;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.menu li:hover {
  background-color: #0099cc;
}

.aside {
  background-color: #33b5e5;
  padding: 15px;
  color: #ffffff;
  text-align: center;
  font-size: 14px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
}

.footer {
  background-color: #0099cc;
  color: #ffffff;
  text-align: center;
  font-size: 12px;
  padding: 15px;
}

/* For mobile phones: */
[class*="col-"] {
  width: 100%;
}


@media pirnt{
  #printButton{
    display: none;
   
  }
}
</style>
</head>
<body>
  <center>
<img src="hacker.jpg" width="70px" height="70px">	
</center>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3 class="text-center text-dark mt-2">CRUD WITH EMAIL  NOTIFICATION</h3>
            <hr>
            <?php if (isset($_SESSION['response'])) { ?>
            <div class="alert alert-<?php echo  $_SESSION['res_type']; ?> alert-dismissible text-center">
              <b><?php echo  $_SESSION['response']; ?></b>
            </div>
            <?php } unset($_SESSION['response']); ?>
        </div>
    </div>
     
    <div class="row">
        <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                Add Record
              </div>
              <div class="card-body">
                <form action="actions.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo  $id; ?>">
                  <div class="mb-3">
                    <input type="text" name="Fullname" value="<?php echo  $Fullname; ?>" class="form-control" placeholder="Enter Fullname" required>
                  </div>
                  <div class="mb-3">
                    <input type="email" name="Email" value="<?php echo  $Email; ?>" class="form-control" placeholder="Enter E-mail" required>
                  </div>
                  <div class="mb-3">
                    <input type="tel" name="Contact" value="<?php echo  $Contact; ?>" class="form-control" placeholder="Enter Contact" required>
                  </div>
                  <div class="mb-3">
                    <input type="hidden" name="oldimage" value="<?php echo  $Photo; ?>">
                    <input type="file" name="image" class="custom-file">
                    <img src="<?php echo  $Photo; ?>" width="120" class="img-thumbnail">
                  </div>
                  <div class="mb-3">
                    <?php if ($update == true) { ?>
                    <input type="submit" name="update" class="btn btn-success btn-block" value="Update Record">
                    <?php } else { ?>
                    <input type="submit" name="add" class="btn btn-primary btn-block" value="Add Record">
                    <?php } ?>
                  </div>
                </form>
              </div>
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
                  <th>FullName</th>
                  <th>Email</th>
                  <th>Contact</th>
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
                    <a href="detailsusers.php?details=<?php echo  $row['id']; ?>" class="btn btn-primary btn-sm">Details</a> 
                   
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
    <a href="admin.php"><h2>Log Out</h2></a>
    <a href ="gmail.php"><h2>Email</h2></a>
    <a href="registeradmin.php"><h2>Add Admin </h2></a>
 
</center>
</body>
</html>