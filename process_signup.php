<?php
session_start();
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password'])) {
    $_SESSION['error'] = 'Bạn chưa điền đủ thông tin!';
    header('location:signup.php');
    exit();
}
if($_FILES['image']['size'] > 0) {
    $image = $_FILES['image'];
    $file_extension = explode('.', $image['name'])[1]; 
    $file_type = array("jpg", "jpeg", "png");

    if(!in_array("$file_extension", $file_type)) {
        $_SESSION['error'] = 'Chỉ cho phép file dạng .JPG, .PNG, .JPEG'; 
        header('location:signup.php');
        exit();
    }

    if ($image["size"] > 1000000) {
        $_SESSION['error'] = 'File của bạn quá lớn!'; 
        header('location:signup.php');
        exit();
    }

    $file_name = 'user_' . time() . '.' . $file_extension; 
    $folder = './assets/images/users/';
    $path_file = $folder . $file_name;
    move_uploaded_file($image['tmp_name'], $path_file);
}
else {
    $file_name = 'no_avatar.png';
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

require_once './database/connect.php';
$sql = "select count(*) from users where email = '$email'";
$result = mysqli_query($connect, $sql);
$num_rows = mysqli_fetch_array($result)['count(*)'];

if($num_rows == 1) {
    $_SESSION['error'] = 'Email này đã được đăng ký!';
    header('location:signup.php');
    exit();
}

$password_hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "insert into users(name, image, email, password, token_verification)
values(?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connect, $sql);
if($stmt) {
    $token_verification = uniqid() . time();
    mysqli_stmt_bind_param($stmt, 'sssss', $name, $file_name, $email, $password_hash, $token_verification);
    mysqli_stmt_execute($stmt);

    require './mail/mail.php';
    $url  = "http://" . $_SERVER['HTTP_HOST'] . "/mail";
    $link = "<a href='$url/email_verification.php?email=$email&token=$token_verification'>Kích hoạt tài khoản</a>";
    sendmail($email, $name, $link);
    $_SESSION['success'] = 'Vui lòng kiểm tra email';
}
else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
}


mysqli_stmt_close($stmt);
mysqli_close($connect);

header('location:signup.php');