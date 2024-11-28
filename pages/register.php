<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    header("Location: dashboard.php");
    exit; 
}  
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../styles/register.css">
    <script src="../scripts/register.js"> </script>
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <div class="container">
            <h2>New User Register</h2>
            <form id="registerForm" method="POST" action="register.php" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="userName">User Name</label>
                    <input type="text" id="userName" name="userName" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                    <span id="passwordError" class="error"></span>
                </div>
                <button type="submit">Register</button>
                <button type="reset">Clear</button>
            </form>
        </div>
    </main>
<?php
include('footer.php');
?>
</body>
</html>
