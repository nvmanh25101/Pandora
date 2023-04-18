<?php

session_start();
require_once './database/connect.php';

$cart_id = $_GET['cart_id'];
$product_id = $_GET['product_id'];
$type = $_GET['type'];

$sql = "select size, quantity from cart_item where cart_id = $cart_id and product_id = $product_id";
$result = mysqli_query($connect, $sql);
$item = mysqli_fetch_array($result);
$quantity = $item['quantity'];
$size = $item['size'];

$sql = "select quantity from product_size
        join sizes on product_size.size_id = sizes.id
        where product_id = $product_id and sizes.name like '$size'";
$result_stock = mysqli_query($connect, $sql);
$stock = mysqli_fetch_assoc($result_stock)['quantity'];

if($type === 'decre') {
    if($quantity > 1) {
        $sql = "update cart_item
        set quantity = quantity - 1
        where cart_id = '$cart_id' and product_id = '$product_id'";
        mysqli_query($connect, $sql);
    } else {
        $sql = "delete from cart_item
        where cart_id = $cart_id and product_id = $product_id";
        mysqli_query($connect, $sql);
    }
} elseif($stock > $quantity && $type === 'incre') {
    $sql = "update cart_item
    set quantity = quantity + 1
    where cart_id = $cart_id and product_id = $product_id";
    mysqli_query($connect, $sql);
} else {
    $_SESSION['error'] = 'Sản phẩm đã hết hàng';
}

header('location:cart.php');