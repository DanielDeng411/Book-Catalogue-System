<?php
include('../server/db.php');
?>
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
        <form method="post" name="loginpage" onsubmit="return validateForm();">
            <div class="textfield">
                <label>Email:</label>
                <input type="text" name="email" class="forminput" required>
            </div>
            <div class="textfield">
                <label>Password:</label>
                <input type="text" name="password" class="forminput" required>
            </div>
            <div class="checkbox">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">I agree to the Terms & Conditions</label>
            </div>
            <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['signupbutton'])) {
            header('Location: register.php');
            exit();
        } elseif (isset($_POST['loginbutton'])) {
            if (!empty($_POST['email'] && !empty($_POST['password']))){
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
    
                // Query to check if the user exists
                $query = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $query);
    
                if ($result && mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
    
                    // Verify the password
                    if (password_verify($password, $user['password'])) {
                        // Start session and redirect to dashboard
                        session_start();
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['email'] = $user['email'];
                        header('Location: dashboard.php');
                        exit();
                    } else {
                        echo "<p style='margin-bottom:10px; font-weight:bold; color: red;'>Invalid password. Please try again.</p>";
                    }
                } else {   
            }
            echo "<p style='margin-bottom:10px; font-weight:bold; color: red;'>No user found with this email address.</p>";
            }
        }
    }
    ?>
           <div>
                <button type="submit" name="loginbutton">Log In</button>
                <button type="reset" name="loginreset">Reset</button>
                <button type="submit" name="signupbutton">Sign Up</button>
           </div>
        </form>
    </main>
    
<?php
include('footer.php');
?>
</body>
</html>