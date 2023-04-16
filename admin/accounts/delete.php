<?php
require_once '../check_super_admin_signin.php';
try {
    if (empty($_POST['id'])) {
        throw new Exception("Phải chọn để xóa!");

    }

    $id = $_POST['id'];

    require_once '../../database/connect.php';
    $sql = "update users set deleted_at = now() 
             where id = '$id'";

    mysqli_query($connect, $sql);
    if (mysqli_error($connect)) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    mysqli_close($connect);

    echo 1;
} catch (Throwable $e) {
    echo $e->getMessage();
}