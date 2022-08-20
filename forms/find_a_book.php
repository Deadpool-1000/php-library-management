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
    <title>Search a Book</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div class="find-form">
        <h1>Please Enter the details of your book</h1>
        <form action="find_a_book.php" method="post">
            <div class="form-item">
                <label for="bookName">Book Name</label><br>
                <input type="text" name="bname" placeholder="Book Name">
            </div>
            <button type="submit">Find the Book</button>
        </form>
    </div>
    <?php
    if (isset($_POST['bname'])) {
        $bname = $_POST['bname'];
        if ($bname == '') {
            echo "<h2 style='text-align:center'>Please Enter the name of the book</h2>";
            exit();
        }
        $sql = "CALL bookCopiesAtAllBranches('$bname');";
        $result = mysqli_query($conn, $sql);
        echo "<div class='display-table'>";
        if (mysqli_num_rows($result) > 0) {
            echo "<h1>Details of $bname <br></h1>";
            echo "<table border='2' cellspacing='2' cellpadding='2'> <tr> <th>BranchId</th> <th>Branch Name</th> <th>Number of Copies</th> </tr>";
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                $branchID = $row['Branch ID'];
                $branchName = $row['Branch Name'];
                $numCopies = $row['Number of Copies'];
                echo "<td>$branchID</td>";
                echo "<td>$branchName</td>";
                echo "<td>$numCopies</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<h1>Sorry No such book exists in our database😭</h1>";
        }
        echo "</div>";
    }
    ?>
</body>

</html>