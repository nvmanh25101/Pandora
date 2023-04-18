<?php 
require './database/connect.php';
session_start();
if(empty($_SESSION['id'])){
  header("location:signin.php");
}
$status = $_GET['status'];
$idCus = $_SESSION['id'];
$idOrder = $_GET['order_id'];
$sqlTtin = "SELECT id, name_receiver, address_receiver, phone_receiver, DATE_FORMAT(created_at, '%d/%m/%Y %T') as created_at, status, total_price FROM orders WHERE id = $idOrder and user_id = $idCus";
$resultTtin = mysqli_query($connect,$sqlTtin);
$rowTtin = mysqli_fetch_assoc($resultTtin);

$sqlBanh = "SELECT * FROM products,order_detail WHERE order_id = $idOrder and order_detail.product_id = products.id";
$resultBanh = mysqli_query($connect,$sqlBanh);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="width=device-width">
  <title>DON HANG - PANDORA</title>
  <link rel="shortcut icon" type="image" href="img/myLogo.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/order.css">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
 
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>
<body>
<?php require './header.php'; ?>
        <div class="order-product mb-3">
        <h2>Thông tin đơn hàng</h2>
            <div class="order-product-content">
               
                 <div class="order-left">
                    <h1>Mã đơn hàng: <?php echo $rowTtin['id']  ?></h1>
                    <p class="mt-3">Tên người đặt: <?php echo $rowTtin['name_receiver']  ?></p>
                    <p>Thời gian đặt hàng: <?php echo $rowTtin['created_at']  ?></p>
                    <p>Số điện thoại: <?php echo $rowTtin['phone_receiver']  ?></p>
                    <p>Địa chỉ giao hàng: <?php echo $rowTtin['address_receiver']  ?></p>
                    <h1>Thông tin sản phẩm:</h1>
                 </div>
                  <div class="order-right">
                    <p class="order-text" >Trạng thái:
                        <?php switch ($status) {
                            case 0:
                                echo "Đơn hàng chưa được duyệt";
                                break;
                            case 1:
                                echo "Nguời gửi đang chuẩn bị hàng";
                                break;
                             case 2:
                                echo "Đang giao hàng";
                                break;
                             case 3:
                                echo "Hoàn thành";
                                break;
                            case 5:
                            case 4:
                                echo "Đơn hàng đã bị huỷ";
                                break;
                        }?>
                    </p>
                 </div>
             </div>

             <table class="cart-table full ">
          <thead class="cart__row">

            <tr class="spaceUnder">
              <th class="item-img" >Ảnh </th>
              <th class="item-content-text">Chi tiết sản phẩm</th>
              <th class="item-content-price">Đơn giá</th>
              <th class="item-amount">Số lượng</th>
              <th class="item-total-price">Thành tiền</th>
            </tr>
          </thead>
          <tbody>

            <?php 
              if(mysqli_num_rows($resultBanh) > 0){
                while($rowBanh = mysqli_fetch_assoc($resultBanh)){
            ?>
              <tr class="spaceUnder">

                <td class="item-img" data-label="Sản phẩm">
                  <a href="" class="cart__image">
                    <img src="./assets/images/products/<?php echo $rowBanh['image'] ?>">
                  </a>
                </td>
                <td class="item-contentt-text">
                 <a class="item-txt"> <?php echo $rowBanh['name'] ?></a>
                <br>
                  <div class="cart__remove">
                    <small>Kích thước: <?php echo $rowBanh['size'] ?> cm</small><br>
                  </div>
                </td>
                <td class="item-contentt-price" data-label="Đơn giá">
                  <span class="item-price">
                  <?= number_format($rowBanh['price'], 0, '.', ' ') ?>&#8363
                  </span>
                </td>
                <td class="item-amountt" data-label="Số lượng">
                  <div class="product-quantitys">     
                    <?php echo  $rowBanh['quantity'] ?>   
                  </div>
                </td>
                <td class="item-totall-price" data-label="Tổng giá">

                  <span class="item-price">
                    <?php echo number_format($rowBanh['price'] * $rowBanh['quantity']) ?>&#8363
                  </span>

                </td>

              </tr>
              <tr class="item-vote ms-5">
                
                <td class="ms-5" >

                  <span class="item-vote ms-5">
                    <button class="btn-vote ms-5">
                      <a class="vote " href="vote.php?id=<?= $rowBanh['id'] ?>">Đánh giá sản phẩm</a>
                    </button>
                  </span>
                </td>
              </tr>

              <?php
                }
              }                   
              ?>



</tbody>
</table>   
      <div class="row-total mb-5">
        <div class="cart-price-right">
          <p>
            <span class="cart__subtotal-title">Tổng tiền</span><br>
            <span class="cart__subtotal"><?= number_format($rowTtin['total_price'], 0, '.', ' ') ?>&#8363</span>
          </p>

        </div>

          </div>
            </div>
    
            <div id="hotline">
              <a href="tel:0333135698" id="yBtn">
                <i class="bi bi-telephone-fill"></i>
              </a>
              <div class="text-quotes">
                <a href="tel:0333135698">0333135698</a>
              </div>
            </div>
            <?php require './footer.php'; ?>
<script src="js/app.js"></script>
  <script src="js/product.js"></script>
</body>
</html>