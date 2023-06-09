<?php
session_start();
if (empty($_SESSION['id'])) {
	header("location:signin.php");
}
require 'database/connect.php';

$id = $_SESSION['id'];
$sql = "select * from users where id = '$id'";
$result = mysqli_query($connect, $sql);
$each = mysqli_fetch_array($result);

$sqlOrder = "select id, name_receiver, address_receiver, phone_receiver, DATE_FORMAT(created_at, '%d/%m/%Y %T') as created_at, status, total_price 
from orders 
where user_id = '$id'
order by created_at desc, status asc";
$resultOrder = mysqli_query($connect, $sqlOrder);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="viewport" content="width=device-width">
	<title>TÀI KHOẢN - PANDORA</title>
    <link rel="shortcut icon" href="//theme.hstatic.net/200000103143/1000942575/14/favicon.png?v=1433" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/user.css">


</head>

<body>

	<?php require './header.php'; ?>
	<section id="page-content">
		<div class="content-header">
			<h1>Tài Khoản Của Bạn</h1>

		</div>

		<div class="content-grid">
			<div class="user_inf">
				<h2>Thông Tin Tài Khoản</h2>
				<h3>Họ và tên: <?= $each['name'] ?? '' ?></h3>
				<p>
					<br>
					Số điện thoại: <?= $each['phone'] ?? '' ?>
					<br>
					Địa chỉ: <?= $each['address'] ?? '' ?>

				</p>
				<p class="text-address"><a href="update_in4.php">Sửa thông tin</a></p>
			</div>
			<div class="his_tran mt-2">
				<h2>Lịch Sử Mua Hàng</h2>
				<p <?php
					if (mysqli_num_rows($resultOrder) < 1) {
						echo 'style = "display:block;"';
					} else {
						echo 'style = "display:none;"';
					}
					?>>Bạn chưa đặt mua sản phẩm</p>
				<table class="table table-borderless" <?php
                                                        if (mysqli_num_rows($resultOrder) < 1) {
                                                            echo 'style = "display:none;"';
                                                        } else {
                                                            echo 'style = "display:table;"';
                                                        }
                                                        ?>>
					<thead class="table-shopping">
						<tr>
							<th scope="col" class="order-shopping">Đơn hàng</th>
							<th scope="col" class="time-shopping">Thời gian đặt</th>
							<th scope="col" class="total-shopping">Tổng tiền</th>
							<th scope="col" class="stt-shopping">Trạng thái</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if (mysqli_num_rows($resultOrder) > 0) {
							while ($rowOrder = mysqli_fetch_assoc($resultOrder)) {
						?>
							<tr>
								<td class="order-shopping"><?php echo $rowOrder['id'] ?></th>
								<td class="time-shopping"><?php
																	echo ($rowOrder['created_at']);
																	?></td>
								<td class="total-shopping"><?= number_format($rowOrder['total_price'], 0, '.', ' ') ?>&#8363</td>
								<td class="stt-shopping">
									<?php switch ($rowOrder['status']) {
										case 0:
											echo "Mới đặt";
											break;
										case 1:
											echo "Đang chuẩn bị hàng";
											break;
										case 2:
											echo "Đang giao hàng";
											break;
										case 3:
											echo "Hoàn thành";
											break;
										case 4:
											echo "Bạn đã huỷ";
											break;
										case 5:
											echo "Người bán đã huỷ";
											break;
									}
									?>
								</td>
                                <?php if($rowOrder['status'] == 0) { ?>
                                    <td class="sttt-shopping">
                                        <a class="detail-txt" onclick="update_order(<?= $rowOrder['id'] ?>, 4, <?= $id ?>)">Hủy đơn</a>
                                    </td>
                                <?php } ?>
								</td>
                                <?php if($rowOrder['status'] == 2) { ?>
                                    <td class="sttt-shopping">
                                        <a class="detail-txt" onclick="update_order(<?= $rowOrder['id'] ?>, 3, <?= $id ?>)">Hoàn thành</a>
                                    </td>
                                <?php } ?>
								<td class="sttt-shopping">
                                    <a class="detail-txt" href="order_product.php?order_id=<?= $rowOrder['id'] ?>">Xem chi tiết</a>
                                </td>
							</tr>
						<?php
							}
						}
						?>
					</tbody>
				</table>
			</div>


		</div>
	</section>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script src="./assets/js/sweetalert2.all.min.js"></script>

    <script>

    $(document).ready(function () {
        $('.btn-menu').click(function () {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });

    })

    function update_order(id, status, user_id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Bạn có chắc chắn?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Uy tín',
            cancelButtonText: 'Hủy',
            reverseButtons: true,
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "update_order.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id,
                        status,
                        user_id
                    }
                })
                    .done(function (res) {
                        if (res == 1) {
                            res = ''
                        }
                        swalWithBootstrapButtons.fire(
                            'Đã cập nhật thành công!',
                            res
                        )
                        window.setTimeout('location.reload()', 1000);
                    });

            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Đã hủy thành công!',
                    'Safe :)',
                    'error'
                )
            }
        })
    }

</script>
	<script src="js/app.js"></script>

</body>

</html>