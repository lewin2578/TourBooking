<?php
require "../connect.php";
$type = $kq = '';
$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Kiểm tra ID
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("ID không hợp lệ.");
    }

    $query = "SELECT * FROM `tour` WHERE `id_tour` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $dest = $row['id_dest'];
        $dura = $row['duration'];
        $date = $row['date'];
        $time = $row['time'];
        $gia = $row['price'];
        $desc = $row['desc'];
    } else {
        die("Tour không tồn tại.");
    }
} else {
    die("Không có ID được cung cấp.");
}
?>

<!DOCTYPE html>
<html lang="vi">
<?php
require "nav.php"
?>

<div class="container">
    <div class="tour-info">
        <h2>Giới thiệu Tour Du Lịch: <span id="tour-name"><?php echo $name?></span></h2>
        <h3>Thông tin tour</h3>
        <p><strong>Điểm đến:</strong> <span id="destination"><?php echo $dest?></span></p>
        <p><strong>Thời gian:</strong> <span id="duration"><?php echo $dura?></span></p>
        <p><strong>Ngày khởi hành:</strong> <span id="date"><?php echo $date?></span></p>
        <p><strong>Giờ khởi hành:</strong> <span id="time"><?php echo $time?></span></p>
        <p class="price"><strong>Giá:</strong> <span id="price"><?php echo $gia?></span></p>
    </div>
    <div class="description">
        <h4>Mô tả tour</h4>
        <p id="description"><?php echo $desc?></p>
    </div>
    <a href="#" class="btn">Đặt tour ngay</a>
</div>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>
