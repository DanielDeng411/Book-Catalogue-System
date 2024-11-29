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
    if(isset($_POST['delete'])) {
        $delete_sql = "DELETE FROM books WHERE id = ?";
        $delete_stmt = $conn->prepare($delete_sql);
        $delete_stmt->bind_param("i", $book_id);
        $delete_stmt->execute();
        header("Location: dashboard.php");
        exit();
    }
    
    if(isset($_POST['save'])) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $genre = $_POST['genre'];
        $description = $_POST['description'];
        $rating = $_POST['rating'];

        $update_sql = "UPDATE books SET title=?, author=?, genre=?, description=?, rating=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssii", $title, $author, $genre, $description, $rating, $book_id);
        $update_stmt->execute();
        header("Location: dashboard.php");
        exit();
    }
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
                    <label for="rating">Rating (1-5)</label>
                    <input type="number" id="rating" name="rating" min="1" max="5" value="<?= htmlspecialchars($book['rating'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4"><?= htmlspecialchars($book['description']) ?></textarea>
                </div>

                <div class="button-group">
                    <button type="submit" name="save" class="save-btn">Save Changes</button>
                    <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?')">Delete Book</button>
                    <a href="dashboard.php" class="cancel-btn">Cancel</a>
                </div>
                </div>
            </form>
        </div>
    </main>
    <?php include('footer.php'); ?>
</body>
</html>
