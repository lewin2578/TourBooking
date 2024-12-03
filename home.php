<?php
require "connect.php";
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Du Lịch</title>
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
            color: white;
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
            flex-direction: row;
            align-items: center;
            padding: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .tour-list .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .tour-list .card:hover {
            transform: translateY(-5px);
        }
        .tour-list .card-title {
            font-size: 1.2em;
            font-weight: bold;
        }
        .tour-list .card-text {
            font-size: 0.9em;
        }
        .btn-success{
            background-color: #4CAF50;
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1><a class="nav-link" href="#">Chào Mừng Đến Với Tour Du Lịch</a></h1>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tour
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="tour/tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="tour/tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="khachsan/hotel.php">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="thuexe/thuexe.php">Thuê xe</a></li>

                    <?php
                    if (isset($_SESSION['id_user'])) {
                        // Đã đăng nhập, hiển thị liên kết Profile
                        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="login/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login/logout.php">Đăng xuất</a>
                    </li>
                    ';
                        // Kiểm tra vai trò Admin
                        if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin') {
                            echo '
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="AdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="AdminDropdown">
                            <li><a class="dropdown-item" href="admin/quanly_user.php">Quản lý User</a></li>
                            <li><a class="dropdown-item" href="admin/quanly_thuexe.php">Quản lý thuê xe</a></li>
                            <li><a class="dropdown-item" href="admin/quanly_tour.php">Quản lý tour</a></li>
                            <li><a class="dropdown-item" href="admin/manager_flights.php">Quản lý chuyến bay</a></li>
                            <li><a class="dropdown-item" href="admin/manage_hotel.php">Quản lý Khách sạn</a></li>
                            <li><a class="dropdown-item" href="admin/manage_room.php.php">Quản lý Phòng</a></li>
                        </ul>
                    </li>
                    ';
                        }
                    } else {
                        // Chưa đăng nhập, hiển thị liên kết Đăng nhập
                        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="login/login.php">Đăng nhập</a>
                    </li>
                    ';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<div class="main" style="margin-left: 100px">
    <h2>Trong nước</h2>
    <section class="tour-list">
        <div class="row">
            <?php
            $query = "SELECT * FROM `tour` WHERE `type` = 'Trong Nước'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Query failed");
            }
            if (isset($_POST["submit"])) {
                $idToEdit = $_POST["idToSubmit"];
                header("Location: tour/chitiet_tour.php?id=$idToEdit");
                exit;
            }
            if (mysqli_num_rows($result) != 0) {
                $i = 0;
                while ($row = mysqli_fetch_row($result)) {
                    $dem = $row[3]-1;
                    if($i<3){
                        echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[1]</h5>
                    <p class='card-text'>Thời gian: $row[3] ngày $dem đêm </p>
                    <p class='card-text'>Ngày khởi hành: $row[4] $row[5]</p>
                    <p class='card-text'>Giá: $row[7] VND</p>
                    <form method='post' action=''>
                        <input type='hidden' name='idToSubmit' value='$row[0]'>
                        <input type='submit' name='submit' class='btn btn-primary' value='Xem chi tiết'>
                    </form>
                </div>
            </div>
        </div>";
                    }
                    $i++;
                }
            }
            ?>
            <a href="tour/tour_trongnuoc.php" class="btn btn-success">Xem thêm</a>
        </div>
    </section>

    <h2>Ngoài nước</h2>
    <section class="tour-list">
        <div class="row">
            <?php
            $query = "SELECT * FROM `tour` WHERE `type` = 'Ngoài Nước'";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                die("Query failed");
            }
            if (isset($_POST["submit"])) {
                $idToEdit = $_POST["idToSubmit"];
                header("Location: tour/chitiet_tour.php?id=$idToEdit");
                exit;
            }
            if (mysqli_num_rows($result) != 0) {
                $i = 0;
                while ($row = mysqli_fetch_row($result)) {
                    $dem = $row[3]-1;
                    if($i<3){
                        echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[1]</h5>
                    <p class='card-text'>Thời gian: $row[3] ngày $dem đêm </p>
                    <p class='card-text'>Ngày khởi hành: $row[4] $row[5]</p>
                    <p class='card-text'>Giá: $row[7] VND</p>
                    <form method='post' action=''>
                        <input type='hidden' name='idToSubmit' value='$row[0]'>
                        <input type='submit' name='submit' class='btn btn-primary' value='Xem chi tiết'>
                    </form>
                </div>
            </div>
        </div>";
                    }
                    $i++;
                }
            }
            ?>
            <a href="tour/tour_ngoainuoc.php" class="btn btn-success">Xem thêm</a>
        </div>
    </section>

    <h2>Chuyến bay</h2>
    <section class="tour-list">
        <div class="row">
            <?php
            $query = "SELECT * FROM `flight_list`";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed");
            }

            if (mysqli_num_rows($result) != 0) {
                $i = 0;

                while ($row = mysqli_fetch_row($result)) {
                    if($i<3){
                        echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>Mã chuyến bay:$row[2]</h5>
                    <p class='card-text'>Thời gian khởi hành: $row[5]</p>
                    <p class='card-text'>Thời gian kết thúc: $row[6]</p>
                    <p class='card-text'>Ghế ngồi: $row[7]</p>
                    <p class='card-text'>Giá vé: $row[8]</p>
                </div>
            </div>
        </div>";
                    }
                    $i++;
                }
            }
            ?>
            <a href="maybay/search.php" class="btn btn-success">Xem thêm</a>
        </div>
    </section>

    <h2>Khách sạn</h2>
    <section class="tour-list">
        <div class="row">
            <?php
            $query = "SELECT * FROM `khachsan`";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed");
            }

            if (mysqli_num_rows($result) != 0) {
                $i = 0;

                while ($row = mysqli_fetch_row($result)) {
                    if($i<3){
                        echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[1]</h5>
                    <p class='card-text'>Đánh giá: $row[2] sao </p>
                    <p class='card-text'>Liên lạc: $row[4] </p>
                    <p class='card-text'>Giá: $row[3] VND</p>
                </div>
            </div>
        </div>";
                    }
                    $i++;
                }
            }
            ?>
            <a href="khachsan/hotel.php" class="btn btn-success">Xem thêm</a>
        </div>
    </section>

    <h2>Cho thuê xe</h2>
    <section class="tour-list">
        <div class="row">
            <?php
            $query = "SELECT * FROM `tourcar`";
            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Query failed");
            }

            if (mysqli_num_rows($result) != 0) {
                $i = 0;

                while ($row = mysqli_fetch_row($result)) {
                    if($i<3){
                        echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[1]</h5>
                    <p class='card-text'>Giá thuê xe theo ngày: $row[2]</p>
                    
                </div>
            </div>
        </div>";
                    }
                    $i++;
                }
            }
            ?>
            <a href="thuexe/thuexe.php" class="btn btn-success">Xem thêm</a>
        </div>
    </section>
</div>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>
