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

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tourbooking";
    
    // Kết nối tới database
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    $query_search = "SELECT * FROM `customer`";

    if (isset($_POST["search"])) {
        $deday = $_POST["deday"];
        $query_search = "SELECT * FROM `customer` WHERE (`deday` = '$deday')";
    }

    if (isset($_POST["edit"])) {
        $idToEdit = $_POST["idToEdit"];
        header("Location: edit_thuexe.php?id=$idToEdit");
        exit;
    }
    
    if (isset($_POST["delete"])) {
        $idToDelete = $_POST["idToDelete"];
        $deleteQuery = "DELETE FROM `customer` WHERE `id`='$idToDelete'";
        if (mysqli_query($conn, $deleteQuery)) {
            echo "<script>alert('Xóa thành công!');</script>";
        } else {
            echo "<script>alert('Lỗi khi xóa: " . mysqli_error($conn) . "');</script>";
        }
    }

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý Thuê xe du lịch</title>
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
    <h1>Trang quản lý Thuê xe du lịch</h1>
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

<form method="post" action="">
    <hr style="display: block;border-top: 3px solid #4CAF50;  margin: 8px 0;" />
    <table align="center" style="background-color: lightgreen; border-radius:3px;">
        <tr>
            <td colspan="2" align="center"><h4>Tìm kiếm lịch thuê xe</h4></td>
        </tr>
        <tr>
            <td>
                <div class="mb-3">
                <label for="deday" class="form-label">Ngày thuê xe</label>
                <input type="date" class="form-control" id="deday" name="deday">
                </div>
            </td>
        </tr>
        <tr style="font-weight: bold">
            <td align="center" colspan="2">
                <input type="submit" name="search" value="Tìm kiếm">
                <input type="submit" name="view" value="Reset">
            </td>
        </tr>
    </table>
    <div class="container mt-5 table-responsive">
        <h2>Danh sách khách hàng thuê xe</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ngày đi</th>
                    <th>Ngày về</th>
                    <th>Nơi nhận xe</th>
                    <th>Nơi giao xe</th>
                    <th>Họ tên khách hàng</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Loại xe</th>
                    <th>Ghi chú</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dữ liệu mẫu -->
                <?php
                $result = mysqli_query($conn, $query_search);
                if (!$result) die("Query failed: ");
                if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr>";
                echo "<td>$row[0]</td>
                  <td>$row[1]</td>
                  <td>$row[2]</td>
                  <td>$row[3]</td>
                  <td>$row[4]</td>
                  <td>$row[5]</td>
                  <td>$row[6]</td>
                  <td>$row[7]</td>
                  <td>$row[8]</td>
                  <td>$row[9]</td>
                  <td>
                      <form method='post' action=''>
                          <input type='hidden' name='idToEdit' value='$row[0]'>
                          <input type='hidden' name='idToDelete' value='$row[0]'>
                          <button type='submit' class='btn btn-warning btn-sm' name='edit'>Sửa</button>
                          <button type='submit' class='btn btn-danger btn-sm' name='delete' onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?');\">Xóa</button>
                      </form>
                  </td>
              </tr>";
            }
        }
        ?>
                
            </tbody>
        </table>
    </div>
</form>
  <footer>
      <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
      <p>Điện thoại: 0123 456 789</p>
      <p>Email: info@tourdulich.com</p>
  </footer>
  </body>
</html>