<?php

$connect = mysqli_connect('localhost', 'root', '', 'pandora');
mysqli_set_charset($connect, 'utf8');
if(!$connect) {
    die("Kết nối thất bại. Vui lòng kiểm tra lại các thông tin máy chủ");
}