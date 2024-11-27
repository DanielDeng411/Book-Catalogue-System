<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="loginstylesheet" href="../styles/login.css">
    <title>Login Page</title>
    
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <form method="post" name="loginpage" action="dashboard.php">
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
           </div>
        </form>
    </main>
<?php
include('footer.php');
?>
</body>
</html>