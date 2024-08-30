<!-- includes/functions.php -->
<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
