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
    <title>Add A borrower</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <div class="add-form">
        <h1 class="title-text">Hello Please add a new borrower</h1>
        <form action="../actions/register.php" method="POST" autocomplete="off">
            <div class="form-item">
                <label for="username">Username</label><br>
                <input type="text" id="username" name="bname">
            </div>
            <div class="form-item">
                <label for="addr">Address</label><br>
                <input type="text" id="addr" name="baddress">
            </div>
            <div class="form-item">
                <label for="phone">Phone Number</label><br>
                <input type="text" id="phone" name="bphone">
            </div>
            <br>
            <button id="add-submit" name="borrower-submit">Add</button>
        </form>
    </div>
</body>

</html>