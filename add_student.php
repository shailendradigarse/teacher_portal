<?php
require_once 'controllers/StudentController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $subject_name = $_POST['subject_name'];
    $marks = $_POST['marks'];

    // Validate the inputs
    if (empty($name) || empty($subject_name) || empty($marks)) {
        // Redirect back with an error message if validation fails
        header("Location: dashboard.php?error=missing_fields");
        exit;
    }

    // Attempt to add the student using the StudentController
    $success = StudentController::addStudent($name, $subject_name, $marks);
    
    // Check the result of the addition operation and redirect accordingly
    if ($success) {
        header("Location: dashboard.php?success=student_added");
    } else {
        header("Location: dashboard.php?error=add_failed");
    }
    exit;
} else {
    // If the request method is not POST, redirect to the dashboard
    header("Location: dashboard.php");
    exit;
}
?>