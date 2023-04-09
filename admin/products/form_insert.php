<?php
require_once '../check_admin_signin.php';
$page = 'products';

$admin_id = $_SESSION['id'];
require_once '../navbar-vertical.php';

require_once '../../database/connect.php';

$sql = "select * from categories";
$result = mysqli_query($connect, $sql);
?>
<div class="main__form">
    <div class="main-container-text d-flex align-items-center justify-content-center">
        <a class="header__name text-decoration-none" href="#">
            Thêm sản phẩm
        </a>
    </div>
    <div class="container-fluid px-4">
        <?php include '../error_success.php' ?>

        <div class="row gx-5">
            <div class="col-12">

                <form action="process_insert.php" method="post" enctype="multipart/form-data">
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="name">Tên</label>
                        <input type="text" name="name" id="name" class="form__input form-control" autocomplete="off"/>
                    </div>

                    <div class="mb-4 fs-4">
                        <label class="form-label fs-4" for="image" role="button">
                            Ảnh trang sức
                            <img id="product__img" class="ms-4" src="../../assets/images/products/no-image.jpg"
                                 alt="Ảnh trang sức" width="200" height="200"/>
                        </label>
                        <input type="file" hidden name="image" id="image" accept=".jpg, .png"
                               class="form__input form-control"/>
                    </div>
                    <div class="row mb-1 fs-4" id="size_quantity">
                        <div class="col-6 d-flex flex-row">
                            <div class="">
                                <label class="form-label" for="size">Kích thước(cm)</label>
                                <input type="text" name="size[]" id="size" class="form__input form-control"/>
                            </div>

                            <div class="ms-1">
                                <label class="form-label" for="quantity">Số lượng</label>
                                <input type="number" name="quantity[]" id="quantity" min="1"
                                       class="form__input form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="mb-5 fs-4" id="add_size">
                        <i class="bi bi-plus-circle"></i>
                    </div>

                    <div class="mb-4 fs-4">
                        <label class="form-label" for="image">Màu sắc</label>
                        <input type="text" name="color" id="color" class="form__input form-control"/>
                    </div>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="image">Chất liệu</label>
                        <input type="text" name="material" id="material" class="form__input form-control"/>
                    </div>
                    <div class="mb-4 fs-4">
                        <label class="form-label" for="image">Giá(vnđ)</label>
                        <input type="number" name="price" id="price" min="1" class="form__input form-control"/>
                    </div>

                    <div class="mb-4 fs-4">
                        <label class="form-label">Mô tả</label>
                        <textarea name="description" class="form__input form-control"></textarea>
                    </div>

                    <div class="mb-4 fs-4">
                        <label class="form-label">Loại trang sức</label>
                        <select class="form__select form-select" id="category">
                            <option value="" selected disabled hidden>Chọn</option>
                            <?php foreach ($result as $each) { ?>
                                <option value="<?= $each['id'] ?>">
                                    <?= $each['name'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <select class="form__select form-select d-none mt-4" name="category" id="category_detail">
                            <option value="" selected disabled hidden>Chọn</option>
                        </select>

                        <input type="hidden" name="admin_id" value="<?= $admin_id ?>">
                    </div>

                    <button type="submit" class="form__btn btn mb-4">Thêm</button>
                </form>
            </div>

        </div>
    </div>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function () {
        $('#category').change(function () {
            let category_id = $(this).val();
            $.ajax({
                url: './get_category_child.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    category_id
                }
            })

                .done(function (res) {
                    const arrId = Object.keys(res);
                    const arrName = Object.values(res);

                    $('#category_detail').removeClass('d-none');
                    $('#category_detail').html('');
                    for (let i = 0; i < arrId.length; i++) {
                        $('#category_detail').append(`
                        <option value="${arrId[i]}">${arrName[i]}</option>
                    `);
                    }
                })
        });

        $('#add_size').click(function () {
            $('#size_quantity').append(`
                <div class="col-6 d-flex flex-row">
                    <div class="">
                        <label class="form-label" for="size">Kích thước(cm)</label>
                        <input type="text" name="size[]" id="size" class="form__input form-control" />
                    </div>

                    <div class="ms-1">
                        <label class="form-label" for="quantity">Số lượng</label>
                        <input type="number" name="quantity[]" id="quantity" class="form__input form-control" />
                    </div>
                    <button type="button" class="delete-size">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </div>
            `);
            $('.delete-size').click(function() {
                $(this).parent().remove();
            });
        })

        $('#image').change(function (e) {
            $('#product__img').attr('src', URL.createObjectURL(e.target.files[0]));
        });

        $('.btn-menu').click(function () {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });
    });
</script>
</body>

</html>