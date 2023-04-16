<?php 
    require_once '../check_super_admin_signin.php';
    $page = "accounts";
    require_once '../navbar-vertical.php';

    require_once '../../database/connect.php';

    $page_current = 1;
    if(isset($_GET['page'])) {
        $page_current = $_GET['page'];
    }

    $search = '';
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $sql_num_employee = "select count(*) from users
                    where name like '%$search%'";
    $arr_num_employee = mysqli_query($connect, $sql_num_employee);
    $result_num_employee = mysqli_fetch_array($arr_num_employee);
    $num_employee = $result_num_employee['count(*)'];

    $num_employee_per_page = 10;

    $num_page = ceil($num_employee / $num_employee_per_page);
    $skip_page = $num_employee_per_page * ($page_current - 1);

    $sql = "select * from users 
            where 
            name like '%$search%' and role = '1'
            order by deleted_at, id  desc
            limit $num_employee_per_page offset $skip_page
            ";
    $result = mysqli_query($connect, $sql);
?>

        <div class="main__container">
        <div class="main-container-text d-flex align-items-center justify-content-center">
            <a class="header__name text-decoration-none" href="#">Nhân viên</a>
        </div>
            <div class="container-fluid px-4">
                <a href="form_insert.php" class="btn btn-dark btn-lg fs-3">Thêm</a>
                <?php require_once '../error_success.php' ?>
                <div class="row gx-5">
                    <div class="col-12">
                        <table class="account__table table table-sm table-bordered table-hover align-middle">
                            <caption class="caption-top text-center mb-2">
                            <thead>
                                <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Tên nhân viên</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">Email</th>
                                <th scope="col">Giới tính</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($result as $each) { ?>
                                <tr>
                                    <th scope="row">
                                        <a href="./detail.php?id=<?= $each['id'] ?>" class="text-decoration-none">
                                            <?= $each['id'] ?>
                                        </a>
                                    </th>
                                    <td>
                                        <a href="./detail.php?id=<?= $each['id'] ?>" class="text-decoration-none">
                                            <?= $each['name'] ?>
                                        </a>
                                    </td>
                                    <td>
                                        <img class="account__img" src="../../assets/images/admin/<?= $each['avatar'] ?>" alt="Avatar">
                                    </td>
                                    <td><?= $each['email'] ?></td>
                                    <td><?= $each['gender'] === 1?'Nam':'Nữ' ?></td>
                                    <td><?= $each['phone'] ?></td>
                                    <?php  if (empty($each['deleted_at'])) { ?>
                                        <td>
                                            <a href="form_update.php?id=<?= $each['id'] ?>">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                        </td>
                                        <td>
                                            <a onclick="showNoti(<?= $each['id'] ?>)">
                                                <i class="bi bi-trash-fill"></i>
                                            </a>
                                        </td>
                                    <?php } else { ?>
                                        <td colspan="2">
                                            Nghỉ việc,
                                            <a href="restore.php?id=<?= $each['id'] ?>" class="text-decoration-none text-center">
                                                Mở lại <i class="bi bi-arrow-clockwise"></i>
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