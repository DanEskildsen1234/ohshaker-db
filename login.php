<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bartender login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include_once('components/header.php');
?>
<section>
    <span data-error class="error-box"></span>
    <h1>Bartender login</h1>
    <input placeholder="Your ID" id="bartenderID" type="text">
    <input placeholder="Pin" id="pin" type="password">
    <a href="manager-login.php">Administrative login</a>


    <button data-login>Log in</button>
</section>

<script src="assets/js/functions.js"></script>
<script src="assets/js/bartender-login.js"></script>
</body>
</html>
