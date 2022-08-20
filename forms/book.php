<?php
session_start();

if (empty($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add A book</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div class="book-form">
        <h1>Hello Please add a new book</h1>
        <form action="../actions/newbook.php" method="POST" autocomplete="off">
            <div class="form-item">
                <label for="bookname">Book Name</label><br>
                <input type="text" name="bookname" id="bookname">
            </div>
            <div class="form-item">
                <label for="bookPublisher">Book Publisher</label><br>
                <input type="text" id="bookPublisher" name="bookpublisher">
            </div>
            <div class="form-item">
                <label for="branch">Branch</label><br>
                <select name="bookbranch" id="branch">
                    <option value="" disabled selected>Select the Branch</option>
                    <option value="Sharpstown">Sharpstown</option>
                    <option value="Central">Central</option>
                    <option value="Saline">Saline</option>
                    <option value="Ann Arbor">Ann Arbor</option>
                </select>
            </div>
            <div class="form-item">
                <label for="bookCopies">Book Copies</label><br>
                <input type="text" id="bookCopies" name="bookcopies">
            </div>
            <div class="form-item">
                <label for="author">Author</label><br>
                <input type="text" id="author" name="bookauthor">
            </div>
            <button type="submit" name="book-add">Add</button>
        </form>
    </div>
</body>

</html>