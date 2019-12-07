<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/manager.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php
    session_start();

    if( !empty($_SESSION['managerID']) ) {
        echo "<span data-manager-id=".$_SESSION['managerID'].">";
    }

    if( !empty($_SESSION['bartenderID']) ) {
        echo "<span data-manager-id=".$_SESSION['bartenderID'].">";
    }
?>

<section>
    <span data-error class="error-box"></span>
    <input placeholder="First name" id="username" type="text">
    <input placeholder="Last name" id="username" type="text">
    <input placeholder="Username or email" id="username" type="text">

</section>

<button data-logout>Logout</button>

</body>
</html>
