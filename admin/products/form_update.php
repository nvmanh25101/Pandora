<?php 
    require_once '../check_admin_signin.php';
    $page = 'products';
    
    if(empty($_GET['id'])) {
        $_SESSION['error'] = 'Phải chọn để sửa!';
        header('location:index.php');
        exit();
    }
//    die(var_dump($_GET['admin_id'] != $_SESSION['id'] || $_SESSION['level'] != 2));
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
    join product_size
    on product_size.product_id = products.id
    JOIN sizes
    ON product_size.size_id = sizes.id
    where products.id = '$id'";
    $result = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($result);
    
    $sql = "select * from categories";
    $categories = mysqli_query($connect, $sql);

    $sql = "select * from category_child where category_id = '$each[category_id]'";
    $category_child = mysqli_query($connect, $sql);

    require_once '../navbar-vertical.php';
?>
    <div class="main__form">
        <div class="main-container-text d-flex align-items-center">
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
                            <img id="product__img" class="ms-4" src="../../assets/images/products/<?= $each['image'] ?>" alt="Ảnh bánh" width="200" height="200"/>
                        </label>
                            <input type="hidden" name="image_old" value="<?= $each['image'] ?>" />
                            <input type="file" hidden name="image_new" id="image" accept=".jpg, .png" class="form__input form-control"/>
                        </div>
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="image">Kích thước(cm)</label>
                            <input type="text" name="size" value="<?= $each['size_name'] ?>" id="size" class="form__input form-control"/>
                        </div>
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="image">Số lượng</label>
                            <input type="number" name="quantity" value="<?= $each['quantity'] ?>" id="quantity" class="form__input form-control"/>
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
                            <label class="form-label">Loại bánh</label>
                            <select class="form__select form-select" id="category">
                                <?php foreach ($categories as $category) { ?>
                                    <option 
                                        <?php if($each['category_id'] == $category['id']) { ?>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
                $('#category_child').append('<option value="" selected disabled hidden>Chọn</option>');
                for (let i = 0; i < arrId.length; i++) {
                    $('#category_child').append(`
                        <option class="category_detail" value="${arrId[i]}">${arrName[i]}</option>
                    `);
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
    });
</script>
</html>