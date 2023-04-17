<?php

    require './database/connect.php';
    require './check_user_cart.php';

    $id = $_POST['product_id'];

    if (empty($_POST['size']) || empty($_POST['color']) || empty($_POST['material'])) {
        $_SESSION['error'] = 'Vui lòng chọn size, màu sắc và chất liệu';
        header('location:product.php?id=' . $id);
        exit();
    }
    $size = $_POST['size'];
    $sql = "select name from sizes where id = $size";
    $result = mysqli_query($connect, $sql);
    $size_id = mysqli_fetch_array($result)['name'];

    $color = $_POST['color'];
    $material = $_POST['material'];
    $quantity = 1;

    $user_id = $_SESSION['id'];
    $sql = "select * from carts where user_id = $user_id";
    $result = mysqli_query($connect, $sql);
    $cart = mysqli_fetch_array($result);
    $cart_id = $cart['id'] ?? 0;
    if (mysqli_num_rows($result) === 0) {
        $sql = "insert into carts(user_id)
          values('$user_id')";

        $result = mysqli_query($connect, $sql);
        $cart_id = mysqli_insert_id($connect);
    }

    $sql = "select * from cart_item where cart_id = $cart_id and product_id = $id";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) === 0) {
        $sql = "insert into cart_item(cart_id, product_id, size, color, material, quantity)
          values('$cart_id', '$id', '$size_id', '$color', '$material', '$quantity')";
        mysqli_query($connect, $sql);
    } else {
        $sql = "update cart_item
          set quantity = quantity + 1
          where cart_id = $cart_id and product_id = $id";
        mysqli_query($connect, $sql);
    }

    mysqli_close($connect);
    header('location:cart.php');

?>