<?php
require_once 'controllers/StudentController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate the input
    if (empty($id)) {
        // Redirect back with an error message if validation fails
        header("Location: dashboard.php?error=missing_id");
        exit;
    }
    // Attempt to delete the student using the StudentController
    $success = StudentController::deleteStudent($id);

    // Check the result of the deletion operation and redirect accordingly
    if ($success) {
        header("Location: dashboard.php?success=student_deleted");
    } else {
        header("Location: dashboard.php?error=delete_failed");
    }
    exit;
} else {
    // If no ID is provided, redirect to the dashboard with an error message
    header("Location: dashboard.php?error=missing_id");
    exit;
}
?>