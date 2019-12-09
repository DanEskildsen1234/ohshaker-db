<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Manager login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include_once('components/header.php');
?>
<section class="form">
    <span data-error class="error-box"></span>
    <h1>Manager login</h1>
    <input placeholder="Username or email" id="username" type="text">
    <input placeholder="Password" id="password" type="password">
    <a href="login.php">Login as bartender instead</a>


    <button class="btn btn-blue" data-login>Log in</button>
    <a class="btn" href="signup.php">Register your bar</a>
</section>

<script src="assets/js/functions.js"></script>
<script src="assets/js/manager-login.js"></script>
</body>
</html>
