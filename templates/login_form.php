<!-- templates/login_form.php -->
<div class="login-container">
    <h2>Login Form</h2>
    <form action="authenticate.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        
        <button type="submit">Login</button>
    </form>
</div>
