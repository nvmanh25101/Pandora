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
  order by category_child_id ASC, products.id desc";

$result = mysqli_query($connect, $sql);
if (mysqli_num_rows($result) === 0) {
    $error = 'Không có sản phẩm nào';
} else {
    $category_name = mysqli_fetch_array($result)['category_name'];
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <title>Pandora Việt Nam</title>
    <link rel="shortcut icon" type="image" href="img/myLogo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</head>

<body>
<?php require './header.php'; ?>

<div class="new-item container">
    <div class="row m-5">
        <div class="col-md">
            <h3 style="font-weight: 700;font-size: 22px;">Khám phá thế giới trang sức tuyệt mỹ</h3>
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
<div id="intro">
    <div class="headline">
        <h3><?= $category_name ?? $error ?></h3>

    </div>
    <ul class="products">
        <?php foreach ($result as $each) { ?>
            <li>
                <div class="product-item">
                    <div class="product-top">
                        <a href="./product.php?id=<?= $each['id'] ?>" class="product-thumb">
                            <img src="./assets/images/products/<?= $each['image'] ?>" alt="">

                        </a>
                    </div>
                    <div class="product-info">
                        <a href="./product.php?id=<?= $each['id'] ?>" class="product-cat"><?= $each['name'] ?></a>
                        <p class="product-name">GN<?= $each['id'] ?></p>
                        <div class="product-price-action">
                            <p class="product-price"><?= number_format($each['price'], 0, '.', ',') ?></p>
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


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


<script src="js/app.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="./assets/js/notify.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $('document').ready(function () {
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
                )
                .appendTo(ul);
        };

        $.notify("<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>", "success");
    });
</script>


</body>

</html>
