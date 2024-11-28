<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/login.css">
    <title>Login Page</title>
    
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <form method="post" name="loginpage">
            <div class="textfield">
                <label>Email:</label>
                <input type="text" name="email" class="forminput"/>
            </div>
            <div class="textfield">
                <label>Password:</label>
                <input type="text" name="password" class="forminput"/>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="terms" id="terms">
                <label for="terms">I agree to the Terms $ Conditions</label>
            </div>
           <div>
                <button type="submit" name="loginbutton">Log In</button>
                <button type="reset" name="loginreset">Reset</button>
                <button type="submit" name="signupbutton">Sign Up</button>
           </div>
        </form>
    </main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['signupbutton'])) {
            header('Location: register.php');
            exit();
        } elseif (isset($_POST['loginbutton'])) {
            header('Location: dashboard.php');
            exit();
        }
    }
    ?>
<?php
include('footer.php');
?>
</body>
</html>