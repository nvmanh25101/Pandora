<?php
session_start();
require './database/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGNUP-PANDORA</title>
    <link rel="shortcut icon" type="image" href="img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
	<link rel="stylesheet" href="css/register.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/app.js"></script>
</head>
<body>
  <?php require './header.php'; ?>
  <section style="background-image: url(img/slider_3.webp);">
			<div class="container py-5 ">
			  <div class="row d-flex justify-content-center align-items-center mt-5 mb-5">
				<div class="col-md-12 col-lg-5 col-xl-5 mb-5 bg-light" style="border-radius: 8px; box-shadow: 0 4px 12px #00000026;">
				  <form class="form-signup text-center mb-5" action="process-signup.php" method = "post" >
						<h1 class="titleSignup mt-3 pb-3">Đăng ký</h1>
						<div class="form-outline mb-4">
							<input type="text" name="name" class="form-control" id="floatingInput" placeholder="Tên" required>
						</div>
						<div class="form-outline mb-4" style="float: left;">
							<input type="radio" class="gender me-1" name="gender" value="nam" id="nam" autocomplete="off">
              					<label for="nam">Nam</label>
							<input type="radio" class="gender me-1" name="gender" value="nu" id="nu" autocomplete="off">
              					<label for="nu">Nữ</label>
						</div>
						<div class="form-outline mb-4">
							<input type="text" name="birthday" class="form-control" id="floatingInput" placeholder="Ngày sinh:năm/tháng/ngày" required>
						</div>
						<div class="form-outline mb-4">
							<input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email" required>
						</div>
						<div class="form-outline mb-4">
							<input type="password" id="floatingInput" name="password" class="form-control form-control-lg" placeholder="Mật khẩu"  required >
						</div>
						<div class="form-outline mb-4">
							<input type="phone" id="floatingInput" name="phonenumber" class="form-control form-control-lg" placeholder="Số điện thoại"  required >
						</div>
						<div class="form-outline mb-4">
							<input type="text" id="floatingInput" name="address" class="form-control form-control-lg" placeholder="Địa chỉ"  required >
						</div>
						<small style="color:red;">
						<?php
						if (isset($_GET['error'])) {
							echo "{$_GET['error']}";
						} else {
							echo "";
						}
						?>
						</small>
						
						<button class="btnSignup glow-on-hover btn-lg bg-dark" name="btnSignup" type="submit" >Đăng ký</button>
						
						<div class=" d-flex mt-5 mb-3" style="display: inline;">
                			<a class="text-primary-50 me-1" href="index.php" style="font-weight: 600; font-size: 17px;">
								<i class="bi bi-arrow-left me-2 mt-1" ></i>Quay về trang chủ</a>
						</div>
					</form>
				  
				</div>
			</div>
		</section>
    <?php require './footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script src="js/app.js"></script>
</body>
</html>