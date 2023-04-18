<?php
session_start();
if(!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Vui lòng đăng nhập để sử dụng giỏ hàng!";
    header("location:signin.php");
    exit();
}
