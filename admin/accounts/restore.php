<?php
require_once '../check_super_admin_signin.php';

if(empty($_GET['id'])) {
    $_SESSION['error'] = 'Phải chọn nhân viên';
    header('location:index.php');
    exit();
}

$id = $_GET['id'];
require_once '../../database/connect.php';

$sql = "update users
set deleted_at = null
where id = '$id'";

mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = 'Đã mở thành công';
header('location:index.php');
