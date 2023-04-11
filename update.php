<?php
  session_start();
  if(empty($_SESSION['id'])){
    header("location:signin.php");
  }
  
  $id = $_SESSION['id'];
  require './database/connect.php';
  $sql = "SELECT * FROM users WHERE (id = '$id')" ;
  $result = mysqli_query($connect,$sql);
  $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image" href="img/logo.png">
    <title>UPDATE-GNBAKERY</title>
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


<link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<link
	rel="stylesheet"
	type="text/css"
	href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
  />
  <script src="js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</head>
<body>
<?php require './header.php'; ?>
    <form action="process-update.php" method = "post">
        <div class="page_container mb-3">
                <div class="main_content">
                        
                            <h2>Thông tin</h2>
                            Email:<span name = "email"> <?php echo $row['email'] ?></span>
                            <input type="text" name="id" style="display:none;" value = "<?php echo $row['id']?>">
                            <small style="color:green;">
                                    <?php
                                        if(isset($_GET['error'])){
                                            echo "{$_GET['error']}";
                                        }else{
                                            echo "";
                                        }
                                    ?>
                    	        </small>
                            <small style="color:red;">
                                    <?php
                                        if(isset($_GET['error1'])){
                                            echo "{$_GET['error1']}";
                                        }else{
                                            echo "";
                                        }
                                    ?>
                    	        </small>
                            <div class="form_name">
                                <label for="">Họ và tên</label>
                                <input type="text" name = "name" class="form-control" placeholder = "Nhập họ tên" value ="<?php echo $row['name']?>" required>
                              </div>
                            <div class="form_name">
                                <label for="">Password</label>
                                <input type="password" name = "password" class="form-control" placeholder="Nhập mật khẩu mới">
                                <small style="color:red;">
                                    <?php
                                        if(isset($_GET['errorpass'])){
                                            echo "{$_GET['errorpass']}";
                                        }else{
                                            echo "";
                                        }
                                    ?>
                    	        </small>
                              </div>
                            <div class="form_address">
                                <label for="">Địa chỉ</label>
                                <input type="" name = "address" class="form-control" placeholder="Thêm địa chỉ" value = "<?php
                                                                                                                if($row['address']==NULL){
                                                                                                                    echo "";
                                                                                                                }else{
                                                                                                                    echo $row['address'];
                                                                                                                }
                                                                                                            ?>">
                              </div>
                            <div class="form_phone">
                                  <label for="">Số điện thoại</label>
                                <input type="" name = "phone" class="form-control" placeholder="Thêm số điện thoại" value = "<?php
                                                                                                                if($row['phone']==NULL){
                                                                                                                    echo "";
                                                                                                                }else{
                                                                                                                    echo $row['phone'];
                                                                                                                }
                                                                                                            ?>">
                              </div>
                            <div class="btnup">
                                <button class="btnUpdate" name="btnUpdate" type="submit">Cập nhật</button>
                                <a href=""><button  class="btnUpdatet">Quay lại</button></a>
                            </div>
                </div>
        </div>
    </form>

    <?php require './footer.php'; ?>
    
    <div id="hotline">
      <a href="tel:0333135698" id="yBtn">
        <i class="bi bi-telephone-fill"></i>
      </a>
      <div class="text-quotes">
        <a href="tel:0333135698">0333135698</a>
      </div>
    </div>
    <div id="backtop">
      <i class="bi bi-chevron-compact-up"></i>
    </div>


  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

  <script src="js/app.js"></script>
</body>
</html>