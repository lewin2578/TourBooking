<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['role'] === 'User') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} elseif ($_SESSION['role'] !== 'Admin') {
    die("Bạn không có quyền truy cập vào trang này.");
}

$conn= new mysqli('localhost','root','','tourbooking')or die("Could not connect to mysql".mysqli_error($con));


// Xử lý yêu cầu thêm chuyến bay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_flight'])) {
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO flight_list (departure_airport_id, arrival_airport_id, departure_datetime, arrival_datetime, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('iissd', $departure_airport_id, $arrival_airport_id, $departure_datetime, $arrival_datetime, $price);
    $stmt->execute();
    $stmt->close();
}

// Xử lý yêu cầu xóa chuyến bay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_flight'])) {
    $flight_id = $_POST['flight_id'];

    $stmt = $conn->prepare("DELETE FROM flight_list WHERE id = ?");
    $stmt->bind_param('i', $flight_id);
    $stmt->execute();
    $stmt->close();
}

// Lấy danh sách các chuyến bay và tên sân bay
$flights = $conn->query("
    SELECT f.*, d.airport AS departure_airport, d.location AS departure_location, 
           a.airport AS arrival_airport, a.location AS arrival_location 
    FROM flight_list f
    JOIN airport_list d ON f.departure_airport_id = d.id
    JOIN airport_list a ON f.arrival_airport_id = a.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý các chuyến bay</title>
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
    <h1>Trang quản lý Chuyến bay</h1>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">

                <li class="nav-item"><a class="nav-link" href="../home.php">Trang chủ</a></li>

                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="AdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Quản lý
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="AdminDropdown">
                            <li><a class="dropdown-item" href="quanly_user.php">Quản lý User</a></li>
                            <li><a class="dropdown-item" href="quanly_thuexe.php">Quản lý thuê xe</a></li>
                            <li><a class="dropdown-item" href="quanly_tour.php">Quản lý tour</a></li>
                            <li><a class="dropdown-item" href="manager_flights.php">Quản lý chuyến bay</a></li>
                            <li><a class="dropdown-item" href="manage_hotel.php">Quản lý Khách sạn</a></li>
                            <li><a class="dropdown-item" href="manage_room.php.php">Quản lý Phòng</a></li>
                        </ul>
                    </li>

            </ul>
        </div>
    </nav>
</header>
    <div class="container mt-5">
        <h2>Thêm chuyến bay</h2>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="departure_airport_id">Điểm đi</label>
                    <select name="departure_airport_id" id="departure_airport_id" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                        while ($row = $airport->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['location'] . ", " . $row['airport']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="arrival_airport_id">Điểm đến</label>
                    <select name="arrival_airport_id" id="arrival_airport_id" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                        while ($row = $airport->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['location'] . ", " . $row['airport']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="departure_datetime">Ngày giờ đi</label>
                    <input type="datetime-local" class="form-control" id="departure_datetime" name="departure_datetime" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="arrival_datetime">Ngày giờ về</label>
                    <input type="datetime-local" class="form-control" id="arrival_datetime" name="arrival_datetime" required>
                </div>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" name="add_flight" class="btn btn-primary">Thêm chuyến bay</button>
        </form>

        <h2 class="mt-5">Danh sách các chuyến bay</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Điểm đi</th>
                    <th>Điểm đến</th>
                    <th>Ngày giờ đi</th>
                    <th>Ngày giờ về</th>
                    <th>Giá</th>
                    <th colspan="2">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $flights->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['departure_location'] . ", " . $row['departure_airport']; ?></td>
                        <td><?php echo $row['arrival_location'] . ", " . $row['arrival_airport']; ?></td>
                        <td><?php echo $row['departure_datetime']; ?></td>
                        <td><?php echo $row['arrival_datetime']; ?></td>
                        <td><?php echo number_format($row['price'], 2); ?> VND</td>
                        <td>
                            <form method="post" action="edit_flight.php">
                                <input type="hidden" name="flight_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" class="btn btn-warning btn-sm">Sửa</button>
                            </form>
                        </td>
                        <td>
                        <form method="post" action="">
                                <input type="hidden" name="flight_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_flight" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>
</body>
</html>
<?php $conn->close(); ?>

