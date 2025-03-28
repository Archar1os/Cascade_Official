<?php
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    $sql = "UPDATE products SET
            product_name='$product_name',
            product_desc='$product_desc',
            product_category='$product_category',
            product_price='$product_price'
            WHERE product_id=$product_id";

    if ($conn->query($sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
<script>
        location.replace('index.php');
</script>