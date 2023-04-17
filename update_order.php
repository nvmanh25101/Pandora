<?php

try {
    if (empty($_POST['id'])) {
        throw new Exception("Chọn đơn hàng để cập nhật!");
    }

  $id = $_POST['id'];
  $status = $_POST['status'];
  $user_id = $_POST['user_id'];
  require_once './database/connect.php';

  $sql = "update orders
  set status = '$status'
  where id = '$id' and user_id = '$user_id'";

  mysqli_query($connect, $sql);
    if (mysqli_error($connect)) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    mysqli_close($connect);

    echo 1;
} catch (Throwable $e) {
    echo $e->getMessage();
}