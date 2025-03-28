<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@363&family=Holtwood+One+SC&family=IM+Fell+DW+Pica:ital@0;1&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="icon" href="ULOGO.png" type="image/x-icon" />
    <title>Cascade Café - Sign Up</title>

    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Changa:wght@200..800&family=Oswald:wght@200..700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet" />
    <style>
        body {
            background-color: white;
        }
        .banner {
            width:unset;
            height: unset;
            position: unset;
            overflow: unset;
        }
        .signup-container {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 50px;
            width: 25%;
            min-height: 100%;
            text-align: center;
            margin: auto;
            display: block;
            position: relative;
        }
        .signup-container h1 {
            color: #333;
            margin-bottom: 20px;
            font-family: 'Oswald', sans-serif;
        }
        input[type="text"], input[type="password"] {
            width: 75%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #333;
            color:rgb(255, 156, 25);
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 80%;
            font-family: 'Changa', sans-serif;
        }
        button:hover {
            background-color: #ca8f42;
            color:white;
        }
        .signup-container{
            height: 50%;
            top: -25px;
        }
        .signup-container p {
            padding: 10px;
        }
        .space {
            padding: 325px 50px;
        }
        body {
        background-image: url('assets/img/Register_Login.gif');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        backdrop-filter: blur(3px);
        }

    </style>
</head>
<body>
    <!-- HEADER -->
    <?php include("assets/include/header.php");?>
    <div class="space">
        <div class="signup-container">
            <h1>Sign Up</h1>
            <form method="POST" action="signup.php" autocomplete="off">
                <input type="text" name="username" placeholder="Username" autocomplete="off"required>
                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <button type="submit">Register</button>
                <p><a href="login.php">Already have Registered? Click Here!</a></p>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $servername = "localhost";
                $db_username = "root";
                $db_password = "";
                $dbname = "coffeeshopdb";

                $conn = new mysqli("localhost", "root", "", "coffeeshopdb");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $username = $_POST['username'];
                $password = $_POST['password'];

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $username, $hashed_password);

                if ($stmt->execute()) {
                    echo "<p>User created successfully! You can now <a href='login.php'>login</a>.</p>";
                    echo "<script>
                    setTimeout(location.replace('login.php'), 3000);
                </script>";
                } else {
                    echo "<p>Error: " . $stmt->error . "</p>";
                }

                $stmt->close();
                $conn->close();
            }
            ?>
        </div>
    </div>
		<!-- FOOTER-->
		<?php include("assets/include/footer.php");?>
</body>
</html>
