<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Du Lịch - Trang Chủ</title>
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
        nav {
            margin: 20px 0;
        }
        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }
        .tour-list {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }
        .tour-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 300px;
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
    <h1>Chào Mừng Đến Với Tour Du Lịch</h1>
    <nav>
        <a href="">Tour</a>
        <a href="">Vé máy bay</a>
        <a href="">Khách sạn</a>
        <a href="">Thuê xe</a>
    </nav>
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