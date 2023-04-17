<?php 
    require_once '../check_admin_signin.php';
    $page = 'products';
    
    if(empty($_GET['id'])) {
        $_SESSION['error'] = 'Phải chọn để sửa!';
        header('location:index.php');
        exit();
    }

    if($_GET['admin_id'] != $_SESSION['id'] || $_SESSION['role'] != 2) {
        $_SESSION['error'] = 'Bạn không có quyền để truy cập!';
        header('location:index.php');
        exit();
    }

    $id = $_GET['id'];
    require_once '../../database/connect.php';

    $sql = "select products.*, categories.id as category_id, product_size.quantity, sizes.name as size_name
    from products
    join category_child
    on category_child.id = products.category_child_id
    join categories
    on categories.id = category_child.category_id
    left join product_size
    on product_size.product_id = products.id
    left JOIN sizes
    ON product_size.size_id = sizes.id
    where products.id = '$id'";
    $result = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($result);

    $sql = "select * from categories";
    $categories = mysqli_query($connect, $sql);

    $sql = "select * from category_child where category_id = '$each[category_id]'";
    $category_child = mysqli_query($connect, $sql);

    $sql = "select sizes.*, product_size.quantity from sizes
        join product_size
        on product_size.size_id = sizes.id
        where product_size.product_id = '$id'";
    $result = mysqli_query($connect, $sql);
    require_once '../navbar-vertical.php';
?>
    <div class="main__form">
        <div class="main-container-text d-flex align-items-center justify-content-center">
            <a class="header__name text-decoration-none" href="#">
                Sửa sản phẩm
            </a>
        </div>
        <div class="container-fluid px-4">
            <?php include '../error_success.php' ?>

            <div class="row gx-5">
                <div class="col-12">

                     <form action="process_update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $each['id'] ?>">
                        <input type="hidden" name="admin_id" value="<?= $each['user_id'] ?>">
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="name">Tên</label>
                            <input type="text" name="name" value="<?= $each['name'] ?>" id="name" class="form__input form-control" autocomplete="off"/>
                        </div>

                        <div class="mb-4 fs-4">
                        <label class="form-label fs-4" for="image" role="button">
                            Ảnh trang sức
                            <img id="product__img" class="ms-4" src="../../assets/images/products/<?= $each['image'] ?>" alt="Ảnh trang sức" width="200" height="200"/>
                        </label>
                            <input type="hidden" name="image_old" value="<?= $each['image'] ?>" />
                            <input type="file" hidden name="image_new" id="image" accept=".jpg, .png" class="form__input form-control"/>
                        </div>
                         <div class="row mb-1 fs-4" id="size_quantity">
                             <?php foreach ($result as $size_quan){ ?>
                                 <div class="col-6 d-flex flex-row mt-2 align-content-center">
                                     <div class="">
                                         <label class="form-label" for="size">Kích thước</label>
                                         <input type="text" name="size[]" id="size" value="<?= $size_quan['name'] ?>" class="form__input form-control" />
                                     </div>

                                     <div class="ms-2">
                                         <label class="form-label" for="quantity">Số lượng</label>
                                         <input type="number" name="quantity[]" value="<?= $size_quan['quantity'] ?>" id="quantity" min="1" class="form__input form-control" />
                                     </div>
                                    <button type="button" class="delete-size" data-size='<?= $size_quan['id'] ?>' data-product='<?= $id ?>'>
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                 </div>
                             <?php } ?>
                         </div>
                         <div class="mb-5 fs-4" id="add_size">
                             <i class="bi bi-plus-circle"></i>
                         </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="image">Màu sắc</label>
                            <input type="text" name="color" value="<?= $each['color'] ?>" id="color" class="form__input form-control"/>
                        </div>
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="image">Chất liệu</label>
                            <input type="text" name="material" value="<?= $each['material'] ?>" id="material" class="form__input form-control"/>
                        </div>
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="image">Giá(vnđ)</label>
                            <input type="number" name="price" value="<?= $each['price'] ?>" id="price" class="form__input form-control"/>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label">Mô tả</label>
                            <textarea name="description" rows="6" class="form__input form-control"><?= $each['description'] ?></textarea>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label">Loại trang sức</label>
                            <select class="form__select form-select" id="category">
                                <?php foreach ($categories as $category) { ?>
                                    <option
                                        <?php if($each['category_id'] === $category['id']) { ?>
                                            selected
                                        <?php    } ?>
                                        value="<?= $category['id'] ?>"
                                    >
                                        <?= $category['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>

                            <select class="form__select form-select mt-4" name="category" id="category_child">
                                <?php foreach ($category_child as $category_child) { ?>
                                    <option
                                        <?php if($each['category_child_id'] === $category_child['id']) { ?>
                                            selected
                                        <?php    } ?>
                                        value="<?= $category_child['id'] ?>"
                                        class="category_child"
                                    >
                                        <?= $category_child['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="form__btn btn mt-4 mb-4">Sửa</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
   
</div>
    
</body>
<script src="../../assets/js/jquery-3.6.4.min.js"></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/notify.js"></script>
<script>
    $.notify.addStyle('noti',{
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
                "font-size": "2rem"
            }
        }
    })

    $(document).ready(function() {
        $('#category').change(function() {
            let category_id = $(this).val();
            $.ajax({
                url: './get_category_child.php',
                type: 'POST',
                dataType: 'json',
                data: {category_id}
            })

            .done(function(res) {
                const arrId = Object.keys(res);
                const arrName = Object.values(res);

                $(".category_child").remove();
                $('#category_child').html('');
                $('#category_child').append('<option value="" selected disabled hidden>Chọn</option>');
                for (let i = 0; i < arrId.length; i++) {
                    $('#category_child').append(`
                        <option class="category_detail" value="${arrId[i]}">${arrName[i]}</option>
                    `);
                }
            })
        });

        $('#add_size').click(function() {
            $('#size_quantity').append(`
                <div class="col-6 d-flex flex-row mt-2 align-items-center">
                    <div class="">
                        <label class="form-label" for="size">Kích thước(cm)</label>
                        <input type="text" name="size[]" id="size" class="form__input form-control" />
                    </div>

                    <div class="ms-5">
                        <label class="form-label" for="quantity">Số lượng</label>
                        <input type="number" name="quantity[]" id="quantity" class="form__input form-control" />
                    </div>
                    <button type="button" class="delete-size" data-size='-1' data-product='-1'>
                         <i class="bi bi-x-circle"></i>
                     </button>
                </div>
            `);

            $('.delete-size').click(function() {
                let btn = $(this);
                let size = $(this).data('size');
                let product = $(this).data('product');

                if (size === -1 && product === -1) {
                    btn.parent().remove();
                }
            });
        })

        $('.delete-size').click(function() {
            let btn = $(this);
            let size = $(this).data('size');
            let product = $(this).data('product');

            if (size === -1 && product === -1) {
                btn.parent().remove();
                return;
            }
            $.ajax({
                url: './delete_size.php',
                type: 'POST',
                dataType: 'json',
                data: {size, product}
            })

                .done(function(res) {
                    if (res === 1) {
                        btn.parent().remove();
                    } else  {
                        console.log(res);
                    }
                })
        });

        $('#image').change(function(e) {
            $('#product__img').attr('src', URL.createObjectURL(e.target.files[0]));
        });

        $('.btn-menu').click(function() {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });

        $.notify("<?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
            style: 'noti',
            className: 'success'
        });
    });
</script>
</html>