<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input:focus, select:focus, button:focus {
            border-color: #4CAF50;
            outline: none;
            box-shadow: 0 0 4px rgba(76, 175, 80, 0.5);
        }

        button {
            background: #4CAF50;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #45a049;
        }

        .payment-method {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .payment-method label {
            font-weight: normal;
            cursor: pointer;
        }

        .payment-method input {
            margin-right: 10px;
        }

        .payment-details {
            display: none;
            margin-top: 10px;
        }

        .flex-container {
            display: flex;
            gap: 10px;
        }

        .flex-container select {
            flex: 1;
        }

        .info-text {
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
        }

        /* Add responsiveness */
        @media screen and (max-width: 500px) {
            form {
                padding: 15px;
            }

            button {
                font-size: 14px;
            }
        }
    </style>
    <script>
        function togglePaymentMethod() {
            const method = document.querySelector('input[name="payment_method"]:checked').value;
            document.getElementById('bank-transfer-details').style.display = (method === 'bank_transfer') ? 'block' : 'none';
            document.getElementById('card-payment-details').style.display = (method === 'card_payment') ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <form action="dattour_lxd.php" method="POST">
        <h2>Chọn phương thức thanh toán</h2>

        <!-- Select Payment Method -->
        <div class="payment-method">
            <label>
                <input type="radio" name="payment_method" value="bank_transfer" onclick="togglePaymentMethod()" required>
                Chuyển tiền qua bank
            </label>
            <label>
                <input type="radio" name="payment_method" value="card_payment" onclick="togglePaymentMethod()">
                Chuyển tiền qua thẻ
            </label>
        </div>

        <!-- Bank Transfer Details -->
        <div id="bank-transfer-details" class="payment-details">
            <h3>Chi tiết chuyển khoản ngân hàng</h3>
            <p class="info-text">Vui lòng chuyển số tiền đến tài khoản ngân hàng bên dưới và cung cấp ID giao dịch.</p>
            <p><strong>Tên ngân hàng:</strong> VCB Bank</p>
            <p><strong>Số tài khoản:</strong> 123456789</p>
            <p><strong>Chủ tài khoản:</strong> LE XUAN DUONG</p>
            <label for="transaction_id">Mã giao dịch:</label>
            <input type="text" id="transaction_id" name="transaction_id" placeholder="Enter transaction ID">
        </div>

        <!-- Card Payment Details -->
        <div id="card-payment-details" class="payment-details">
            <h3>Chi tiết chuyển khoản qua thẻ</h3>
            <label for="card_number">Số thẻ *</label>
            <input type="text" id="card_number" name="card_number" pattern="\d{16}" placeholder="16-digit card number" required>

            <label for="expiration_date">Ngày hết hạn</label>
            <div class="flex-container">
                <select id="expiration_month" name="expiration_month" required>
                    <option value="" disabled selected>Tháng</option>
                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
                <select id="expiration_year" name="expiration_year" required>
                    <option value="" disabled selected>Năm</option>
                    <?php for ($i = date("Y"); $i <= date("Y") + 20; $i++) { ?>
                        <option value="<?= $i ?>"><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>

            <label for="security_code">CVC</label>
            <input type="text" id="security_code" name="security_code" pattern="\d{3,4}" placeholder="3-4 digit code" required>

            <label for="card_holder">Chủ thẻ</label>
            <input type="text" id="card_holder" name="card_holder" placeholder="Name on card" required>
        </div>

        <button type="submit">Hoàn tất thanh toán</button>
    </form>
</body>
</html>
