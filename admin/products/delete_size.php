<?php

try {
    if(empty($_POST['product']) || empty($_POST['size'])) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    $size_id = $_POST['size'];
    $product_id = $_POST['product'];

    require_once '../../database/connect.php';

    $sql = "delete from product_size
    where product_id = '$product_id' and size_id = '$size_id'";

    mysqli_query($connect, $sql);
    if(mysqli_error($connect)) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    mysqli_close($connect);
    echo 1;
}
catch (Throwable $e) {
    echo $e->getMessage();
}