<?php

require "../connect.php";
$message = '';
$id = '';

if (isset($_GET['id_user'])) {
    $id = $_GET['id_user'];
    // Validate ID
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("ID không hợp lệ.");
    }

    $query = "SELECT * FROM `user` WHERE `id_user` = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $role = $row['role'];
        $status = $row['status'];
    } else {
        die("Người dùng không tồn tại.");
    }
} else {
    die("Không có ID được cung cấp.");
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $errors = [];

    // Validate input data
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        $errors[] = "Mã người dùng sai định dạng.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email không hợp lệ.";
    }
    if (!filter_var($phone, FILTER_VALIDATE_INT)) {
        $errors[] = "Số điện thoại không hợp lệ.";
    }

    // If no errors, perform the update
    if (empty($errors)) {
        $query = "UPDATE `user` SET 
                    `name` = '$name',
                    `email` = '$email',
                    `phone` = '$phone',
                    `address` = '$address',
                    `role` = '$role',
                    `status` = '$status'
                  WHERE `id_user` = '$id'";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            die("Cập nhật thất bại: " . mysqli_error($conn));
        } else {
            $message = "Cập nhật thành công!";
        }
    } else {
        foreach ($errors as $error) {
            $message .= $error . "<br>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chỉnh sửa Người Dùng</title>
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
    <h1>Chỉnh Sửa Thông Tin Người Dùng</h1>
</header>

<form method="post" action="">
    <table>
        <tr>
            <td colspan="2" align="center"><h4>Sửa dữ liệu Người Dùng</h4></td>
        </tr>
        <tr>
            <td>Mã Người Dùng</td>
            <td><input type="text" name="id" value="<?php echo isset($id) ? $id : ''; ?>" readonly></td>
        </tr>
        <tr>
            <td>Tên</td>
            <td><input type="text" name="name" value="<?php echo isset($name) ? $name : ''; ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>"></td>
        </tr>
        <tr>
            <td>Số Điện Thoại</td>
            <td><input type="text" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>"></td>
        </tr>
        <tr>
            <td>Địa Chỉ</td>
            <td><input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>"></td>
        </tr>
        <tr>
            <td>Vai Trò</td>
            <td>
                <input type="radio" name="role" value="Admin" <?php echo (isset($role) && $role == 'Admin') ? 'checked' : ''; ?>> Admin
                <input type="radio" name="role" value="User" <?php echo (isset($role) && $role == 'User') ? 'checked' : ''; ?>> User
            </td>
        </tr>
        <tr>
            <td>Trạng Thái</td>
            <td>
                <select name="status">
                    <option value="Active" <?php echo (isset($status) && $status == 'Active') ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo (isset($status) && $status == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                    <option value="Banned" <?php echo (isset($status) && $status == 'Banned') ? 'selected' : ''; ?>>Banned</option>
                </select>
            </td>
        </tr>
        <tr style="font-weight: bold">
            <td colspan="2" align="center" style="color: red"><?php echo $message; ?></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Cập nhật dữ liệu">
            </td>
        </tr>
    </table>
</form>

<footer>
    <p>Địa chỉ: 123 Đường Người Dùng, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@quanlyngười dùng.com</p>
</footer>
</body>
</html>