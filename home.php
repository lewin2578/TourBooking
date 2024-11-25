<?php
session_start();
require "nav.php";

if (isset($_SESSION['id_user'])) {
//    // Nếu người dùng chưa đăng nhập, chuyển hướng về trang đăng nhập
//    header("Location: ../login/login.php");
//    exit();
    // Hiển thị thông tin người dùng
    echo "<script>alert('Chào mừng, " . addslashes(htmlspecialchars($_SESSION['name'])) . "');</script>";
}

?>

<!DOCTYPE html>
<html lang="vi">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trang chủ</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" ref="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

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