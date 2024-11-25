<!DOCTYPE html>
<html lang="vi">
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$conn = mysqli_connect("localhost", "root", "", "tourbooking");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
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
        <h1><a class="nav-link" href="../home.php">Chào Mừng Đến Với Tour Du Lịch</a></h1>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tour</p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="../tour/tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="../tour/tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="../khachsan/hotel.php">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="../thuexe/thuexe.php">Thuê xe</a></li>
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/logout.php">Đăng xuất</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../login/login.php">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<h1 style="text-align: center;font-weight: bold;color: black">KHÁCH SẠN TIÊU BIỂU</h1>
<div class="container" style="width: 100%;height: 300px;" dir="ltr">
    <ul>
        <?php
        $query = "SELECT * FROM `khachsan`";
        $result = mysqli_query($conn, $query);
        if(!$result) die("Query failed!");
        while($row = mysqli_fetch_row($result)) {
            ?>
            <li style="list-style: none;float: left; width: 30%;height: 300px;margin-left: 20px;position: relative">
                <div class="container">
                    <a href="room.php?id_hotel=<?php echo $row[0] ?>" style="color: yellow; text-decoration: none"><img src="<?php echo $row[6] ?>" style="width: 100%;height: 300px;object-fit: fill;filter: brightness(80%)">
                        <div class="desc" style="position: absolute;bottom: 5%; left: 5%;height: 30%; width: 90%;text-align: center;user-select: none">
                            <text style="font-size: large"><?php for ($x = 0; $x <= $row[2]; $x++) {?>&#9733 <?php } ?><br></text>
                            <text style="font-weight: bold;color: white"><?php echo $row[1] ?><br></text>
                            <text style="font-size: small;color: black">Giá từ: <text style="font-weight: bold;font-size: large;color: yellow"><?php echo $row[3] ?></text></text>
                        </div>
                    </a>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>
</body>
</html>