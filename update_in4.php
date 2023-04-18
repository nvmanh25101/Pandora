<?php
session_start();
if (empty($_SESSION['id'])) {
    header("location:signin.php");
}

$id = $_SESSION['id'];
require './database/connect.php';
$sql = "SELECT * FROM users WHERE (id = '$id')";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);
[$address, $ward, $district, $city] = explode(', ', $row['address']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image" href="img/logo.png">
    <title>Cập nhật thông tin tài khoản-PANDORA</title>
    <link rel="stylesheet" href="css/update.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"
    />
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

</head>
<body>
<?php require './header.php'; ?>
<form action="process_update_in4.php" method="post">
    <div class="page_container mb-3">
        <div class="main_content">

            <h2>THÔNG TIN TÀI KHOẢN</h2>
            Email:<span> <?php echo $row['email'] ?></span>
            <input type="text" name="id" style="display:none;" value="<?php echo $row['id'] ?>">
            <small style="color:green;">
                <?php
                if (isset($_GET['error'])) {
                    echo "{$_GET['error']}";
                } else {
                    echo "";
                }
                ?>
            </small>
            <small style="color:red;">
                <?php
                if (isset($_GET['error1'])) {
                    echo "{$_GET['error1']}";
                } else {
                    echo "";
                }
                ?>
            </small>
            <div class="form_name ">
                <label for="">Họ và tên</label>
                <input type="text" name="name" class="form-control m-1" placeholder="Nhập họ tên"
                       value="<?php echo $row['name'] ?>" required>
            </div>

            <div class="form-gender m-3">
                <input type="radio" class="gender me-1" name="gender" value="1" <?= $row['gender'] === '1' ? 'checked':'' ?> id="nam" autocomplete="off">
                <label for="nam">Nam</label>
                <input type="radio" class="gender me-1" name="gender" value="0"<?= $row['gender'] === '0' ? 'checked':'' ?> id="nu" autocomplete="off">
                <label for="nu">Nữ</label>
            </div>
            <div class="form_name">
                <label for="">Ngày sinh</label>
                <input type="date" name="birth_date" class="form-control m-1"
                       placeholder="Ngày sinh:năm/tháng/ngày" required value="<?= $row['birth_date'] ?>">
            </div>
            <div class="form_name">
                <label for="">Mật khẩu</label>
                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới">
                <small style="color:red;">
                    <?php
                    if (isset($_GET['errorpass'])) {
                        echo (string) ($_GET['errorpass']);
                    } else {
                        echo "";
                    }
                    ?>
                </small>
            </div>
            <div class="form_address">
                <label for="">Số điện thoại</label>
                <input type="text" name="phone" class="form-control form-control-lg"
                       placeholder="Số điện thoại" required value="<?= $row['phone'] ?>">
            </div>
            <div class="form_address">
                <label for="">Địa chỉ</label>
                <input type="text" name="address" class="form-control mb-2"
                       value="<?= $address ?>" required>
            </div>
            <select id="city-select" required>
                <option value="">Chọn Tỉnh / Thành phố</option>
            </select>
            <select id="district-select" required>
                <option value="">Chọn Quận / Huyện</option>
            </select>
            <select id="ward-select" required>
                <option value="">Chọn Xã / Phường</option>
            </select>
            <input name="address_last" hidden id="address-min">

            <div class="btnup">
                <button class="btnUpdate" name="btnUpdate" type="submit">Cập nhật</button>

            </div>
            <a href="./user_in4.php" class="mt-3 d-flex align-items-center fs-5">
                <i class="bi bi-arrow-left me-2"></i> <span>Quay lại</span>
            </a>
        </div>
    </div>
</form>

<?php require './footer.php'; ?>

<div id="hotline">
    <a href="tel:0333135698" id="yBtn">
        <i class="bi bi-telephone-fill"></i>
    </a>
    <div class="text-quotes">
        <a href="tel:0333135698">0333135698</a>
    </div>
</div>


<script src="./assets/js/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="../../assets/js/notify.js"></script>


<script>
    $(document).ready(function () {
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
                    "font-size": "1.4rem"
                }
            }
        })
        $.getJSON('./assets/hanh_chinh/tinh_tp.json', function (data) {
            $.each(data, function (key, value) {
                if (value.name_with_type == '<?= $city ?>') {
                    $('#city-select').append('<option value="' + value.code + '" selected>' + value.name + '</option>');
                } else {
                    $('#city-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                }
            })
        })

        $.getJSON('./assets/hanh_chinh/quan_huyen.json', function (data) {
            var city = $('#city-select').val();
            $.each(data, function (key, value) {
                if (value.parent_code == city) {
                    if (value.name_with_type == '<?= $district ?>') {
                        $('#district-select').append('<option value="' + value.code + '" selected>' + value.name + '</option>');
                    } else {
                        $('#district-select').append('<option value="' + value.code + '">' + value.name + '</option>');
                    }
                }
            })
        })

        $.getJSON('./assets/hanh_chinh/xa_phuong.json', function (data) {
            var district = $('#district-select').val();

            $.each(data, function (key, value) {
                if (value.parent_code == district) {
                    if (value.name_with_type == '<?= $ward ?>') {
                        $('#ward-select').append('<option value="' + value.path_with_type + '" selected>' + value.name + '</option>');
                        var ward = $('#ward-select').val();
                        $('#address-min').val(ward);
                    } else {
                        $('#ward-select').append('<option value="' + value.path_with_type + '">' + value.name + '</option>');
                    }
                }
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

                $('#district-select').change(function () {
                    var district = $(this).val();
                    $.getJSON('xa_phuong.json', function (data) {
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
        });

        $('#ward-select').change(function () {
            var ward = $(this).val();
            $('#address-min').val(ward);
        });

        $.notify("<?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
            style: 'noti',
            className: 'success'
        });
    })
</script>
<script src="js/app.js"></script>

</body>
</html>