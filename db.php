<?php

function bookByPublisher($db, $publisher)
{
    $statement = $db->prepare("SELECT name, ISBN, publisher, date, quantity FROM literatures WHERE publisher=?");
    $statement->execute([$publisher]);

    $output = "<table style='text-align: center'>";
    $output .= "<tr><th>Name</th><th>ISBN</th><th>Publisher</th><th>Year</th><th>Number Of Pages</th></tr>";
    while ($data = $statement->fetch()) {
        $output .= "
                <tr>
                    <td>{$data['name']}</td>
                    <td>{$data['ISBN']}</td>
                    <td>{$data['publisher']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['quantity']}</td>
                </tr>
            ";
    }
    echo $output;
}

function bookByTime($db, $start, $stop)
{
    $statement = $db->prepare("SELECT name, date, literate FROM literatures WHERE date BETWEEN ? AND ?");
    $statement->execute([$start, $stop]);

    $output = "<table style='text-align: center'>";
    $output .= "<tr><th>Name</th><th>Date</th><th>Literate</th>";
    while ($data = $statement->fetch()) {
        $output .= "
                <tr>
                    <td>{$data['name']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['literate']}</td>
                </tr>
            ";
    }
    echo json_encode($output);
}

function bookByAuthor($db, $author)
{
    $statement = $db->prepare("
            SELECT literatures.name, ISBN, publisher, date, quantity, authors.name FROM literatures
            INNER JOIN book_authors ON literatures.ID_Book = book_authors.FID_Book
            INNER JOIN authors ON book_authors.FID_Authors = authors.ID_Authors 
            WHERE literatures.literate = 'Book' AND authors.name = ?
        ");
    $statement->execute([$author]);

    $output = "<table style='text-align: center'>";
    $output .= "<tr><th>Name</th><th>ISBN</th><th>Publisher</th><th>Year</th><th>Number Of Pages</th><th>Author Name</th></tr>";
    while ($data = $statement->fetch()) {
        $output .= "
                <tr>
                    <td>{$data[0]}</td>
                    <td>{$data['ISBN']}</td>
                    <td>{$data['publisher']}</td>
                    <td>{$data['date']}</td>
                    <td>{$data['quantity']}</td>
                    <td>{$data['name']}</td>
                </tr>
            ";
    }
    echo $output;
}

$db = new PDO("mysql:host=127.0.0.1;dbname=library", "root", "");

if (isset($_POST["publisher"])) {
    bookByPublisher($db, $_POST["publisher"]);
} elseif (isset($_POST["start"])) {
    bookByTime($db, $_POST["start"], $_POST["stop"]);
} elseif (isset($_POST["author"])) {
    bookByAuthor($db, $_POST["author"]);
}