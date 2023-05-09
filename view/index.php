<?php
include_once 'backend/function.php';

clearSession();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

    <title>Welcome <?php echo $_SESSION['name'] ?></title>

    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/nav.css">
</head>
<body >
    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn"><?php echo $_SESSION['name'] ?></button>
        <div id="myDropdown" class="dropdown-content">
            <a href="/account">Account</a>
            <a href="/logout">Logout</a>
        </div>
    </div>
    <script src="../assets/js/main.js"></script>
</body>
</html>