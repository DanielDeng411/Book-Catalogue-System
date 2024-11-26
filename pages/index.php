<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Catalogue System</title>
</head>
<?php
    include("header.php");
?>
<body>
    <h2>Welcome to The Book Catalogue System!</h2>
    <?php
    if (isset($_POST['signup'])){
        header('Location: signup.php');
        exit();
    }
    ?>
    <?php
    if (isset($_POST['login'])){
        header('Location: login.php');
        exit();
    }
    ?>
    <form method="post">
        <button type="submit" name="signup">Sign Up</button>
        <button type="submit" name="login">Log in</button>
    </form>
    <?php
    include('footer.php');
?>
</body>
</html>