<!-- includes/auth_helper.php -->
<?php
require_once 'config/db.php';
require_once 'controllers/TeacherController.php';

function authenticate($username, $password) {
    return TeacherController::authenticate($username, $password);
}
?>
