<?php

session_start();
require_once './database/connect.php';

$id = $_GET['id'];
$sql = "select products.*, category_child.name as category_name, sizes.name AS name_size
from products
join category_child
on category_child.id = products.category_child_id
left join product_size
on product_size.product_id = products.id
left JOIN sizes
ON product_size.size_id = sizes.id
where products.id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);
$category_id = $each['category_child_id'];
$sql = "select * from products
  where category_child_id = '$category_id'";
$result_category = mysqli_query($connect, $sql);

$sql = "select sizes.* from sizes
    join product_size
    on product_size.size_id = sizes.id
    where product_size.product_id = '$id' and product_size.quantity > 0";
$result_size = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width">
    <title>SANPHAM - PANDORA</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/product.css">

</head>

<body>

<?php require './header.php'; ?>
<!--product-->

<div class="content-top mt-5">
    <p class="mt-1">Miễn phí vận chuyển toàn bộ đơn hàng</p>
</div>

<nav aria-label="breadcrumb ">
    <ol class="breadcrumb m-2">
        <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="#">Tất cả sản phẩm</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $each['name'] ?></li>
    </ol>
</nav>

<div class="product">
    <div class="product-content row">
        <div class="product-content-left col-6">
            <img class="image-img" src="./assets/images/products/<?= $each['image'] ?>"/>
        </div>

        <div class="product-content-right col-6">
            <div class="product-content-right-name">
                <h1><?= $each['name'] ?></h1>

            </div>
            <div class="product-price">
                <p class="line-price">
                        <span class="product-content-right-name price-pro p-2" itemprop="price" content="220000">
                            <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                        </span>
                </p>
            </div>
            <hr>
            <?php if($each['status'] !== 0) { ?>
                <?php require './admin/error_success.php'; ?>
                <form action="add_to_cart.php" method="POST">

                    <div class="product-select-swatch">
                        <div class="product-select-swatch-text">
                            <p>Kích Thước:</p>
                        </div>

                        <div class="select-swap-size">
                            <?php
                            if (mysqli_num_rows($result_size) > 0) {
                                foreach ($result_size as $size) { ?>
                                    <div class="data-one">
                                        <input type="radio" id="size-<?= $size['id'] ?>" name="size"
                                               value="<?= $size['id'] ?>" class="input-opt">
                                        <label for="size-<?= $size['id'] ?>" class="sd"><?= $size['name'] ?> cm</label>
                                    </div>
                                <?php } ?>
                            <?php } else { ?>
                                <p class="text-danger">Hết hàng</p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="product-select-swatch">
                        <div class="product-select-swatch-text">
                            <p>Màu sắc</p>
                        </div>
                        <div class="select-swap">
                            <div class="data-one">
                                <input type="text" name="color" value="<?= $each['color'] ?>" class="input-opt">
                                <label for="swatch-19" class="select-color">
                                    <?= $each['color'] ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="product-select-swatch">
                        <div class="product-select-swatch-text">
                            <p>Chất liệu</p>
                        </div>
                        <div class="select-swap">
                            <div class="data-one">
                                <input type="text" name="material" value="<?= $each['material'] ?>" class="input-opt">
                                <label for="swatch-19" class="select-material">
                                    <?= $each['material'] ?>
                                </label>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="product_id" value="<?= $id ?>">
                    <hr>
                    <div class="product-actions">
                        <button type="submit" id="AddToCart" class="btnAddtocart">Thêm vào giỏ</button>
                    </div>
                </form>
            <?php } else { ?>
            <h1>Sản phẩm đã ngừng bán!</h1>
            <?php } ?>
        </div>

    </div>

    <div class="col-md-12 policy  mt-3" style="display: flex">
        <div class="col-md-2 ms-5" style="border-right: solid #d78ac8 1px;">
            <p>Chính sách áp dụng một đổi một trong vòng 15 ngày kể từ ngày nhận hàng và chỉ đổi duy nhất 01 lần.</p>
        </div>
        <div class="col-md-2 ms-3" style="border-right: solid #d78ac8 1px;">
            <p>Miễn phí vận chuyển</p>
        </div>
        <div class="col-md-2 ms-3" style="border-right: solid #d78ac8 1px;">
            <p>Vệ sinh, làm sạch sản phẩm miễn phí</p>
        </div>
    </div>

    <div class="product-tab mt-5">
        <div class="tab mt-3">
            <button class="tablinkss">Thông tin sản phẩm</button>

        </div>
        <div class="content-product-tab">
            <div id="Content" class="tablinks">
                <?= nl2br($each['description']) ?>
            </div>
            <div class="content-detail mt-2">
                <div class="">Bộ sưu tập: Pandora Moments</div>
                <div class="">Mã sản phẩm: <?= $each['id'] ?></div>
                <div class="">Chất liệu: <?= $each['material'] ?></div>
                <div class="">Màu sắc: <?= $each['color'] ?></div>
            </div>
        </div>
    </div>
    

    <?php
        $sql_vote = "select votes.*, users.name as user_name, users.avatar as user_avatar
        from votes
        join users
        on votes.product_id = '$id' and votes.user_id = users.id";
        $result_vote = mysqli_query($connect,$sql_vote);

        $count_vote = "select COUNT(product_id) from votes where product_id = '$id'";
        $result_count = mysqli_query($connect,$count_vote);
        $count = mysqli_fetch_array($result_count);
    ?>
    <div class="product-tab mt-5">
        <div class="content-product-tab">
            <h4 class="ms-2" style="font-weight: bold">Đánh giá</h4>
                <?php foreach ($result_vote as $vote) { ?>
                    <div class="vote__row mb-3">
                        <div class="user-vote-img">
                                <img src="./assets/images/admin/adminvjppro.jpg" alt="">
                        </div>
                        <div class="item-content-text">
                            <div class="user_name mb-2">
                                <?= $vote['user_name'] ?>
                            </div>
                            <div class="product-rating mb-2">
                                <div class="product-rate">
                                    <?php
                                    $star = $vote['rating'];
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $star) {
                                            echo '<i class="bi bi-star-fill full-star"></i>';
                                        } else {
                                            echo '<i class="bi bi-star"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="time-vote">
                                <?= $vote['created_at'] ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class=" policy-last ms-5">
        <ul class="list-policy ms-5 mt-2" style="display: flex">
            <li class="">
                <h4>Chính sách đổi hàng</h4>
                <p>Chính sách đổi hàng chỉ áp dụng cho các sản phẩm bị lỗi kĩ thuật và là hàng nguyên giá hoặc giảm
                    giá dưới 20%. Chính sách áp dụng một đổi một trong vòng 15 ngày kể từ ngày nhận hàng và chỉ đổi
                    duy nhất 01 lần.</p>
            </li>
            <li class="">
                <h4>Tặng quà</h4>
                <p>Bạn muốn gửi tặng trang sức Pandora đến người đặc biệt? Chỉ cần chọn sản phẩm bạn muốn tặng, nhân
                    viên CSKH của chúng tôi sẽ tự tay gói quà và viết thông điệp bạn muốn gửi đến người nhận quà.
                    Chỉ cần ghi chú lên đơn hàng khi đặt hàng bạn nhé! Pandora sẽ liên hệ bạn ngay!</p>
            </li>
            <li class="">
                <h4>Miễn phí vận chuyển</h4>
                <p>Pandora miễn phí giao hàng trên toàn quốc với mọi giá trị đơn hàng.</p>
            </li>
            <li class="">
                <h4>Cách thức bảo quản</h4>
                <p>Nên vệ sinh sản phẩm bằng bộ vệ sinh sản phẩm chuyên dụng của Pandora và sau khi sử dụng vui lòng
                    vệ sinh, bảo quản trong hộp kín để tránh tiếp xúc với không khí và tránh bị oxi hóa.</p>
            </li>
        </ul>
    </div>

    <div id="Home-notice">
        <div class="latest-wrap">
            <div class="title-notice">
                <h3>CÓ THỂ BẠN THÍCH</h3>
                <h2>SẢN PHẨM CÙNG LOẠI</h2>

            </div>

            <?php
            $sql_pandora = " SELECT * FROM products WHERE category_child_id='$category_id'and not exists(SELECT * FROM products WHERE id = $id)";
            $result_pandora = mysqli_query($connect, $sql_pandora);
            ?>

            <ul class="productss">
                <?php foreach ($result_pandora as $category_product) { ?>
                    <li>
                        <div class="product-item">
                            <div class="product-top">
                                <a href="" class="product-thumb">
                                    <img src="./assets/images/products/<?= $category_product['image'] ?>" alt="">

                                </a>
                            </div>
                            <div class="product-info">
                                <a href="" class="product-cat"><?= $category_product['name'] ?></a>
                                <div class="product-price-action">
                                    <p class="product-price"><?= number_format(
                                            $category_product['price'],
                                            0,
                                            '.',
                                            ','
                                        ) ?></p>
                                    <div class="product-action">
                                        <form action="view_cart.php?id=<?= $each['id'] ?>" method="POST">
                                            <button type="submit" name="addcart" class="btn-action"><i
                                                        class="bi bi-cart-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>


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


    <script type="text/javascript" src="./assets/js/jquery-3.6.4.min.js"></script>
    <!--footer-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script type="text/javascript" src="./assets/js/jquery.zoom.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.image-img')
            .wrap('<span style="display:inline-block"></span>')
            .css('display', 'block')
            .parent()
            .zoom({
                magnify: 1.8
            });
            
            $('.data-one').click(function () {
                let product_id = <?= $id ?>;
                let size_id = $(this).children('input').val();
                $.ajax({
                    url: './get_quantity.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        size_id: size_id,
                        product_id: product_id
                    }
                })
                
                .done(function (res) {
                        $('#quantity').text(res);
                    })
                });
                
                $('.sd').click(function () {
                    $('.sd').removeClass('active');
                    $(this).addClass('active');
                });
                
                $('.sd:first').addClass('active').is(":checked");
                $('.input-opt:first').attr('checked', 'checked');
            });
    </script>

    <script src="js/app.js"></script>
    <script src="js/product.js"></script>
</body>

</html>