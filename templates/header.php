<!-- templates/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Teacher Portal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Teacher Portal</h1>

        <?php
            if (isset($_SESSION['teacher_id'])) {
        ?>
        <nav>
            <a href="dashboard.php">Home</a>
            <a href="logout.php">Logout</a>
        </nav>
        <?php } ?>
    </header>
    <!-- Notification Message Div -->
    <div id="notification" class="notification"></div>
