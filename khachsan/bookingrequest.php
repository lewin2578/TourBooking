<!DOCTYPE html>
<html lang="vi">
<?php
require "../nav.php";
$conn = mysqli_connect("localhost", "root", "", "tourbooking");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request</title>
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
if(isset($_POST['submit'])){
    $name_request = $_POST['name_request'];
    $email_request = $_POST['email_request'];
    $phone_request = $_POST['phone_request'];
    $address_request = $_POST['address_request'];
    $desc_request = $_POST['desc_request'];
    $ads_request = $_POST['ads_request'];
    if ($name_request == NULL || $email_request == NULL || $phone_request == NULL || $desc_request == NULL) {
        $kq="Gửi thất bại, yêu cầu kiểm tra lại thông tin.";
    }
    else{
        $query = "INSERT INTO `booking_request` (`id_request`, `id_hotel`, `name_request`, `email_request`, `phone_request`, `address_request`, `desc_request`, `ads_request`) VALUES (NULL, '$id_hotel', '$name_request', '$email_request', '$phone_request', '$address_request', '$desc_request', '$ads_request');";
        $result = mysqli_query($conn, $query);
        if($result){
            $kq="Thêm thành công";
        }
    }
}
?>
<form method="post" action="bookingrequest.php?id_hotel=<?php echo $id_hotel ?>">
    <table align="center">
        <tr style="height: 10%">
            <td colspan="2" align="center" style="font-weight: bold "><?php echo $row_hotel[1]?></td>
        </tr>
        <tr>
            <td>Họ Tên<text style="color: red">*</text>:</td>
            <td><input type="text" name="name_request" value ="<?php if(isset($name_request)) echo $name_request ?>" </td>
        </tr>
        <tr>
            <td>Email<text style="color: red">*</text>:</td>
            <td><input type="email" name="email_request" value ="<?php if(isset($email_request)) echo $email_request ?>" </td>
        </tr>
        <tr>
            <td>Số điện thoại<text style="color: red">*</text>:</td>
            <td><input type="number" name="phone_request" value ="<?php if(isset($phone_request)) echo $phone_request ?>" </td>
        </tr>
        <tr>
            <td>Địa chỉ:</td>
            <td><input type="text" name="address_request" value ="<?php if(isset($address_request)) echo $address_request ?>" </td>
        </tr>
        <tr>
            <td>Yêu cầu<text style="color: red">*</text>:</td>
            <td><textarea rows="3" name="desc_request" id="desc_request"></textarea></td>
        </tr>
        <tr>
            <td>Bạn biết thông tin qua:</td>
            <td><textarea rows="2" name="ads_request" id="ads_request"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Gửi" style="background-color: green;color: white">
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
