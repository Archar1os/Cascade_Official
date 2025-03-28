<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "coffeeshopdb");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch orders
$sql = "
SELECT 
    orders.orders_id, 
    orders.order_number, 
    orders.order_date, 
    orders.total_amount, 
    customer.customer_name 
FROM orders
INNER JOIN customer ON orders.customer_id = customer.customer_id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: rgb(255, 156, 25);
            text-align: center;
        }
        h1 {
            padding: 30px;
            color: rgb(255, 156, 25);
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #333;
        }
        table th, table td {
            border: 1px solid rgb(255, 156, 25);
            padding: 10px;
            text-align: center;
        }
        table th {
            background-color: rgb(255, 156, 25);
            color: #333;
        }
        .action-buttons a {
            text-decoration: none;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
        }
        .edit-btn {
            background-color: rgb(255, 156, 25);
        }
        .delete-btn {
            background-color: rgb(255, 156, 25);
        }
        .delete-btn:hover, .edit-btn:hover {
            background-color: #333;
            color: rgb(255, 156, 25);
        }
        .go_back {
            position: absolute;
            top: 20px;
            background-color: rgb(255, 156, 25);
            padding: 20px;
            border-radius: 5px;
            left: 20px;
        }
        .go_back a {
            color: #333;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Order List</h1>
    <p class="go_back"><a href="../index.php">Go Back</a></p>
    <table>
        <tr>
            <th>ID</th>
            <th>Order Number</th>
            <th>Order Date</th>
            <th>Total Amount</th>
            <th>Customer Name</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['orders_id']; ?></td>
                <td><?php echo $row['order_number']; ?></td>
                <td><?php echo $row['order_date']; ?></td>
                <td>₱<?php echo number_format($row['total_amount'], 2); ?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td class="action-buttons">
                    <a href="edit_order.php?id=<?php echo $row['orders_id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_order.php?id=<?php echo $row['orders_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this order?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
