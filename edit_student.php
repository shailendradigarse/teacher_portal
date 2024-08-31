<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'controllers/StudentController.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values
    $id = $_POST['id'];
    $name = $_POST['name'];
    $subject_name = $_POST['subject_name'];
    $marks = $_POST['marks'];

    // Validate the inputs
    if (empty($id) || empty($name) || empty($subject_name) || empty($marks)) {
        // Redirect back with an error message if validation fails
        header("Location: dashboard.php?error=missing_fields");
        exit;
    }

    // Use the StudentController to handle editing the student
    $result = StudentController::editStudent($id, $name, $subject_name, $marks);
    // Check the result of the update operation and redirect accordingly
    if ($result === "duplicate_error") {
        header("Location: dashboard.php?error=update_failed_duplicate");
    }elseif ($result) {
        
        header("Location: dashboard.php?success=student_updated");
    } else {
        header("Location: dashboard.php?error=update_failed");
    }
    exit;
} else {
    // If the request method is not POST, redirect to the dashboard
    header("Location: dashboard.php");
    exit;
}
?>
