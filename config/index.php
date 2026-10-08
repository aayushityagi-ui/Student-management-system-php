<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            color: #333;
        }

        header {
            background: #1e3a8a;
            color: white;
            padding: 20px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            font-size: 24px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .hero {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px 20px;
        }

        .hero-content {
            max-width: 700px;
        }

        .hero h1 {
            font-size: 45px;
            color: #1e3a8a;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            margin: 5px;
        }

        .btn:hover {
            background: #162d6b;
        }

        footer {
            text-align: center;
            background: #1e3a8a;
            color: white;
            padding: 15px;
        }
    </style>
</head>

<body>

<header>
    <h2>Student Management System</h2>

    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    </nav>
</header>

<section class="hero">

    <div class="hero-content">

        <h1>Welcome to Student Management System</h1>

        <p>
            Manage student information easily and efficiently.
            This system provides student registration, login,
            dashboard and student management features.
        </p>

        <a href="register.php" class="btn">Register</a>

        <a href="login.php" class="btn">Login</a>

    </div>

</section>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Student Management System</p>
</footer>

</body>
</html>
