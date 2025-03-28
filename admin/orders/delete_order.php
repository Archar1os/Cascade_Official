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
$sql = "DELETE FROM orders WHERE orders_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);

if ($stmt->execute()) {
    header("Location: orders.php");
    exit();
} else {
    echo "Error deleting order: " . $conn->error;
}
?>
