<?php
session_start();
require_once('../server/db.php');

if (!isset($_SESSION['user_id']) || !isset($_GET['bookid'])) {
    header('Location: login.php');
    exit();
}

$book_id = $_GET['bookid'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];

    $update_sql = "UPDATE books SET title=?, author=?, genre=?, description=? WHERE id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $title, $author, $genre, $description, $book_id);
    $update_stmt->execute();
    
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../styles/editbook.css">
</head>
<body>
    <?php include('header.php'); ?>
    <main>
        <div class="container">
            <h2>Edit Book Details</h2>
            <form method="POST" class="edit-form">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($book['genre']) ?>" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"><?= htmlspecialchars($book['description']) ?></textarea>
                </div>

                <div class="button-group">
                    <button type="submit">Save Changes</button>
                    <a href="dashboard.php" class="cancel-btn">Cancel</a>
                </div>
            </form>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>
