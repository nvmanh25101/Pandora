<?php
require_once '../check_admin_signin.php';
$page = 'products';
require_once '../../database/connect.php';

$where = '1';
$page_current = 1;
if (isset($_GET['page'])) {
    $page_current = $_GET['page'];
}

$search = '';
if (isset($_GET['search'])) {
    $search = htmlspecialchars($_GET['search'], ENT_QUOTES);
    $where = "products.name like '%$search%' or products.id like '%$search%'";
}

if (isset($_GET['search_status'])) {
    $where = 'products.status like ' . $_GET['search_status'];
}

$sql_num_product = "select count(*) from products 
                    where $where";
$arr_num_product = mysqli_query($connect, $sql_num_product);
$result_num_product = mysqli_fetch_array($arr_num_product);
$num_product = $result_num_product['count(*)'];

$num_product_per_page = 10;

$num_page = ceil($num_product / $num_product_per_page);
$skip_page = $num_product_per_page * ($page_current - 1);

$sql = "select products.*, category_child.name as category_name, users.name as admin_name, products.user_id, sizes.name AS name_size, product_size.quantity, product_size.size_id
    from products
    join category_child
    on category_child.id = products.category_child_id
    join users
    on users.id = products.user_id
    left join product_size
    on product_size.product_id = products.id
    left JOIN sizes
    ON product_size.size_id = sizes.id
    where $where
    ORDER BY status desc,id DESC
    limit $num_product_per_page offset $skip_page
    ";
$result = mysqli_query($connect, $sql);

require_once '../navbar-vertical.php';
?>

<div class="main__container">
    <div class="main-container-text d-flex align-items-center justify-content-center">
        <a class="header__name text-decoration-none" href="#">Trang sức</a>
    </div>
    <div class="container-fluid px-4 mt-2">
        <a href="form_insert.php" class="btn-insert btn btn-dark btn-lg">Thêm</a>
        <div class="row gx-5">
            <div class="col-12">
                <div class="table-responsive-sm">
                    <table class="product__table table table-sm table-light table-bordered  align-middle">

                        <?php require_once '../error_success.php' ?>
                        <thead>
                            <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Tên trang sức</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Kích thước</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Loại</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Người thêm</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $each) { ?>
                                <tr>
                                    <th scope="row">
                                        <a href="detail.php?id=<?= $each['id'] ?>" class="text-decoration-none"><?= $each['id'] ?></a>
                                    </th>
                                    <td>
                                        <a href="detail.php?id=<?= $each['id'] ?>" class="text-decoration-none"><?= $each['name'] ?></a>
                                    </td>
                                    <td>
                                        <img class="products__img" src="../../assets/images/products/<?= $each['image'] ?>" alt="">
                                    </td>
                                    <td><?php
                                        if ($each['name_size'] !== 'One size') {
                                            echo $each['name_size']; ?> cm
                                        <?php } else {
                                            echo $each['name_size'];
                                        }
                                        ?>
                                    </td>
                                    <td><?= number_format($each['price'], 0, '.', ' ') ?>&#8363</td>
                                    <td><?= $each['category_name'] ?></td>
                                    <td><?= $each['quantity'] ?></td>
                                    <td><?php
                                        if ($each['status'] == '1' && $each['quantity'] > 0) { ?>
                                            Đang bán
                                        <?php } else if($each['status'] == '1' && $each['quantity'] == 0){ ?>
                                            Hết hàng
                                        <?php } else { ?>
                                            Ngừng bán
                                        <?php } ?>
                                    </td>
                                    <td><?= $each['admin_name'] ?></td>
                                    <?php if ($each['status'] == '1' && $each['quantity'] > 0) { ?>
                                        <td>
                                            <a href="form_update.php?id=<?= $each['id'] ?>&admin_id=<?= $each['user_id'] ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a onclick="showNoti(<?= $each['id'] ?>, <?= $each['user_id'] ?>, <?= $each['size_id'] ?>)">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    <?php } else if ($each['status'] == '1' && $each['quantity'] == 0){ ?>
                                        <td colspan="2">
                                            <a href="form_update.php?id=<?= $each['id'] ?>&admin_id=<?= $each['user_id'] ?>" class="text-decoration-none d-flex justify-content-center">
                                                <i class="bi bi-plus-circle fs-1 me-2"></i>
                                            </a>
                                        </td>
                                    <?php } else { ?>
                                        <td colspan="2">
                                            <a href="update_status.php?id=<?= $each['id'] ?>&admin_id=<?= $each['user_id'] ?>">
                                                Mở bán
                                            </a>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<?php require_once '../footer.php'; ?>