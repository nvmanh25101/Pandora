<?php
require_once '../check_admin_signin.php';

if (empty($_POST['name']) || empty($_POST['size']) || empty($_POST['quantity'])  || empty($_POST['color']) || empty($_POST['material']) || empty($_POST['price']) || empty($_POST['category']) || empty($_POST['admin_id']) || $_FILES['image']['size'] === 0) {
    $_SESSION['error'] = 'Phải điền đầy đủ thông tin';
    header('location:form_insert.php');
    exit();
}

$name = $_POST['name'];
$size = $_POST['size'];
$quantity = $_POST['quantity'];
$color = $_POST['color'];
$material = $_POST['material'];
$price = $_POST['price'];
$image = $_FILES['image'];
$description = $_POST['description'];
$category = $_POST['category'];
$admin_id = $_POST['admin_id'];

$price = (float) $price;

if ($price <= 0) {
    $_SESSION['error'] = 'Giá phải lớn hơn 0!';
    header('location:form_insert.php');
    exit();
}

// Ảnh
$folder = '../../assets/images/products/';
$path = $image['name'];
$file_extension = pathinfo($path, PATHINFO_EXTENSION);
$file_type = array("jpg", "jpeg", "png");

if ($image["size"] > 1000000) {
    $_SESSION['error'] = 'File của bạn quá lớn!';
    header('location:form_insert.php');
    exit();
}

if (!in_array((string) $file_extension, $file_type)) {
    $_SESSION['error'] = 'Chỉ cho phép file dạng .JPG, .PNG, .JPEG';
    header('location:form_insert.php');
    exit();
}

$file_name = 'jw_'.time().'.'.$file_extension;
$path_file = $folder.$file_name;
move_uploaded_file($image['tmp_name'], $path_file);

require_once '../../database/connect.php';

$sql = "insert into products(name, color, material, image, price, description, category_child_id, user_id)
values(?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connect, $sql);
if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'ssssisii', $name, $color, $material, $file_name, $price, $description,
        $category, $admin_id);
    mysqli_stmt_execute($stmt);

    $_SESSION['success'] = 'Đã thêm thành công';
} else {
    $_SESSION['error'] = 'Không thể chuẩn bị truy vấn!';
    header('location:form_insert.php');
    exit();
}

mysqli_stmt_close($stmt);

$product_id = mysqli_insert_id($connect);

$size_quan=array_combine($size,$quantity);

foreach ($size_quan  as $size => $quantity) {
        $sql = "select * from sizes where name like '$size'";
        $result = mysqli_query($connect, $sql);
        if (mysqli_num_rows($result) > 0) {
            $size_id = mysqli_fetch_assoc($result)['id'];
            $sql = "insert into product_size(product_id, size_id, quantity)
            values('$product_id', '$size_id', '$quantity')";
            mysqli_query($connect, $sql);
            continue;
        }

        $sql = "insert into sizes(name) values ('$size')";
        mysqli_query($connect, $sql);
        $size_id = mysqli_insert_id($connect);

        $sql = "insert into product_size(product_id, size_id, quantity)
        values('$product_id', '$size_id', '$quantity')";
        mysqli_query($connect, $sql);

}

mysqli_close($connect);

header('location:form_insert.php');