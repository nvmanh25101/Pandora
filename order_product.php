<?php
require './database/connect.php';
session_start();
if (empty($_SESSION['id'])) {
    header("location:signin.php");
}
$idCus = $_SESSION['id'];
$idOrder = $_GET['order_id'];
$sqlTtin = "SELECT id, name_receiver, address_receiver, phone_receiver, DATE_FORMAT(created_at, '%d/%m/%Y %T') as created_at, status, total_price FROM orders WHERE id = $idOrder and user_id = $idCus";
$resultTtin = mysqli_query($connect, $sqlTtin);
$rowTtin = mysqli_fetch_assoc($resultTtin);

$sqlBanh = "SELECT order_detail.*, products.image, products.id FROM products,order_detail WHERE order_id = $idOrder and order_detail.product_id = products.id";
$resultBanh = mysqli_query($connect, $sqlBanh);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="viewport" content="width=device-width">
    <title>DON HANG - PANDORA</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/order.css">
</head>
<body>
<?php require './header.php'; ?>
<div class="order-product mb-3">
    <h2>Thông tin đơn hàng</h2>
    <div class="order-product-content">

        <div class="order-left">
            <h1>Mã đơn hàng: <?php echo $rowTtin['id'] ?></h1>
            <p class="mt-3">Tên người đặt: <?php echo $rowTtin['name_receiver'] ?></p>
            <p>Thời gian đặt hàng: <?php echo $rowTtin['created_at'] ?></p>
            <p>Số điện thoại: <?php echo $rowTtin['phone_receiver'] ?></p>
            <p>Địa chỉ giao hàng: <?php echo $rowTtin['address_receiver'] ?></p>
            <h1>Thông tin sản phẩm:</h1>
        </div>
        <div class="order-right">
            <p class="order-text">Trạng thái:
                <?php switch ($rowTtin['status']) {
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
                } ?>
            </p>
        </div>
    </div>

    <table class="cart-table full ">
        <thead class="cart__row">

        <tr class="spaceUnder">
            <th class="item-img">Ảnh</th>
            <th class="item-content-text">Chi tiết sản phẩm</th>
            <th class="item-content-price">Đơn giá</th>
            <th class="item-amount">Số lượng</th>
            <th class="item-total-price">Thành tiền</th>
        </tr>
        </thead>
        <tbody>

        <?php
        if (mysqli_num_rows($resultBanh) > 0) {
            while ($rowBanh = mysqli_fetch_assoc($resultBanh)) { ?>
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
                            <?php echo $rowBanh['quantity'] ?>
                        </div>
                    </td>
                    <td class="item-totall-price" data-label="Tổng giá">
                        <span class="item-price">
                            <?php echo number_format($rowBanh['price'] * $rowBanh['quantity']) ?>&#8363
                        </span>
                        <?php
                        $order_id = $rowTtin['id'];
                        $product_id = $rowBanh['product_id'];
                        $sql = "select * from votes 
                            JOIN products ON products.id = votes.product_id
                            JOIN order_detail
                            ON order_detail.product_id = votes.product_id
                            JOIN sizes
                            ON sizes.name = order_detail.size
                            WHERE order_detail.order_id = $order_id and votes.user_id = $idCus and votes.product_id = $product_id";
                        $result_vote = mysqli_query($connect, $sql);
                        if ($rowTtin['status'] == 3 && mysqli_num_rows($result_vote) == 0) { ?>
                            <span class="item-vote">
                          <button class="vote " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Đánh giá</button>
                        </span>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Đánh giá sản phẩm</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <form action="process-votes.php" method="Post">
                                            <div class="modal-body">
                                                <div class="product-vote">
                                                    <div class="product-vote-item">
                                                        <div class="product-vote-top me-2">
                                                            <div class="product-vote-thumb">
                                                                <img src="./assets/images/products/<?= $rowBanh['image'] ?>"
                                                                     alt="">
                                                            </div>
                                                        </div>
                                                        <div class="product-vote-info">
                                                            <div class="product-vote-cat">
                                                                <?= $rowBanh['name'] ?>
                                                            </div>
                                                            <p class="product-vote-price">
                                                                <?= $rowBanh['size'].'-'.$rowBanh['color'].'-'.$rowBanh['material'] ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="item-modal-vote">
                                                        Chất lượng sản phẩm
                                                        <input type="hidden" name="id" value="<?= $rowBanh['id'] ?>"/>
                                                        <input type="hidden" name="id_user" value="<?= $idCus ?>"/>
                                                        <div class="rate">
                                                            <input type="radio" id="star5" name="rate" value="5"/>
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="rate" value="4"/>
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="rate" value="3"/>
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="rate" value="2"/>
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="rate" value="1"/>
                                                            <label for="star1" title="text">1 star</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="order_id" value="<?= $rowTtin['id'] ?>">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="send-votes glow-on-hover">
                                                    Gửi đánh giá
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php } else { ?>
                            <span class="item-vote">
                                <button class="vote " type="button">Bạn đã đánh giá sản phẩm này</button>
                            </span>
                        <?php } ?>
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

        $.notify("<?php if (isset($_SESSION['success'])) {echo $_SESSION['success']; unset($_SESSION['success']);}  ?>", {
            style: 'noti',
            className: 'success'
        });
    });
</script>
<script src="js/app.js"></script>
<script src="js/product.js"></script>
</body>
</html>