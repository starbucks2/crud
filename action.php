<?php
    session_start();
    include 'config.php';
 
    $update=false;
    $id="";
    $Fullname="";
    $Email="";
    $Contact="";
    $Photo="";
 
    if(isset($_POST['add'])){
        $Fullname=$_POST['Fullname'];
        $Email=$_POST['Email'];
        $Contact=$_POST['Contact'];
        $Photo=$_FILES['image']['name'];
        $upload="uploads/".$Photo;
 
        $query="INSERT INTO crud(Fullname,Email,Contact,photo)VALUES(?,?,?,?)";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("ssss",$Fullname,$Email,$Contact,$upload);
        $stmt->execute();
        move_uploaded_file($_FILES['image']['tmp_name'], $upload);
 
        header('location:crud.php');
        $_SESSION['response']="Successfully Save to the database!";
        $_SESSION['res_type']="success";
    }
    if(isset($_GET['delete'])){
        $id=$_GET['delete'];
 
        $sql="SELECT Photo FROM crud WHERE id=?";
        $stmt2=$conn->prepare($sql);
        $stmt2->bind_param("i",$id);
        $stmt2->execute();
        $result2=$stmt2->get_result();
        $row=$result2->fetch_assoc();
 
        $imagepath=$row['Photo'];
        unlink($imagepath);
 
        $query="DELETE FROM crud WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
 
        header('location:crud.php');
        $_SESSION['response']="Successfully Deleted!";
        $_SESSION['res_type']="danger";
    }
    if(isset($_GET['edit'])){
        $id=$_GET['edit'];
 
        $query="SELECT * FROM crud WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();
 
        $id=$row['id'];
        $Fullname=$row['Fullname'];
        $Email=$row['Email'];
        $Contact=$row['Contact'];
        $Photo=$row['Photo'];
 
        $update=true;
    }
    if(isset($_POST['update'])){
        $id=$_POST['id'];
        $Fullname=$_POST['Fullname'];
        $Email=$_POST['Email'];
        $Contact=$_POST['Contact'];
        $oldimage=$_POST['oldimage'];
 
        if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
            $newimage="uploads/".$_FILES['image']['name'];
            unlink($oldimage);
            move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
        }
        else{
            $newimage=$oldimage;
        }
        $query="UPDATE crud SET Fullname=?,Email=?,Contact=?,Photo=? WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("ssssi",$Fullname,$Email,$Contact,$newimage,$id);
        $stmt->execute();
 
        $_SESSION['response']="Updated Successfully!";
        $_SESSION['res_type']="primary";
        header('location:crud.php');
    }
 
    if(isset($_GET['details'])){
        $id=$_GET['details'];
        $query="SELECT * FROM crud WHERE id=?";
        $stmt=$conn->prepare($query);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result=$stmt->get_result();
        $row=$result->fetch_assoc();
 
        $vid=$row['id'];
        $vFullname=$row['Fullname'];
        $vEmail=$row['Email'];
        $vContact=$row['Contact'];
        $vPhoto=$row['Photo'];
    }
?>