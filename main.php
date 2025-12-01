<?php
$GLOBALS['books'] = [];

// I put one initial book
$initialbook = [
    "title" => "Round Six",
    "author" => "Gi-hun Seong",
    "genre" => "Action and Adventure",
    "price" => 8
];
array_push($GLOBALS['books'], $initialbook);

// Function for applying 10 percent of discount in science fiction books
function applyDiscount(&$allbooks){
    $idx = count($GLOBALS['books']) - 1;

    // Logic for adding discount to the last one (after I saw on the requirements that we need a loop)
    // For me, it makes more sense to apply discount to every new book, not to all every time

    // if ($GLOBALS['books'][$idx]['genre'] === "Science Fiction") {
    //     $GLOBALS['books'][$idx]["price"] = $GLOBALS['books'][$idx]["price"] * 0.9;
    // }

    // Loop through all books, check the genre and change the price
    foreach ($allbooks as &$book) {
        if ($book['genre'] === 'Science Fiction') {
            $book['price'] = $book['price'] * 0.9;
        }
    }
}

// Function for applying 5 percent of discount in fantasy books
function applyFantasyDiscount(&$allbooks){
    // Loop through all books, check the genre and change the price
    foreach ($allbooks as &$book) {
        if ($book['genre'] === 'Fantasy') {
            $book['price'] = $book['price'] * 0.95;
        }
    }
}

function showBooks($books){
    if (!empty($books)) {
        foreach ($books as $book) {
            echo "<tr>
  <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['title']}</td>
  <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['author']}</td>
  <td style='padding:8px; border-bottom:1px solid #eee;'>{$book['genre']}</td>
  <td style='padding:8px; border-bottom:1px solid #eee; text-align:right;'>\${$book['price']}</td>
</tr>";
        }
    }
}

function totalPrice(&$allbooks){
    $total = 0;
    foreach($allbooks as $book){
        $total += $book['price'];
    }
    echo $total;
}

// Function to log book into the file
function logBookAddition($title, $author, $genre, $price) {
    $time = date('Y-m-d H:i:s');
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $log_entry = "\n[$time]\n IP: $ip_address |\n UA: $user_agent |\n Added book: \"$title\" \n($author, $genre, $price)\n";
    
    // Append to the log file
    file_put_contents('bookstore_log.txt', $log_entry, FILE_APPEND);
}

// If server call post method, then:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Storing form data into variables, used trim for avoiding
    // spaces on the edges. The HTML form is already required, so
    // no problems with empty inputs.
    $title = trim(htmlspecialchars($_POST['title']));
    $author = trim(htmlspecialchars($_POST['author']));
    $genre = trim(htmlspecialchars($_POST['genre']));
    $price = trim(htmlspecialchars($_POST['price']));
    
    if ($title == "" | $author == "" | $genre == "") {
        echo "One or more fields are empty! Please submit again without empty fields.";
    } else {
        // Putting every data into the books array
        array_push($GLOBALS['books'], ["title" => $title, "author" => $author, "genre" => $genre, "price" => $price]);
        
        // Log the addition of the new book
        logBookAddition($title, $author, $genre, $price);
        
        // Apply discount function call
        applyDiscount($GLOBALS['books']);
        applyFantasyDiscount($GLOBALS['books']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
    <h1>Form Submission</h1>
    <?php
    // Change the timezone to Vancouver :)
    date_default_timezone_set("America/Vancouver");
    // Show time
    $time = date('Y-m-d H:i');
    // Get IP Address and User Agent
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    ?>
    <!-- Show to user -->
    <p class="meta">
      Request time: <?php echo htmlspecialchars($time); ?><br>
      IP: <?php echo htmlspecialchars($ip_address); ?><br>
      User agent: <?php echo htmlspecialchars($user_agent); ?>
    </p>

    <form class="book-form" action="http://localhost/online-bookstore-php/main.php" method="POST">
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

    <table id="books-table" class="books-table" aria-label="Books list">
        <caption>Books</caption>
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Genre</th>
                <th scope="col" style="text-align:right;">Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Call the function for show books
            showBooks($GLOBALS['books']);
            ?>
        </tbody>
    </table>

    <p class="total-price"> Total Price: 
    <?php 
    // Call the function for price calculation
    totalPrice($GLOBALS['books']);
    ?></p>

    <!-- Display bookstore_log.txt -->
    <section class="activity-log">
        <h2>Activity Log</h2>
        <?php
        // Uses DIR to have the path for the file
        $logfile = __DIR__ . '/bookstore_log.txt';
        if (file_exists($logfile)) {
            $log_contents = file_get_contents($logfile);
            // If log content doesn't exist, it will return false
            if ($log_contents === false) {
                echo "<p>No log entries yet.</p>";
            } else {
                echo '<p style="white-space:pre-wrap; font-size: 14px; background:#f8f8f8; padding:12px; border-radius:6px;">' . htmlspecialchars($log_contents) . '</p>';
            }
        } else {
            echo "<p>Log file not found or unreadable.</p>";
        }
        ?>
    </section>

    </div>
</body>

</html>