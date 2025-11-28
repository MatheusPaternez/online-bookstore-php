<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Form Submission</h1>
    <form method="post">
        <!-- Title -->
        <label for="title">Title:</label>
        <input type="text" placeholder="Insert the title" id="title" name="title" /><br><br>
        <!-- Author -->
        <label for="author">Author:</label>
        <input placeholder="Insert the author" id="author" type="text" name="author" /><br><br>
        <!-- Genre -->
        <label for="genre">Genre:</label>
        <input placeholder="Insert the genre" id="genre" type="text" name="genre" /><br><br>
        <!-- Price -->
        <label for="price">Price:</label>
        <input placeholder="Insert the price" id="price" type="number" name="price" /><br><br>
        <!-- Submit -->
        <input type="submit" value="Submit via POST">
    </form>
</body>

</html>