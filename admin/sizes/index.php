<?php
    require_once '../check_super_admin_signin.php';
    $page = "sizes";
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

    $sql_num_size = "select count(*) from sizes 
                    where name like '%$search%'";
    $arr_num_size = mysqli_query($connect, $sql_num_size);
    $result_num_size = mysqli_fetch_array($arr_num_size);
    $num_size = $result_num_size['count(*)'];

    $num_size_per_page = 10;

    $num_page = ceil($num_size / $num_size_per_page);
    $skip_page = $num_size_per_page * ($page_current - 1);

    $sql = "select * from sizes
    where name like '%$search%'
    order by id desc
    limit $num_size_per_page offset $skip_page
    ";
    $result = mysqli_query($connect, $sql);
?>

        <div class="main__container">
        <div class="main-container-text d-flex align-items-center justify-content-center">
            <a class="header__name text-decoration-none" href="#">Kích thước</a>
        </div>
            <div class="container-fluid px-4">
                <form action="process_insert.php" method="post" enctype="multipart/form-data" class="col-4">
                    <h2 class="text-center">Thêm kích thước</h2>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form__input form-control" autocomplete="off"/>
                        <span id="error" class="error_input"></span>
                    </div>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="image">Mô tả</label>
                        <input type="text" name="description" id="description" class="form__input form-control" autocomplete="off"/>
                        <span id="error" class="error_input"></span>
                    </div>
                    <button type="submit" class="form__btn btn btn-dark mb-4">Thêm</button>
                </form>

                <?php include '../error_success.php' ?>
                
                <div class="row gx-5">
                    <div class="col-12">
                        <table class="category__table table table-sm table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Kích thước</th>
                                <th scope="col">Mô tả</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $each) { ?>
                                <tr>
                                    <th scope="row"><?= $each['id'] ?></th>
                                    <td>
                                        <?= $each['name'] ?>
                                    </td>
                                    <td>
                                        <?= $each['description'] ?>
                                    </td>
                                    <td>
                                        <a href="form_update.php?id=<?= $each['id'] ?>">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a onclick="return showNoti(<?= $each['id'] ?>)">
                                        <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once '../footer.php';?>