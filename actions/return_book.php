<?php
include_once '../functions.php';
include_once '../db.php';
$borrowerName = $_POST['borrowername'];
$bookName = $_POST['bookname'];
$bookBranch = filter_input(INPUT_POST, 'bookbranch', FILTER_SANITIZE_STRING);

$borrowerID = getBorrowerIDbyName($conn, $borrowerName);
if ($borrowerID  ==  -1) {
    echo "No such User exist please  try again";
    echo "<a href='return.html'><button>Try Again</button></a>";
} else {
    $bookID = getBookIDbyName($conn, $bookName);
    if ($bookID == -1) {
        echo "No Such Book exist please try again";
        echo "<br><a href='return.html'><button>Try Again</button></a>";
    } else {
        $branchID = getBranchIDbyname($conn, $bookBranch);
        if ($branchID == -1) {
            echo "No such Branch exist please try again" . $bookBranch;
        } else {
            returnBook($conn, $bookID, $branchID, $borrowerID);
        }
    }
}
