<?php
require "../connect.php";

$query = "SELECT * FROM `tour` WHERE `type` = 'Trong Nước'";
$result = mysqli_query($conn,$query);
if(!$result){
    die("Query failed");
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Du Lịch</title>
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
        .tour-list {
            flex: 1;
            display: flex;
            flex-direction: column; /* Sắp xếp theo cột */
            align-items: center; /* Canh giữa các mục */
            padding: 20px;
        }
        .tour-item {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 10px;
            padding: 15px;
            width: 80%; /* Chiếm 80% chiều rộng */
            text-align: center;
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
    <h1>Chào Mừng Đến Với Tour Du Lịch</h1>
    <nav>
        <a href="">Tour</a>
        <a href="">Vé máy bay</a>
        <a href="">Khách sạn</a>
        <a href="">Thuê xe</a>
    </nav>
</header>
<section class="tour-list">
    <div class='tour-item'>
        <h3>$row[1]</h3>
        <p>Thời gian: $row[3] ngày</p>
        <p>Ngày khởi hành: $row[4] $row[5]</p>
        <p>Giá: $row[7] VND</p>
        <form method='post' action=''>
            <input type='hidden' name='idToSubmit' value='$row[0]'>
            <input type='submit' name='submit' value='Xem chi tiết'>
        </form>
    </div>
<?php
if(mysqli_num_rows($result) != 0){
    while ($row = mysqli_fetch_row($result)){
        echo "<div class='tour-item'>
                  <h3>$row[1]</h3>
                  <p>Thời gian: $row[3] ngày</p>
                  <p>Ngày khởi hành: $row[4] $row[5]</p>
                  <p>Giá: $row[7] VND</p>
                  <form method='post' action=''>
                      <input type='hidden' name='idToSubmit' value='$row[0]'>
                      <input type='submit' name='submit' value='Xem chi tiết'>       
                  </form>
            </div>";
    }
}
?>
</section>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>