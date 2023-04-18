<?php
session_start();
if (isset($_POST['btnSignin'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    require './database/connect.php';

    $sql = "SELECT * FROM users where email = '$email'";
    $result = mysqli_query($connect, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $name = $row['name'];
        $pass_hash = $row['password'];
        if ($row['status'] == 1) {
            if (password_verify($pass, $pass_hash)) {
                $_SESSION['id'] = $id;
                $_SESSION['name'] = $name;
                $_SESSION['role'] = $row['role'];
                $_SESSION['success'] = "Đăng nhập thành công!";
                header("location:index.php");
            } else {
                $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu!";
                header("location:signin.php");
            }
        }
        else {
            $_SESSION['infor'] ="Kiểm tra email của bạn để xác thực tài khoản!";
            header("location:signin.php");
        }
    }
    else{
        $_SESSION['error'] = "Sai tài khoản hoặc mật khẩu";
        header("location:signin.php");
        }
    } else {
        header("location: signin.php");
    }

    ?>