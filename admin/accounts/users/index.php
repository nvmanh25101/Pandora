<?php 
    require_once '../../check_admin_signin.php';
    $page = "accounts";
    require_once './navbar-vertical.php';

    require_once '../../../database/connect.php';

    $page_current = 1;
    if(isset($_GET['page'])) {
        $page_current = $_GET['page'];
    }

    $search = '';
    if(isset($_GET['search'])) {
        $search = $_GET['search'];
    }

    $sql_num_user = "select count(*) from users
                    where name like '%$search%'";
    $arr_num_user = mysqli_query($connect, $sql_num_user);
    $result_num_user = mysqli_fetch_array($arr_num_user);
    $num_user = $result_num_user['count(*)'];

    $num_user_per_page = 10;

    $num_page = ceil($num_user / $num_user_per_page);
    $skip_page = $num_user_per_page * ($page_current - 1);

    $sql = "select * from users 
            where 
            name like '%$search%' and role = '0'
            order by id desc
            limit $num_user_per_page offset $skip_page
            ";
    $result = mysqli_query($connect, $sql);
?>

        <div class="main__container">
        <div class="main-container-text d-flex align-items-center justify-content-center">
            <a class="header__name text-decoration-none" href="#">Khách hàng</a>
        </div>
            <div class="container-fluid px-4">
                <?php require_once '../../error_success.php' ?>
                <div class="row gx-5">
                    <div class="col-12">
                        <table class="account__table table table-sm table-bordered table-hover align-middle">
                            <caption class="caption-top text-center mb-2">
                            <thead>
                                <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Tên khách hàng</th>
                                <th scope="col">Ảnh đại diện</th>
                                <th scope="col">Email</th>
                                <th scope="col">Giới tính</th>
                                <th scope="col">Số điện thoại</th>
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
                                    <td><?= $each['name'] ?></td>
                                    <td>
                                        <img class="account__img" src="../../assets/images/user/<?= $each['avatar'] ?>" alt="Avatar">
                                    </td>
                                    <td><?= $each['email'] ?></td>
                                    <td><?= $each['gender'] === 1?'Nam':'Nữ' ?></td>
                                    <td><?= $each['phone'] ?></td>

                                </tr>
                                <?php } ?>
                               
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../../footer.php'; ?>