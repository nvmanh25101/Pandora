<?php
    require_once '../../check_super_admin_signin.php';
    $page = "categories";
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

    $sql_num_category = "select count(*) from categories 
                    where name like '%$search%'";
    $arr_num_category = mysqli_query($connect, $sql_num_category);
    $result_num_category = mysqli_fetch_array($arr_num_category);
    $num_category = $result_num_category['count(*)'];

    $num_category_per_page = 10;

    $num_page = ceil($num_category / $num_category_per_page);
    $skip_page = $num_category_per_page * ($page_current - 1);

    $sql = "select category_child.id, category_child.name, categories.name as category_name from category_child
    join categories 
    on category_child.category_id = categories.id
    where category_child.name like '%$search%'
    order by category_child.id desc
    limit $num_category_per_page offset $skip_page
    ";
    $result = mysqli_query($connect, $sql);

    $sql = "select * from categories";
    $category = mysqli_query($connect, $sql);
?>

        <div class="main__container">
        <div class="main-container-text d-flex align-items-center justify-content-center">
            <a class="header__name text-decoration-none" href="#">Loại phụ</a>
        </div>
            <div class="container-fluid px-4">
                <form action="process_insert.php" method="post" enctype="multipart/form-data" class="col-4">
                    <h2 class="text-center">Thêm loại phụ</h2>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="name">Loại chính</label>
                        <select name="category" class="form__select form-select">
                            <option value="" selected disabled hidden>Chọn</option>
                            <?php foreach ($category as $each) { ?>
                                <option value="<?= $each['id'] ?>">
                                    <?= $each['name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <span id="error" class="error_input"></span>
                    </div>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form__input form-control" autocomplete="off"/>
                        <span id="error" class="error_input"></span>
                    </div>

                    <button type="submit" class="form__btn btn btn-dark mb-4">Thêm</button>
                </form>

                <?php include '../../error_success.php' ?>
                
                <div class="row gx-5">
                    <div class="col-12">
                        <table class="category__table table table-sm table-bordered table-hover align-middle">
                            <thead>
                                <tr>
                                <th scope="col">Mã</th>
                                <th scope="col">Loại</th>
                                <th scope="col">Loại chính</th>
                                <th scope="col">Sửa</th>
                                <th scope="col">Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $each) { ?>
                                <tr>
                                    <th scope="row"><?= $each['id'] ?></th>
                                    <td>
                                        <a href="./show.php?id=<?= $each['id'] ?>" class="text-decoration-none">
                                            <?= $each['name'] ?>
                                        </a>
                                    </td>
                                    <td> <?= $each['category_name'] ?></td>
                                    <td>
                                        <a href="form_update.php?id=<?= $each['id'] ?>">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="delete.php?id=<?= $each['id'] ?>">
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

<?php require_once '../../footer.php';?>