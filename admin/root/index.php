<?php 
    require_once '../check_admin_signin.php';
    $page = "root";
    require_once '../navbar-vertical.php';

    require_once '../../database/connect.php';

//    $sql = "select count(*) from users where role = '1'";
//    $admin = mysqli_query($connect, $sql);
//    $admin_quantity = mysqli_fetch_array($admin)['count(*)'];
//    $sql = "select count(*) from users where role = '0'";
//    $customer = mysqli_query($connect, $sql);
//    $customer_quantity = mysqli_fetch_array($customer)['count(*)'];
//    $sql = "select count(*) from categories";
//    $category = mysqli_query($connect, $sql);
//    $category_quantity = mysqli_fetch_array($category)['count(*)'];
//    $sql = "select count(*) from products";
//    $product = mysqli_query($connect, $sql);
//    $product_quantity = mysqli_fetch_array($product)['count(*)'];
?>

        <div class="main__container">
            <div class="container-fluid px-4">
                
<!--                --><?php //require_once '../error_success.php' ?>

                <div class="row gx-5">
                    <div class="col-md-3 mt-5">
                        <a class="card d-flex flex-column" href="../orders">
                            <div class="card__icon d-flex flex-fill">
                                <i class="bi bi-cart-dash-fill"></i>
                            </div>
                            <div class="card__content d-flex justify-content-center">
                                <h2 class="card__name">Đơn hàng</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mt-5">
                        <a class="card d-flex flex-column" href="../products">
                            <div class="card__icon d-flex flex-fill">
                                <i class="bi bi-vinyl-fill"></i>
                            </div>
                            <div class="card__content d-flex justify-content-center">
                                <h2 class="card__name">Trang sức</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mt-5">
                        <a class="card d-flex flex-column" href="../categories">
                            <div class="card__icon d-flex flex-fill">
                                <i class="bi bi-list-ul"></i>
                            </div>
                            <div class="card__content d-flex justify-content-center">
                                <h2 class="card__name">Loại trang sức</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mt-5">
                        <a class="card d-flex flex-column" href="../accounts">
                            <div class="card__icon d-flex flex-fill">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="card__content d-flex justify-content-center">
                                <h2 class="card__name">Tài khoản</h2>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 mt-5">
                        <a class="card d-flex flex-column" href="../sizes">
                            <div class="card__icon d-flex flex-fill">
                                <i class="bi bi-border-width"></i>
                            </div>
                            <div class="card__content d-flex justify-content-center">
                                <h2 class="card__name">Kích thước</h2>
                            </div>
                        </a>
                    </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        $('.btn-menu').click(function() {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });
    })
</script>
</body>
</html>