<?php
require_once '../check_super_admin_signin.php';

if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['birth_date']) || empty($_POST['address']) || !isset($_POST['gender']) || empty($_POST['phone']) || $_FILES['image']['size'] == 0 || empty($_POST['role'])) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
    header('location:form_insert.php');
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
$role = $_POST['role'];
$token_verification = uniqid().time();
$status = 1;

$folder = '../../assets/images/admin/';
$path = $image['name'];
$file_extension = pathinfo($path, PATHINFO_EXTENSION);
$file_type = array("jpg", "jpeg", "png");

if (!in_array((string) $file_extension, $file_type)) {
    $_SESSION['error'] = 'Chỉ cho phép file dạng .JPG, .PNG, .JPEG';
    header('location:form_insert.php');
    exit();
}

if ($image["size"] > 500000) {
    $_SESSION['error'] = 'File của bạn quá lớn!';
    header('location:form_insert.php');
    exit();
}

$file_name = 'admin_'.time().'.'.$file_extension; // tránh trùng ảnh
$path_file = $folder.$file_name;

move_uploaded_file($image['tmp_name'], $path_file);

require_once '../../database/connect.php';

$password_hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "insert into users(name, avatar, gender, birth_date, email, password, phone, address, role, token_verification, status)
values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connect, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssisssssisi', $name, $file_name, $gender, $birth_date, $email, $password_hash, $phone,
        $address, $role, $token_verification, $status);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = 'Đã thêm thành công';
} else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
    header('location:form_insert.php');
    exit();
}

mysqli_stmt_close($stmt);
mysqli_close($connect);
header('location:form_insert.php');