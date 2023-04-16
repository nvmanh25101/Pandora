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


$sql = "update products
set status = 1
where category_child_id in 
      (select category_child.id from category_child
                 join categories
                 on categories.id = category_child.category_id
                 where categories.id = '$id' and categories.status = 1)";
mysqli_query($connect, $sql);

mysqli_close($connect);

$_SESSION['success'] = 'Đã mở thành công';
header('location:index.php');
