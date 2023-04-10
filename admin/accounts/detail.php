<?php

require_once '../check_admin_signin.php';
$page = "accounts";
require_once '../navbar-vertical.php';

require_once '../../database/connect.php';
if (empty($_GET['id'])) {
    header('location:../root.php');
    exit();
}

$id = $_GET['id'];

$sql = "select *
     from users
     where id = '$id'";

$users = mysqli_query($connect, $sql);
$user = mysqli_fetch_array($users);

?>
    <div class="main__container">

        <div class="container-fluid px-5">
            <div class="user__profile-container">
                <div class="user__avatar">
                    <figure class="user__avatar-img">
                        <img src="../../assets/images/admin/<?= $user['avatar'] ?>" alt="">
                    </figure>
                </div>
                <h3 class="title"><?= $user['name'] ?></h3>
            </div>
            <div class="user__profile mt-5">
                <span class=" d-block"><strong>Email:</strong> <?= $user['email'] ?></span>
                <br>
                <span class=" d-block"><strong>Ngày sinh:</strong> <?php
                    $date1 = date_create($user['birth_date']);
                     echo date_format($date1,"d/m/Y");
                    ?></span>
                <br>
                <span class=" d-block"><strong>Giới tính:</strong> <?= $user['gender'] === '1' ? 'Nam' : 'Nữ' ?></span>
                <br>
                <span class=" d-block"><strong>Số điện thoại:</strong> <?= $user['phone'] ?></span>
                <br>
                <span class=" d-block"><strong>Địa chỉ:</strong> <?= $user['address'] ?></span>
                <br>
                <span class=" d-block"><strong>Chức vụ:</strong> <?= $user['role'] === '2' ? 'Quản lý' : 'Nhân viên' ?></span>
                <br>
                <span class=" d-block"><strong>Thời gian tạo tài khoản:</strong> <?php
                    $date1 = date_create($user['created_at']);
                    $date2 = new DateTime("now");
                    echo date_format($date1,"d/m/Y");
                    $interval = $date1->diff($date2);
                    $year = $interval->y === '0' ? " năm, " : '';
                    $month = $interval->m === '0' ? " tháng, " : '';
                    echo " (Khoảng " . $year . $month . $interval->d." ngày trước)";
                    ?>
                </span>
                <br>
                <span class=" d-block"><strong>Trạng thái:</strong> <?= $user['deleted_at'] ?? 'Đi làm' ?></span>
            </div>

            <div class="user__profile-action mt-5 d-flex justify-content-center">
                <a href="../accounts/form_update.php?id=<?= $user['id'] ?>" class="btn btn-update-info">Chỉnh sửa</a>
            </div>
        </div>
    </div>

<?php require '../footer.php' ?>