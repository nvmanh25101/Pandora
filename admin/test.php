<?php
$connect = mysqli_connect('localhost', 'root', '', 'pandora');
mysqli_set_charset($connect, 'utf8');
if(!$connect) {
    die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
}

$name = 'admin';
$email = 'admin@gmail.com';
$password = 'adminvjppro';
$gender = 1;
$birth_date = "2001-10-25";
$phone = "0986971670";
$role = 2;
$token_verification = uniqid() . time();
$status = 1;
$address = "Phú Xuyên - Hà Nội";

//require_once '../database/connect.php';

$password_hash = password_hash($password, PASSWORD_DEFAULT);
$sql = "insert into users(name, gender,birth_date, email, password, phone,address,role,token_verification, status)
values('$name',$gender,'$birth_date','$email','$password_hash','$phone','$address', $role,'$token_verification',$status)";
mysqli_query($connect, $sql);
//$stmt = mysqli_prepare($connect, $sql);
//if($stmt) {
//    mysqli_stmt_bind_param($stmt, 'sisssssisi', $name,$gender,$birth_date,$email,$password,$phone,$address,$role,$token_verification,$status);
//    mysqli_stmt_execute($stmt);
//}
//else {
//    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
//}
//
//
//mysqli_stmt_close($stmt);
mysqli_close($connect);
