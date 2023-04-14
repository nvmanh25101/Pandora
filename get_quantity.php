<?php

$size_id = $_POST['size_id'];
$product_id = $_POST['product_id'];
require_once './database/connect.php';

$sql = "select quantity from product_size where product_id = '$product_id' and size_id = '$size_id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

echo json_encode($each['quantity']);