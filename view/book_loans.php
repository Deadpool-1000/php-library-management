<?php
session_start();

if (empty($_SESSION['authenticated'])) {
    header('Location: ../login.php');
    exit;
}
include_once '../db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Of Book Loans</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div class="display-table">
        <h1>List of book Loans</h1>
        <table border="1px" cellspacing="2" cellpadding="5">
            <tr>
                <th>Borrower Name</th>
                <th>Book Name</th>
                <th>Due Date</th>
            </tr>
            <?php
            $sql = "SELECT borrower.borrower_BorrowerName AS `name` , book.book_title AS `title` ,book_loans.book_loans_DueDate AS `date`
                    FROM book_loans
                    INNER JOIN borrower
                    INNER JOIN book
                    ON borrower.borrower_CardNo=book_loans_CardNo AND book_loans.book_loans_BookID=book.book_BookID;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                $name = $row['name'];
                $title = $row['title'];
                $date = $row['date'];
                echo "<td>$name</td>";
                echo "<td>$title</td>";
                echo "<td>$date</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>