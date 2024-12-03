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
    <title>Manage Hotel</title>
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
    <h1>Trang quản lý khách sạn</h1>
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
    $name_hotel = $_POST['name_hotel'];
    $rating_hotel = $_POST['rating_hotel'];
    $price_hotel= $_POST['price_hotel'];
    $contact_hotel = $_POST['contact_hotel'];
    $desc_hotel = $_POST['desc_hotel'];
    $img_hotel = $_POST['img_hotel'];
    if ($name_hotel == NULL || $rating_hotel == NULL || $contact_hotel == NULL || $img_hotel == NULL|| $rating_hotel>5 || $rating_hotel<1) {
        $kq="Thêm thất bại, yêu cầu kiểm tra lại thông tin.";
    }
    else{
        $query = "INSERT INTO `khachsan` (`id_hotel`, `name_hotel`, `rating_hotel`, `price_hotel`, `contact_hotel`, `desc_hotel`, `img_hotel`) VALUES (NULL, '$name_hotel', '$rating_hotel','$price_hotel', '$contact_hotel', '$desc_hotel', '$img_hotel');";
        $result = mysqli_query($conn, $query);
        if($result){
            $kq="Thêm thành công";
        }
        else $kq="Lỗi!";
    }
}
?>
<form method="post" action="manage_hotel.php">
    <table align="center">
        <tr style="height: 10%">
            <td colspan="2" align="center" style="font-weight: bold ">Thêm Khách Sạn</td>
        </tr>
        <tr>
            <td>Tên khách sạn<text style="color: red">*</text>:</td>
            <td><input type="text" name="name_hotel" value ="<?php if(isset($name_hotel)) echo $name_hotel ?>"> </td>
        </tr>
        <tr>
            <td>Số sao của khách sạn<text style="color: red">*</text>:</td>
            <td><input type="number" max="5" min="1" name="rating_hotel" value ="<?php if(isset($rating_hotel)) echo $rating_hotel ?>"> </td>
        </tr>
        <tr>
            <td>Giá từ<text style="color: red">*</text>:</td>
            <td><input type="text" name="price_hotel" value ="<?php if(isset($price_hotel)) echo $price_hotel ?>"> </td>
        </tr>
        <tr>
            <td>Liên hệ:<text style="color: red">*</text>:</td>
            <td><input type="number" name="contact_hotel" value ="<?php if(isset($contact_hotel)) echo $contact_hotel ?>"> </td>
        </tr>
        <tr>
            <td>Mô tả:</td>
            <td><textarea rows="3" name="desc_hotel" id="desc_hotel"></textarea></td>
        </tr>
        <tr>
            <td>Hình ảnh(Nhập đường dẫn)<text style="color: red">*</text>:</td>
            <td><input type="text" id="img_hotel" name="img_hotel" value ="<?php if(isset($img_hotel)) echo $img_hotel ?>"></td>
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
    <table style="border: solid">
        <tr style="border: solid">
            <td colspan="9" style="text-align: center">Danh sách khách sạn hiện có</td>
        </tr>
        <tr style="border: solid">
            <td style="border: solid">id_hotel</td>
            <td style="border: solid">name_hotel</td>
            <td style="border: solid">rating_hotel</td>
            <td style="border: solid">price_hotel</td>
            <td style="border: solid">contact_hotel</td>
            <td style="border: solid">desc_hotel</td>
            <td style="border: solid">img_hotel</td>
        </tr style="border: solid">
            <?php
            $query_list = "SELECT * FROM `khachsan`";
            $result_list = mysqli_query($conn, $query_list);
            if(!$result_list) die("Query failed!");
            if(mysqli_num_rows($result_list)>0)
                while($row_list = mysqli_fetch_row($result_list)){
                ?><tr>
                    <td style="border: solid"><?php echo "$row_list[0]";?></td>
                    <td style="border: solid"><?php echo "$row_list[1]";?></td>
                    <td style="border: solid"><?php echo "$row_list[2]";?></td>
                    <td style="border: solid"><?php echo "$row_list[3]";?></td>
                    <td style="border: solid"><?php echo "$row_list[4]";?></td>
                    <td style="border: solid"><?php echo "$row_list[5]";?></td>
                    <td style="border: solid"><?php echo "$row_list[6]";?></td>
                </tr>
                    <?php
                }
            ?>
    </table>
</form>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>
</body>
</html>
