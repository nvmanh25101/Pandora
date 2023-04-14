<?php
require_once '../check_admin_signin.php';
$page = "orders";
require_once '../navbar-vertical.php';
require_once '../../database/connect.php';

$page_current = 1;
if (isset($_GET['page'])) {
    $page_current = $_GET['page'];
}

$sql_num_order = "select count(*) from orders";
$arr_num_order = mysqli_query($connect, $sql_num_order);
$result_num_order = mysqli_fetch_array($arr_num_order);
$num_order = $result_num_order['count(*)'];

$num_order_per_page = 10;

$num_page = ceil($num_order / $num_order_per_page);
$skip_page = $num_order_per_page * ($page_current - 1);
$sql = "SELECT orders.id, name_receiver, address_receiver, phone_receiver, DATE_FORMAT(orders.created_at, '%d/%m/%Y %T') as created_at, orders.status, users.name, orders.user_admin_id 
    from orders
    join users on orders.user_id = users.id
    limit $num_order_per_page offset $skip_page";
$result = mysqli_query($connect, $sql);
?>
<div class="main__container">
    <div class="main-container-text d-flex align-items-center justify-content-center">
        <a class="header__name text-decoration-none" href="#">Đơn hàng</a>
    </div>

    <div class="container-fluid">
        <a href="statistics.php" class="btn-insert btn btn-dark btn-lg">Thống kê</a>
        <div class="row gx-5">
            <div class="col-12">
                <div class="table-responsive-sm">
                    <table class="order_table table table-sm table-light align-middle">
                        <thead style="text-align : center;">
                            <tr>
                                <th class="id-product" scope="col">Mã đơn</th>
                                <th class="orderer-product" scope="col">Người đặt</th>
                                <th class="recipient-product" scope="col">Người nhận</th>
                                <th class="time-product" scope="col">Thời gian đặt</th>
                                <th class="status-order" scope="col">Trạng thái</th>
                                <th class="status-order" scope="col">Người duyệt đơn</th>
                                <th class="manage-order" scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            <?php foreach ($result as $each) { ?>
                                <tr>
                                    <th class="id-numbers" scope="col">
                                        <a style="text-decoration:none; color:#333;" href="./detail.php?id=<?= $each['id'] ?>"><?= $each['id'] ?></a>
                                    </th>
                                    <th scope="col">
                                        <span class="nameofyou"><?= $each['name'] ?></span>
                                    </th>
                                    <th scope="col">
                                        <span class="nameofyou"><?= $each['name_receiver'] ?></span> <br>
                                        <span><?= $each['phone_receiver'] ?></span> <br>
                                        <span><?= $each['address_receiver'] ?></span>
                                    </th>

                                    <th scope="col"><?= $each['created_at'] ?></th>
                                    <th scope="col" style="font-weight:600;">
                                        <?php switch ($each['status']) {
                                            case 0:
                                                echo "Mới đặt";
                                                break;
                                            case 1:
                                                echo "Đang chuẩn bị hàng";
                                                break;
                                            case 2:
                                                echo "Đang giao hàng";
                                                break;
                                            case 3:
                                                echo "Hoàn thành";
                                                break;
                                            case 4:
                                                echo "Người đặt đã huỷ";
                                                break;
                                            case 5:
                                                echo "Người bán đã huỷ";
                                                break;
                                        }
                                        ?>
                                    </th>
                                    <th scope="col"><?php
                                        $admin_id = $each['user_admin_id'];
                                        $sql_admin = "select name from users where id = '$admin_id'";
                                        $result_admin = mysqli_query($connect, $sql_admin);
                                        $admin = mysqli_fetch_array($result_admin);
                                        echo $admin['name'] ?? "Chưa cập nhật";
                                        ?></th>
                                    <th scope="col">
                                        <div class="two_buttons">
                                            <?php if ($each['status'] == 1) { ?>
                                                    <form action="./update.php" method="post">
                                                        <input type="hidden" name="id" value="<?= $each['id'] ?>">
                                                        <input type="hidden" name="status" value="2">
                                                        <button class="btn btnBrowser">Giao hàng</button>
                                                    </form>
                                            <?php } else if($each['status'] == 2) { ?>
                                                <form action="./update.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $each['id'] ?>">
                                                    <input type="hidden" name="status" value="3">
                                                    <button class="btn btnBrowser">Hoàn thành</button>
                                                </form>
                                            <?php } else if ($each['status'] == 0){ ?>
                                                <form action="./update.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $each['id'] ?>">
                                                    <input type="hidden" name="status" value="1">
                                                    <input type="hidden" name="user_admin_id" value="<?= $_SESSION['id'] ?>">
                                                    <button class="btn btnBrowser">Duyệt</button>
                                                </form>
                                                <form action="./update.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $each['id'] ?>">
                                                    <input type="hidden" name="status" value="5">
                                                    <input type="hidden" name="user_admin_id" value="<?= $_SESSION['id'] ?>">
                                                    <button class="btn btnBrowser">Hủy</button>
                                                </form>
                                            <?php } else { ?>
                                            <?php } ?>
                                        </div>
                                    </th>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require '../footer.php' ?>