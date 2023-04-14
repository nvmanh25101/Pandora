<?php
  require_once '../check_admin_signin.php';

  $id = $_POST['id'];
  $status = $_POST['status'];
  
  require_once '../../database/connect.php';

  if (isset($_POST['user_admin_id'])){
    $user_admin_id = $_POST['user_admin_id'];
    $sql = "update orders
    set status = '$status', 
        user_admin_id = '$user_admin_id'
    where id = '$id'";
  } else {
    $sql = "update orders
    set status = '$status'
    where id = '$id'";
  }
  
  mysqli_query($connect, $sql);
  
  header('location:index.php');