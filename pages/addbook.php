<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Your Books</title>
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <fieldset>

            
            <form method="get" action="">
            <legend class="addbookheader">Book Information</legend>
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
                    <textarea name="description" class="bookinput" rows="5"></textarea>
                </div>
                <div>
                    <button type="submit" name="submitbookinfo" class="bookinfobutton">Add</button>
                    <button type="reset" name="resetbookinfo" class="bookinfobutton">Clear</button>
                </div>
            </form>
        </fieldset>
    </main>
    <?php
    include('footer.php');
    ?>
</body>
</html>