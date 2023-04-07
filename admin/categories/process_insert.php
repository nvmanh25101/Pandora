<?php
require_once '../check_super_admin_signin.php';

if(empty($_POST['name'])) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin'; 
    header('location:index.php');
    exit();
}

$name = $_POST['name'];

$file_name = '';
if ($_FILES['image']['size'] !== 0) {
    $image = $_FILES['image'];
    // Ảnh
    $folder = '../../assets/images/categories/';
    $path = $image['name'];
    $file_extension = pathinfo($path, PATHINFO_EXTENSION);
    $file_type = array("jpg", "jpeg", "png");

    if ($image["size"] > 1000000) {
        $_SESSION['error'] = 'File của bạn quá lớn!';
        header('location:form_insert.php');
        exit();
    }

    if(!in_array((string) $file_extension, $file_type)) {
        $_SESSION['error'] = 'Chỉ cho phép file dạng .JPG, .PNG, .JPEG';
        header('location:form_insert.php');
        exit();
    }

    $file_name = 'category_' . time() . '.' . $file_extension;
    $path_file = $folder . $file_name;
    move_uploaded_file($image['tmp_name'], $path_file);
}

require_once '../../database/connect.php';

$sql = "insert into categories(name, image)
values(?, ?)";

$stmt = mysqli_prepare($connect, $sql);
if($stmt) {
    mysqli_stmt_bind_param($stmt, 'ss', $name, $file_name);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = 'Đã thêm thành công';
}
else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
    header('location:index.php');
    exit();
}


mysqli_stmt_close($stmt);
mysqli_close($connect);

header('location:index.php');