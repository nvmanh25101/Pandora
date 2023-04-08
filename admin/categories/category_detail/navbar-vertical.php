<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../../assets/css/admin.css">
    <link rel="stylesheet" href="../../../assets/css/responsive_admin.css">
    <title>ADMIN-GN Bakery</title>
</head>
<body>
<div class="main">
    <nav class="navbar navbar-vertical position-fixed top-0 start-0 bottom-0 p-0 navbar-collapse hide-on-mobile-tablet">
        <div class="navbar__content">
            <a class="navbar-brand px-5 d-block" href="#">
                <svg xmlns="http://www.w3.org/2000/svg"  class="navbar-brand__img" version="1.1" viewBox="0 0 283.5 58.9">
                    <polygon points="177.9,10.2 179,10.2 179.1,10.2 178.1,0.1 178,0 177.7,0 177.7,0.1 176.6,10.2 176.7,10.2 "/>
                    <polygon points="183.6,10.9 183.6,10.8 185.3,1.8 185.3,1.7 185,1.6 184.9,1.7 181.2,10.3 181.2,10.3 "/>
                    <path d="M181.8,14.8c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4c-0.8,0-1.4,0.6-1.4,1.4C180.4,14.2,181,14.8,181.8,14.8z"/>
                    <path d="M177.9,14.3c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4c-0.8,0-1.4,0.6-1.4,1.4C176.4,13.8,177.1,14.3,177.9,14.3z"/>
                    <polygon points="172.2,10.9 174.5,10.3 174.6,10.3 170.8,1.7 170.7,1.6 170.5,1.7 170.4,1.8 172.1,10.8 "/>
                    <path d="M172.5,13.3c0,0.8,0.6,1.4,1.4,1.4c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4C173.2,12,172.5,12.6,172.5,13.3z"/>
                    <path d="M12.1,17.3h-12L0,17.3c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.9L8,58.4c0,0-0.3-2.9-0.3-7.9v-7.4L7.8,43       c1.1,0.1,3.5,0.2,4.3,0.2c8.1,0,15.1-4.9,15.1-13.3C27.1,21.9,20.1,17.3,12.1,17.3z M11.7,36.5c-0.9,0-3.1-0.1-4-0.3V24h4.6       c4.1,0,7.3,1.6,7.3,5.9C19.6,34.2,16.8,36.5,11.7,36.5z"/>
                    <path d="M49.6,20.6c-0.9-2.1-1.2-3.3-1.2-3.3l-0.1-0.1H42l-0.1,0.1c0,0-0.2,1.2-1.1,3.3L26.9,54c-1.2,2.8-2.4,4.4-2.4,4.4v0.1h8.1       l0.1-0.1c0-0.2,0.2-1.2,1.2-3.7l2.5-6.3h17.9l2.7,6.3c0.9,2.4,1.4,3.7,1.4,3.7l0.1,0.1h8.1v-0.1c0,0-1.1-1.5-2.4-4.4L49.6,20.6z       M39.2,41.6L45,27.1h0.1l6.3,14.5H39.2z"/>
                    <path d="M107.2,17.3L107.2,17.3l-7.2-0.1l-0.1,0.1c0,0,0.3,2.9,0.3,7.9v20.7h-0.1L77.9,17.3h-7.9L70,17.3c0.9,1.9,1.4,3.2,1.4,4.1       v29.1c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.2l0.1-0.1c0,0-0.3-2.9-0.3-7.9V29.4h0.1l22.3,29h6.7l0.1-0.1c0,0-0.3-2.9-0.3-7.9V25.2       C106.9,20.2,107.2,17.3,107.2,17.3z"/>
                    <path d="M129.6,17.3h-13.8l-0.1,0.1c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h4.2c2.8,0,5.9,0.4,9.4,0.4       c12.6,0,21.6-8.9,21.6-20.9C151,25.9,142.3,17.3,129.6,17.3z M129.1,52c-2,0-3.8-0.1-4.9-0.4c-0.6-0.2-0.8-0.4-0.8-1.5V24h5.5       c8.9,0,14.6,6,14.6,14C143.5,45.9,137.8,52,129.1,52z"/>
                    <path d="M177.9,16.7c-11.9,0-21.1,9.2-21.1,21.1c0,12,9.2,21.1,21.1,21.1c12,0,21.1-9.1,21.1-21.1C199,25.9,189.9,16.7,177.9,16.7z       M177.9,52.2c-7.6,0-13.6-6.2-13.6-14.3c0-8.1,5.9-14.3,13.6-14.3c7.7,0,13.6,6.2,13.6,14.3C191.5,45.9,185.6,52.2,177.9,52.2z"/>
                    <path d="M228.3,44.5c-1-1.6-2.5-2.9-4.1-3.4V41c4.3-0.9,8.3-5.9,8.3-10.9c0-6.8-5.2-12.8-13.3-12.8h-13.2l-0.1,0.1       c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.9l0.1-0.1c0,0-0.3-2.9-0.3-7.9v-7.9c3.9,0,5.5,0.8,6.9,3L224,51       c2.8,4.5,3.9,7.3,3.9,7.3l0.1,0.1h9.4v-0.1c0,0-2.4-2.9-5.1-7.3L228.3,44.5z M217.4,36.1c-0.9,0-2.6,0-3.7-0.2V24h4.5       c4.4,0,6.8,2.9,6.8,6.2C225,33.3,222.6,36.1,217.4,36.1z"/>
                    <path d="M281.1,54l-14.6-33.4c-0.9-2.1-1.2-3.3-1.2-3.3l-0.1-0.1h-6.4l-0.1,0.1c0,0-0.2,1.2-1.1,3.3L243.8,54       c-1.2,2.8-2.4,4.4-2.4,4.4v0.1h8.1l0.1-0.1c0-0.2,0.2-1.2,1.2-3.7l2.5-6.3h17.9l2.7,6.3c0.9,2.4,1.4,3.7,1.4,3.7l0.1,0.1h8.1v-0.1       C283.5,58.4,282.4,56.9,281.1,54z M256.1,41.6l5.8-14.5h0.1l6.3,14.5H256.1z"/>
                </svg>
            </a>
            <ul class="nav navbar__list flex-column">
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'root'?'active':'' ?>" href="../../root">
                        <i class="navbar__link-icon bi bi-house-fill"></i>
                        <span>Trang chủ</span> 
                    </a>
                </li>
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'orders'?'active':'' ?>" href="../../orders">
                        <i class="navbar__link-icon bi bi-cart-dash-fill"></i>
                        <span>Đơn hàng</span> 
                    </a>
                </li>
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'products'?'active':'' ?>" href="../../products">
                        <i class="navbar__link-icon bi bi-vinyl"></i>
                        <span>Sản phẩm</span> 
                    </a>
                    <div class="sub-navbar">
                        <ul class="list-group">
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products/form_insert.php">Thêm sản phẩm</a>
                            </li>
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products?search_status=1">Đang bán</a>
                            </li>
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products?search_status=0">Ngừng bán</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'categories'?'active':'' ?>" href="../../categories">
                        <i class="navbar__link-icon bi bi-slack"></i>
                        <span>Loại trang sức</span> 
                    </a>
                    <div class="sub-navbar">
                        <ul class="list-group">
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../categories">Loại chính</a>
                            </li>
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action text-decoration-none" href="./index.php">Loại phụ</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link <?= $page === 'accounts' ? 'active' : '' ?>"
                       href="../../accounts">
                        <i class="navbar__link-icon bi bi-person"></i>
                        <span>Tài khoản</span>
                    </a>
                    <div class="sub-navbar">
                        <ul class="list-group">
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action" href="../../accounts">Nhân viên</a>
                            </li>
                            <li class="sub-navbar__item">
                                <a class="sub-navbar__link list-group-item-action" href="../../accounts/users">Khách
                                    hàng</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item navbar__item">
                    <a class="nav-link d-flex align-items-center navbar__link" href="../../signout.php">
                        <i class="navbar__link-icon bi bi-box-arrow-in-right"></i>
                        <span>Đăng xuất khỏi Trái Đất</span> 
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="header__navbar-overlay btn-menu"></div>
    <nav class="navbar navbar-vertical-mobile position-fixed top-0 start-0 bottom-0 p-0 navbar-collapse">
        <div class="navbar-logo">
            <a class="navbar-mobile-brand d-block" href="#">
                <svg xmlns="http://www.w3.org/2000/svg"  class="navbar-brand__img" version="1.1" viewBox="0 0 283.5 58.9">
                    <polygon points="177.9,10.2 179,10.2 179.1,10.2 178.1,0.1 178,0 177.7,0 177.7,0.1 176.6,10.2 176.7,10.2 "/>
                    <polygon points="183.6,10.9 183.6,10.8 185.3,1.8 185.3,1.7 185,1.6 184.9,1.7 181.2,10.3 181.2,10.3 "/>
                    <path d="M181.8,14.8c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4c-0.8,0-1.4,0.6-1.4,1.4C180.4,14.2,181,14.8,181.8,14.8z"/>
                    <path d="M177.9,14.3c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4c-0.8,0-1.4,0.6-1.4,1.4C176.4,13.8,177.1,14.3,177.9,14.3z"/>
                    <polygon points="172.2,10.9 174.5,10.3 174.6,10.3 170.8,1.7 170.7,1.6 170.5,1.7 170.4,1.8 172.1,10.8 "/>
                    <path d="M172.5,13.3c0,0.8,0.6,1.4,1.4,1.4c0.7,0,1.4-0.6,1.4-1.4c0-0.8-0.6-1.4-1.4-1.4C173.2,12,172.5,12.6,172.5,13.3z"/>
                    <path d="M12.1,17.3h-12L0,17.3c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.9L8,58.4c0,0-0.3-2.9-0.3-7.9v-7.4L7.8,43       c1.1,0.1,3.5,0.2,4.3,0.2c8.1,0,15.1-4.9,15.1-13.3C27.1,21.9,20.1,17.3,12.1,17.3z M11.7,36.5c-0.9,0-3.1-0.1-4-0.3V24h4.6       c4.1,0,7.3,1.6,7.3,5.9C19.6,34.2,16.8,36.5,11.7,36.5z"/>
                    <path d="M49.6,20.6c-0.9-2.1-1.2-3.3-1.2-3.3l-0.1-0.1H42l-0.1,0.1c0,0-0.2,1.2-1.1,3.3L26.9,54c-1.2,2.8-2.4,4.4-2.4,4.4v0.1h8.1       l0.1-0.1c0-0.2,0.2-1.2,1.2-3.7l2.5-6.3h17.9l2.7,6.3c0.9,2.4,1.4,3.7,1.4,3.7l0.1,0.1h8.1v-0.1c0,0-1.1-1.5-2.4-4.4L49.6,20.6z       M39.2,41.6L45,27.1h0.1l6.3,14.5H39.2z"/>
                    <path d="M107.2,17.3L107.2,17.3l-7.2-0.1l-0.1,0.1c0,0,0.3,2.9,0.3,7.9v20.7h-0.1L77.9,17.3h-7.9L70,17.3c0.9,1.9,1.4,3.2,1.4,4.1       v29.1c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.2l0.1-0.1c0,0-0.3-2.9-0.3-7.9V29.4h0.1l22.3,29h6.7l0.1-0.1c0,0-0.3-2.9-0.3-7.9V25.2       C106.9,20.2,107.2,17.3,107.2,17.3z"/>
                    <path d="M129.6,17.3h-13.8l-0.1,0.1c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h4.2c2.8,0,5.9,0.4,9.4,0.4       c12.6,0,21.6-8.9,21.6-20.9C151,25.9,142.3,17.3,129.6,17.3z M129.1,52c-2,0-3.8-0.1-4.9-0.4c-0.6-0.2-0.8-0.4-0.8-1.5V24h5.5       c8.9,0,14.6,6,14.6,14C143.5,45.9,137.8,52,129.1,52z"/>
                    <path d="M177.9,16.7c-11.9,0-21.1,9.2-21.1,21.1c0,12,9.2,21.1,21.1,21.1c12,0,21.1-9.1,21.1-21.1C199,25.9,189.9,16.7,177.9,16.7z       M177.9,52.2c-7.6,0-13.6-6.2-13.6-14.3c0-8.1,5.9-14.3,13.6-14.3c7.7,0,13.6,6.2,13.6,14.3C191.5,45.9,185.6,52.2,177.9,52.2z"/>
                    <path d="M228.3,44.5c-1-1.6-2.5-2.9-4.1-3.4V41c4.3-0.9,8.3-5.9,8.3-10.9c0-6.8-5.2-12.8-13.3-12.8h-13.2l-0.1,0.1       c0,0,0.3,2.9,0.3,7.9v25.3c0,5-0.3,7.9-0.3,7.9l0.1,0.1h7.9l0.1-0.1c0,0-0.3-2.9-0.3-7.9v-7.9c3.9,0,5.5,0.8,6.9,3L224,51       c2.8,4.5,3.9,7.3,3.9,7.3l0.1,0.1h9.4v-0.1c0,0-2.4-2.9-5.1-7.3L228.3,44.5z M217.4,36.1c-0.9,0-2.6,0-3.7-0.2V24h4.5       c4.4,0,6.8,2.9,6.8,6.2C225,33.3,222.6,36.1,217.4,36.1z"/>
                    <path d="M281.1,54l-14.6-33.4c-0.9-2.1-1.2-3.3-1.2-3.3l-0.1-0.1h-6.4l-0.1,0.1c0,0-0.2,1.2-1.1,3.3L243.8,54       c-1.2,2.8-2.4,4.4-2.4,4.4v0.1h8.1l0.1-0.1c0-0.2,0.2-1.2,1.2-3.7l2.5-6.3h17.9l2.7,6.3c0.9,2.4,1.4,3.7,1.4,3.7l0.1,0.1h8.1v-0.1       C283.5,58.4,282.4,56.9,281.1,54z M256.1,41.6l5.8-14.5h0.1l6.3,14.5H256.1z"/>
                </svg>
            </a>
            <i class="btn-close btn-menu bi bi-x-lg"></i>
        </div>

        <ul class="nav navbar__list-mobile flex-column">
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'root'?'active':'' ?>" href="../../root">
                    <i class="navbar__link-icon bi bi-house-fill"></i>
                    <span>Trang chủ</span> 
                </a>
            </li>
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'orders'?'active':'' ?>" href="../../orders">
                    <i class="navbar__link-icon bi bi-cart-dash-fill"></i>
                    <span>Đơn hàng</span> 
                </a>
            </li>
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'products'?'active':'' ?>" href="../../products">
                    <i class="navbar__link-icon bi bi-vinyl"></i>
                    <span>Sản phẩm</span> 
                </a>
                <div class="sub-navbar">
                    <ul class="list-group">
                        <li class="sub-navbar__item">
                            <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products/form_insert.php">Thêm sản phẩm</a>
                        </li>
                        <li class="sub-navbar__item">
                            <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products?search_status=1">Đang bán</a>
                        </li>
                        <li class="sub-navbar__item">
                            <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../products?search_status=0">Ngừng bán</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'categories'?'active':'' ?>" href="../../categories">
                    <i class="navbar__link-icon bi bi-slack"></i>
                    <span>Loại trang sức</span> 
                </a>
                <div class="sub-navbar">
                    <ul class="list-group">
                        <li class="sub-navbar__item">
                            <a class="sub-navbar__link list-group-item-action text-decoration-none" href="../../categories">Loại chính</a>
                        </li>
                        <li class="sub-navbar__item">
                            <a class="sub-navbar__link list-group-item-action text-decoration-none" href="./index.php">Loại phụ</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link <?= $page == 'accounts'?'active':'' ?>" href="../employees">
                    <i class="navbar__link-icon bi bi-person"></i>
                    <span>Nhân viên</span> 
                </a>
            </li>
            <li class="nav-item navbar__item">
                <a class="nav-link d-flex align-items-center navbar__link" href="../../signout.php">
                    <i class="navbar__link-icon bi bi-box-arrow-in-right"></i>
                    <span>Đăng xuất</span> 
                </a>
            </li>
        </ul>
    </nav>

    <header class="header d-flex justify-content-between align-items-center">
        <div class="header__mobile-icon align-items-center">
            <button class="btn-menu header__mobile-btn align-items-center me-1">
                <i class="bi bi-list"></i>
            </button>
            <button class="header__mobile-btn align-items-center">
                <i class="bi bi-search"></i>
            </button>
        </div>
        <form action="" class="form__search hide-on-mobile-tablet">
            <input type="search" name="search" class="input__search" value="<?php $search?? '' ?>" placeholder="Nhập tên để tìm kiếm">
        </form>
        <div class="header__user d-flex align-items-center">
            <img class="header__user-img" src="../../../assets/images/admin/<?= $_SESSION['image'] ?>" alt="avt-user">
            <span class="header__user-name"><?= $_SESSION['name'] ?></span>

            <div class="header__signout">
                <a href="../../signout.php">
                    <i class="bi bi-box-arrow-right"></i>
                    Đăng xuất
                </a>
            </div>
        </div>
    </header>