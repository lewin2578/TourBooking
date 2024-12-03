<?php

session_start();

if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit();
} elseif ($_SESSION['role'] === 'User') {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} elseif ($_SESSION['role'] !== 'Admin') {
    die("Bạn không có quyền truy cập vào trang này.");
}

require "../connect.php";
$message = '';
$query_search = "SELECT * FROM `user`";

if (isset($_POST['submit'])) {
    $id = $_POST['id_user'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $status = $_POST['status'];
    $createdat = date('Y-m-d H:i:s'); // Current date and time
    $reset_token = '';
    $reset_expires = null;

    $errors = [];

    if (!filter_var($id, FILTER_VALIDATE_INT))
        $errors[] = "Mã người dùng sai định dạng.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors[] = "Email không hợp lệ.";
    if (empty($password))
        $errors[] = "Mật khẩu không được để trống.";
    if (!filter_var($phone, FILTER_VALIDATE_INT))
        $errors[] = "Số điện thoại không hợp lệ.";

    if (empty($errors)) {
        $query = "INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `createdat`, `reset_token`, `reset_expires`) VALUES (
                    '$id',
                    '$name',
                    '$email',
                    '$password',
                    '$phone',
                    '$address',
                    '$role',
                    '$status',
                    '$createdat',
                    '$reset_token',
                    '$reset_expires'
                )";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die("Query failed");
        } else {
            $message = "Thêm người dùng thành công";
        }
    } else {
        foreach ($errors as $error) {
            $message .= $error . "<br>";
        }
    }
}

if(isset($_POST['reset'])){
    $id = $name = $email = $password = $phone = $address = $role = $status = $message = '';
}

if (isset($_POST["search"])) {
    $s_email = $_POST["s_email"];
    $query_search = "SELECT * FROM `user` WHERE (`email` LIKE '%$s_email%')";
}

if (isset($_POST["view"])) {
    $query_search = "SELECT * FROM `user`";
}

if (isset($_POST["edit"])) {
    $idToEdit = $_POST["idToEdit"];
    header("Location: edit_user.php?id_user=$idToEdit");
    exit;
}


if (isset($_POST["delete"])) {
    $idToDelete = $_POST["idToDelete"];

    // Check if the user to delete is the protected admin
    $checkAdminQuery = "SELECT email FROM `user` WHERE `id_user`='$idToDelete'";
    $adminResult = mysqli_query($conn, $checkAdminQuery);

    if ($adminResult && mysqli_num_rows($adminResult) > 0) {
        $adminRow = mysqli_fetch_assoc($adminResult);
        if ($adminRow['email'] === 'admin123@gmail.com') {
            echo "<script>alert('Không thể xóa System Admin');</script>";
        } else {
            // Proceed with deletion
            $deleteQuery = "DELETE FROM `user` WHERE `id_user`='$idToDelete'";
            if (mysqli_query($conn, $deleteQuery)) {
                echo "<script>alert('Xóa người dùng thành công!');</script>";
            } else {
                echo "<script>alert('Lỗi khi xóa: " . mysqli_error($conn) . "');</script>";
            }
        }
    } else {
        echo "<script>alert('Người dùng không tồn tại.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý Người Dùng</title>
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
    <h1>Trang quản lý Người dùng</h1>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav">

                <li class="nav-item"><a class="nav-link" href="../home.php">Trang chủ</a></li>

                <li class="nav-item dropdown">
                    <p class="nav-link dropdown-toggle" id="AdminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Quản lý
                    </p>
                    <ul class="dropdown-menu" aria-labelledby="AdminDropdown">
                        <li><a class="dropdown-item" href="quanly_user.php">Quản lý User</a></li>
                        <li><a class="dropdown-item" href="quanly_thuexe.php">Quản lý thuê xe</a></li>
                        <li><a class="dropdown-item" href="quanly_tour.php">Quản lý tour</a></li>
                        <li><a class="dropdown-item" href="manager_flights.php">Quản lý chuyến bay</a></li>
                        <li><a class="dropdown-item" href="manage_hotel.php">Quản lý Khách sạn</a></li>
                        <li><a class="dropdown-item" href="manage_room.php.php">Quản lý Phòng</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>
<hr />
<form method="post" action="">
    <table align="center" style="background-color: lightgreen">
        <tr>
            <td colspan="2" align="center"><h4>Nhập dữ liệu Người Dùng</h4></td>
        </tr>
        <tr>
            <td>Mã Người Dùng</td>
            <td><input type="text" name="id_user" value="<?php echo isset($id) ? $id : '' ?>"></td>
        </tr>
        <tr>
            <td>Tên</td>
            <td><input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>"></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" value="<?php echo isset($email) ? $email : '' ?>"></td>
        </tr>
        <tr>
            <td>Mật khẩu</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td>Số điện thoại</td>
            <td><input type="text" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>"></td>
        </tr>
        <tr>
            <td>Địa chỉ</td>
            <td><input type="text" name="address" value="<?php echo isset($address) ? $address : '' ?>"></td>
        </tr>
        <tr>
            <td>Vai trò</td>
            <td><input type="text" name="role" value="<?php echo isset($role) ? $role : '' ?>"></td>
        </tr>
        <tr>
            <td>Trạng thái</td>
            <td><input type="text" name="status" value="<?php echo isset($status) ? $status : '' ?>"></td>
        </tr>
        <tr>
            <td>Reset Token</td>
            <td><input type="text" name="reset_token" value="<?php echo isset($reset_token) ? $reset_token : '' ?>" readonly></td>
        </tr>
        <tr>
            <td>Reset Expires</td>
            <td><input type="text" name="reset_expires" value="<?php echo isset($reset_expires) ? $reset_expires : '' ?>" readonly></td>
        </tr>
        <tr style="font-weight: bold">
            <td colspan="2" align="center" style="color: red"><?php echo $message?></td>
        </tr>
        <tr style="font-weight: bold">
            <td align="center" colspan="2">
                <input type="submit" name="submit" value="Thêm Người Dùng">
                <input type="submit" name="reset" value="Reset Dữ Liệu">
            </td>
        </tr>
    </table>
    <hr />
    <table align="center" style="background-color: lightgreen">
        <tr>
            <td colspan="2" align="center"><h4>Tìm kiếm người dùng</h4></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" name="s_email" value="<?php echo isset($s_email) ? $s_email : '' ?>"></td>
        </tr>
        <tr style="font-weight: bold">
            <td align="center" colspan="2">
                <input type="submit" name="search" value="Tìm kiếm">
                <input type="submit" name="view" value="Reset">
            </td>
        </tr>
    </table>
    <table align="center" border="1" width="100%">
        <tr style="font-weight: bold">
            <td colspan="10" align="center"><h4>Thông tin người dùng</h4></td>
        </tr>
        <tr>
            <td>Mã Người Dùng</td>
            <td>Tên</td>
            <td>Email</td>
            <td>Số Điện Thoại</td>
            <td>Địa Chỉ</td>
            <td>Vai Trò</td>
            <td>Trạng Thái</td>
            <td>Reset Token</td>
            <td>Reset Expires</td>
            <td>Chức Năng</td>
        </tr>
        <?php
        $result = mysqli_query($conn, $query_search);
        if (!$result) die("Query failed: ");
        if (mysqli_num_rows($result) != 0) {
            $i = 1;
            while ($row = mysqli_fetch_row($result)) {
                echo "<tr style='" . ($i % 2 == 0 ? "background-color: lightgreen" : "") . "'>";
                echo "<td>$row[0]</td>
              <td>$row[1]</td>
              <td>$row[2]</td>
              <td>$row[4]</td>
              <td>$row[5]</td>
              <td>$row[6]</td>
              <td>$row[7]</td>
              <td>$row[9]</td> <!-- Reset Token -->
              <td>$row[8]</td> <!-- Reset Expires -->
              <td>
                  <a href='edit_user.php?id_user=$row[0]' class='btn btn-warning'>Sửa</a>
                  <form method='post' action='' style='display:inline;'>
                      <input type='hidden' name='idToDelete' value='$row[0]'>
                      <input type='submit' name='delete' value='Xóa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa không?');\">
                  </form>
              </td>
          </tr>";
                $i++;
            }
        }
        ?>
    </table>
</form>


<footer>
    <p>Địa chỉ: 123 Đường Người Dùng, Thành Phố Hồ Chí Minh</p>
    <p>Điện thoại: 0123 456 789</p>
    <p>Email: info@quanlyngười dùng.com</p>
</footer>
</body>
</html>