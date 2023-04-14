<?php
require_once '../check_admin_signin.php';

if(empty($_GET['id'])) {
    $_SESSION['error'] = 'Phải chọn loại trang sức để mở';
    header('location:index.php');
    exit();
}

$id = $_GET['id'];
require_once '../../database/connect.php';

$sql = "update categories
set status = 1
where id = '$id'";

mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = 'Đã mở thành công';
header('location:index.php');
