<?php

require './database/connect.php';
session_start();

$id = $_GET['id'];

$user_id = $_SESSION['id'];
$sql = "select * from users where id = '$user_id'";
$result = mysqli_query($connect,$sql);
$each = mysqli_fetch_array($result);

$sql_product = "select * from products where id = '$id'";
$result_product = mysqli_query($connect,$sql_product);
$product = mysqli_fetch_array($result_product);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá sản phẩm</title>
    <link rel="shortcut icon" type="image" href="img/myLogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/order.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php require './header.php'; ?>

    <div class="title mt-4" style="text-align: center">
        <h1 style="font-size: 30px" >Đánh giá sản phẩm </h1>
    </div>
    

    <div class="container m-5">
        <form action="process-votes.php" method = "Post">

            <ul class="products">
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <div  class="product-thumb">
                                <img src="./assets/images/products/<?= $product['image'] ?>" alt="">

                            </div>
                        </div>
                        <div class="product-info">
                            <div  class="product-cat">
                                <?= $product['name'] ?>
                            </div>
                                <p class="product-price">
                                    <?= number_format($product['price'], 0, '.', ',') ?>&#8363
                                </p>

                        </div>
                    </div>
                </li>
                <div class="item-vote ms-5">
                    <h4 class="ms-5">Người đánh giá: <?= $each['name'] ?> </h4>
                    <input type="hidden" name="id" value="<?= $id ?>" />
                    <input type="hidden" name="id_user" value="<?= $user_id  ?>" />
                    <div class="rate ms-5">
                        <input type="radio" id="star5" name="rate" value="5" />
                            <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                            <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                            <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                            <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                            <label for="star1" title="text">1 star</label>
                    </div>
                    <div class="item-vote">
                        <button type = "submit" class="send-votes glow-on-hover">
                            Gửi đánh giá
                        </button>
                    </div>
                </div>
            </ul>


        </form>
    </div>

    <?php require './footer.php'; ?>
</body>
</html>