<?php
    require './database/connect.php';
    session_start();

    $rate = $_POST['rate'];
    $id_product = $_POST['id'];
    $id_user = $_POST['id_user'];
    $order_id = $_POST['order_id'];
    $sql = "insert into votes(product_id, user_id, rating)
    values('$id_product', '$id_user','$rate')";
    $result = mysqli_query($connect, $sql);

    $_SESSION['success'] = 'Đánh giá thành công';
    header('location:./order_product.php?order_id='.$order_id);
?>