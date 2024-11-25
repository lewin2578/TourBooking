<!DOCTYPE html>
<html lang="vi">
<?php
require "../nav.php";
$conn = mysqli_connect("localhost", "root", "", "khachsan");
if (!$conn) {
    die("Kết nối thất bại : " . mysqli_connect_error());
}
$query = "SELECT * FROM `khachsan`";
$result = mysqli_query($conn, $query);
if(!$result) die("Query failed!");
while($row = mysqli_fetch_row($result)) {
    ?><img src="<?php echo "$row[6]"; ?>"><?php
}
?>
<h2>Trong nước</h2>
<section class="tour-list" id="tours">
    <div class="tour-item">
        <h3>Tour Hà Nội - Hạ Long</h3>
        <p>Thời gian: 3 ngày 2 đêm</p>
        <p>Giá: 3.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Đà Nẵng - Hội An</h3>
        <p>Thời gian: 4 ngày 3 đêm</p>
        <p>Giá: 4.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Nha Trang</h3>
        <p>Thời gian: 5 ngày 4 đêm</p>
        <p>Giá: 6.000.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
</section>

<h2>Ngoài nước</h2>
<section class="tour-list" id="tours">
    <div class="tour-item">
        <h3>Tour Hà Nội - Hạ Long</h3>
        <p>Thời gian: 3 ngày 2 đêm</p>
        <p>Giá: 3.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Đà Nẵng - Hội An</h3>
        <p>Thời gian: 4 ngày 3 đêm</p>
        <p>Giá: 4.500.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
    <div class="tour-item">
        <h3>Tour Nha Trang</h3>
        <p>Thời gian: 5 ngày 4 đêm</p>
        <p>Giá: 6.000.000 VNĐ</p>
        <button>Đặt Ngay</button>
    </div>
</section>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>