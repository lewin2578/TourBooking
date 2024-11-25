<?php
require "../connect.php";
$id_tour = '';
$flag = 0;

if (isset($_GET['id'])){
    $id_tour = $_GET['id'];
    $id_user = $_SESSION['id_user'];
    $query = "SELECT * FROM `user` WHERE `id_user` = '$id_user'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
    }
}

if(isset($_POST['submit'])){
    $depa = $_POST['depa'];
    $sl = $_POST['sl'];
    $id_book = $id_user . $id_tour . $depa . $sl;
    $query = "INSERT INTO `booking` (`id_book`, `id_user`, `id_tour`, `id_depa`, `quantity`) VALUES ('$id_book', '$id_user', '$id_tour', '$depa', '$sl')";
    $result = mysqli_query($conn,$query);
    if(!$result){
        die("Query failed");
    }
    else{
        $kq = "Thêm thành công";
    }
    $flag = 1;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Du Lịch</title>
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
        .tour-list {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .tour-list .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .tour-list .card:hover {
            transform: translateY(-5px);
        }
        .tour-list .card-title {
            font-size: 1.2em;
            font-weight: bold;
        }
        .tour-list .card-text {
            font-size: 0.9em;
        }
        .tour-list .btn {
            background-color: #007bff;
            border-color: #007bff;
        }
        .main {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .main h1, h2, h3 {
            color: #333;
        }
        .tour-info {
            margin: 20px 0;
        }
        .price {
            color: red;
            font-size: 1.5em;
        }
        .description {
            margin: 20px 0;
            line-height: 1.6;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container">
        <h1><a class="nav-link" href="../home.php">Chào Mừng Đến Với Tour Du Lịch</a></h1>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <p class="nav-link dropdown-toggle" id="tourDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tour
                        </p>
                        <ul class="dropdown-menu" aria-labelledby="tourDropdown">
                            <li><a class="dropdown-item" href="tour_trongnuoc.php">Trong nước</a></li>
                            <li><a class="dropdown-item" href="tour_ngoainuoc.php">Ngoài nước</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="../maybay/booking.php">Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link" href="../khachsan/hotel.php">Khách sạn</a></li>
                    <li class="nav-item"><a class="nav-link" href="../thuexe/thuexe.php">Thuê xe</a></li>

                    <?php
                    if (isset($_SESSION['id_user'])) {
                        // Đã đăng nhập, hiển thị liên kết Profile
                        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../login/profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login/logout.php">Đăng xuất</a>
                    </li>
                    ';
                    } else {
                        // Chưa đăng nhập, hiển thị liên kết Đăng nhập
                        echo '
                    <li class="nav-item">
                        <a class="nav-link" href="../login/login.php">Đăng nhập</a>
                    </li>
                    ';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </div>
</header>
<div class="main">
    <h1>Xác nhận đặt tour</h1>
    <form method="post" action="">
        <?php
        if($flag==0){
            echo '<p>Họ tên: '. $name .'</p>
        <p>So luong: <input type="number" min="1" value="1"  name="sl"></p>
        <p>Chon dia diem xuat phat:  <select name="depa"> ';
        ?>
        <?php
        $query = "SELECT * FROM `departure`";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("Query failed");
        }
        if(mysqli_num_rows($result) != 0){
            while ($row = mysqli_fetch_row($result)){
                echo "<option value='".$row[0]."'>".$row[1]."</option>";
            }
        }
        ?>
        <?php echo
        '</select></p>
        <p><input type="submit" class="btn" name="submit" value="Xác nhận đặt tour"></p>';}
        else
            require "../thanhtoan/thanhtoan.php";
        ?>
    </form>
</div>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>

</body>
</html>
