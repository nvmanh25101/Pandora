<?php
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $email= $_POST['email'];
        $pass = $_POST['password'];
        $phone = $_POST['phonenumber'];
        require './database/connect.php';

        
        if($gender == 'nam')  { $genderId = 1;}
        else {$genderId = 0;}

        $sqlEmail = "SELECT * FROM users WHERE email = '$email' ";
        $resultEmail = mysqli_query($connect,$sqlEmail);
        if(mysqli_num_rows($resultEmail) > 0){
            $error = "Email already exists. Please enter another email"; 
            header("location:signup.php?error=$error");
        }else{
            if(strlen($pass) < 6){
                $errorpass = "Password must be at least 6 characters long"; 
                header("location:signup.php?errorpass=$errorpass");
            }else{
                $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
                $sqlInsert="INSERT INTO users(name,gender, birth_date, email, password, phone, role_id) 
                    VALUES('$name', $genderId, '$birthday', '$email', '$pass_hash', '$phone',1)";
        
                $resultInsert = mysqli_query($connect,$sqlInsert);
                if(isset($resultInsert) > 0){
                    header("location: signin.php");
                }else{
                    $errorpass = "Registration failed";
                    header("location: signup.php?errorpass=$errorpass");
                }
            }
        }
        mysqli_close($connect);
    
?>