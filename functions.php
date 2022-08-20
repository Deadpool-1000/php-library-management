<?php
include_once 'db.php';
function getBorrowerIDbyName($conn, $name)
{
    $borrowerID;
    $sql = "SELECT `borrower`.`borrower_CardNo` AS `cardnum`
    FROM `rdbmslibmanagement`.`borrower`
    WHERE `borrower`.`borrower_BorrowerName`='$name';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $borrowerID = $row['cardnum'];
        }
        return $borrowerID;
    } else {
        return -1;
    }
}

function getBookIDbyName($conn, $name)
{
    $bookID;
    $sql = "SELECT `book`.`book_BookID` AS `bookID`
    FROM `rdbmslibmanagement`.`book`
    WHERE `book`.`book_Title`='$name';";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $bookID = $row['bookID'];
        }
        return $bookID;
    } else {
        return -1;
    }
}

function getBranchIDbyname($conn, $name)
{
    $branchID;
    $sql = "SELECT `library_branch_BranchID` AS `branchID` FROM library_branch WHERE `library_branch_BranchName`='$name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $branchID = $row['branchID'];
        }
        return $branchID;
    } else {
        return -1;
    }
}


function issueBook($conn, $bookID, $branchID, $borrowerID)
{
    $today = new DateTime('now');
    $duedate = new DateTime('now');
    $duedate->modify('+28 day');
    $strdue = $duedate->format('d/m/Y');
    $strtoday = $today->format('d/m/Y');
    $sql = "INSERT INTO `rdbmslibmanagement`.`book_loans`
    (`book_loans_BookID`,
    `book_loans_BranchID`,
    `book_loans_CardNo`,
    `book_loans_DateOut`,
    `book_loans_DueDate`)
    VALUES
    ($bookID,
    $branchID,
    $borrowerID,
    '$strtoday',
    '$strdue');
    ";
    if (!book_isAvailable($conn, $bookID, $branchID)) {
        return false;
    } else {
        if (!mysqli_query($conn, $sql)) {
            echo "Error couldnt proccess loan request.";
        } else {
            echo "Successfully issued book!";
        }
        //deduct a book copy
        $sql = "UPDATE `rdbmslibmanagement`.`book_copies` SET `book_copies_No_Of_Copies`=`book_copies_No_Of_Copies`-1 WHERE `book_copies_BookID`=$bookID AND `book_copies_BranchID`=$branchID";
        mysqli_query($conn, $sql);
    }
}

function returnBook($conn, $bookID, $branchID, $borrowerID)
{
    $fine;
    if (num_of_days_past_due_date($conn, $bookID, $branchID, $borrowerID) >= 0) {
        $fine = 0;
    } else {
        $fine = abs(num_of_days_past_due_date($conn, $bookID, $branchID, $borrowerID) * 3);
    }
    $sql = "DELETE FROM `rdbmslibmanagement`.`book_loans`
    WHERE `book_loans_CardNo`=$borrowerID AND `book_loans_BookID`=$bookID;";
    $sql2 = "UPDATE `rdbmslibmanagement`.`book_copies` SET `book_copies_No_Of_Copies`=`book_copies_No_Of_Copies`+1 WHERE `book_copies_BookID`=$bookID AND `book_copies_BranchID`=$branchID;";
    if (!mysqli_query($conn, $sql)) {
        echo "Error couldnt proccess Return request.";
        exit();
    } else {
        if (!mysqli_query($conn, $sql2)) {
            echo "Error couldnt";
            exit();
        }
        echo "Successfully Returned book!" . "<br>";
        if ($fine > 0) {
            echo "Please Collect Fine of $fine ₹";
        }
    }
}

function book_isAvailable($conn, $bookID, $branchID)
{
    $sql = "SELECT *
    FROM `rdbmslibmanagement`.`book_copies`
    WHERE `book_copies_BookID`=$bookID AND `book_copies_BranchID`=$branchID AND `book_copies_No_Of_Copies`>0;
    ";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function getAllLoanDetails($conn)
{
    $sql = "SELECT book_loans.book_loans_CardNo AS `CardNo`,borrower.borrower_BorrowerName AS `Name`,book_loans.book_loans_DateOut AS `DateOut` ,book_loans.book_loans_DueDate AS `DueDate`
    FROM book_loans
    NATURAL JOIN borrower";
    $result = mysqli_query($conn, $sql);
    return $result;
}


function num_of_days_past_due_date($conn, $bookID, $branchID, $borrowerID)
{
    $sql = "SELECT `book_loans`.`book_loans_DueDate` AS `dd`
    FROM `rdbmslibmanagement`.`book_loans` WHERE `book_loans_BookID`=$bookID AND `book_loans_BranchID`=$branchID AND `book_loans_CardNo`=$borrowerID;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $duedate = $row['dd'];
    $later = '28/11/2022';
    $newdate = DateTime::createFromFormat('d/m/Y', $duedate)->format('Y-m-d');
    // $nd=DateTime::createFromFormat('d/m/Y',$later)->format('Y-m-d');
    $nd = date('Y-m-d');
    $newdate = strtotime($newdate);
    $nd = strtotime($nd);
    $days_diff = ($newdate - $nd) / (60 * 60 * 24);
    return $days_diff;
}
