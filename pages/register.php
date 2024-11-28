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
    <title>register</title>
    <link rel="stylesheet" href="register.css">
    <script scr="register.js"> </script>
</head>
<?php
include('header.php');
?>
<body>
<div class="container">
    <h2>New User Register</h2>
    <form method="POST" action="register.php" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="userName">userName</label>
            <input type="text" id="userName" name="userName" required>
        </div>
        <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
        <div class="form-group">
                <label for="confirmPassword">Comfirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
                <span id="passwordError" class="error"></span>
            </div>
            <button type="submit">Register</button>
    </form>
</div>
<?php
include('footer.php');
?>
</body>
</html>
