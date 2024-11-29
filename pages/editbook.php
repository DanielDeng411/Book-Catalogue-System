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

$rating_sql = "SELECT rating FROM ratings WHERE book_id = ? AND user_id = ?";
$rating_stmt = $conn->prepare($rating_sql);
$rating_stmt->bind_param("ii", $book_id, $user_id);
$rating_stmt->execute();
$rating_result = $rating_stmt->get_result();
$rating = $rating_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['delete'])) {
        // Delete ratings first
        $delete_ratings_sql = "DELETE FROM ratings WHERE book_id = ?";
        $delete_ratings_stmt = $conn->prepare($delete_ratings_sql);
        $delete_ratings_stmt->bind_param("i", $book_id);
        $delete_ratings_stmt->execute();
        
        // Delete user_books associations
        $delete_user_books_sql = "DELETE FROM user_books WHERE book_id = ?";
        $delete_user_books_stmt = $conn->prepare($delete_user_books_sql);
        $delete_user_books_stmt->bind_param("i", $book_id);
        $delete_user_books_stmt->execute();
        
        // Delete book
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
        $update_sql = "UPDATE books SET title=?, author=?, genre=?, description=? WHERE id=?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $title, $author, $genre, $description, $book_id);
        $update_stmt->execute();

        if(isset($_POST['rating']) && $_POST['rating'] != '') {
            $rating = $_POST['rating'];
            // Delete old rating
            $delete_rating_sql = "DELETE FROM ratings WHERE book_id = ? AND user_id = ?";
            $delete_rating_stmt = $conn->prepare($delete_rating_sql);
            $delete_rating_stmt->bind_param("ii", $book_id, $user_id);
            $delete_rating_stmt->execute();
            
            // Insert new rating
            $rating_sql = "INSERT INTO ratings (user_id, book_id, rating) VALUES (?, ?, ?)";
            $rating_stmt = $conn->prepare($rating_sql);
            $rating_stmt->bind_param("iii", $user_id, $book_id, $rating);
            $rating_stmt->execute();
        }
        
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
   <title>Edit Book Details</title>
   <link rel="stylesheet" href="../styles/editbook.css">
</head>
<body>
   <?php include('header.php'); ?>
   <main>
       <div class="container">
           <h2>Edit Book Details</h2>
           <form method="POST">
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

               <div class="form-group">
                   <label for="rating">Rating (1-5)</label>
                   <input type="text" id="rating" name="rating" min="1" max="5" value=" <?= htmlspecialchars($rating['rating'] ?? '') ?>">
               </div>

               <div class="button-group">
                   <button type="submit" name="save" class="save-btn">Save Changes</button>
                   <button type="submit" name="delete" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?')">Delete Book</button>
                   <a href="dashboard.php" class="cancel-btn">Cancel</a>
               </div>
           </form>
       </div>
   </main>
   <?php include('footer.php'); ?>
</body>
</html>
