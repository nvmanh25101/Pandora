<?php
require 'check_user_cart.php';
require_once './database/connect.php';
$user_id = $_SESSION['id'];
$sql = "select * from carts where user_id = $user_id;";
$result = mysqli_query($connect, $sql);
$cart = mysqli_fetch_array($result);
$cart_id = $cart['id'];
$sql = "select cart_item.*, products.name, products.image, products.price from cart_item 
        join products
        on products.id = cart_item.product_id
        where cart_id = $cart_id";
$cart_item = mysqli_query($connect, $sql);
$cart_item_count = mysqli_num_rows($cart_item);

$sql = "select sum(quantity * price) as sum_price from cart_item 
        join products
        on products.id = cart_item.product_id
        WHERE cart_item.cart_id = $cart_id;";
$result = mysqli_query($connect, $sql);
$sum = mysqli_fetch_array($result)['sum_price'];
?>
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
    <?php require './header.php'; ?>

    <div class="mt-5">
        <h4 class="ms-3">Giỏ Hàng của bạn</h4>
    </div>
    <div class="Pagecart container mb-4 ">
        <div class="row">
            <div class="cart-content col-md-8">
                <div class="Empty_cart" <?php
                    if (empty($cart_item_count)) {
                        echo 'style = "display:block;"';
                    } else {
                        echo 'style = "display:none;"';
                    }
                ?>>
                    <span class="cart-txt">Giỏ hàng đang trống</span>
                    <br><br>
                    <button class="bg-dark p-3">
                        <a class="cart-txt-he" href="./index.php">
                            <i class="bi bi-cart me-2"></i> Tiếp tục mua sắm
                        </a>
                    </button>
                </div>
                <!--  -->
                <div <?php
                    if (empty($cart_item_count)) {
                        echo 'style = "display:none;"';
                    } else {
                        echo 'style = "display:block;"';
                    }
                ?>>
                    <table class="cart-table full">
                    <tbody>
                        <?php foreach ($cart_item as $key => $value) : ?>
                            <tr class="cart__row table__section">
                                <td class="item-img" data-label="Sản phẩm">
                                    <a href="./product.php?id=<?= $value['product_id'] ?>" class="cart__image">
    
                                        <img src="./assets/images/products/<?php echo $value['image'] ?>">
                                    </a>
                                </td>
                                <td class="item-content-text">
                                    <a href="./product.php?id=<?= $value['product_id'] ?>" class="item-text">
                                        <?php echo $value['name'] ?>
                                    </a>
                                    <div class="mt-2">
                                        Giá <?php echo number_format($value['price']) ?>&#8363
                                    </div>
                                    <div class="mt-2">
                                        <span style="font-weight: bold;"> Mã SP:</span> PDR<?php echo $value['product_id'] ?> - <?php echo $value['size'] ?>
                                    </div>
    
                                    <div class="cart__remove">
                                        
                                    </div>
                                </td>
                                <td class="item-content-price" data-label="Đơn giá">
                              <span class="item-price">
                                
                              </span>
                                </td>
                                <td class="item-amount" data-label="Số lượng">
                                    <div class="product-quantitys">
                                        <div class="buttons_added">
                                            <a class="minus is-form"
                                               href="update_quantity_in_cart.php?cart_id=<?= $value['cart_id'] ?>&product_id=<?= $value['product_id'] ?>&type=decre">
                                                -
                                            </a>
                                            <a class="input-qty"><?php echo $value['quantity'] ?> </a>
                                            <a class="plus is-form"
                                               href="update_quantity_in_cart.php?cart_id=<?= $value['cart_id'] ?>&product_id=<?= $value['product_id'] ?>&type=incre">
                                                +
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="item-total-price" data-label="Tổng giá">
                                  <span class="item-price">
                                    <?= number_format($value['price'] * $value['quantity']) ?>&#8363
                                  </span>
                                </td>
                                <td class="item-total-price" data-label="Tổng giá">
                                    <a class="btn-text"
                                        href="delete_from_cart.php?cart_id=<?= $value['cart_id'] ?>&product_id=<?= $value['product_id'] ?>&action=delete">
                                        <i style="color: #b17f99" class="bi bi-x-circle-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                        <input name="sum_price" hidden value="<?= $sum ?>"></input>
                        <input name="cart_id" hidden value="<?= $cart_id ?>"></input>
                    </tbody>
                </table>
                <div class="row total">
                        <div class="col-md pt-4" >
                            <input class="mycheckbox m-3" type="checkbox" name="" id="" style="font-size: 20px;">Xuất hóa đơn GTGT
                        </div>
                        <div class="col-md pt-4">
                            <p style="font-size: 17px;">Nhập ghi chú quà tặng hoặc hướng dẫn giao hàng đặc
                                biệt dưới đây (nếu có):</p>
                            <div class="form-field" >
                                <textarea class="note" name="note" id="note" cols="30" rows="10"  placeholder="Ghi chú: "></textarea>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="ms-4">
                    <span class="cartt__subtotal-title me-4">Tổng tiền</span>
                    <span class="cartt__total me-5"><?= number_format($sum) ?>&#8363</span>
                </div>
                <div class="ms-4 mt-2" style="display: flex">
                    <span class="cartt__subtotal-title me-3 mt-3"><input class="mycheckbox" type="checkbox"></span>
                    <span class="me-5">
                        <p>Khi bấm nút "Thanh toán" đồng nghĩa Khách hàng đã hiểu và đồng ý các Điều khoản dịch vụ của Pandora Việt Nam.</p>
                    </span>
                </div>
                <button class="btn-payment-text mt-2 ms-4">
                    <a href="./checkout.php?cart_id=<?= $cart_id ?>">THANH TOÁN</a>
                </button>
                
                <div class="mt-3 ms-5">
                    <a href="index.php" style="color: #d1b8c5">Tiếp tục mua sắm ></a>
                </div>
                <div class="img-pay mt-3" style="display: flex">
                    <img src="img/trustbadge.webp" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="container more_info p-3 mb-3">
        <div class="row">
            <div class="col-md ">
                <i class="bi bi-award"> Hàng chính hãng 100%</i>
            </div>
            <div class="col-md ">
                <i class="bi bi-truck"> Miễn phí giao hàng toàn quốc</i>
            </div>
            <div class="col-md ">
                <i class="bi bi-credit-card"> Mua trước trả sau với lãi suất 0%</i>
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

    <div id="backtop">
        <i class="bi bi-chevron-compact-up"></i>
    </div>

    <?php require './footer.php'; ?>


<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="js/app.js"></script>
<script src="js/product.js"></script>

</body>

</html>