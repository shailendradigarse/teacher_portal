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
<script>
    // Convert PHP variables to JavaScript
    var successParam = '<?php echo isset($_GET['success']) ? $_GET['success'] : ''; ?>';
    var errorParam = '<?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?>';
    var message = '';
    var isError = false;

    // Function to handle success or error messages
    function handleNotification() {
        // Check if successParam is set and not empty
        if (successParam) {
            // Handle success parameter using switch
            switch (successParam) {
                case 'student_added':
                    message = 'Student added successfully!';
                    break;
                case 'student_updated':
                    message = 'Student updated successfully!';
                    break;
                case 'student_deleted':
                    message = 'Student deleted successfully!';
                    break;
                default:
                    message = 'Unknown success state.';
                    break;
            }
        } else if (errorParam) {

            switch (errorParam) {
                case 'update_failed':
                    message = 'An error occurred while updateing!';
                    break;
                case 'update_failed_duplicate':
                    message = 'An error occurred while updateing! Student already exist';
                    break;
                default:
                    message = 'An error occurred. Please try again.';
                    break;
            }

            isError = true;
        }
        
        // Show the notification if there is a message
        if (message) {
            showNotification(message, isError);
            
        }
        window.history.replaceState(null, null, window.location.pathname);
    }


    // Call the function when the script loads
    handleNotification();
</script>
