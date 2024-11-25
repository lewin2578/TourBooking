<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $payment_method = $_POST['payment_method'];

    
    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tourbooking";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    if ($payment_method === 'bank_transfer') {
        $transaction_id = $_POST['transaction_id'];

        $sql = "INSERT INTO payments (payment_method, transaction_id) VALUES ('Bank Transfer', '$transaction_id')";

    } elseif ($payment_method === 'card_payment') {
        $card_number = $_POST['card_number'];
        $expiration_month = $_POST['expiration_month'];
        $expiration_year = $_POST['expiration_year'];
        $security_code = $_POST['security_code'];
        $card_holder = $_POST['card_holder'];

        $sql = "INSERT INTO payments (payment_method, card_number, expiration_month, expiration_year, security_code, card_holder) 
                VALUES ('Card Payment', '$card_number', '$expiration_month', '$expiration_year', '$security_code', '$card_holder')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Thanh toán thành công!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>