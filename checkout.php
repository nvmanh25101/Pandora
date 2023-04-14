<?php
session_start();
if (empty($_SESSION['id'])) {
    header('location:./signin.php');
    exit();
}

$id = $_SESSION['id'];
$cart_id = $_GET['cart_id'];

require './database/connect.php';
$sql = "select * from users where id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

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
    <link rel="shortcut icon" type="image" href="img/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/confirminfo.css">
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
<?php require './header.php'; ?>

<div class="hero-image">
    <div>
        <p class="hero-text"></p>
    </div>
</div>
<div class="main-container-header">
    <div class="confirm-container">
        <div class="confirm-box">
            <div class="confirm-text">
                <p>Thông tin giao hàng</p>
            </div>
            <hr>
        </div>
    </div>

    <form class="form-page" action="./process_checkout.php" method="post">
        <div class="page_container">
            <div class="main_content">
                <div class="row user_infor">

                    <div class="col-md-3"><img class="image-img" style="width:50%;" src="./img/<?= $each['avatar'] ?>"/>
                    </div>
                    <div class="col-md-3">
                        <div class="name"><?= $each['name'] ?></div>
                        <div class="email mb-2"><?= $each['email'] ?></div>
                        <a href="signout.php"><i class="bi bi-box-arrow-right" aria-hidden="true"></i>Đăng Xuất</a>
                    </div>
                </div>
                <div class="form_name">
                    <label for="">Họ và tên</label>
                    <input type="text" name="name_receiver" class="form-control" value="<?= $each['name'] ?>" required>
                </div>
                <div class="form_address">
                    <label for="">Địa chỉ</label>
                    <input type="text" name="address_receiver" class="form-control" value="<?= $each['address'] ?>"
                           required>
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
                    <input type="text" name="phone_receiver" class="form-control" value="<?= $each['phone'] ?>" required>
                </div>

            </div>
        </div>
        <h1 style="margin: 60px 50px 10px 50px; font-size: 25px; font-weight: bold;">Phương thức thanh toán</h1>
        <div class="pay ">
            <div class="bybank mt-2"><input type="radio" class="payment me-1 ms-3" name="payment" value="0" id="bank"
                                            autocomplete="off">
                <label for="bank"><i class="bi bi-credit-card me-2"></i>Chuyển khoản qua ngân hàng</label>
                <div class="infbank ">
                    <p>Quý khách vui lòng chuyển khoản theo thông tin sau:</p>
                    <p> - CONG TY TNHH THUONG MAI NCA (VN) </p>
                    <p> - NGÂN HÀNG TMCP KỸ THƯƠNG VIỆT NAM - TECHCOMBANK </p>
                    <p> - Số tài khoản: 19030734309076 (VND)</p>
                    <p> - Nội dung chuyển khoản: Thanh toán cho mã đơn hàng [Mã đơn hàng của bạn] Mã đơn hàng của bạn sẽ
                        hiển thị khi bấm Hoàn tất đơn hàng</p>
                </div>
            </div>
            <div class="shipcod mt-2"><input type="radio" class="payment me-1 ms-3" name="payment" value="1"
                                             id="shipcod" autocomplete="off">
                <label for="shipcod"><i class="bi bi-cash-coin me-2"></i>Thanh toán khi giao hàng</label></div>

            <div class="momo mt-2"><input type="radio" class="payment me-1 ms-3" name="payment" value="2" id="momo"
                                          autocomplete="off">
                <label for="momo"><i class="bi bi-bank"></i>Ví Momo</label></div>
        </div>
        <h1 style="margin: 60px 50px 10px 50px; font-size: 20px;">Nhập ghi chú quà tặng hoặc hướng dẫn giao hàng đặc
            biệt dưới đây (nếu có):</h1>
        <div class="note">
            <input type="text" name="note" class="note ms-5" id="note" placeholder="Ghi chú" style="height: 100px; width: 90%">
        </div>
        <div class="btnup">
            <a class="btnReturn" href="./cart.php">Giỏ hàng</a>
            <button class="btnConfirm">Hoàn tất đơn hàng</button>
        </div>
    </form>

</div>

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
<script src="./assets/js/jquery-3.6.4.min.js"></script>
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>


<script>
    $(document).ready(function () {
        $.getJSON('tinh_tp.json', function (data) {
            $.each(data, function (key, value) {
                $('#city-select').append('<option value="' + value.code + '">' + value.name + '</option>');
            })
        })

        $('#city-select').change(function () {
            var city = $(this).val();
            $.getJSON('quan_huyen.json', function (data) {
                $.each(data, function (key, value) {
                    if (value.parent_code == city) {
                        $('#district-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                    }
                })
            })
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
</script>


</body>

</html>