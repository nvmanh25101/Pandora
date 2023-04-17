<?php  
    session_start();
    $id = $_POST['id'];
    $name = $_POST['name'];
    $birth_date = $_POST['birth_date'];
    $pass = $_POST['password'];
    $address = $_POST['address'];
    $address_last = $_POST['address_last'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address .= ', '.$address_last;

    require './database/connect.php';

    if($pass==""){
        $sql = "UPDATE users 
        SET name = '$name', gender = '$gender', birth_date = '$birth_date', phone = '$phone', address = '$address' 
        WHERE id = '$id'";
        $result = mysqli_query($connect,$sql);
        $_SESSION['success'] = "Cập nhật thành công!";
        header("location: update_in4.php");
    }else{
        if(strlen($pass) < 6){
            $errorpass = "Mật khẩu phải có ít nhất 6 kí tự";
            header("location:update_in4.php?errorpass=$errorpass");
        }else{
            $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET name = '$name' , address = '$address',phone = '$phone', gender = '$genderId', password = '$pass_hash' WHERE id = '$id'";
    
            $result = mysqli_query($connect,$sql);
            if(isset($result) > 0){
                $_SESSION['success'] = "Cập nhật thành công!";
                header("location: update_in4.php");
            }else{
                $error1 = "Cập nhật thất bại!";
                header("location: update_in4.php?error1=$error1");
            }
        }
    }
    
?>