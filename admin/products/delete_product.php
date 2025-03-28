<?php
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

// Get product ID
$id = $_GET['id'];
$sql = "DELETE FROM products WHERE product_id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Product deleted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
<script>
        location.replace('index.php');
</script>