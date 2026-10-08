<?php
session_start();
require_once("config/database.php");

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {

        $message = "Please enter email and password.";
        $message_type = "error";

    } else {

        $stmt = mysqli_prepare(
            $conn,
            "SELECT id, name, email, password FROM users WHERE email = ?"
        );

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {

            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user["password"])) {

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["user_name"] = $user["name"];
                $_SESSION["user_email"] = $user["email"];

                header("Location: dashboard.php");
                exit();

            } else {

                $message = "Invalid email or password.";
                $message_type = "error";
            }

        } else {

            $message = "Invalid email or password.";
            $message_type = "error";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Login</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 400px;
            background: white;
            padding: 35px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            color: #1e3a8a;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #1e3a8a;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background: #162d6b;
        }

        .message {
            padding: 10px;
            margin-bottom: 18px;
            border-radius: 5px;
            text-align: center;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .register-link {
            text-align: center;
            margin-top: 20px;
        }

        .register-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-weight: bold;
        }

        .home-link {
            text-align: center;
            margin-top: 12px;
        }

        .home-link a {
            color: #555;
            text-decoration: none;
        }

    </style>

</head>

<body>

<div class="container">

    <h2>Student Login</h2>

    <?php if (!empty($message)): ?>

        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>

    <?php endif; ?>

    <form method="POST" action="">

        <div class="form-group">

            <label for="email">
                Email
            </label>

            <input
                type="email"
                id="email"
                name="email"
                placeholder="Enter your email"
                required
            >

        </div>

        <div class="form-group">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter your password"
                required
            >

        </div>

        <button type="submit">
            Login
        </button>

    </form>

    <div class="register-link">

        Don't have an account?

        <a href="register.php">
            Register
        </a>

    </div>

    <div class="home-link">

        <a href="index.php">
            ← Back to Home
        </a>

    </div>

</div>

</body>

</html>
