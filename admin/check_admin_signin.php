<?php

session_start();
//die(var_dump($_SESSION['role'] != 2));
if(empty($_SESSION['role'])) {
    $_SESSION['error'] = 'Bạn không đủ quyền để truy cập!';
    header('location:../index.php');
    exit();
}