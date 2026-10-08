<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Dashboard</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
        }

        header {
            background: #1e3a8a;
            color: white;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            font-size: 22px;
        }

        .logout {
            background: #dc2626;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
        }

        .logout:hover {
            background: #b91c1c;
        }

        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .welcome h1 {
            color: #1e3a8a;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #555;
            font-size: 16px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
        }

        .card h3 {
            color: #1e3a8a;
            margin-bottom: 12px;
        }

        .card p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #1e3a8a;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background: #162d6b;
        }

        footer {
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            background: #1e3a8a;
            color: white;
        }

    </style>

</head>

<body>

<header>

    <h2>Student Management System</h2>

    <a href="logout.php" class="logout">
        Logout
    </a>

</header>

<div class="container">

    <div class="welcome">

        <h1>
            Welcome, <?php echo htmlspecialchars($user_name); ?>!
        </h1>

        <p>
            You are successfully logged in.
        </p>

        <p>
            Email:
            <?php echo htmlspecialchars($user_email); ?>
        </p>

    </div>

    <div class="cards">

        <div class="card">

            <h3>My Profile</h3>

            <p>
                View your account information.
            </p>

            <a href="#" class="btn">
                View Profile
            </a>

        </div>

        <div class="card">

            <h3>Students</h3>

            <p>
                Manage student information.
            </p>

            <a href="students.php" class="btn">
                View Students
            </a>

        </div>

        <div class="card">

            <h3>Add Student</h3>

            <p>
                Add a new student record.
            </p>

            <a href="add_student.php" class="btn">
                Add Student
            </a>

        </div>

    </div>

</div>

<footer>

    <p>
        &copy; <?php echo date("Y"); ?>
        Student Management System
    </p>

</footer>

</body>

</html>
