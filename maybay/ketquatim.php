<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'database_connect.php'; // Kết nối đến database

    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departureDate = $_POST['departureDate'];
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
    $tripType = $_POST['tripType'];

    // Truy vấn thông tin sân bay
    $airport = $conn->query("SELECT * FROM airport_list");
    while ($row = $airport->fetch_assoc()) {
        $aname[$row['id']] = ucwords($row['airport'] . ', ' . $row['location']);
    }

    // Truy vấn vé một chiều
    if ($tripType == 'oneWay' && !empty($departureDate)) {
    $where = " WHERE DATE(f.departure_datetime) = '".date('Y-m-d', strtotime($departureDate))."'";
    $where .= " AND f.departure_airport_id = '$departure_airport_id' AND f.arrival_airport_id = '$arrival_airport_id'";
    $flight = $conn->query("SELECT f.* 
                            FROM flight_list f 
                            $where 
                            ORDER BY rand()");

    if ($flight->num_rows > 0) {
        echo "<div class='container mt-5'>
                <h3>Vé Một Chiều</h3>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Ngày đi</th>
                            <th>Thời gian đi</th>
                            <th>Điểm đi</th>
                            <th>Điểm đến</th>
                            <th>Giá</th>
                            <th>Số ghế trống</th>
                            <th>Đặt vé</th>
                        </tr>
                    </thead>
                    <tbody>";

        while ($row = $flight->fetch_assoc()) {

            echo "<tr>
                    <td>" . date('d-m-Y', strtotime($row['departure_datetime'])) . "</td>
                    <td>" . date('h:i A', strtotime($row['departure_datetime'])) . "</td>
                    <td>" . $aname[$row['departure_airport_id']] . "</td>
                    <td>" . $aname[$row['arrival_airport_id']] . "</td>
                    <td>" . number_format($row['price'], 2) . " VND</td>
                    <td><button class='btn btn-primary'>Đặt vé</button></td>
                  </tr>";
        }

        echo "</tbody>
            </table>
        </div>";
    } else {
        echo "<div class='container mt-5'>
                <h3>Vé Một Chiều</h3>
                <div class='row align-items-center'>
                    <h5 class='text-center'><b>No result.</b></h5>
                </div>
              </div>";
    }
}

    // Nếu người dùng chọn khứ hồi, truy vấn thêm vé khứ hồi
    if ($tripType == 'roundTrip' && !empty($returnDate)) {
        $where = " WHERE DATE(f.departure_datetime) = '".date('Y-m-d', strtotime($returnDate))."'";
        $where .= " AND f.departure_airport_id = '$arrival_airport_id' AND f.arrival_airport_id = '$departure_airport_id'";
        $flight = $conn->query("SELECT f.* 
                                FROM flight_list f 
                                $where 
                                ORDER BY rand()");

        if ($flight->num_rows > 0) {
            echo "<div class='container mt-5'>
                    <h3>Vé Khứ Hồi</h3>
                    <table class='table table-bordered'>
                        <thead>
                            <tr>
                                <th>Ngày đi</th>
                                <th>Thời gian đi</th>
                                <th>Điểm đi</th>
                                <th>Điểm đến</th>
                                <th>Giá</th>
                                <th>Số ghế trống</th>
                                <th>Đặt vé</th>
                            </tr>
                        </thead>
                        <tbody>";

            while ($row = $flight->fetch_assoc()) {
                echo "<tr>
                        <td>" . date('d-m-Y', strtotime($row['departure_datetime'])) . "</td>
                        <td>" . date('h:i A', strtotime($row['departure_datetime'])) . "</td>
                        <td>" . $aname[$row['departure_airport_id']] . "</td>
                        <td>" . $aname[$row['arrival_airport_id']] . "</td>
                        <td>" . number_format($row['price'], 2) . " VND</td>
                        <td><button class='btn btn-primary'>Đặt vé</button></td>
                      </tr>";
            }

            echo "</tbody>
                </table>
            </div>";
        } else {
            echo "<div class='container mt-5'>
                    <h3>Vé Khứ Hồi</h3>
                    <div class='row align-items-center'>
                        <h5 class='text-center'><b>No result.</b></h5>
                    </div>
                  </div>";
        }
    }
    mysqli_close($conn);
}
?>
