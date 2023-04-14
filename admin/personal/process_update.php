<?php

require_once '../check_super_admin_signin.php';

if(empty($_POST['id'])) {
    $_SESSION['error'] = 'Không có dữ liệu để sửa!';
    header('location:index.php');
    exit();
}

$id = $_POST['id'];
if(empty($_POST['name']) || empty($_POST['gender']) || empty($_POST['phone'])) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin!';
    header("location:form_update.php?id=$id");
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$image = $_FILES['image'];
$gender = $_POST['gender'];
$birth_date = $_POST['birth_date'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$image_old = $_POST['image_old'];
$image_new = $_FILES['image_new'];

if($image_new['size'] > 0) {
    $folder = '../../assets/images/admin/';
    $path = $image_new['name'];
    $file_extension = pathinfo($path, PATHINFO_EXTENSION);
    $file_name = 'admin_' . time() . '.' . $file_extension; // tránh trùng ảnh
    $path_file = $folder . $file_name;

    move_uploaded_file($image_new['tmp_name'], $path_file);
}
else {
    $file_name = $image_old;
}

require_once '../../database/connect.php';

$sql = "update users
set name = ?,
avatar = ?,
gender = ?,
birth_date = ?,
phone = ?,
address = ?
where id = '$id'";

$stmt = mysqli_prepare($connect, $sql);
if($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssisss', $name, $file_name, $gender, $birth_date, $phone, $address);
    mysqli_stmt_execute($stmt);

    $_SESSION['name'] = $name;
    $_SESSION['image'] = $file_name;
    $_SESSION['success'] = 'Đã sửa thành công';

}
else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
    header("location:form_update.php?id=$id");
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($connect);

header("location:form_update.php?id=$id");