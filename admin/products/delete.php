<?php 
    require_once '../check_admin_signin.php';

if(empty($_GET['id'])) {
    $_SESSION['error'] = 'Phải chọn để xóa';
    header('location:index.php');
    exit();
}
  
if($_GET['admin_id'] != $_SESSION['id'] || $_SESSION['level'] != 2) {
    $_SESSION['error'] = 'Bạn không có quyền để xóa trang sức này';
    header('location:index.php');
    exit();
}

$id = $_GET['id'];
$admin_id = $_GET['admin_id'];
require_once '../../database/connect.php';

$sql = "update products set status = 0 where id = '$id' and user_id = '$admin_id'";

mysqli_query($connect, $sql);
$error = mysqli_errno($connect);
mysqli_close($connect);
if(empty($error)) {
    $_SESSION['success'] = 'Đã xóa thành công';
} else {
    $_SESSION['error'] = 'Không thể xóa trang sức này!';
}

header('location:index.php');
