<?php

require_once '../check_admin_signin.php';

if (empty($_POST['id']) || empty($_POST['admin_id'])) {
    $_SESSION['error'] = 'Không có dữ liệu để sửa!';
    header('location:index.php');
    exit();
}

if (empty($_POST['name']) || empty($_POST['size'])|| empty($_POST['quantity']) || empty($_POST['color']) || empty($_POST['material']) || empty($_POST['description']) || empty($_POST['price']) || empty($_POST['category']) || empty($_POST['image_old'])) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
    header('location:form_update.php?id='.$_POST['id'].'&admin_id='.$_POST['admin_id']);
    exit();
}

$id = $_POST['id'];
$admin_id = $_POST['admin_id'];
$image_old = $_POST['image_old'];
$image_new = $_FILES['image_new'];
$name = $_POST['name'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$color = $_POST['color'];
$material = $_POST['material'];
$price = $_POST['price'];
$description = $_POST['description'];
$category = $_POST['category'];

if ($image_new['size'] > 0) {
    $folder = '../../assets/images/products/';
    $path = $image_new['name'];
    $file_extension = pathinfo($path, PATHINFO_EXTENSION);
    $file_name = 'jw_'.time().'.'.$file_extension;
    $path_file = $folder.$file_name;

    move_uploaded_file($image_new['tmp_name'], $path_file);
} else {
    $file_name = $image_old;
}

require_once '../../database/connect.php';

$sql = "update products
set name = ?,
color = ?,
material = ?,
image = ?,
price = ?,
description = ?,
category_child_id = ?
where id = '$id' and user_id = '$admin_id'";

$stmt = mysqli_prepare($connect, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssisi', $name, $color, $material, $file_name, $price, $description,
        $category);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = 'Đã sửa thành công';
} else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
    header("location:form_update.php?id=$id&admin_id=$admin_id");
    exit();
}

mysqli_stmt_close($stmt);

$size_quan = array_combine($size, $quantity);

foreach ($size_quan as $size => $quantity) {
    $sql = "select * from sizes where name like '$size'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $size_id = mysqli_fetch_assoc($result)['id'];
        $sql = "select * from product_size where product_id = '$id' and size_id = '$size_id'";
        $product_size = mysqli_query($connect, $sql);
        if (mysqli_num_rows($product_size) > 0) {
            $sql = "update product_size set 
                quantity = $quantity
                where product_id = '$id' and size_id = '$size_id'";
            mysqli_query($connect, $sql);
            continue;
        }
        $sql = "insert into product_size(product_id, size_id, quantity)
            values('$id', '$size_id', '$quantity')";
        mysqli_query($connect, $sql);
        continue;
    }

    $sql = "insert into sizes(name) values ('$size')";
    mysqli_query($connect, $sql);
    $size_id = mysqli_insert_id($connect);

    $sql = "insert into product_size(product_id, size_id, quantity)
        values('$id', '$size_id', '$quantity')";
    mysqli_query($connect, $sql);
}
mysqli_close($connect);

header("location:form_update.php?id=$id&admin_id=$admin_id");