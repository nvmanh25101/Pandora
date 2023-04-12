<?php 

require './database/connect.php';
require 'check_user_cart.php';
session_start();

$id = $_POST['product_id'];
$size = $_POST['size'];
$sql = "select name from sizes where id = $size";
$result = mysqli_query($connect, $sql);
$size_id = mysqli_fetch_array($result)['name'];
$color = $_POST['color'];
$material = $_POST['material'];
$quantity = 1;

$sql = "select * from products
  where id = $id";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

$user_id = $_SESSION['id'];
$sql = "select * from carts where user_id = $user_id";
$result = mysqli_query($connect, $sql);
$cart = mysqli_fetch_array($result);
$cart_id = 0;
if(isset($cart['id'])) {
  $cart_id = $cart['id'];
}
if(mysqli_num_rows($result) == 0) {
  $sql = "insert into carts(user_id)
  values('$user_id')";

  $result = mysqli_query($connect,$sql);
  $cart_id = mysqli_insert_id($connect);
}

$sql = "insert into cart_item(cart_id, product_id, size, color, material, quantity)
values('$cart_id', '$id', '$size_id', '$color', '$material', '$quantity')";
mysqli_query($connect, $sql);
$error = mysqli_errno($connect);
// print_r($error);
// header('location:cart.php');
// $action = $_GET['action'] ?? 'add';


// $quantity = $_GET['quantity'] ?? 1;
// //session_destroy();
// //die();
// if($quantity <= 0){
//   unset($_SESSION['cart'][$id]['quantity']);
// }

// $item = [
//   'id' =>$each['id'],
//   'user_id' =>$each['user_id'],
//   'name' => $each['name'],
//   'image' => $each['image'],
//   'size' => $each['size'],
//   'price' => $each['price'],
//   'quantity' => $quantity

// ];

// if($action === 'add'){

//     if(isset($_SESSION['cart'][$id])){
//        $_SESSION['cart'][$id]['quantity'] += $quantity;
//       }
//     else {
//        $_SESSION['cart'][$id] = $item;
//          }
// }
// if($action === 'delete'){

// unset($_SESSION['cart'][$id]);
//  }
// if($action === 'update'){
// $_SESSION['cart'][$id]['quantity'] = $quantity;
// }




?>