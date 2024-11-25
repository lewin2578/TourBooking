<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourbooking";

// Kết nối tới database
$conn = mysqli_connect($servername, $username, $password, $dbname);

$type = $kq = '';
$id = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Kiểm tra ID
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("ID không hợp lệ.");
    }

    $query = "SELECT * FROM `customer` WHERE `id` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $deday = $row['deday'];
        $reday = $row['reday'];
        $pulocation = $row['pulocation'];
        $dolocation = $row['dolocation'];
        $fname = $row['fname'];
        $phone = $row['phone'];
        $email = $row['email'];
        $cartype = $row['cartype'];
        $addinfo = $row['addinfo'];
    } else {
        die("Thông tin không tồn tại.");
    }
} else {
    die("Không có ID được cung cấp.");
}

if (isset($_POST['submit'])) {
        $deday = $_POST['deday'];
        $reday = $_POST['reday'];
        $pulocation = $_POST['pulocation'];
        $dolocation = $_POST['dolocation'];
        $fname = $_POST['fname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $cartype = $_POST['cartype'];
        $addinfo = $_POST['addinfo'];
    $errors = [];

    // Nếu không có lỗi, thực hiện cập nhật
    if (empty($errors)) {
        $query = "UPDATE `customer` SET 
                    `deday` = '$deday',
                    `reday` = '$reday',
                    `pulocation` = '$pulocation',
                    `dolocation` = '$dolocation',
                    `fname` = '$fname',
                    `phone` = '$phone',
                    `email` = '$email',
                    `cartype` = '$cartype',
                    `addinfo` = '$addinfo'
                  WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Cập nhật thất bại: " . mysqli_error($conn));
        } else {
            $message = "Cập nhật thành công!";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
    } else {
        foreach ($errors as $error) {
            $kq .= $error . "<br>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        table tr td{
            border: 0px solid;
            padding: 10px;  
            background: rgba(192, 192, 192, 0.8);
        }
        table{
            width: 1000px;

        }
        label{
            font-family: sans-serif;
            
        }
        
        button {
            width: 200px;
            height: 50px;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 18px;
        }
        button:hover {
            background-color: #0056b3;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            margin: 0 15px;
            color: white;
            text-decoration: none;
        }
    </style>
    
</head>
<body>
<header>
    <h1>Chỉnh Sửa Thông Tin Đặt Xe</h1>
    <nav>
        <a href="quanly_thuexe.php">Quay lại</a>
    </nav>
</header>

<form method="post" action="">
<table border="0" style="margin-left: 16%;">
                <tr>
                    <td colspan="2" align="center">
                        <h2 style="font-family: sans-serif;">THÔNG TIN ĐẶT XE</h2>
                    </td>   
                </tr>
                <tr>
                    <td>
                        <!-- <label for="departure-date">Nhập ngày đi *</label>
                        <input type="date" id="departure-date" name="deday" required> -->
                        <div class="mb-3">
                        <label for="departure-date" class="form-label">Ngày đi*</label>
                        <input type="date" class="form-control" id="departure-date" name="deday" value="<?php echo isset($deday) ? $deday : ''; ?>" required>
                        </div>
                    </td>
                    <td>
                        <!-- <label for="return-date">Nhập ngày về</label>
                        <input type="date" id="return-date" name="reday" required> -->
                        <div class="mb-3">
                        <label for="return-date" class="form-label">Ngày về*</label>
                        <input type="date" class="form-control" id="return-date" name="reday" value="<?php echo isset($reday) ? $reday : ''; ?>" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- <label for="pickup-location">Nhập điểm nhận đi *</label>
                        <input type="text" id="pickup-location" name="pulocation" required> -->
                        <div class="mb-3">
                        <label for="pickup-location" class="form-label">Điểm nhận đi*</label>
                        <input type="text" class="form-control" id="pickup-location" name="pulocation" value="<?php echo isset($pulocation) ? $pulocation : ''; ?>" required>
                        </div>
                    </td>
                    <td>
                        <!-- <label for="dropoff-location">Nhập điểm đến *</label>
                        <input type="text" id="dropoff-location" name="dolocation" required> -->
                        <div class="mb-3">
                        <label for="dropoff-location" class="form-label">Điểm đến*</label>
                        <input type="text" class="form-control" id="dropoff-location" name="dolocation" value="<?php echo isset($dolocation) ? $dolocation : ''; ?>" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- <label for="full-name">Họ Tên *</label>
                        <input type="text" id="full-name" name="fname" required> -->
                        <div class="mb-3">
                        <label for="full-name" class="form-label">Họ Tên*</label>
                        <input type="text" class="form-control" id="full-name" name="fname" value="<?php echo isset($fname) ? $fname : ''; ?>" required>
                        </div>
                    </td>
                    <td>
                        <!-- <label for="phone">Điện thoại *</label>
                        <input type="tel" id="phone" name="phone" required> -->
                        <div class="mb-3">
                        <label for="phone" class="form-label">Điện thoại*</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required> -->
                        <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                        </div>
                    </td>
                    <td>
                        <label for="car-service">Chọn loại dịch vụ xe *</label>
                        <select class="form-select" id="car-service" name="cartype" required>
                            <?php
                                $query = "SELECT * FROM `tourcar`;";
                                $result = mysqli_query($conn, $query);
                                if(!$result) die("\nQuery failed");
                                if(mysqli_num_rows($result) != 0){
                                    while($row = mysqli_fetch_array($result)){
                                        $str = "<option value='".$row['cartype']."'>".$row['cartype']."</option>";
                                        echo $str;
                                    }
                                }
                        ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" >
                        <!-- <label for="additional-info">Thêm thông tin và Yêu cầu khác</label>
                        <textarea id="additional-info" rows="4" name="addinfo" style="margin-left: 00px; width: 1000px"></textarea> -->
                        <div class="mb-3">
                        <label for="additional-info" class="form-label">Thêm thông tin và yêu cầu khác</label>
                        <textarea class="form-control" id="additional-info" rows="3" name="addinfo"><?php echo isset($addinfo) ? $addinfo : ''; ?></textarea>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="right" style="background: none;">
                        <!-- <button type="submit" name="submit">THUÊ XE NHANH</button> -->
                         <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            CẬP NHẬT
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận cập nhật</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Bạn chắc chắn muốn cập nhật ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Đồng ý</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </td>
                </tr>
            </table> 
</form>

<footer>
    <p>Địa chỉ: 123 Đường Du Lịch, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@tourdulich.com</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>