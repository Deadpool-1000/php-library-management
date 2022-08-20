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
    <title>List Of Publishers</title>
    <link rel="stylesheet" href="../css/stylesheet.css">
</head>

<body>
    <div class="display-table">
        <h1>This is the list of publishers</h1>
        <table border="1px" cellspacing="5" cellpadding="5">
            <tr>
                <th>Publisher Name</th>
                <th>Publisher Address</th>
                <th>Publisher Phone</th>
            </tr>
            <?php
            $sql = "SELECT `publisher_PublisherName` AS `pname`,`publisher_PublisherAddress` AS `addr`,`publisher_PublisherPhone` AS `pho` FROM publisher;";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                $pname = $row['pname'];
                $addr = $row['addr'];
                $p = $row['pho'];
                echo "<td>$pname</td>";
                echo "<td>$addr</td>";
                echo "<td>$p</td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>