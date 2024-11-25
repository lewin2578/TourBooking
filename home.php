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
                    <li class="nav-item"><a class="nav-link" href="#">Khách sạn</a></li>
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
    <section class="flight-list">
    <div class="row">
        <?php
        // Truy vấn lấy dữ liệu chuyến bay và thông tin sân bay
        $query = "SELECT 
                     fl.id AS flight_id, 
                     dep_airport.airport AS departure_airport, 
                     arr_airport.airport AS arrival_airport, 
                     fl.departure_datetime, 
                     fl.price 
                  FROM flight_list fl
                  JOIN airport_list dep_airport ON fl.departure_airport_id = dep_airport.id
                  JOIN airport_list arr_airport ON fl.arrival_airport_id = arr_airport.id
                  ORDER BY fl.departure_datetime ASC";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Lỗi truy vấn: " . mysqli_error($conn));
        }

        // Kiểm tra và hiển thị dữ liệu
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 col-sm-6 mb-4'>
                        <div class='card'>
                            <div class='card-header bg-primary text-white'>
                                <h5 class='card-title'>Mã chuyến bay: {$row['flight_id']}</h5>
                            </div>
                            <div class='card-body'>
                                <p class='card-text'>Điểm đi: {$row['departure_airport']}</p>
                                <p class='card-text'>Điểm đến: {$row['arrival_airport']}</p>
                                <p class='card-text'>Khởi hành:" . date("d-m-Y H:i", strtotime($row['departure_datetime'])) . "</p>
                                <p class='card-text'>Giá vé: " . number_format($row['price'], 0, ',', '.') . " VND</p>
                                <form method='get' action='/TourBooking/maybay/datvemaybay.php'>
                                    <input type='hidden'name='action' value='view'>
                                    <input type='submit' name='submit' class='btn btn-primary' value='Xem chi tiết'>
                                </form>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "<p>Không có chuyến bay nào được tìm thấy.</p>";
        }
        ?>
    </div>
</section>


    <h2>Khách sạn</h2>
    <!--    code o day-->

    <h2>Cho thuê xe</h2>
    <section class="tour-list">
    <div class="row">
        <?php
        $query = "SELECT * FROM tourcar";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Query failed");
        }
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='col-md-4 col-sm-6 mb-4'>
                        <div class='card'>
                            <div class='card-body'>
                                <h5 class='card-title'>Loại xe: {$row['cartype']}</h5>
                                <p class='card-text'>Giá thuê/ngày: {$row['priceperday']} VND</p>
                                <form method='get' action='/TourBooking/thuexe/thuexe.php'>
                                    <input type='hidden'name='action' value='view'>
                                    <input type='submit' name='submit' class='btn btn-primary' value='Xem chi tiết'>
                                </form>
                            </div>
                        </div>
                    </div>";
            }
        }
        ?>
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
