<?php 

require 'cart_function.php';
require './database/connect.php';

    
    $sql = "select * from categories";
    $categories = mysqli_query($connect, $sql);

$cart = (isset($_SESSION['cart']))? $_SESSION['cart'] : [];
?>

<link rel="stylesheet" type="text/css" href="css/style.css">

  <header class="medium-header fixed-top mb-5">
    <div class="site-header ">
      <div class="header-left col-md-6">
        <div id="mySidenav" class="sidenav">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

          <div class="drawer_header">
            <a href="#"><img style="width:40%;height: 40%;" src="img/Pandora_Logo_Blank.jpg"></a>
          </div>

          <a href="./index.php">Trang chủ</a>
          <?php foreach($categories as $category) { ?>
            <button class="dropdown-btn"><?= $category['name'] ?><i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
              <?php  
                  $sql = "select * from category_detail where category_id = '$category[id]'";
                  $result_sub = mysqli_query($connect,$sql);
                  foreach($result_sub as $each_sub) {
              ?>
                  <a href="./index.php?category=<?= $each_sub['id'] ?>"><?= $each_sub['name'] ?></a>
              <?php } ?>
            </div>
          <?php } ?>
          <?php if(empty($_SESSION['id'])) { ?>
            <a href="./signin.php">
              <i class="bi bi-people-fill" aria-hidden="true"></i>
              Tài khoản
            </a>
          <?php } else { ?>
              <a href="./user.php?id=<?= $each['id'] ?>">
              <i class="bi bi-people-fill" aria-hidden="true"></i>
              Chào , <?= $_SESSION['name'] ?>
            </a>
            <a href="signout.php">
              <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
              Đăng Xuất
            </a>
          <?php } ?>

        </div>

        <div id="main">

          <span style="font-size:30px;cursor:pointer; color:#000" onclick="openNav()">&#9776; </span>
        </div>

        <div class="logo ms-5">
            <a href="index.php">
              <img src="img/Pandora_Logo_Blank.jpg">
            </a>
        </div>
        <div class="search ms-5">
              <form action="./index.php" method="post" class="input-search ms-5" role="search">
                  <button type="submit" class="btn icon-fallback-text">
                    <i class="bi bi-search" aria-hidden="true"></i>
                  </button>
                  <input id="search" type="search" name="search" 
                    value placeholder="Tìm sản phẩm..." class="input-field" aria-label="Tim kiem ..." autocomplete="off" style="border: none;">
              </form>
              <div class="sub-search">
                <ul class="sub-search-list">
                  
                </ul>
              </div>
        </div>
        
      </div>


      <div class="header-right">
        <ul class="list-item">
          <a class="item" href="#">
            <i class="bi bi-geo-alt" aria-hidden="true"></i>
          </a>
          <?php if(empty($_SESSION['id'])) { ?>
            <a class="item" href="./signin.php">
              <i class="bi bi-person" aria-hidden="true"></i>
            </a>
          <?php } else { ?>
              <a class="item" href="user.php">
              <i class="bi bi-person" aria-hidden="true"></i>
              Chào , <?= $_SESSION['name'] ?>
            </a>
            <a class="item" href="signout.php">
              <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
              Đăng Xuất
            </a>
          <?php } ?>
       
          <a class="item" href="cart.php">
            <div class="cart-total-price">
              <i class="bi bi-bag" aria-hidden="true"></i>
              
              <?php if(empty($_SESSION['id'])) { ?><span id="CartCount">
               
              0</span>
              <?php } else { ?>
                <span id="CartCount"><?php echo total_item($cart) ?></span>
                <?php } ?>
            </div>
          </a>
          
          <ul>

      </div>

    </div>
    <nav class="container">
      <ul id="main-menu">
        <?php foreach($categories as $category) { ?>
            <li>
                <a href="#"><?= $category['name'] ?></a>
                <ul class="sub-menu">
                    <?php  
                        $sql = "select * from category_detail where category_id = '$category[id]'";
                        $result_sub = mysqli_query($connect,$sql);
                        foreach($result_sub as $each_sub) {
                    ?>
                    <li><a href="./index.php?category=<?= $each_sub['id'] ?>"><?= $each_sub['name'] ?></a></li>
                    <?php } ?>
                </ul>
            </li>
          <?php } ?>
          <li><a href="./index.php">Khuyến mãi</a></li>
          <li><a href="./index.php">Tuyển dụng</a></li>
      </ul>
    </nav>
  </header>
  <div class="empty" style="height: 130px"></div>                      