<?php
require_once 'database_connect.php';

// Xử lý yêu cầu thêm chuyến bay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_flight'])) {
    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departure_datetime = $_POST['departure_datetime'];
    $arrival_datetime = $_POST['arrival_datetime'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO flight_list (departure_airport_id, arrival_airport_id, departure_datetime, arrival_datetime, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('iissd', $departure_airport_id, $arrival_airport_id, $departure_datetime, $arrival_datetime, $price);
    $stmt->execute();
    $stmt->close();
}

// Xử lý yêu cầu xóa chuyến bay
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_flight'])) {
    $flight_id = $_POST['flight_id'];

    $stmt = $conn->prepare("DELETE FROM flight_list WHERE id = ?");
    $stmt->bind_param('i', $flight_id);
    $stmt->execute();
    $stmt->close();
}

// Lấy danh sách các chuyến bay và tên sân bay
$flights = $conn->query("
    SELECT f.*, d.airport AS departure_airport, d.location AS departure_location, 
           a.airport AS arrival_airport, a.location AS arrival_location 
    FROM flight_list f
    JOIN airport_list d ON f.departure_airport_id = d.id
    JOIN airport_list a ON f.arrival_airport_id = a.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý các chuyến bay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm chuyến bay</h2>
        <form method="post" action="">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="departure_airport_id">Điểm đi</label>
                    <select name="departure_airport_id" id="departure_airport_id" class="form-control" required>
                        <option value=""></option>
                        <?php
                        $airport = $conn->query("SELECT * FROM airport_list order by airport asc");
                        while ($row = $airport->fetch_assoc()):
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['location'] . ", " . $row['airport']; ?></option>
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
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['location'] . ", " . $row['airport']; ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="departure_datetime">Ngày giờ đi</label>
                    <input type="datetime-local" class="form-control" id="departure_datetime" name="departure_datetime" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="arrival_datetime">Ngày giờ về</label>
                    <input type="datetime-local" class="form-control" id="arrival_datetime" name="arrival_datetime" required>
                </div>
            </div>
            <div class="form-group">
                <label for="price">Giá</label>
                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" name="add_flight" class="btn btn-primary">Thêm chuyến bay</button>
        </form>

        <h2 class="mt-5">Danh sách các chuyến bay</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Điểm đi</th>
                    <th>Điểm đến</th>
                    <th>Ngày giờ đi</th>
                    <th>Ngày giờ về</th>
                    <th>Giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $flights->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['departure_location'] . ", " . $row['departure_airport']; ?></td>
                        <td><?php echo $row['arrival_location'] . ", " . $row['arrival_airport']; ?></td>
                        <td><?php echo $row['departure_datetime']; ?></td>
                        <td><?php echo $row['arrival_datetime']; ?></td>
                        <td><?php echo number_format($row['price'], 2); ?> VND</td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="flight_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_flight" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
