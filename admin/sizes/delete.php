<?php
require_once '../check_super_admin_signin.php';
try {

    if (empty($_POST['id'])) {
        throw new Exception('Phải chọn để xóa');
    }

    $id = $_POST['id'];

    require_once '../../database/connect.php';
    $sql = "delete from sizes where id = '$id'";

    $success = mysqli_query($connect, $sql);
    if (!$success) {
        throw new Exception("Kích thước này vẫn chứa trang sức. Không thể xóa!", 9999);
    }
    mysqli_close($connect);

    echo 1;

} catch (Throwable $e) {
    if ($e->getCode() == 1451) {
        echo 'Kích thước này vẫn chứa trang sức. Không thể xóa!';
        exit;
    } else {
        echo $e->getMessage();
    }
}
