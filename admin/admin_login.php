
<?php
session_start();

require_once("../config/database.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Temporary admin credentials for local testing
    $admin_email = "admin@example.com";
    $admin_password = "Admin@123";

    if ($email === $admin_email && $password === $admin_password) {
        session_regenerate_id(true);
        $_SESSION["admin_logged_in"] = true;
        $_SESSION["admin_email"] = $admin_email;

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid admin email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Student Management System</title>
    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #eef2ff;
        }

        .login-box {
            background: white;
            width: 90%;
            max-width: 420px;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.12);
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
            font-size: 27px;
        }

        label {
            display: block;
            margin: 18px 0 7px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            width: 100%;
            margin-top: 24px;
            padding: 13px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .error {
            color: #b91c1c;
            background: #fee2e2;
            padding: 10px;
            border-radius: 5px;
        }

        .back {
            display: block;
            margin-top: 20px;
            text-align: center;
            color: #1e3a8a;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Admin Login</h1>
        <p style="text-align:center;">Student Management System</p>

        <?php if ($error !== ""): ?>
            <p class="error">
                <?php echo htmlspecialchars($error); ?>
            </p>
        <?php endif; ?>

        <form method="POST">
            <label for="email">Admin Email</label>
            <input
                type="email"
                id="email"
                name="email"
                required
            >

            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >

            <button type="submit">Login as Admin</button>
        </form>

        <a class="back" href="../index.php">Back to Home</a>
    </div>
</body>
</html>
