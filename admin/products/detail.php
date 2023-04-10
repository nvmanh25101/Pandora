<?php
require_once '../check_admin_signin.php';
include '../navbar-vertical.php';

$id = $_GET['id'];

require_once '../../database/connect.php';
$sql = "select products.*, category_child.name as category_name, users.name as admin_name, products.user_id, sizes.name AS name_size, product_size.quantity
    from products
    join category_child
    on category_child.id = products.category_child_id
    join users
    on users.id = products.user_id
    join product_size
    on product_size.product_id = products.id
    JOIN sizes
    ON product_size.size_id = sizes.id
    where products.id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);
$sql = "select sizes.* from sizes
    join product_size
    on product_size.size_id = sizes.id
    where product_size.product_id = '$id'";
$result = mysqli_query($connect, $sql);
?>

<div class="main__container">

    <div class="product">
        <div class="product-content">
            <div class="product-content-left">
                <img class="image-img hide-on-mobile-tablet" src="../../assets/images/products/<?= $each['image'] ?>"
                     data-zoom-image="../../assets/images/products/<?= $each['image'] ?>"/>
                <img class="image-img-mobile" src="../../assets/images/products/<?= $each['image'] ?>"/>
            </div>

            <div class="product-content-right">
                <div class="product-content-right-name">
                    <h1><?= $each['name'] ?></h1>
                    <p>Mã sản phẩm: <?= $each['id'] ?></p>
                </div>
                <hr>
                <div class="product-price">
                    <p class="line-price">
                        <span class="">Giá: </span>
                        <span class="ProductPrice" itemprop="price" content="220000">
                            <?= number_format($each['price'], 0, '.', ' ') ?>&#8363
                        </span>
                    </p>

                </div>

                <div class="product-select-swatch">
                    <div class="product-select-swatch-text">
                        <p>Kích Thước:</p>
                    </div>

                    <div class="select-swap ">
                        <?php foreach ($result as $size) { ?>
                            <div class="data-one">
                                <input type="radio" name="option1" value="<?= $size['id'] ?>" class="input-opt">
                                <label for="swatch" class="sd">
                                    <?= $size['name'] ?> cm
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="product-select-swatch">
                        <div class="product-select-swatch-text">
                            <p>Số lượng:</p>
                        </div>
                        <div class="select-swap">
                            <div class="data-one">
                                <label for="swatch"  id="quantity">
                                    <?= $each['quantity'] ?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-actions">
                    <a href="form_update.php?id=<?= $each['id'] ?>&admin_id=<?= $each['user_id'] ?>" id="AddToCart"
                       class="btnAddtocart">Sửa</a>
                    <a onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                       href="delete.php?id=<?= $each['id'] ?>&admin_id=<?= $each['user_id'] ?>" id="buy-now"
                       class="btnBuynow">
                        Xóa
                    </a>
                </div>
            </div>
        </div>
        <div class="product-tab">
            <div class="tab">
                <button class="tablinks">Mô tả chung</button>
            </div>
            <div class="content-product-tab">
                <?= nl2br($each['description']) ?>
                <br>
                <strong>Phân loại sản phẩm:</strong> <?= $each['category_name'] ?>
                <br>
                <strong>Chất liệu:</strong> <?= $each['material'] ?>
                <br>
                <strong>Màu sắc:</strong> <?= $each['color'] ?>
            </div>
        </div>


    </div>
    <script src="../../assets/js/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
            integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="../../assets/js/jquery.zoom.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.image-img')
                .wrap('<span style="display:inline-block"></span>')
                .css('display', 'block')
                .parent()
                .zoom({
                    magnify: 1.5
                });
        });

        $('.btn-menu').click(function () {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });

        $('.data-one').click(function() {
            let product_id = <?= $id ?>;
            let size_id = $(this).children('.input-opt').val();
            $.ajax({
                url: './get_quantity.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    size_id: size_id,
                    product_id: product_id
                }
            })

                .done(function(res) {
                   $('#quantity').text(res);
                })
            });

        $('.sd').click(function() {
            $('.sd').removeClass('active');
            $(this).addClass('active');
        });

    </script>
    </body>

    </html>