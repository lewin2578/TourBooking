<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            text-align: center;
        }
        .navbar-nav {
            margin: auto;
        }
        .nav-link {
            color: #ffffff !important;
        }
        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }
        .tour-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .tour-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 80%;
            text-align: center;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>

<body>
<header>
    <div class="container">
        <h1>Chào Mừng Đến Với Tour Du Lịch</h1>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="tour/tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="tour/tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="thuexe/thuexe.php">Thuê xe</a></li>

                    <?php if (isset($_SESSION['id_user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login/profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login/logout.php">Đăng xuất</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login/login.php">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>

<h2>Trong nước</h2>
<section class="tour-list" id="tours">
    <div class="tour-item">
        <h3>Tour Hà Nội - Hạ Long</h3>
        <p>Thời gian: 3 ngày 2 đêm</p>
        <p>Giá: 3.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Đà Nẵng - Hội An</h3>
        <p>Thời gian: 4 ngày 3 đêm</p>
        <p>Giá: 4.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Nha Trang</h3>
        <p>Thời gian: 5 ngày 4 đêm</p>
        <p>Giá: 6.000.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
</section>

<h2>Ngoài nước</h2>
<section class="tour-list" id="tours">
    <div class="tour-item">
        <h3>Tour Hà Nội - Hạ Long</h3>
        <p>Thời gian: 3 ngày 2 đêm</p>
        <p>Giá: 3.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Đà Nẵng - Hội An</h3>
        <p>Thời gian: 4 ngày 3 đêm</p>
        <p>Giá: 4.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Nha Trang</h3>
        <p>Thời gian: 5 ngày 4 đêm</p>
        <p>Giá: 6.000.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
</section>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>