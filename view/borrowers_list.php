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
    <title>List Of Borrowers/Users</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>
<body>
        <div class="display-table">
            <h1>This is the list of Users</h1>
            <table border="1px" cellspacing="5" cellpadding="5">
                <tr>
                    <th>User Name</th>
                    <th>Users Address</th>
                    <th>Users Phone No.</th>
                </tr>
                <?php
                    $sql="SELECT `borrower`.`borrower_BorrowerName` AS `bname`,
                    `borrower`.`borrower_BorrowerAddress` AS `baddr`,
                    `borrower`.`borrower_BorrowerPhone` AS `bphone`
                    FROM `rdbmslibmanagement`.`borrower`;";
                    $result=mysqli_query($conn,$sql);
                    while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
                        echo "<tr>";
                            $bname=$row['bname'];
                            $baddr=$row['baddr'];
                            $bphone=$row['bphone'];
                            echo "<td>$bname</td>";
                            echo "<td>$baddr</td>";
                            echo "<td>$bphone</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
</body>
</html>