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

// Delete student
$stmt = mysqli_prepare(
    $conn,
    "DELETE FROM students WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $student_id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);

    header("Location: students.php?deleted=1");
    exit();
} else {
    mysqli_stmt_close($stmt);

    echo "Unable to delete student.";
    echo "<br><br>";
    echo '<a href="students.php">Back to Students</a>';
}

?>
