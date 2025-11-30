<?php
$books = [];

// I put one initial book
$initialbook = [
    "title" => "Round Six",
    "author" => "Gi-hun Seong",
    "genre" => "Science Fiction",
    "price" => 8
];
array_push($books, $initialbook);

// Function for applying 10 percent of discount in science fiction books
function applyDiscount(&$allbooks)
{
    foreach ($allbooks as &$book) {
        if ($book["genre"] === "Science Fiction") {
            $book["price"] = $book["price"] * 0.9;
        }
    }
}
// Call it for the first time

// If server call post method, then:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Storing form data into variables, used trim for avoiding
    // spaces on the edges. The HTML form is already required, so
    // no problems with empty inputs.
    $title = trim(htmlspecialchars($_POST['title']));
    $author = trim(htmlspecialchars($_POST['author']));
    $genre = trim(htmlspecialchars($_POST['genre']));
    $price = trim(htmlspecialchars($_POST['price']));

    // Putting every data into the books array, so then we can iterate over
    // after to show it
    array_push($books, ["title" => $title, "author" => $author, "genre" => $genre, "price" => $price]);
    // Apply discount function call
    applyDiscount($books);
    print_r($books);

    // Logic for checking if array has something
    function showBooks($books){
        if (!empty($books)) {
            foreach ($books as $book) {
                echo     "<tr>
      <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['title']}</td>
      <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['author']}</td>
      <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['genre']}</td>
      <td style='padding:8px; border-bottom:1px solid #eee; text-align:right;'>\${$book['price']}</td>
    </tr>";
            }
        }
    }


} else {
    // For other type of requests
    echo "Very bad request :(";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
</head>

<body>
    <h1>Form Submission</h1>
    <form action="http://localhost/online-bookstore-php/main.php" method="POST">
        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" placeholder="Insert the title" id="title" name="title" required /><br><br>
        <!-- Author -->
        <label for="author">Author:</label>
        <input placeholder="Insert the author" id="author" type="text" name="author" required /><br><br>
        <!-- Genre -->
        <label for="genre">Genre:</label>
        <input placeholder="Insert the genre" id="genre" type="text" name="genre" required /><br><br>
        <!-- Price -->
        <label for="price">Price:</label>
        <input placeholder="Insert the price" id="price" type="number" name="price" required /><br><br>
        <!-- Submit -->
        <input type="submit" value="Submit via POST">
    </form>

    <table id="books-table" aria-label="Books list" style="width:70%; margin: auto; border-collapse:collapse;">
        <caption>Books</caption>
        <thead>
            <tr>
                <th scope="col" style="text-align:left; padding:8px; border-bottom:1px solid #ccc;">
                    Title
                </th>
                <th scope="col" style="text-align:left; padding:8px; border-bottom:1px solid #ccc;">
                    Author
                </th>
                <th scope="col" style="text-align:left; padding:8px; border-bottom:1px solid #ccc;">
                    Genre
                </th>
                <th scope="col" style="text-align:right; padding:8px; border-bottom:1px solid #ccc;">
                    Price
                </th>
            </tr>
        </thead>
        <tbody>
            <?php 
                showBooks($books);
            ?>
        </tbody>
    </table>

</body>

</html>