<?php 
    session_start();

require 'check_user_cart.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width">
    <title>GIO HANG - Pandora</title>
    <link rel="shortcut icon" type="image" href="img/myLogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/cart.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
<?php 
    require './header.php';
    require_once './database/connect.php';
    $user_id = $_SESSION['id'];
    $sql = "select * from carts where user_id = $user_id;";
    $result = mysqli_query($connect, $result);
    $cart = mysqli_fetch_array($result);
?>
<div class="hero-image">
    <div>
        <p class="hero-text">Giỏ Hàng của bạn</p><br>
    </div>
</div>
<div class="Pagecart mb-4 ">
    <div class="cart-content">
        <h1>Giỏ Hàng </h1>

        <div class="Empty_cart" <?php
        if (empty($cart)) {
            echo 'style = "display:block;"';
        } else {
            echo 'style = "display:none;"';
        }
        ?>>
            <span class="cart-txt">Giỏ hàng đang trống</span><br><br>
            <button class="bg-dark p-3"><a class="cart-txt-he" href="index.php"><i class="bi bi-cart me-2"></i>Tiếp tục
                    mua sắm </a></button>
        </div>
        <!--  -->
        <form action="" method="post" novalidate="" class="cart table-wrap"
            <?php
            if (empty($cart)) {
                echo 'style = "display:none;"';
            } else {
                echo 'style = "display:block;"';
            }
            ?>>
            <table class="cart-table full ">
                <thead class="cart__row">
                <tr>
                    <th class="item-img"></th>
                    <th class="item-content-text">Thông tin chi tiết sản phẩm</th>
                    <th class="item-content-price">Đơn giá</th>
                    <th class="item-amount">Số lượng</th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($cart as $key => $value) : ?>
                    <tr class="cart__row table__section">

                        <td class="item-img" data-label="Sản phẩm">
                            <a href="./product.php?id=<?= $value['id'] ?>" class="cart__image">

                                <img src="./assets/images/products/<?php echo $value['image'] ?>">
                            </a>
                        </td>
                        <td class="item-content-text">
                            <div class="">PDR<?php echo $value['id'] ?></div>
                            <a href="./product.php?id=<?= $value['id'] ?>" class="item-text">
                                <?php echo $value['name'] ?>
                            </a>
                            <div class=""><small><?php echo $value['size'] ?></small><br></div>

                            <div class="cart__remove">
                                <a class="btn-text" href="view_cart.php?id=<?php echo $value['id'] ?>&action=delete">
                                    xoá

                                </a>
                            </div>
                        </td>
                        <td class="item-content-price" data-label="Đơn giá">
                  <span class="item-price">
                    <?php echo number_format($value['price']) ?>&#8363
                  </span>
                        </td>
                        <td class="item-amount" data-label="Số lượng">
                            <div class="product-quantitys">
                                <div class="buttons_added">
                                    <a class="minus is-form"
                                       href="update_quantity_in_cart.php?id=<?= $key ?>&type=decre">
                                        -
                                    </a>
                                    <a class="input-qty"><?php echo $value['quantity'] ?> </a>
                                    <a class="plus is-form"
                                       href="update_quantity_in_cart.php?id=<?= $key ?>&type=incre">
                                        +
                                    </a>
                                </div>
                            </div>
                        </td>
                        <td class="item-total-price" data-label="Tổng giá">

                  <span class="item-price">
                    <?php
                    // echo number_format($value['price'] * $value['quantity']) 
                    ?>
                  </span>
                        </td>
                    </tr>
                <?php endforeach ?>

                </tbody>
            </table>


        </form>
    </div>
    <div class="row-total">
        <div class="cart-price p-4">
            <p>
                <span class="cartt__subtotal-title me-4">Tạm tính</span>
                <span class="cartt__subtotal me-5"><?php echo number_format(total_price($cart)) ?>&#8363</span>
            </p>
            <p>
                <span class="cartt__subtotal-title me-4">Phí vận chuyển</span>
                <span class="cartt__subtotal me-5">Miễn phí</span>
            <hr class="subtotal">
            </p>
            <p>
                <span class="cartt__subtotal-title me-4">Tổng tiền</span>
                <span class="cartt__total me-5"><?php echo number_format(total_price($cart)) ?>&#8363</span>
            </p>
        </div>
    </div>
</div>
<a class="btn-payment-text ms-5 mb-5" href="./confirminfo.php">
    Đặt hàng
</a>

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

<?php require './footer.php'; ?>


<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="js/app.js"></script>
<script src="js/product.js"></script>

</body>

</html>