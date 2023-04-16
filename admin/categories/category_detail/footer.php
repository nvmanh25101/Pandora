<footer>
    <ul class="pagination footer__pagination justify-content-center mt-5">
        <?php
        if (isset($num_page)) {
            for ($i = 1; $i <= $num_page; $i++) { ?>
                <li class="pagination-item
                    <?php if ($i == $page) {
                    echo 'pagination-item--active';
                } ?>
                ">
                    <a href="?page=<?php echo $i ?>&search=<?php echo $search ?>" class="pagination-item__link">
                        <?php echo $i ?>
                    </a>
                </li>
            <?php } ?>
        <?php } ?>

    </ul>
</footer>
</div>

<?php mysqli_close($connect) ?>
<script src="../../../assets/js/jquery-3.6.4.min.js"></script>
<script src="../../../assets/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../../../assets/js/sweetalert2.all.min.js"></script>
<script src="../../../assets/js/notify.js"></script>

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
        $('.btn-menu').click(function () {
            $('.navbar-vertical-mobile').toggle("fast");
            $('.header__navbar-overlay').toggle("fast");
        });

        $.notify("<?php if(isset($_SESSION['success'])) { echo $_SESSION['success']; unset($_SESSION['success']); }  ?>", {
            style: 'noti',
            className: 'success'
        });

        $('.sub-navbar__link.active').parent().closest('div').css({"display": "block"});
    })

    function showNoti(id, admin_id, size) {
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
                    url: "delete.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id,
                        admin_id,
                        size,
                    }
                })
                    .done(function () {
                        swalWithBootstrapButtons.fire(
                            'Đã xóa thành công!',
                        )

                        window.setTimeout('location.reload()', 1000);
                    })
                    .fail(function(res) {
                        console.log(res)
                        swalWithBootstrapButtons.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: res.responseText,
                        })
                    })

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

    function update_order(id, status, admin_id) {
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
                    url: "update.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        id,
                        status,
                        admin_id
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

</body>
</html>