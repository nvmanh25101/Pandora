<?php

session_start();
// empty kiểm tra trống, = 0
if(empty($_SESSION['role']) || $_SESSION['role'] != 2) {
    $_SESSION['error'] = 'Bạn không đủ quyền để truy cập';
    header('location:../root/index.php');
    exit();
}