<?php

session_start();

require_once("config/database.php");

// Check login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Check student ID
if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: students.php");
    exit();
}

$student_id = (int) $_GET["id"];

$error = "";
$success = "";

// Fetch student details
$stmt = mysqli_prepare(
    $conn,
    "SELECT id, name, email, course, phone FROM students WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $student_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result(
    $stmt,
    $id,
    $name,
    $email,
    $course,
    $phone
);

if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: students.php");
    exit();
}

mysqli_stmt_close($stmt);

// Update student
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $phone = trim($_POST["phone"] ?? "");

    if ($name === "" || $email === "" || $course === "" || $phone === "") {
        $error = "Please fill all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {

        // Update student record
        $update_stmt = mysqli_prepare(
            $conn,
            "UPDATE students 
             SET name = ?, email = ?, course = ?, phone = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $update_stmt,
            "ssssi",
            $name,
            $email,
            $course,
            $phone,
            $student_id
        );

        if (mysqli_stmt_execute($update_stmt)) {
            mysqli_stmt_close($update_stmt);

            header("Location: students.php?updated=1");
            exit();
        } else {
            $error = "Unable to update student. Please try again.";
            mysqli_stmt_close($update_stmt);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Student - Student Management System</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            min-height: 100vh;
        }

        .header {
            background: #1e3a8a;
            color: white;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h2 {
            font-size: 24px;
        }

        .header a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .header a:hover {
            text-decoration: underline;
        }

        .container {
            width: 90%;
            max-width: 650px;
            margin: 50px auto;
        }

        .card {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        .card h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #1e3a8a;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #1e3a8a;
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: #1e3a8a;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #162d6b;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #1e3a8a;
            text-decoration: none;
            font-weight: bold;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

    </style>
</head>

<body>

    <div class="header">

        <h2>Student Management System</h2>

        <div>
            <a href="dashboard.php">Dashboard</a>
            <a href="students.php">Students</a>
            <a href="logout.php">Logout</a>
        </div>

    </div>

    <div class="container">

        <div class="card">

            <h1>Edit Student</h1>

            <?php if ($error !== ""): ?>
                <div class="error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="form-group">
                    <label>Student Name</label>

                    <input
                        type="text"
                        name="name"
                        value="<?php echo htmlspecialchars($name); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Email Address</label>

                    <input
                        type="email"
                        name="email"
                        value="<?php echo htmlspecialchars($email); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Course</label>

                    <input
                        type="text"
                        name="course"
                        value="<?php echo htmlspecialchars($course); ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Phone Number</label>

                    <input
                        type="text"
                        name="phone"
                        value="<?php echo htmlspecialchars($phone); ?>"
                        required
                    >
                </div>

                <button type="submit" class="btn">
                    Update Student
                </button>

            </form>

            <a href="students.php" class="back">
                ← Back to Students
            </a>

        </div>

    </div>

</body>
</html>
