<?php
  require_once '../check_admin_signin.php';
try {
    if (empty($_POST['id'])) {
        throw new Exception("Chọn đơn hàng để cập nhật!");
    }

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
    if (mysqli_error($connect)) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    mysqli_close($connect);

    echo 1;
} catch (Throwable $e) {
    echo $e->getMessage();
}