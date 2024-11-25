<!DOCTYPE html>
<html lang="vi">
<?php
require "../nav.php";
$conn = mysqli_connect("localhost", "root", "", "tour_booking");
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
    $query_room = "SELECT * FROM `room` WHERE `id_hotel` = $id_hotel";
    $result_room = mysqli_query($conn, $query_room);
    if (!$result_room) die("Query failed!");

?>
<h1 style="text-align: center;font-weight: bold;color: black"><?php echo $row_hotel[1] ?></h1>
<div class="Hotel" style="width: 90%;height: 350px;margin-left: 5%">
    <div class="Hotel_Image" style="width: 50%;height: 100%;float: left">
        <img src="<?php echo $row_hotel[6] ?>" style="height: 100%; width: 100%">
    </div>
    <div class="Hotel_Info" style="width: 50%;height: 100%;float: left;padding-left: 2%;padding-top: 2%">
        <text style="font-size: large;font-weight: bold">Số sao:</text>
        <text style="color: yellow;font-size: large"><?php for ($x = 0; $x <= $row_hotel[2]; $x++) {?>&#9733 <?php } ?><br></text>
        <text style="font-size: large;font-weight: bold">Giá từ: <?php echo $row_hotel[3] ?></text> <br>
        <text style="font-size: large;font-weight: bold">Liên hệ: <?php echo $row_hotel[4] ?></text><br>
        <text style="font-size: large;font-weight: bold"><?php echo $row_hotel[5] ?></text>
    </div>
</div>
<div class="container" style="width: 90%; margin-top: 3%">
    <?php while($row_room = mysqli_fetch_row($result_room)) {?>
        <div class="room" style="width: 100%; height: 300px;border-style: solid;border-width: 10px;border-color: lightgray">
            <div class="Room_Image" style="width: 30%;height: 100%;float: left">
                <img src="<?php echo $row_room[7] ?>" style="width: 96%;height: 96%;margin-top: 2%;margin-left: 2%">
            </div>
            <div class="Room_Info" style="width: 35%; height: 100%;float: left;padding-left: 1%">
                <text style="font-weight: bold;text-decoration: underline"><?php echo $row_room[2] ?></text><br>
                <text>
                    <?php
                        $room_desc = explode('.',$row_room[6]);
                        foreach ($room_desc as $value) echo $value.'<br>';
                    ?>
                </text>
            </div>
            <div class="Room_Price" style="width: 35%;height: 100%;float: left;padding-left: 1%">
                <text style="font-weight: bold">Giá Phòng:</text>
                <text>
                    <?php echo $row_room[5] ?>
                </text>
            </div>
        </div>
    <?php } ?>
</div>
<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>php
