<!-- dashboard.php -->
<?php
session_start();
if (!isset($_SESSION['teacher_id'])) {
    header("Location: index.php");
    exit;
}

require_once 'controllers/StudentController.php';
$students = StudentController::getAllStudents();

include 'templates/header.php';
?>

<div class="container">
    <?php include 'templates/student_list.php'; ?>
</div>

<script src="assets/js/app.js"></script>
<?php include 'templates/footer.php'; ?>
<!-- Show notification based on query parameters -->
<?php if (isset($_GET['success']) || isset($_GET['error'])): ?>
    <script>
        let message = '';
        let isError = false;
        if ('<?php echo isset($_GET['success']); ?>') {
            switch ('<?php echo $_GET['success']; ?>') {
                case 'student_added':
                    message = 'Student added successfully!';
                    break;
                case 'student_updated':
                    message = 'Student updated successfully!';
                    break;
                case 'student_deleted':
                    message = 'Student deleted successfully!';
                    break;
            }
        } else if ('<?php echo isset($_GET['error']); ?>') {
            message = 'An error occurred. Please try again.';
            isError = true;
        }
        showNotification(message, isError);

        // Remove query parameters from the URL to prevent notification from showing on refresh
        window.history.replaceState(null, null, window.location.pathname);
    </script>
<?php endif; ?>