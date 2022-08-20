<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management</title>
    <link rel="stylesheet" href="css/stylesheet.css">
</head>

<body>
    <div class="login-form">
        <h1>Welcome to Library</h1>
        <p>Please Verify your credentials</p>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-item">
                <input type="text" id="admin" placeholder="Username..." autocomplete="off" name="admin">
            </div>
            <br>
            <div class="form-item">
                <input type="password" id="pwd" placeholder="Password..." name="pwd">
            </div>
            <br>
            <button type="submit">Login</button>
            <button id="form-clear" type="button">Clear</button>
            <br>
            <?php
            if (isset($_GET['error'])) {
                echo "<span>Sorry Invalid Credentials😢</span>";
            }
            ?>
        </form>
    </div>
    <p><span id="message"></span></p>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $admin = $_POST['admin'];
        $pwd = $_POST['pwd'];
        if ($pwd == "yourSecretPassword" && $admin == "admin1212") {
            $_SESSION['authenticated'] = true;
            header('Location: dashboard.php');
        } else {
            header("Location: login.php?error=invalid-credentials");
        }
    }
    ?>

    <script>
        const admin = document.getElementById('admin');
        const pwd = document.getElementById('pwd');
        const clearButton = document.getElementById('form-clear');

        clearButton.addEventListener('click', function(e) {
            console.log("clearing");
            e.preventDefault();
            admin.value = '';
            pwd.value = '';
        });
    </script>
</body>

</html>