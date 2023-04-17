<?php
session_start();
require './database/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập-PANDORA</title>
    <link rel="shortcut icon" type="image" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css">
</head>
<body>
  <?php require './header.php'; ?>
  <section style="background-image: url(img/slider_3.webp);">
			<div class="container py-5 ">
			  <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
				<div class="col-md-12 col-lg-5 col-xl-5 mb-5 bg-light" style="border-radius: 8px; box-shadow: 0 4px 12px #00000026;">
				  <form class="form-signin text-center mb-5" action="process-signin.php" method = "post" >
						<h1 class="titleLogin mt-3 pb-3">Đăng nhập</h1>
						<div class="form-outline mb-4">
							<input type="email"  id="floatingInput" name="email" class="form-control form-control-lg"  placeholder="Email" required >
						</div>
			
						<div class="form-outline mb-2">
							<input type="password" id="floatingInput" name="password" class="form-control form-control-lg" placeholder="Password"  required >
						</div>
<!--						<small style="color:red;">-->
<!--						--><?php //require './admin/error_success.php'; ?>
<!--						</small>-->
						<div class=" d-flex mt-3 mb-3" style="display: inline;">
                			<a class="text-primary-50 me-1" href="" style="font-weight: 600; font-size: 17px;">Quên mật khẩu</a>Hoặc
               				 <a class="text-primary-50 ms-1" href="signup.php" style="  font-weight: 600; font-size: 17px;">Đăng ký?</a>
						</div>
						
						<button class="btn-signin glow-on-hover btn-lg bg-dark" name="btnSignin" type="submit" >Đăng nhập</button>
						
					</form>
				  <input id="error" hidden value="<?php echo $_SESSION['error'] ?? ''; unset($_SESSION['error']) ?>">
				</div>
			</div>
		</section>
    <?php require './footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./assets/js/sweetalert2.all.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="js/app.js"></script>
<script>
    $(document).ready(function (){
        if ($("#error").val() !== '') {
            Swal.fire(
                {
                    title: 'Thông báo!',
                    text: $("#error").val(),
                    icon: 'info',
                    confirmButtonText: 'OK'
                }
            )
        }
    })
</script>
</body>
</html>