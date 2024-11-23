<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'database_connect.php'; // Kết nối đến database

    $departure_airport_id = $_POST['departure_airport_id'];
    $arrival_airport_id = $_POST['arrival_airport_id'];
    $departureDate = $_POST['departureDate'];
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
    $tripType = $_POST['tripType'];

    // Truy vấn vé một chiều
    $query_oneway = "SELECT f.*, a.airlines, a.logo_path 
                     FROM flight_list f 
                     INNER JOIN airlines_list a ON f.airline_id = a.id 
                     WHERE f.departure_airport_id = ? 
                     AND f.arrival_airport_id = ? 
                     AND DATE(f.departure_datetime) = ?";
    
    $stmt_oneway = mysqli_prepare($conn, $query_oneway);
    mysqli_stmt_bind_param($stmt_oneway, "sss", $departure_airport_id, $arrival_airport_id, $departureDate);
    mysqli_stmt_execute($stmt_oneway);
    $result_oneway = mysqli_stmt_get_result($stmt_oneway);

    echo "<div class='container mt-5'>
            <h3>Vé Khứ Một Chiều</h3>
            <table class='table table-bordered'>
                <thead>
                    <tr>
                        <th>Hãng bay</th>
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

    while ($row = mysqli_fetch_assoc($result_oneway)) {
        $booked = $conn->query("SELECT * FROM booked_flight WHERE flight_id = " . $row['id'])->num_rows;
        $availableSeats = $row['seats'] - $booked;

        echo "<tr>
                <td><img src='assets/img/" . $row['logo_path'] . "' alt=''>" . $row['airlines'] . "</td>
                <td>" . date('d-m-Y', strtotime($row['departure_datetime'])) . "</td>
                <td>" . date('h:i A', strtotime($row['departure_datetime'])) . "</td>
                <td>" . $row['departure_airport_id'] . "</td>
                <td>" . $row['arrival_airport_id'] . "</td>
                <td>" . number_format($row['price'], 2) . " VND</td>
                <td>" . $availableSeats . "</td>
                <td><button class='btn btn-primary'>Đặt vé</button></td>
              </tr>";
    }

    echo "</tbody>
        </table>
    </div>";

    // Nếu người dùng chọn khứ hồi, truy vấn thêm vé khứ hồi
    if ($tripType == 'roundTrip' && !empty($returnDate)) {
        $query_roundtrip = "SELECT f.*, a.airlines, a.logo_path 
                            FROM flight_list f 
                            INNER JOIN airlines_list a ON f.airline_id = a.id 
                            WHERE f.departure_airport_id = ? 
                            AND f.arrival_airport_id = ? 
                            AND DATE(f.departure_datetime) = ?";

        $stmt_roundtrip = mysqli_prepare($conn, $query_roundtrip);
        mysqli_stmt_bind_param($stmt_roundtrip, "sss", $arrival_airport_id, $departure_airport_id, $returnDate);
        mysqli_stmt_execute($stmt_roundtrip);
        $result_roundtrip = mysqli_stmt_get_result($stmt_roundtrip);

        echo "<div class='container mt-5'>
                <h3>Vé Khứ Hồi</h3>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Hãng bay</th>
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

        while ($row = mysqli_fetch_assoc($result_roundtrip)) {
            $booked = $conn->query("SELECT * FROM booked_flight WHERE flight_id = " . $row['id'])->num_rows;
            $availableSeats = $row['seats'] - $booked;

            echo "<tr>
                    <td><img src='assets/img/" . $row['logo_path'] . "' alt=''>" . $row['airlines'] . "</td>
                    <td>" . date('d-m-Y', strtotime($row['departure_datetime'])) . "</td>
                    <td>" . date('h:i A', strtotime($row['departure_datetime'])) . "</td>
                    <td>" . $row['departure_airport_id'] . "</td>
                    <td>" . $row['arrival_airport_id'] . "</td>
                    <td>" . number_format($row['price'], 2) . " VND</td>
                    <td>" . $availableSeats . "</td>
                    <td><button class='btn btn-primary'>Đặt vé</button></td>
                  </tr>";
        }

        echo "</tbody>
            </table>
        </div>";
    }

    // Đóng câu lệnh và kết nối
    mysqli_stmt_close($stmt_oneway);
    if (isset($stmt_roundtrip)) {
        mysqli_stmt_close($stmt_roundtrip);
    }
    mysqli_close($conn);
}
?>
