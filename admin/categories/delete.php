<?php 
    require_once '../check_super_admin_signin.php';
if(empty($_GET['id'])) {
    $_SESSION['error'] = 'Phải chọn để xóa';
    header('location:index.php');
    exit();
}

$id = $_GET['id'];

require_once '../../database/connect.php';
$sql = "update categories 
set status = 0
where id = '$id'";

mysqli_query($connect, $sql);

$sql = "update products
set status = 0
where category_child_id in 
      (select id from category_child
                 join categories
                 on categories.id = category_child.category_id
                 where categories.id = '$id' and categories.status = 0)";
$error = mysqli_error($connect);
mysqli_close($connect);

if(empty($error)) {
    $_SESSION['success'] = 'Đã xóa thành công';
} else {
    $_SESSION['error'] = 'Không thể xóa!';
}
header('location:index.php');
