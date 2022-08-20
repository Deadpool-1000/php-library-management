<?php
    session_start();

    if (empty($_SESSION['authenticated'])) {
        header('Location: login.php');
        exit;
    }
    include_once 'functions.php';
    include_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Dashboard</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>
<body>
    <div class="dashboard">
        <h1>Hi admin Whats On your Mind?</h1>    
        <a href="forms/Borrower.php"><button>Add A new User/Borrower</button></a>
        <a href="forms/book.php"><button>Add A new Book</button></a>
        <a href="forms/loans.php"><button>Issuing a book</button></a>
        <a href="forms/return.php"><button>Return a Book</button></a>
        <a href="view/publishers.php"><button>Publishers List</button></a>
        <a href="view/borrowers_list.php"><button>Borrowers/Users List</button></a>
        <a href="view/book_loans.php"><button>Book-loans detail</button></a>
        <a href="forms/find_a_book.php"><button>Find a book</button></a>
    </div>
</body>
</html>