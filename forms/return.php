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
    <title>Issuing Books</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div class="issue-form">
        <h1>Hi admin Enter the details of the borrowed Book</h1>
        <form action="../actions/return_book.php" method="POST">
            <div class="form-item">
                <label for="borrowerName">Borrower Name</label><br>
                <input type="text" name="borrowername" id="borrowerName">
            </div>
            <div class="form-item">
                <label for="bookName">Book Name</label><br>
                <input type="text" name="bookname" id="bookName">
            </div>
            <div class="form-item">
                <label for="bookBranch">Book Branch</label><br>
                <select name="bookbranch" id="bookBranch">
                    <option value="" disabled selected>Select the Branch</option>
                    <option value="Sharpstown">Sharpstown</option>
                    <option value="Central">Central</option>
                    <option value="Saline">Saline</option>
                    <option value="Ann Arbor">Ann Arbor</option>
                </select>
            </div>
            <button type="submit" name="return-book">Return the book</button>
        </form>
    </div>
</body>

</html>