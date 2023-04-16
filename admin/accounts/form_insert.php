<?php 
    require_once '../check_super_admin_signin.php';
    $page = 'accounts';
    require_once '../navbar-vertical.php';
?>
    <div class="main__form">
        <div class=" container-fluid px-4">
            <div class="row gx-5">
                <div class="col-12 text-white">
                    <?php require_once '../error_success.php' ?>

                    <form action="process_insert.php" method="post" enctype="multipart/form-data">
                        <div class="mb-4 fs-4">
                            <label class="form-label" for="name">Tên</label>
                            <input type="text" id="name" name="name" class="form__input form-control" autocomplete="off"/>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="email">Email</label>
                            <input type="email" id="email" name="email" class="form__input form-control" autocomplete="off"/>
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="password">Mật khẩu</label>
                            <input type="password" id="password" name="password" class="form__input form-control" autocomplete="off" />
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label fs-4" for="image" role="button">
                                Ảnh
                                <img id="account__img" class="ms-4" src="../../assets/images/products/no-image.jpg"
                                     alt="Ảnh trang sức" width="200" height="200"/>
                            </label>
                            <input type="file" hidden name="image" id="image" accept="image/*"
                                   class="form__input form-control"/>
                        </div>
                        
                        <div class="mb-4 fs-4 text-dark">
                            <label class="form-label me-3" for="gender">Giới tính</label>
                            <input type="radio" id="gender" class="form__input" name="gender" value="1"/>Nam
                            <input type="radio" id="gender" class="form__input ms-3" name="gender" value="0"/>Nữ
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Ngày sinh</label>
                            <input type="date" id="birth_date" name="birth_date" class="form__input" autocomplete="off" />
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="phone">Số điện thoại</label>
                            <input type="text" id="phone" name="phone" class="form__input form-control" autocomplete="off" />
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="address">Địa chỉ</label>
                            <input type="text" id="address" name="address" class="form__input form-control" autocomplete="off" />
                        </div>

                        <div class="mb-4 fs-4">
                            <label class="form-label" for="level">Cấp độ</label>
                            <input type="text" id="role" value="Nhân viên" class="form__input form-control" autocomplete="off" disabled/>
                            <input type="hidden" name="role" value="1"/>
                        </div>

                        <button type="submit" class="form__btn btn btn-dark mb-4">Thêm</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
   
</div>
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
    $(document).ready(function () {
        $('#image').change(function (e) {
            $('#account__img').attr('src', URL.createObjectURL(e.target.files[0]));
        });
        $.notify("<?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
            style: 'noti',
            className: 'success'
        });

    });
</script>

</body>
</html>