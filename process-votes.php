<?php
    require './database/connect.php';
    session_start();

    $rate = $_POST['rate'];
    $id_product = $_POST['id'];
    $id_user = $_POST['id_user'];

    $sql = "insert into votes(product_id, user_id, rating)
    values('$id_product', '$id_user','$rate')";
    $result = mysqli_query($connect, $sql);

    $_SESSION['success'] = 'Đặt hàng thành công';
    header('location:./index.php');
?>