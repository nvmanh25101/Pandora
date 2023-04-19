<?php
session_start();
require './database/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng ký-PANDORA</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<?php require './header.php'; ?>
<section style="background-image: url(img/slider_3.webp);">
    <div class="container py-5">
        <div class="row d-flex justify-content-center mt-5 mb-5">
            <div class="col-md-12 col-lg-6 col-xl-6 mb-5 bg-light px-3"
                 style="border-radius: 8px; box-shadow: 0 4px 12px #00000026;">
                <form class="form-signup text-center mb-5" action="process-signup.php" method="post">
                    <h1 class="titleSignup mt-3 pb-3">Đăng ký</h1>
                    <div class="form-outline mb-4">
                        <input type="text" name="last_name" class="form-control" id="floatingInput" placeholder="Tên"
                               required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="first_name" class="form-control" id="floatingInput" placeholder="Họ"
                               required>
                    </div>
                    <div class="form-outline mb-4" style="float: left;">
                        <input type="radio" class="gender me-1" name="gender" value="1" id="gender" autocomplete="off">
                        <label for="nam">Nam</label>
                        <input type="radio" class="gender me-1" name="gender" value="0" id="gender" autocomplete="off">
                        <label for="nu">Nữ</label>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="birthday" class="form-control" id="floatingInput"
                               placeholder="Ngày sinh:năm/tháng/ngày" required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" name="email" class="form-control" id="floatingInput" placeholder="Email"
                               required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="password" id="floatingInput" name="password" class="form-control form-control-lg"
                               placeholder="Mật khẩu" required>
                    </div>
                    <div class="form-outline mb-4">
                        <input type="text" id="floatingInput" name="phonenumber" class="form-control form-control-lg"
                               placeholder="Số điện thoại" required>
                    </div>
                    <div class="form-outline">
                        <select id="city-select" required class="form-control mb-3">
                            <option value="">Chọn Tỉnh / Thành phố</option>
                        </select>
                        <select id="district-select" required class="form-control mb-3">
                            <option value="">Chọn Quận / Huyện</option>
                        </select>
                        <select id="ward-select" required class="form-control mb-3">
                            <option value="">Chọn Xã / Phường</option>
                        </select>
                    </div>
                    <input name="address_last" hidden id="address-min">

                    <div class="form-outline mb-4">
                        <input type="text" id="floatingInput" name="address" class="form-control form-control-lg"
                               placeholder="Địa chỉ cụ thể" required>
                    </div>
                    <small style="color:red;">
                    <?php require './admin/error_success.php'; ?>
                    </small>

                    <button class="btnSignup glow-on-hover btn-lg bg-dark" name="btnSignup" type="submit">Đăng ký
                    </button>
                </form>
                    <div class=" d-flex mt-5 mb-3" style="display: inline;">
                        <a class="text-primary-50 me-1" href="index.php" style="font-weight: 600; font-size: 17px;">
                            <i class="bi bi-arrow-left me-2 mt-1"></i>Quay về trang chủ</a>
                    </div>

            </div>
        </div>
</section>
<?php require './footer.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
    $(document).ready(function () {
        $.getJSON('./assets/hanh_chinh/tinh_tp.json', function (data) {
            $.each(data, function (key, value) {
                $('#city-select').append('<option value="' + value.code + '">' + value.name + '</option>');
            })
        })

        $('#city-select').change(function () {
            var city = $(this).val();
            $.getJSON('./assets/hanh_chinh/quan_huyen.json', function (data) {
                $.each(data, function (key, value) {
                    if (value.parent_code == city) {
                        $('#district-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                    }
                })
            })
        })

        $('#district-select').change(function () {
            var district = $(this).val();
            $.getJSON('./assets/hanh_chinh/xa_phuong.json', function (data) {
                $.each(data, function (key, value) {
                    if (value.parent_code == district) {
                        $('#ward-select').append('<option value="' + value.path_with_type + '">' + value.name + '</option>');
                    }
                })
            })
        });
        $('#ward-select').change(function () {
            var ward = $(this).val();
            $('#address-min').val(ward);
        });
    })
</script>
<script src="js/app.js"></script>
</body>
</html>
