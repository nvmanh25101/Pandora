<?php
require_once '../check_admin_signin.php';

try {
//    if (empty($_POST['id']) || empty($_POST('size'))) {
//        throw new Exception("Phải chọn để xóa!");
//    }
//
//    if ($_POST['admin_id'] != $_SESSION['id'] || $_SESSION['role'] != 2) {
//        throw new Exception("Bạn không có quyền xóa trang sức này!");
//    }

    $id = $_POST['id'];
    $size = $_POST['size'];
    $admin_id = $_POST['admin_id'];
    require_once '../../database/connect.php';

    $sql = "update product_size
    set quantity = 0
    where product_id = '$id' and size_id = '$size'";
    mysqli_query($connect, $sql);

    $sql = "SELECT SUM(quantity) AS SUM FROM product_size
    WHERE product_id = '$id'";
    $result = mysqli_query($connect, $sql);
    $sum = mysqli_fetch_assoc($result)['SUM'];
    if ($sum == 0) {
        $sql = "update products
        set products.status = 0 
        where products.id = '$id' and products.user_id = '$admin_id'";
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