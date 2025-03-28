<?php
include("../assets/mysql/database.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $product_desc = $_POST['product_desc'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    $stm = $con->prepare("INSERT INTO products (product_name, product_desc, product_category, product_price) VALUES (?, ?, ?, ?)");
    $stm->bind_param("sssi",$product_name, $product_desc, $product_category, $product_price);

    if ($stm->execute()) {
        echo "New product added successfully!";
    } else {
    }
}
?>
<script>
        location.replace('index.php');
</script>