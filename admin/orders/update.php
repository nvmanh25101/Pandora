<?php
  require_once '../check_admin_signin.php';
try {
    if (empty($_POST['id'])) {
        throw new Exception("Chọn đơn hàng để cập nhật!");
    }

  $id = $_POST['id'];
  $status = $_POST['status'];
  
  require_once '../../database/connect.php';

  if (isset($_POST['admin_id'])){
    $user_admin_id = $_POST['admin_id'];
    $sql = "update orders
    set status = '$status', 
        user_admin_id = '$user_admin_id'
    where id = '$id'";
  } else {
      $sql = "select user_admin_id from orders where id = '$id'";
        $result = mysqli_query($connect, $sql);
        $admin = mysqli_fetch_array($result);
        $user_admin_id = $admin['user_admin_id'];
      if($user_admin_id != $_SESSION['id'] || $_SESSION['role'] != 2) {
          throw new Exception("Bạn không có quyền để truy cập!!");
      } else {
          $sql = "update orders
            set status = '$status'
            where id = '$id'";
      }
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