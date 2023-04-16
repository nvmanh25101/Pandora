<?php
require_once '../check_super_admin_signin.php';

try {
    if (empty($_POST['id'])) {
        throw new Exception("Chọn loại để xóa!");
    }

    $id = $_POST['id'];

    require_once '../../database/connect.php';

    $sql = "update categories 
    set status = 0
    where id = '$id'";

    mysqli_query($connect, $sql);

    $sql = "update products
    set status = 0
    where category_child_id in 
          (select category_child.id from category_child
                     join categories
                     on categories.id = category_child.category_id
                     where categories.id = '$id' and categories.status = 0)";

    mysqli_query($connect, $sql);
    if (mysqli_error($connect)) {
        throw new Exception("Đã xảy ra lỗi, vui lòng thử lại sau!");
    }
    mysqli_close($connect);
    echo 1;
} catch (Throwable $e) {
    echo $e->getMessage();
}