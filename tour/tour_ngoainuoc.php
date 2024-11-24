<?php
require "../connect.php";

$query = "SELECT * FROM `tour` WHERE `type` = 'Ngoài Nước'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Query failed");
}
if (isset($_POST["submit"])) {
    $idToEdit = $_POST["idToSubmit"];
    header("Location: chitiet_tour.php?id=$idToEdit");
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<?php
require "nav.php"
?>
<section class="tour-list">
    <div class="row">
        <?php
        if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_row($result)) {
                echo "<div class='col-md-4 col-sm-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>$row[1]</h5>
                    <p class='card-text'>Thời gian: $row[3] ngày</p>
                    <p class='card-text'>Ngày khởi hành: $row[4] $row[5]</p>
                    <p class='card-text'>Giá: $row[7] VND</p>
                    <form method='post' action=''>
                        <input type='hidden' name='idToSubmit' value='$row[0]'>
                        <input type='submit' name='submit' class='btn btn-primary' value='Xem chi tiết'>
                    </form>
                </div>
            </div>
        </div>";
            }
        }
        ?>
    </div>
</section>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>


</body>
</html>