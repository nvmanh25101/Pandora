<?php
session_start();
require './database/connect.php';

$where = 1;
if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $where = "category_child_id = '$category'";
}

$search = '';
if (isset($_POST['search'])) {
    $search = htmlspecialchars($_POST['search'], ENT_QUOTES);
    $where = "products.name like '%$search%'";
}

$sql = "SELECT products.*, category_child.name as category_name FROM products
  join category_child on category_child.id = products.category_child_id
  where $where
  order by products.id desc, products.status desc";
$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) == 0) {
    $error = 'Không có sản phẩm nào';
}  else {
    $category_name = mysqli_fetch_array($result)['category_name'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width">
    <title>Pandora Việt Nam</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">


</head>

<body>
<?php require './header.php'; ?>

<div class="new-item container">
    <div class="row m-4">
        <div class="col-md-2">
            <h3 style="font-weight: 700;font-size: 22px;">Khám phá thế giới trang sức tuyệt mỹ</h3>
        </div>
        <div class="col-md">
            <div id="intro">
                <?php
                $sql_pandora = "SELECT * FROM categories order by id desc";
                $result_pandora = mysqli_query($connect, $sql_pandora);
                ?>

                <ul class="categories">
                    <?php foreach ($result_pandora as $each) { ?>
                        <li class="ms-4">
                            <div class="category-item pb-3">
                                <div class="category-top">
                                    <a href="#" class="category-thumb d-block">
                                        <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                                    </a>
                                </div>
                                <div class="category-info mt-2">
                                    <a href="#" class="category-cat">
                                        <?= $each['name'] ?>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>

            </div>
        </div>
    </div>
</div>

<!-- image slider start -->
<div class="slideshow-container">

    <div class="mySlides">
        <div class="numbertext"></div>
        <img src="img/slider_1.webp" style="width:100%">
    </div>

    <div class="mySlides">
        <div class="numbertext"></div>
        <img src="img/slider_2.webp" style="width:100%">
    </div>

    <div class="mySlides">
        <div class="numbertext"></div>
        <img src="img/slider_3.webp" style="width:100%">
    </div>

</div>
<br>

<div style="text-align:center">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
</div>

<!-- product -->
<?php if (isset($_GET['category']) || isset($_POST['search'])) { ?>
    <div id="intro">
        <div class="headline">
            <h3><?= $category_name ?? $error ?></h3>

        </div>
        <ul class="products">
            <?php foreach($result as $each) { ?>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="./product.php?id=<?= $each['id'] ?>" class="product-thumb">
                                <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                            </a>
                        </div>
                        <div class="product-info">
                            <div  class="product-cat">
                                <?= $each['name'] ?>
                            </div>
                            <p class="product-price">
                                <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                            </p>
                        </div>
                    </div>
                </li>
            <?php } ?>
    </div>
<?php } else { ?>
    <div id="intro">
        <div class="headline">
            <h3>Charm Treo</h3>
        </div>

        <?php
        $sql = "select id from category_child where name = 'Charm treo'";
        $result = mysqli_query($connect, $sql);
        $category_child_id = mysqli_fetch_assoc($result)['id'];
        $sql_pandora = "SELECT * FROM products WHERE category_child_id='$category_child_id' order by id desc";
        $result_pandora = mysqli_query($connect, $sql_pandora);
        ?>

        <ul class="products">
            <?php foreach ($result_pandora as $each) { ?>
                <li>
                    <a href="./product.php?id=<?= $each['id'] ?>" class="product-item">
                        <div class="product-top">
                            <div  class="product-thumb">
                                <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                            </div>
                        </div>
                        <div class="product-info">
                            <div  class="product-cat">
                                <?= $each['name'] ?>
                            </div>
                                <p class="product-price">
                                    <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                                </p>
                        </div>
                    </a>
                </li>
            <?php } ?>

    </div>

    <div id="intro">
        <div class="headline">
            <h3>Vòng mềm</h3>
        </div>

        <?php
        $sql = "select id from category_child where name = 'Vòng mềm'";
        $result = mysqli_query($connect, $sql);
        $category_child_id = mysqli_fetch_assoc($result)['id'];
        $sql_pandora = "SELECT * FROM products WHERE category_child_id='$category_child_id' order by id desc, status desc";
        $result_pandora = mysqli_query($connect, $sql_pandora);
        ?>

        <ul class="products">
            <?php foreach ($result_pandora as $each) { ?>
                <li>
                    <a href="./product.php?id=<?= $each['id'] ?>" class="product-item">
                        <div class="product-top">
                            <div class="product-thumb">
                                <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                            </div>
                        </div>
                        <div class="product-info">
                            <div  class="product-cat">
                                <?= $each['name'] ?>
                            </div>
                                <p class="product-price">
                                    <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                                </p>

                        </div>
                    </a>
                </li>
            <?php } ?>
    </div>

    <div id="intro">
        <div class="headline">
            <h3>Nhẫn bạc</h3>
        </div>

        <?php
            $sql = "select id from category_child where name = 'Nhẫn bạc'";
            $result = mysqli_query($connect, $sql);
            $category_child_id = mysqli_fetch_assoc($result)['id'];
            $sql_pandora = "SELECT * FROM products WHERE category_child_id='$category_child_id' order by id desc, status desc";
            $result_pandora = mysqli_query($connect, $sql_pandora);
        ?>

        <ul class="products">
            <?php foreach ($result_pandora as $each) { ?>
                <li>
                    <a class="product-item" href="./product.php?id=<?= $each['id'] ?>">
                        <div class="product-top">
                            <div class="product-thumb">
                                <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                            </div>
                        </div>
                        <div class="product-info">
                            <div  class="product-cat">
                                <?= $each['name'] ?>
                            </div>
                                <p class="product-price">
                                    <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                                </p>

                        </div>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>

<?php } ?>

<div id="intro">
    <div class="headline-last m-5" style="border-top: 5px solid #fbcad4">
        <h3 class="mt-2" style="font-weight: bold">Sản phẩm bán chạy</h3>
    </div>

    <?php
    $sql_pandora = "SELECT * from products 
    join (SELECT product_id FROM order_detail GROUP BY product_id ORDER BY COUNT(*) DESC) AS t 
    ON t.product_id = products.id";
    $result_pandora = mysqli_query($connect, $sql_pandora);
    ?>

    <ul class="products">
        <?php foreach ($result_pandora as $each) { ?>
            <li>
                <a class="product-item" href="./product.php?id=<?= $each['id'] ?>">
                    <div class="product-top">
                        <div class="product-thumb">
                            <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                        </div>
                    </div>
                    <div class="product-info">
                        <div class="product-cat">
                            <?= $each['name'] ?>
                        </div>
                        <p class="product-price">
                            <?= number_format($each['price'], 0, '.', ',') ?>&#8363
                        </p>

                    </div>
                </a>
            </li>
        <?php } ?>
    </ul>
</div>

<div id="intro" class="container  p-2 ">
    <div class="row" style="border-top: 5px solid #fbcad4">
        <div class="col-md-8">
            <ul class="products mt-5">
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/charmCubic.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                GỢI Ý QUÀ TẶNG
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item" >
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/daychuyen.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                SINH NHẬT THÁNG 4
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/nhanSignature.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                GIA ĐÌNH VÀ BẠN BÈ
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="products">
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/charmMuranoHong.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                TÔN VINH KHOẢNH KHẮC
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/charmDory.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                YÊU THƯƠNG ĐONG ĐẦY
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="./assets/images/products/vongNgoisao.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                BIỂU TƯỢNG MÀU SẮC
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="headline-last col-md-4 mt-5">
            <h3 class="mt-5" style="font-weight: 900">HƠN CẢ MỘT MÓN QUÀ</h3>
            <button style="background: #000; color: #fff">Xem thêm</button>
        </div>

    </div>
</div>

<div id="intro" class="container p-2">
    <div class="row " style="border-top: 5px solid #fbcad4">
        <div class="col-md-8">
            <ul class="products mt-5">
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/grandmother.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                BÀ
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/friends.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                BẠN BÈ
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/sister.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                CHỊ EM GÁI
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="products">
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/daughter.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                CON GÁI
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/mother.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                MẸ
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="product-item">
                        <div class="product-top">
                            <a href="#" class="product-thumb">
                                <img src="img/girlfriend.webp" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-suggest p-2">
                                NGƯỜI YÊU
                                <hr>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

        <div class="headline-last col-md-4 mt-5">
            <h3 class="mt-5" style="font-weight: 900">TẶNG NGƯỜI PHỤ NỮ BẠN YÊU</h3>
            <button style="background: #000; color: #fff">Xem thêm</button>
        </div>

    </div>
</div>

<div class="container album mb-5" style="border-top: 5px solid #fbcad4">
    <div class="row m-1 mt-4 mb-3">
        <h3 class="m-2 mb-3" style="font-weight: bold; text-align: center;">BỘ SƯU TẬP</h3>
        <div class="col-md-3" style="text-align: center;">
            <div class="product-item">
                <div class="product-top">
                    <a href="#" class="product-thumb">
                        <img src="img/pandora_moments.webp" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <h5 class="m-3" style="font-weight: bold;">Pandora Moments</h5>
                </div>
            </div>
            <button class="mt-4" style="background: #000; color: #fff; ">Xem thêm</button>
        </div>

        <div class="col-md-3" style="text-align: center;">
            <div class="product-item">
                <div class="product-top">
                    <a href="#" class="product-thumb">
                        <img src="img/pandora_timeless.webp" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <h5 class="m-3" style="font-weight: bold;">Pandora Timeless</h5>
                </div>
            </div>
            <button class="mt-4" style="background: #000; color: #fff; ">Xem thêm</button>
        </div>

        <div class="col-md-3" style="text-align: center;">
            <div class="product-item">
                <div class="product-top">
                    <a href="#" class="product-thumb">
                        <img src="img/pandoraME.webp" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <h5 class="m-3" style="font-weight: bold;">Pandora ME</h5>
                </div>
            </div>
            <button class="mt-4" style="background: #000; color: #fff; ">Xem thêm</button>
        </div>

        <div class="col-md-3" style="text-align: center;">
            <div class="product-item">
                <div class="product-top">
                    <a href="#" class="product-thumb">
                        <img src="img/disneyxPandora.webp" alt="">
                    </a>
                </div>
                <div class="product-info">
                    <h5 class="m-3" style="font-weight: bold;">Disney x Pandora</h5>
                </div>
            </div>
            <button class="mt-4" style="background: #000; color: #fff; ">Xem thêm</button>
        </div>
    </div>
</div>

<!-- image slider start -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <div class="d-block w-100">
                <h1>Thanh toán trả góp lãi suất 0% dành cho chủ thẻ tín dụng</h1>
                <a href="" style="font-size: 18px;">Xem thêm</a>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-block w-100">
                <h1>Miễn phí vẫn chuyển toàn bộ đơn hàng</h1>
                <a href="" style="font-size: 18px;">Xem thêm</a>
            </div>
        </div>
        <div class="carousel-item">
            <div class="d-block w-100">
                <h1>Chính sách đổi hàng trong 15 ngày</h1>
                <a href="" style="font-size: 18px;">Xem thêm</a>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
        <span class="carousel-control-prev-icon" style="color: #000;" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
        <span class="carousel-control-next-icon" style="color: #000;" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<br>

<div style="text-align:center">
    <span class="dot-ft"></span>
    <span class="dot-ft"></span>
    <span class="dot-ft"></span>
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


<script src="./assets/js/jquery-3.6.4.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script> -->
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="./assets/js/notify.js"></script>
<script>
    $(document).ready(function () {
        $.notify.addStyle('noti', {
            html: '<div><i class="bi bi-check-circle-fill"></i> <span data-notify-text/>☺</div>',
            classes: {
                base: {
                    "white-space": "nowrap",
                    "background-color": "black",
                    "padding": "12px",
                    "border-radius": "5px",
                },
                success: {
                    "color": "#468847",
                    "background-color": "#DFF0D8",
                    "font-size": "1.4rem"
                }
            }
        })

        $("#search").autocomplete({
            source: "search.php"
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li class='sub-search-item'>")
                .append(`<a href='./product.php?id=${item.value}' class='sub-search-link'>
                  <img class='sub-search-link__img' src='./assets/images/products/${item.image}' alt=''>
                  <h5 class='sub-search-link__name'>
                    ${item.label}
                  </h5>
                  <span class='sub-search-link__price'>
                  ${item.price}&#8363
                  </span>
                </a>`
                ).appendTo(ul);
        };

        $.notify("<?php if (isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
            style: 'noti',
            className: 'success'
        });
    });
</script>

<script src="./js/app.js"></script>

</body>

</html>
