<?php 
    require_once '../check_super_admin_signin.php';
    $page = 'accounts';
    require_once '../navbar-vertical.php';

    if(empty($_GET['id'])) {
        $_SESSION['error'] = 'Phải chọn để sửa!';
        header('location:index.php');
        exit();
    }

    $id = $_GET['id'];
    require_once '../../database/connect.php';
    $sql = "select * from users where id = '$id'";
    $result = mysqli_query($connect, $sql);
    $each = mysqli_fetch_array($result);
?>
    <div class="main__form">
        <div class=" container-fluid px-4">
            <?php include '../error_success.php' ?>
          
            <div class="row gx-5">
                <div class="col-12 text-white">
                    <form action="process_update.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $each['id'] ?>">
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="name">Tên</label>
                            <input type="text" name="name" id="name" value="<?= $each['name'] ?>" class="form__input form-control" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label">Ảnh cũ</label>
                            <img src="../../assets/images/admin/<?= $each['avatar']?>" class="img-thumbnail" alt="">
                            <input type="hidden" name="image_old" value="<?= $each['avatar'] ?>" />
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label">Đổi ảnh mới</label>
                            <input type="file" name="image_new" accept="image/*" class="form__input form-control"/>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="gender">Giới tính</label>
                            <input type="text" name="gender" id="gender" value="<?= $each['gender'] === 1?"Nam":"Nữ" ?>" class="form__input form-control" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Ngày sinh</label>
                            <input type="date" name="birth_date" id="birth_date" value="<?= $each['birth_date'] ?>" class="form__input" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" value="<?= $each['phone'] ?>" class="form__input form-control" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?= $each['address'] ?>" class="form__input form-control" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <button type="submit" class="form__btn btn btn-dark mb-4">Sửa</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
   
</div>
    
</body>

</html>