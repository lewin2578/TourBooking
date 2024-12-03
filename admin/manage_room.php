<!DOCTYPE html>
<html lang="vi">
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

$conn = mysqli_connect("localhost", "root", "", "tourbooking");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Room</title>
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
    <h1>Trang quản lý Phòng</h1>
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
<?php
$query_hotel = "SELECT * FROM `khachsan`";
$result_hotel = mysqli_query($conn, $query_hotel);
if (!$result_hotel) die("Query failed!");
$row_hotel = mysqli_fetch_array($result_hotel);
if(isset($_POST['submit'])){
    $id_hotel = $_POST['id_hotel'];
    $name_room = $_POST['name_room'];
    $smallbed_room= $_POST['smallbed_room'];
    $largebed_room = $_POST['largebed_room'];
    $price_room = $_POST['price_room'];
    $desc_room = $_POST['desc_room'];
    $img_room = $_POST['img_room'];
    if ($id_hotel == NULL || $name_room == NULL || $smallbed_room == NULL || $smallbed_room < 0|| $largebed_room == NULL|| $largebed_room < 0|| $price_room == NULL || $img_room = NULL) {
        $kq="Thêm thất bại, yêu cầu kiểm tra lại thông tin.";
    }
    else{
        $query = "INSERT INTO `room` (`id_room`,`id_hotel`, `name_room`, `smallbed_room`, `largebed_room`, `price_room`, `desc_room`, `img_room`) VALUES (NULL, '$id_hotel', '$name_room','$smallbed_room', '$largebed_room', '$price_room', '$desc_room', '$img_room');";
        $result = mysqli_query($conn, $query);
        if($result){
            $kq="Thêm thành công";
        }
        else $kq="Lỗi!";
    }
}
?>
<form method="post" action="manage_room.php">
    <table align="center">
        <tr style="height: 10%">
            <td colspan="2" align="center" style="font-weight: bold ">Thêm Phòng Mới Cho Khách Sạn</td>
        </tr>
        <tr>
            <td>Mã Khách sạn<text style="color: red">*</text>:</td>
            <td><select name="id_hotel">
                    <?php
                    $query_hotel_id_list = "SELECT * FROM `khachsan`";
                    $result_hotel_id_list = mysqli_query($conn, $query_hotel_id_list);
                    if(!$result_hotel_id_list) die("Query failed!");
                    if(mysqli_num_rows($result_hotel_id_list) != 0)
                        while($row = mysqli_fetch_row($result_hotel_id_list)){
                            echo "<option value='".$row[0]."'>".$row[1]."</option>";
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Tên phòng<text style="color: red">*</text>:</td>
            <td><input type="text" name="name_room" value ="<?php if(isset($name_room)) echo $name_room ?>"> </td>
        </tr>
        <tr>
            <td>Giường nhỏ<text style="color: red">*</text>:</td>
            <td><input type="number" min="0" name="smallbed_room" value ="<?php if(isset($smallbed_room)) echo $smallbed_room ?>"> </td>
        </tr>
        <tr>
            <td>Giường lớn<text style="color: red">*</text>:</td>
            <td><input type="number" min="0" name="largebed_room" value ="<?php if(isset($largebed_room)) echo $largebed_room ?>"> </td>
        </tr>
        <tr>
            <td>Giá phòng<text style="color: red">*</text>:</td>
            <td><textarea rows="4" name="price_room" id="price_room"></textarea></td>
        </tr>
        <tr>
            <td>Mô tả phòng:</td>
            <td><textarea rows="4" name="desc_room" id="desc_room"></textarea></td>
        </tr>
        <tr>
            <td>Hình ảnh(Nhập đường dẫn)<text style="color: red">*</text>:</td>
            <td><input type="text" id="img_room" name="img_room" value ="<?php if(isset($img_room)) echo $img_room ?>"></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Thêm" style="background-color: green;color: white">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php if(isset($kq)) echo $kq ?>
            </td>
        </tr>
    </table>
</form>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>
</body>
</html>
