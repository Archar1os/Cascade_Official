<?php
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_GET['id'])) {
    header("Location: customer_list.php");
    exit();
}

$customer_id = $_GET['id'];
$sql = "DELETE FROM customer WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);

if ($stmt->execute()) {
    header("Location: customer.php");
    exit();
} else {
    echo "Error deleting customer: " . $conn->error;
}
?>
