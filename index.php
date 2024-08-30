
<?php
session_start();
if (isset($_SESSION['teacher_id'])) {
    header("Location: dashboard.php");
    exit;
}

include 'templates/header.php';
include 'templates/login_form.php';
include 'templates/footer.php';
?>
<script src="assets/js/app.js"></script>
<?php if (isset($_GET['error'])): ?>
    <script>
       if ('<?php echo isset($_GET['error']); ?>') {
            message = 'Invalid username or password.';
            isError = true;
        }
        showNotification(message, isError);

        // Remove query parameters from the URL to prevent notification from showing on refresh
        window.history.replaceState(null, null, window.location.pathname);
    </script>
<?php endif; ?>