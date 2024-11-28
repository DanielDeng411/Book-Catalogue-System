<?php
include('../server/db.php');
if (isset($_GET['submitbookinfo'])) {
    $title = $_GET['title'];
    $author = $_GET['author'];
    $genre = $_GET['genre'];
    $year = $_GET['year'];
    $description = $_GET['description'];

    $sql = "INSERT INTO books (title, author, genre, year, description) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssis", $title, $author, $genre, $year, $description); // "sssis" indicates the types: string, string, string, integer, string

    if ($stmt->execute()) {
        echo "<script>alert('New book successfully added!');</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Your Books</title>
    <link rel="stylesheet" href="../styles/addbook.css">
    <script>
        function validateAddBookForm() {
            const title = document.forms["addBookForm"]["title"].value;
            const author = document.forms["addBookForm"]["author"].value;
            const genre = document.forms["addBookForm"]["genre"].value;
            const year = document.forms["addBookForm"]["year"].value;

            if (title === "" || author === "" || genre === "" || year === "") {
                alert("All fields except Description must be filled out before submitting.");
                return false;
            }
            return true;
        }
    </script>
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <div style="margin-bottom: 20px;">
            <a href="dashboard.php" class="back-button" style="text-decoration: none;">
                <button type="button" style="font-weight:bold; padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer;">
                    Back to Dashboard
                </button>
            </a>
        </div>
        <form name="addBookForm" method="GET" onsubmit="return validateAddBookForm();">
        <h2>Book Information</h2>
            <div class="textfield">
                <label class="bookinfo">Title:</label>
                <input type="text" name="title" class="booinput">
            </div>
            <div class="textfield">
                <label class="bookinfo">Author:</label>
                <input type="text" name="author" class="bookinput">
            </div>
            <div class="textfield">
                <label class="bookinfo">Genre:</label>
                <input type="text" name="genre" class="bookinput">
            </div>
            <div class="textfield">
                <label class="bookinfo">Year:</label>
                <input type="text" name="year" class="bookinput">
            </div>
            <div class="textfield">
                <label class="bookinfo">Description:</label>
                <textarea name="description" class="bookinput" rows="4"></textarea>
            </div>
            <div id="addbutton">
                <button type="submit" name="submitbookinfo" class="bookinfobutton">Add</button>
                <button type="reset" name="resetbookinfo" class="bookinfobutton">Clear</button>
            </div>
        </form>
    </main>
    <?php
    include('footer.php');
    ?>
</body>
</html>

