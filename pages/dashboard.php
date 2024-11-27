<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<?php
include('header.php');
?>
<body>
    <main>
        <form method="GET" class="form-control">
            <div class="searchform">
                <input type="text" name="search" class="searchfilter" placeholder="Search by Title">
            </div>

            <div class="filterform">
                <select name="filter" class="form-control">
                    <option value="">All Genres</option>
                    <!-- php to print all the genres-->
                </select>
            </div>

            <div class="filterform">
                <select name="filter" class="form-control">
                    <option value="">Writer</option>
                    <!-- php to print all the writer-->
                </select>
            </div>  
            <button type="submit" class="form-control">Search</button>
        </form>

        <table>
            <tr>
                <th colspan="5">Book List</th>
            </tr>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Genre</th>
                <th>Edit</th>
                <th>Remove</th>
            </tr>
            <tr>
                <!-- php to print all the Books-->
            </tr>
        </table>
        <form method="post" action="addbook.php">
            <button type="submit" class="form-control">Add Book</button>
        </form>
    </main>
    
<?php
include('footer.php');
?>
</body>
</html>