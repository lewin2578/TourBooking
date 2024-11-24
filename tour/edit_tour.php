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

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $dest = $_POST['dest'];
    $dura = $_POST['dura'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $gia = $_POST['gia'];
    $desc = $_POST['desc'];
    $errors = [];

    // Xác định loại tour
    if (intval(substr($dest, 0, 2)) == 84) {
        $type = 'Trong nước';
    } else {
        $type = 'Ngoài nước';
    }

    // Kiểm tra dữ liệu đầu vào
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        $errors[] = "Mã Tour sai định dạng.";
    }
    if (!filter_var($dura, FILTER_VALIDATE_INT) || $dura <= 0) {
        $errors[] = "Lịch trình phải là số nguyên dương.";
    }
    if (!filter_var($gia, FILTER_VALIDATE_INT) || $gia <= 0) {
        $errors[] = "Giá phải là số nguyên dương.";
    }

    // Nếu không có lỗi, thực hiện cập nhật
    if (empty($errors)) {
        $query = "UPDATE `tour` SET 
                    `id_tour` = '$id',
                    `name` = '$name',
                    `id_dest` = '$dest',
                    `duration` = '$dura',
                    `date` = '$date',
                    `time` = '$time',
                    `type` = '$type',
                    `price` = '$gia',
                    `desc` = '$desc'
                  WHERE id_tour = '$id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Cập nhật thất bại: " . mysqli_error($conn));
        } else {
            $kq = "Cập nhật thành công!";
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
        table {
            margin: 20px auto;
            background-color: lightgreen;
            padding: 10px;
            border-radius: 5px;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
<header>
    <h1>Chỉnh Sửa Thông Tin Tour</h1>
</header>

<form method="post" action="">
    <table>
        <tr>
            <td colspan="2" align="center"><h4>Sửa dữ liệu Tour</h4></td>
        </tr>
        <tr>
            <td>Mã Tour</td>
            <td><input type="text" name="id" value="<?php echo isset($id) ? $id : ''; ?>" readonly></td>
        </tr>
        <tr>
            <td>Tên</td>
            <td><input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>"></td>
        </tr>
        <tr>
            <td>Điểm đến</td>
            <td>
                <select name="dest">
                    <?php
                    $query = "SELECT * FROM `destination`";
                    $result = mysqli_query($conn, $query);
                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_row($result)) {
                            $selected = ($row[0] == $dest) ? 'selected' : '';
                            echo "<option value='$row[0]' $selected>$row[1]</option>";
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Lịch trình</td>
            <td><input type="text" name="dura" value="<?php echo isset($dura) ? $dura : ''; ?>"> ngày</td>
        </tr>
        <tr>
            <td>Ngày khởi hành</td>
            <td><input type="date" name="date" value="<?php echo isset($date) ? $date : ''; ?>"></td>
        </tr>
        <tr>
            <td>Giờ khởi hành</td>
            <td><input type="time" name="time" value="<?php echo isset($time) ? $time : ''; ?>"></td>
        </tr>
        <tr>
            <td>Giá</td>
            <td><input type="text" name="gia" value="<?php echo isset($gia) ? $gia : ''; ?>"></td>
        </tr>
        <tr>
            <td>Thông tin mô tả</td>
            <td><textarea rows="5" name="desc"><?php echo isset($desc) ? $desc : ''; ?></textarea></td>
        </tr>
        <tr style="font-weight: bold">
            <td colspan="2" align="center" style="color: red"><?php echo $kq; ?></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Cập nhật dữ liệu">
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