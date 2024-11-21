<?php

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <link rel="stylesheet" href="login_style.css">

</head>
<body>
    <div class="container">
        <!-- Phần bên trái: Slideshow -->
        <div class="left-side">
            <div class="slideshow">
                <img src="images/tour1.jpg" alt="Ảnh 1">
                <img src="images/tour2.jpg" alt="Ảnh 2">
                <img src="images/tour3.jpg" alt="Ảnh 3">
            </div>
        </div>

        <!-- Phần bên phải: Đăng nhập -->
        <div class="right-side">
            <div class="form-container">
                <h1>Đăng Nhập</h1>
                <form action="login.php" method="POST">
                    <input type="text" name="username" placeholder="Tên đăng nhập" required>
                    <input type="password" name="password" placeholder="Mật khẩu" required>
                    <button type="submit">Đăng Nhập</button>
                </form>
                <a  href="#" id="forgot-password-link">Quên mật khẩu?</a>
                <a href="#" id="register-link">Đăng ký tài khoản</a>
            </div>
        </div>
    </div>

    <!-- Popup Đăng ký -->
    <div class="popup-overlay" id="popup-register">
        <div class="popup-content">
            <h2>Đăng Ký Tài Khoản</h2>
            <form action="register.php" method="POST">
                <input style="width: 80%" type="email" name="email" placeholder="Email" required>
                <input style="width: 80%" type="text" name="phone" placeholder="Số điện thoại" required>
                <input style="width: 80%" type="password" name="password" placeholder="Mật khẩu" required>
                <input style="width: 80%" type="password" name="confirm_password" placeholder="Xác nhận mật khẩu" required>
                <button style="width: 40%" type="submit">Đăng Ký</button>
            </form>
            <button style="width: 40%" class="close-btn" id="close-register">Đóng</button>
        </div>
    </div>

    <!-- Popup Quên mật khẩu: Nhập email -->
    <div class="popup-overlay" id="popup-forgot-step1">
        <div class="popup-content">
            <h2>Quên Mật Khẩu</h2>
            <form id="forgot-step1-form">
                <input style="width: 80%" type="email" name="email" placeholder="Nhập email của bạn" required>
                <button style="width: 40%" type="submit" id="send-token">Xác nhận</button>
            </form>
            <button style="width: 40%" class="close-btn" id="close-forgot-step1">Đóng</button>
        </div>
    </div>

    <!-- Popup Quên mật khẩu: Nhập Code -->
    <div class="popup-overlay" id="popup-forgot-step2">
        <div class="popup-content">
            <h2>Xác Nhận Code</h2>
            <form id="forgot-step2-form">
                <input style="width: 80%" type="text" name="token" placeholder="Nhập mã code" required>
                <button style="width: 40%" type="submit" id="verify-token">Xác Nhận</button>
            </form>
            <button style="width: 40%" class="close-btn" id="close-forgot-step2">Đóng</button>
        </div>
    </div>

    <!-- Popup Quên mật khẩu: Đổi mật khẩu -->
    <div class="popup-overlay" id="popup-forgot-step3">
        <div class="popup-content">
            <h2>Đặt Mật Khẩu Mới</h2>
            <form id="forgot-step3-form">
                <input style="width: 80%" type="password" name="new_password" placeholder="Mật khẩu mới" required>
                <input style="width: 80%" type="password" name="confirm_password" placeholder="Xác nhận mật khẩu mới" required>
                <button style="width: 40%" type="submit">Đổi Mật Khẩu</button>
            </form>
            <button style="width: 40%" class="close-btn" id="close-forgot-step3">Đóng</button>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
