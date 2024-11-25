<?php
$conn= new mysqli('localhost','root','','tourbooking')or die("Could not connect to mysql".mysqli_error($con));

// Xử lý yêu cầu cập nhật chuyến bay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_flight'])) {
    $flight_id = $_POST['flight_id'];
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE flight_list SET departure_airport_id = ?, arrival_airport_id = ?, departure_datetime = ?, arrival_datetime = ?, price = ? WHERE id = ?");
    $stmt->bind_param('iissdi', $departure_airport_id, $arrival_airport_id, $departure_datetime, $arrival_datetime, $price, $flight_id);
    $stmt->execute();
    $stmt->close();
    header("Location: manager_flights.php");
    exit();
}

// Lấy thông tin chuyến bay để chỉnh sửa
$flight_id = $_POST['flight_id'];
$flight = $conn->query("
    SELECT f.*, d.airport AS departure_airport, d.location AS departure_location, 
           a.airport AS arrival_airport, a.location AS arrival_location 
    FROM flight_list f
    JOIN airport_list d ON f.departure_airport_id = d.id
    JOIN airport_list a ON f.arrival_airport_id = a.id
    WHERE f.id = $flight_id
")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa chuyến bay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Chỉnh sửa chuyến bay</h2>
        <form method="post" action="">
            <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="departure_airport_id">Điểm đi</label>
                    <select name="departure_airport_id" id="departure_airport_id" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                        while ($row = $airport->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $flight['departure_airport_id'] ? 'selected' : ''; ?>><?php echo $row['location'] . ", " . $row['airport']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="arrival_airport_id">Điểm đến</label>
                    <select name="arrival_airport_id" id="arrival_airport_id" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                        while ($row = $airport->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php echo $row['id'] == $flight['arrival_airport_id'] ? 'selected' : ''; ?>><?php echo $row['location'] . ", " . $row['airport']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="departure_datetime">Ngày giờ đi</label>
                    <input type="datetime-local" class="form-control" id="departure_datetime" name="departure_datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($flight['departure_datetime'])); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="arrival_datetime">Ngày giờ đến</label>
                    <input type="datetime-local" class="form-control" id="arrival_datetime" name="arrival_datetime" value="<?php echo date('Y-m-d\TH:i', strtotime($flight['arrival_datetime'])); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $flight['price']; ?>" required>
            </div>
            <button type="submit" name="update_flight" class="btn btn-primary">Cập nhật chuyến bay</button>
            <a href="manager_flights.php" class="btn btn-secondary">Trở lại</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
