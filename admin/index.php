<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cascade Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222;
            color: rgb(255, 156, 25);
            text-align: center;
        }
        a {
            text-decoration: none;
        }
        h1 {
            padding: 50px;
            color: rgb(255, 156, 25);
        }
        .container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        .card {
            width: 250px;
            padding: 50px;
            min-width: 500px;
            background-color: #333;
            color: rgb(255, 156, 25);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease, background-color 0.3s ease;
            font-size: large;
        }
        .card:hover {
            background-color: rgb(255, 156, 25);
            color: #333;
            transform: scale(1.1);
        }
        .card a {
            text-decoration: none;
            color: inherit;
            font-weight: bold;
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
    </style>
</head>
<body>

<h1>Welcome to Cascade Admin Panel</h1>
<div class="container">
<p class="go_back"><a href="../index.php">Go Back</a></p>
    <a href="products/products.php">
        <div class="card">
            <h2>Product List</h2>
            <p>View and manage all products.</p>
            Go to Product List
        </div>
    </a>
    <a href="orders/orders.php">
        <div class="card">
            <h2>Order List</h2>
            <p>View, update, and delete orders.</p>
            Go to Order List
        </div>
    </a>
    <a href="customer/customer.php">
        <div class="card">
            <h2>Customer List</h2>
            <p>View, update, and delete customer details.</p>
            Go to Customer List
        </div>
    </a>
</div>

</body>
</html>
