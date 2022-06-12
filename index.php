<?php
$db = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");

function showPublisher($db)
{
    $statement = $db->query("SELECT DISTINCT publisher FROM literatures");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}

function showAuthor($db)
{
    $statement = $db->query("SELECT DISTINCT name FROM authors");
    while ($data = $statement->fetch()) {
        echo "<option value='$data[0]'>$data[0]</option>";
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AJAX</title>
    <script src="script.js"></script>
</head>
<body>
<div id="content"></div>
<form action="" method="post" id="publisher">
    <select name="publisher">
        <?php
        showPublisher($db);
        ?>
    </select>
    <input type="submit" value="Search"><br>
</form>
<br>
<form action="" method="post" id="time">
    <input name="start" type="date">
    <input name="stop" type="date">
    <input type="submit" value="Search"><br>
</form>
<br>
<form action="" method="post" id="author">
    <select name="author">
        <?php
        showAuthor($db);
        ?>
    </select>
    <input type="submit" value="Search"><br>
</form>
</body>
</html>
