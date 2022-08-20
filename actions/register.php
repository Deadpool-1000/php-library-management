<?php
include_once '../db.php';
$bname = $_POST['bname'];
$baddress = $_POST['baddress'];
$bphone = $_POST['bphone'];


$sql = "INSERT INTO `rdbmslibmanagement`.`borrower`
    (`borrower_BorrowerName`,
    `borrower_BorrowerAddress`,
    `borrower_BorrowerPhone`)
    VALUES
    ('$bname',
    '$baddress',
    '$bphone');";

mysqli_query($conn, $sql);
