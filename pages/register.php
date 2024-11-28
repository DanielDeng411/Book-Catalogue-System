<?php
include('../server/db.php');
function isEmailRegistered($email) {
    global $conn;
    
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userName = $_POST['userName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isEmailRegistered($email)) {
        $error_message = "This email is already registered. Please use a different email.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $userName, $hashedPassword, $email);

        if ($stmt->execute()) {
            echo "<script>alert('You are registered! Please log in now');</script>";
            header("Location: login.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    $stmt->close();
    }
}
$conn->close();
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
                <?php
                if (!empty($error_message)) {
                    echo "<p style='color: red; font-weight:bold'>$error_message</p>";
                }
                ?>
                <button type="submit">Register</button>
                <button type="reset">Clear</button>
                <a href="login.php" class="back-button" style="text-decoration: none;">
                    <button type="button">
                    Log in
                    </button>
                </a>
            </form>
        </div>
    </main>
<?php
include('footer.php');
?>
</body>
</html>
