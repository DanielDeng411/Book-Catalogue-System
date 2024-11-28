<?php
session_start();
include('../server/db.php');

$user_id = $_SESSION['user_id'];

// Fetch genres for filtering
$genresql = "SELECT DISTINCT genre FROM books b INNER JOIN user_books ub ON b.id = ub.book_id WHERE ub.user_id = ?";
$stmt = $conn->prepare($genresql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$genreresult = $stmt->get_result();

$genres = []; // Initialize an empty array to store genres
while ($row = $genreresult->fetch_assoc()) {
    $genres[] = $row['genre']; // Add each genre to the array
}
$stmt->close();

// Fetch authors for filtering
$authorsql = "SELECT DISTINCT author FROM books b INNER JOIN user_books ub ON b.id = ub.book_id WHERE ub.user_id = ?";
$stmt = $conn->prepare($authorsql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$authorresult = $stmt->get_result();

$authors = []; // Initialize an empty array to store authors
while ($row = $authorresult->fetch_assoc()) {
    $authors[] = $row['author']; // Add each author to the array
}
$stmt->close();

// Function to generate options
function displayOptions($values) {
    $options = "";
    foreach ($values as $value) {
        $options .= "<option value=\"" . htmlspecialchars($value) . "\">" . htmlspecialchars($value) . "</option>";
    }
    return $options;
}

// Search and filter books
$search = isset($_GET['search']) ? '%' . $_GET['search'] . '%' : '%';
$filterGenre = isset($_GET['genre']) && $_GET['genre'] != "" ? $_GET['genre'] : '%';
$filterAuthor = isset($_GET['author']) && $_GET['author'] != "" ? $_GET['author'] : '%';

// Fetch all books linked to the user by default if no filter is applied
$sql = "SELECT b.* FROM books b INNER JOIN user_books ub ON b.id = ub.book_id WHERE ub.user_id = ? AND b.title LIKE ? AND b.genre LIKE ? AND b.author LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isss", $user_id, $search, $filterGenre, $filterAuthor);
$stmt->execute();
$result = $stmt->get_result();
$books = [];
while ($row = $result->fetch_assoc()) {
    $books[] = $row;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <form method="get" class="form-control">
            <div class="searchform">
                <input type="text" name="search" class="searchfilter" placeholder="Search by Title" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
            </div>

            <div class="filterform">
                <select name="genre" class="form-control">
                    <option value="">All Genres</option>
                    <?= displayOptions($genres); ?>
                </select>
            </div>

            <div class="filterform">
                <select name="author" class="form-control">
                    <option value="">All Authors</option>
                    <?= displayOptions($authors); ?>
                </select>
            </div>
            <div>
                <button type="submit" class="form-control">Search</button>
            </div>
        </form>
        <div id="booklist">
            <div>
                <form id="addbook" method="post" action="addbook.php">
                    <button type="submit" class="form-control" id="addbutton">Add Book</button>
                </form>
            </div>
            <div>
                <table>
                    <tr>
                        <th colspan="4">Book List</th>
                    </tr>
                    <tr>
                        <th id="title">Title</th>
                        <th id="author">Author</th>
                        <th id="genre">Genre</th>
                        <th id="edit">Edit</th>
                    </tr>
                    <?php if (count($books) > 0): ?>
                        <?php foreach ($books as $book): ?>
                        <tr>
                            <td><?= htmlspecialchars($book['title']) ?></td>
                            <td><?= htmlspecialchars($book['author']) ?></td>
                            <td><?= htmlspecialchars($book['genre']) ?></td>
                            <td><a href="editbook.php?bookid=<?= htmlspecialchars($book['id']) ?>">Edit</a></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="4">No books found. Please add a book or adjust your filters.</td>
                    </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>  
    </main>
<?php
include('footer.php');
?>
</body>
</html>
