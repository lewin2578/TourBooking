<?php
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
    <title>Admin Thue Xe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <nav>
        <a href="../home.php">Quay lại trang chủ</a>
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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
  </body>
</html>