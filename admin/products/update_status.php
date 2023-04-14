<?php 
    require_once '../check_admin_signin.php';

if(empty($_GET['id'])) {
    $_SESSION['error'] = 'Phải chọn trang sức để mở bán';
    header('location:index.php');
    exit();
}
  
if($_GET['admin_id'] != $_SESSION['id'] || $_SESSION['role'] != '2') {
    $_SESSION['error'] = 'Bạn không có quyền để truy cập';
    header('location:index.php');
    exit();
}

$id = $_GET['id'];
$admin_id = $_GET['admin_id'];
require_once '../../database/connect.php';

$sql = "select categories.status from categories
join category_child
on categories.id = category_child.category_id
join products
on products.category_child_id = category_child.id
where products.id = '$id'";
$result = mysqli_query($connect, $sql);
$category_status = mysqli_fetch_assoc($result)['status'];
if ($category_status == 0) {
    $_SESSION['error'] = 'Không thể mở bán trang sức này vì loại chứa trang sức này đã bị xóa';
    header('location:index.php');
    exit();
}

$sql = "update products
set status = 1
where id = '$id' and user_id = '$admin_id'";

mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = 'Đã mở bán thành công';
header('location:index.php');
