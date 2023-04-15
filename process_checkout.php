<?php
session_start();
require './database/connect.php';


if(empty($_SESSION['id'])){
  header('location:./signin.php');
  exit();
}

if(empty($_POST['name_receiver']) || empty($_POST['phone_receiver']) || empty($_POST['address_receiver'])) {
    header('location:checkout.php');
    exit;
}

$user_id = $_SESSION['id'];
$name_receiver = $_POST['name_receiver'];
$address_receiver = $_POST['address_receiver'];
$phone_receiver = $_POST['phone_receiver'];
$note = $_POST['note'];
$address_last = $_POST['address_last'];
$payment = $_POST['payment'];

$address_receiver .= ', '.$address_last;

$sql = "select id from carts where user_id = $user_id";
$result = mysqli_query($connect, $sql);
$cart_id = mysqli_fetch_array($result)['id'];

$sql = "select sum(quantity * price) as sum_price from cart_item 
        join products
        on products.id = cart_item.product_id
        WHERE cart_item.cart_id = $cart_id;";
$result_total = mysqli_query($connect, $sql);
$total_price = mysqli_fetch_array($result_total)['sum_price'];

$status = 0;


$sql = "insert into orders(name_receiver, phone_receiver, address_receiver,  status, total_price, payment_id, note, user_id, cart_id) 
values('$name_receiver', '$phone_receiver', '$address_receiver',  '$status', '$total_price', '$payment', '$note', '$user_id', '$cart_id')";

mysqli_query($connect, $sql);
$last_order_id = mysqli_insert_id($connect);

$sql = "select cart_item.*, products.name, products.price from cart_item
         join products
         on products.id = cart_item.product_id
         where cart_id = $cart_id";
$cart_item = mysqli_query($connect, $sql);
foreach ($cart_item as $key => $value) :
    $product_id = $value['product_id'];
    $quantity = $value['quantity'];
    $name = $value['name'];
    $price = $value['price'];
    $size = $value['size'];
    $color = $value['color'];
    $material = $value['material'];
    $sql = "insert into order_detail(order_id, product_id, name, size, color, material, quantity, price) 
    values('$last_order_id', '$product_id', '$name', '$size', '$color', '$material', '$quantity', '$price')";
    mysqli_query($connect, $sql);
endforeach;

$sql = "delete from cart_item where cart_id = $cart_id";
mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = 'Đặt hàng thành công';
header('location:./index.php');