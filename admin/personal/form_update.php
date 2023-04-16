<?php 
    require_once '../check_admin_signin.php';
    $page = 'personal';
    require_once '../navbar-vertical.php';

    $id = $_SESSION['id'];

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
                            <label class="form-label label-img" for="avatar">Ảnh
                                <img src="../../assets/images/admin/<?= $each['avatar']?>" class="img-thumbnail avatar-img" alt="">
                            </label>
                            <input type="hidden" name="image_old" value="<?= $each['avatar'] ?>" />
                            <input type="file" name="image_new" hidden accept="image/*" id="avatar" class="form__input form-control"/>
                        </div>

                        <div class="mb-4 fs-4 text-dark">
                            <label class="form-label me-3" for="gender">Giới tính</label>
                            <input type="radio" id="gender" class="form__input" <?= $each['gender'] === '1' ? "checked":"" ?> name="gender" value="1"/>Nam
                            <input type="radio" id="gender" class="form__input ms-3" <?= $each['gender'] === '0' ? "checked":"" ?> name="gender" value="0"/>Nữ
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

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Chức vụ</label>
                            <input type="text" disabled name="role" id="role" value="<?= $each['role'] === '1' ? 'Nhân viên' : 'Quản lý' ?>" class="form__input form-control" autocomplete="off"/>
                            <span id="error" class="error_input"></span>
                        </div>

                        <button type="submit" class="form__btn btn btn-dark mb-4">Sửa</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
   
</div>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/jquery-3.6.4.min.js"></script>
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
            $('#avatar').change(function(e) {
                $('.avatar-img').attr('src', URL.createObjectURL(e.target.files[0]));
            });
            $.notify("<?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
                style: 'noti',
                className: 'success'
            });
        });
    </script>
</body>

</html>