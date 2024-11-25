<!DOCTYPE html>
<html lang="vi">
<?php
require "../nav.php";
$conn = mysqli_connect("localhost", "root", "", "khachsan");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room</title>
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
<?php
    $id_hotel = $_GET['id_hotel'];
    $query_hotel = "SELECT * FROM `khachsan` WHERE `id_hotel` = $id_hotel";
    $result_hotel = mysqli_query($conn, $query_hotel);
    if (!$result_hotel) die("Query failed!");
    $row_hotel = mysqli_fetch_array($result_hotel);
?>
<h1 style="text-align: center;font-weight: bold;color: black"><?php echo $row_hotel[1] ?></h1>
<div class="container" style="width: 100%;height: 300px;" dir="ltr">
    <ul>
        <?php
        $query = "SELECT * FROM `room` WHERE `id_hotel` = 3";
        $result = mysqli_query($conn, $query);
        if(!$result) die("Query failed!");
        ?>
    </ul>
</div>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>php
