<?php
session_start();

require_once("config/database.php");

// Login check
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

// Get all students
$query = "SELECT id, name, email, course, phone, created_at
          FROM students
          ORDER BY id DESC";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching students: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Students - Student Management System</title>

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

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 15px;
            padding: 8px 14px;
            border-radius: 5px;
        }

        nav a:hover {
            background: rgba(255,255,255,0.15);
        }

        .container {
            width: 92%;
            max-width: 1200px;
            margin: 40px auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-section h1 {
            color: #1e3a8a;
        }

        .add-btn {
            background: #16a34a;
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border-radius: 6px;
        }

        .add-btn:hover {
            background: #15803d;
        }

        .table-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #1e3a8a;
            color: white;
            padding: 13px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:hover {
            background: #f8fafc;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #666;
        }

        .edit {
            background: #f59e0b;
            color: white;
            padding: 7px 10px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 5px;
        }

        .delete {
            background: #dc2626;
            color: white;
            padding: 7px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .edit:hover {
            background: #d97706;
        }

        .delete:hover {
            background: #b91c1c;
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

    <nav>

        <a href="dashboard.php">
            Dashboard
        </a>

        <a href="logout.php">
            Logout
        </a>

    </nav>

</header>

<div class="container">

    <div class="top-section">

        <h1>Student List</h1>

        <a href="add_student.php" class="add-btn">
            + Add Student
        </a>

    </div>

    <div class="table-container">

        <?php if (mysqli_num_rows($result) > 0): ?>

            <table>

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Course</th>

                        <th>Phone</th>

                        <th>Date</th>

                        <th>Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php while ($student = mysqli_fetch_assoc($result)): ?>

                        <tr>

                            <td>
                                <?php echo $student["id"]; ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars($student["name"]);
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars($student["email"]);
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars($student["course"]);
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars($student["phone"]);
                                ?>
                            </td>

                            <td>
                                <?php
                                echo htmlspecialchars($student["created_at"]);
                                ?>
                            </td>

                            <td>

                                <a
                                    href="edit_student.php?id=<?php echo $student["id"]; ?>"
                                    class="edit"
                                >
                                    Edit
                                </a>

                                <a
                                    href="delete_student.php?id=<?php echo $student["id"]; ?>"
                                    class="delete"
                                    onclick="return confirm('Are you sure you want to delete this student?');"
                                >
                                    Delete
                                </a>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        <?php else: ?>

            <div class="empty">

                <h3>No students found</h3>

                <p>
                    Click "Add Student" to add your first student.
                </p>

            </div>

        <?php endif; ?>

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
