<?php
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: orders.php");
    exit();
}

$order_id = $_GET['id'];
$sql = "SELECT * FROM orders WHERE orders_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Order not found.");
}

$order = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total_amount = $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];
    $update_sql = "UPDATE orders SET total_amount = ?, payment_method = ? WHERE orders_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("dsi", $total_amount, $payment_method, $order_id);
    if ($update_stmt->execute()) {
        header("Location: orders.php");
        exit();
    } else {
        echo "Error updating order: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #222;
            color: rgb(255, 156, 25);
        }
        h1 {
            text-align: center;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
        form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
        }
        form input {
            width: 95.5%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid rgb(255, 156, 25);
            border-radius: 5px;
            background-color: #444;
            color: white;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: rgb(255, 156, 25);
            border: none;
            border-radius: 5px;
            font-weight: bold;
            color: #222;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: white;
            color: rgb(255, 156, 25);
        }
        form a {
            color: rgb(255, 156, 25);
            text-decoration: none;
        }
        form a:hover {
            text-decoration: underline;
        }
        .space {
            display: inline-block;
            margin-top:10px ;
            padding: 15px;
        }
    </style>
</head>
<body>
    <h1>Edit Order</h1>
    <form method="POST">
        <label for="total_amount">Total Amount:</label>
        <input type="number" id="total_amount" name="total_amount" value="<?php echo htmlspecialchars($order['total_amount']); ?>" required>
        <label for="payment_method">Payment Method:</label>
        <input type="text" id="payment_method" name="payment_method" value="<?php echo htmlspecialchars($order['payment_method']); ?>" required>
        <button type="submit">Update</button>
        <a href="orders.php" class="space">Cancel</a>
    </form>
</body>
</html>
