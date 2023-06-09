<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:./signin.php');
    exit();
}

$id = $_SESSION['id'];
if(empty($_POST['cart_id'])){
    $cart_id = $_GET['cart_id'];
} else {
    $cart_id = $_POST['cart_id'];
}
$note = $_POST['note'] ?? '';
require './database/connect.php';
$sql = "select * from users where id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

[$address, $ward, $district, $city] = explode(', ', $each['address']);

$sql = "select * from cart_item where cart_id = '$cart_id'";
$result = mysqli_query($connect, $sql);
$sql = "select sum(quantity * price) as sum_price from cart_item 
        join products
        on products.id = cart_item.product_id
        WHERE cart_item.cart_id = $cart_id;";
$result_sum = mysqli_query($connect, $sql);

$sum = mysqli_fetch_array($result_sum)['sum_price'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh toán đơn hàng-PANDORA</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/confirminfo.css">
</head>

<body>

<div class="main-container-header" style="background: #fafafa">
    <div class="row">
        <div class="col-md-6 py-4" style="background: #fff; border-right: solid 1px #ccc;">
            <div class="confirm-box">
                <div class="confirm-text mt-4">
                    <p>Pandora Việt Nam</p>
                </div>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ms-5">
                    <li class="breadcrumb-item ms-5"><a href="index.php">Giỏ hàng</a></li>
                    <li class="breadcrumb-item"><a href="#">Thông tin giao hàng</a></li>
                </ol>
            </nav>
            <form class="form-page " action="./process_checkout.php" method="post">
                <div class="page_container ">
                    <div class="main_content">
                        <div class="row user_infor">

                            <div class="col-md-2">
                                <img class="image-img" style="width: 100px; height: 100px;border-radius: 50%;"
                                                        src="./assets/images/admin/adminvjppro.jpg"/>
                            </div>
                            <div class="col-md-8 ms-3">
                                <div class="name mb-3 mt-3">
                                    <?= $each['name'] ?>(<?= $each['email'] ?>)
                                </div>
                                <a href="signout.php"><i class="bi bi-box-arrow-right" aria-hidden="true"></i>Đăng Xuất</a>
                            </div>
                        </div>
                        <?php require './admin/error_success.php'; ?>
                        <div class="form_name">
                            <label for="">Họ và tên</label>
                            <input type="text" name="name_receiver" class="form-control" value="<?= $each['name'] ?>"
                                   style="width:80%" required>
                        </div>
                        <div class="form_address">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="address_receiver" class="form-control mb-2" style="width:80%"
                                   value="<?= $address ?>" required>
                        </div>
                        <select id="city-select" required>
                            <option value="">Chọn Tỉnh / Thành phố</option>
                        </select>
                        <select id="district-select" required>
                            <option value="">Chọn Quận / Huyện</option>
                        </select>
                        <select id="ward-select" required>
                            <option value="">Chọn Xã / Phường</option>
                        </select>
                        <input name="address_last" hidden id="address-min">

                        <div class="form_phone">
                            <label for="">Số điện thoại</label>
                            <input type="text" name="phone_receiver" class="form-control" value="<?= $each['phone'] ?>"
                                   style="width:80%" required>
                        </div>

                    </div>
                    <h1 style="margin: 40px 0 20px 0; font-size: 25px; font-weight: bold;">Phương thức thanh toán</h1>
                    <div class="pay" >
                        <div class="bybank mt-2">
                            <input type="radio" class="payment me-1 ms-3" name="payment" value="0"
                                                        id="bank" autocomplete="off">
                            <label for="bank"><img src="img/paybyBank.svg" alt="" class="payby"> Chuyển khoản qua ngân hàng</label>
                            <div class="infbank ">
                                <p>Quý khách vui lòng chuyển khoản theo thông tin sau:</p>
                                <p> - CONG TY TNHH THUONG MAI NCA (VN) </p>
                                <p> - NGÂN HÀNG TMCP KỸ THƯƠNG VIỆT NAM - TECHCOMBANK </p>
                                <p> - Số tài khoản: 19030734309076 (VND)</p>
                                <p> - Nội dung chuyển khoản: Thanh toán cho mã đơn hàng [Mã đơn hàng của bạn] Mã đơn hàng
                                    của bạn sẽ
                                    hiển thị khi bấm Hoàn tất đơn hàng</p>
                            </div>
                        </div>
                        <div class="shipcod mt-2">
                            <input type="radio" class="payment me-1 ms-3" name="payment" value="1"
                                                         id="shipcod" autocomplete="off">
                            <label for="shipcod"><img src="img/cod.svg" alt="" class="payby"> Thanh toán khi giao hàng (COD)</label>
                        </div>

                        <div class="vnpay mt-2">
                            <input type="radio" class="payment me-1 ms-3" name="payment" value="2"
                                                       id="shipcod" autocomplete="off">
                            <label for="vnpay"><img src="img/vnpay_new.svg" alt="" class="payby"
                                                    style="width: 40px; height: 35px;"> Thẻ ATM/Visa/Master/JCB/QR Pay qua
                                cổng VNPAY</label>
                        </div>

                        <div class="momo mt-2">
                            <input type="radio" class="payment me-1 ms-3" name="payment" value="3"
                                                      id="momo" autocomplete="off">
                            <label for="momo"><img src="img/momo.svg" alt="" class="payby"
                                                   style="width: 40px; height: 35px;"> Ví Momo</label>
                        </div>

                        <div class="paypoo mt-2">
                            <input type="radio" class="payment me-1 ms-3" name="payment" value="4"
                                                        id="momo" autocomplete="off">
                            <label for="paypoo"><img src="img/paypoo.svg" alt="" class="payby"
                                                     style="width: 40px; height: 35px;"> Trả góp qua ví Payoo</label>
                        </div>
                    </div>
                    <input type="hidden" name="cart_id" value="<?= $cart_id ?>">
                    <textarea  name="note" hidden ><?= nl2br($note) ?></textarea>
                    <div class="btnup">
                        <a class="btnReturn" href="./cart.php">Giỏ hàng</a>
                        <button class="btnConfirm">Hoàn tất đơn hàng</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="about-order col-md-6 pt-5" >
            <?php
            $sql = "select * from carts where user_id = $id";
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
                            WHERE cart_item.cart_id = $cart_id";
            $result = mysqli_query($connect, $sql);
            $sum = mysqli_fetch_array($result)['sum_price'];
            ?>
            <?php foreach ($cart_item as $key => $value) : ?>
                <div class="row ms-3 pb-4">
                    <div class="col-md-8 " style="display: flex;">

                        <div class="item-img" data-label="Sản phẩm">
                            <a href="./product.php?id=<?= $value['product_id'] ?>" class="cart__image">
                                <img src="./assets/images/products/<?php echo $value['image'] ?>">
                            </a>
                        </div>
                        <div class="item-content-text">
                            <a href="./product.php?id=<?= $value['product_id'] ?>" class="item-text">
                                <?php echo $value['name'] ?>
                            </a>
                            <div class="inf-product mt-2">
                                <?php echo $value['size'] ?>/
                                <?php echo $value['color'] ?>/
                                <?php echo $value['material'] ?>
                            </div>

                        </div>

                    </div>
                    <div class="item-total-price col-md-3 ms-4 mt-3" data-label="Tổng giá">
                        <span class="item-price">
                            <?= number_format($value['price'] * $value['quantity']) ?>&#8363
                        </span>
                    </div>
                </div>
            <?php endforeach ?>

            <div class="row ms-3 pb-4 mt-4" style="border-bottom: #ccc 1px solid;">
                <div class="ms-2">
                        <span>
                            Tạm tính
                        </span>
                    <span class="item-price me-5" style="float: right; margin-right: 20px">
                                <?= number_format($value['price'] * $value['quantity']) ?>&#8363
                            </span>
                </div>
                <div class="ms-2 mt-2">
                        <span>
                            Phí vận chuyển
                        </span>
                    <span class="item-price me-5" style="float: right; margin-right: 20px">
                                Miễn phí
                            </span>
                </div>
            </div>
            <div class="row ms-3 pb-4 mt-4">
                <div class="ms-2">
                        <span>
                            Tổng cộng
                        </span>
                    <span class="item-price me-5" style="float: right; margin-right: 20px">
                        <?= number_format($value['price'] * $value['quantity']) ?>&#8363
                    </span>
                </div>
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


</div>

    <script src="./assets/js/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

<script>
    $(document).ready(function () {
        $.getJSON('./assets/hanh_chinh/tinh_tp.json', function (data) {
            $.each(data, function (key, value) {
                if (value.name_with_type == '<?= $city ?>') {
                    $('#city-select').append('<option value="' + value.code + '" selected>' + value.name + '</option>');
                } else {
                    $('#city-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                }
            })
        })

        $.getJSON('./assets/hanh_chinh/quan_huyen.json', function (data) {
            var city = $('#city-select').val();
            $.each(data, function (key, value) {
                if (value.parent_code == city) {
                    if (value.name_with_type == '<?= $district ?>') {
                        $('#district-select').append('<option value="' + value.code + '" selected>' + value.name + '</option>');
                    } else {
                        $('#district-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                    }
                }
            })
        })

        $.getJSON('./assets/hanh_chinh/xa_phuong.json', function (data) {
            var district = $('#district-select').val();

            $.each(data, function (key, value) {
                if (value.parent_code == district) {
                    if (value.name_with_type == '<?= $ward ?>') {
                        $('#ward-select').append('<option value="' + value.path_with_type + '" selected>' + value.name + '</option>');
                        var ward = $('#ward-select').val();
                        $('#address-min').val(ward);
                    } else {
                        $('#ward-select').append('<option value="' + value.path_with_type + '">' + value.name + '</option>');
                    }
                }
            })
        })

        $('#city-select').change(function () {
            var city = $(this).val();
            $.getJSON('./assets/hanh_chinh/quan_huyen.json', function (data) {
                $.each(data, function (key, value) {
                    if (value.parent_code == city) {
                        $('#district-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                    }
                })
            })
        })

        $('#district-select').change(function () {
            var district = $(this).val();
            $.getJSON('./assets/hanh_chinh/xa_phuong.json', function (data) {
                $.each(data, function (key, value) {
                    if (value.parent_code == district) {
                        $('#ward-select').append('<option value="' + value.path_with_type + '">' + value.name + '</option>');
                    }
                })

                $('#district-select').change(function () {
                    var district = $(this).val();
                    $.getJSON('xa_phuong.json', function (data) {
                        $.each(data, function (key, value) {
                            if (value.parent_code == district) {
                                $('#ward-select').append('<option value="' + value.path_with_type + '">' + value.name + '</option>');
                            }
                        })
                    })
                });
                $('#ward-select').change(function () {
                    var ward = $(this).val();
                    $('#address-min').val(ward);
                });
            })
        });

        $('#ward-select').change(function () {
            var ward = $(this).val();
            $('#address-min').val(ward);
        });
    })
</script>
<script src="js/app.js"></script>


</body>

</html>
