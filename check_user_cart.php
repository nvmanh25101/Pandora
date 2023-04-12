<?php
session_start();
if(!isset($_SESSION['id'])) {
    $error = "Vui lòng đăng nhập!";
    header("location:signin.php?error=$error");

}
?>