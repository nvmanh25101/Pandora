<?php

session_start();

if (empty($_POST['last_name']) || empty($_POST['first_name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['birthday']) || empty($_POST['phonenumber']) || empty($_POST['address']) || empty($_POST['address_last'])) {
    $_SESSION['error'] = 'Bạn chưa điền đủ thông tin!';
    header('location:signup.php');
    exit();
}

$name = $_POST['first_name'] . ' ' . $_POST['last_name'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];
$email = $_POST['email'];
$pass = $_POST['password'];
$phone = $_POST['phonenumber'];
$address = $_POST['address'];
$address_last = $_POST['address_last'];
$address .= ', '.$address_last;

require './database/connect.php';

$sqlEmail = "SELECT * FROM users WHERE email = '$email' ";
$resultEmail = mysqli_query($connect, $sqlEmail);
if (mysqli_num_rows($resultEmail) > 0) {
    $_SESSION['error'] = "Email này đã được đăng ký!";
    header("location:signup.php");
    exit();

} elseif (strlen($pass) < 6) {
    $_SESSION['error'] = "Mật khẩu phải có ít nhất 6 ký tự!";
    header("location:signup.php");
    exit();
} 

    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $token_verification = uniqid() . time();
    $sqlInsert = "INSERT INTO users(name,gender, birth_date, email, password, phone, address, token_verification) 
                VALUES('$name', $gender, '$birthday', '$email', '$pass_hash', '$phone', '$address', '$token_verification')";

    $resultInsert = mysqli_query($connect, $sqlInsert);

    require './mail/mail.php';
//    "http://" .
    $url  =  $_SERVER['HTTP_HOST'] . "/pandora/mail";
    $link = "<a href='$url/email_verification.php?email=$email&token=$token_verification'>Kích hoạt tài khoản</a>";
    sendmail($email, $name, $link);

    if (isset($resultInsert) > 0) {
        $_SESSION['error'] = "Vui lòng kiểm tra email!";
        header("location: signin.php");
        exit();
    } else {
        $_SESSION['error'] = "Đăng ký thất bại!";
        header("location: signup.php");
    }
mysqli_close($connect);

?>