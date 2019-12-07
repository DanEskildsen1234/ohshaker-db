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
    <input placeholder="First name" id="firstName" type="text">
    <input placeholder="Surname" id="surname" type="text">
    <input placeholder="Username" id="username" type="text">
    <input placeholder="Email" id="email" type="email">
    <input placeholder="Phone number" id="phone" type="tel">
    <input placeholder="Address" id="address" type="text">
    <input placeholder="Zip" id="zip" type="text">
    <input placeholder="New password" id="password" type="password">

    <p>Date joined: <span id="joined"></span></p>

</section>

<button data-logout>Logout</button>

</body>
</html>
