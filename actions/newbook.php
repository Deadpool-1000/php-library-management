<?php
$bookname = $_POST['bookname'];
$bookpublisher = $_POST['bookpublisher'];
$bookcopies = $_POST['bookcopies'];
$bookauthor = $_POST['bookauthor'];
$bookBranch = filter_input(INPUT_POST, 'bookbranch', FILTER_SANITIZE_STRING);
$sql = "INSERT INTO `rdbmslibmanagement`.`book`
    (`book_Title`,
    `book_PublisherName`)
    VALUES
    ('$bookname',
    '$bookpublisher');";
mysqli_query($conn, $sql);
$insertedbookid = mysqli_insert_id($conn);
// Get the branchID
$branchID;
$sql = "SELECT `library_branch_BranchID` FROM library_branch WHERE `library_branch_BranchName`='$bookBranch'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $branchID = $row['library_branch_BranchID'];
    }
}
//INSERT IN bookcopies 
$sql = "INSERT INTO `rdbmslibmanagement`.`book_copies`
    (`book_copies_BookID`,
    `book_copies_BranchID`,
    `book_copies_No_Of_Copies`)
    VALUES
    ($insertedbookid,
    $branchID,
    $bookcopies);
    ";
mysqli_query($conn, $sql);
$sql = "INSERT INTO `rdbmslibmanagement`.`book_authors`
    (`book_authors_BookID`,
    `book_authors_AuthorName`)
    VALUES
    ($insertedbookid,
    '$bookauthor');
    ";
mysqli_query($conn, $sql);
echo "inserted in book copies, book,author";
