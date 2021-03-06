<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include_once('components/header.php');
?>
<section>
    <form data-sign-up-form class="form">
        <span data-error class="error-box"></span>
        <input placeholder="Bar name" id="barName" type="text">
        <input placeholder="First Name" id="firstName" type="text">
        <input placeholder="Surname" id="surname" type="text">
        <input placeholder="Username" id="username" type="text">
        <input placeholder="Email" id="email" type="email">
        <input placeholder="Phone number" id="phoneNumber" type="tel">
        <input placeholder="Address" id="address" type="text">
        <input placeholder="Zip" id="zip" type="text">
        <input placeholder="Password" id="password" type="password">
        <input placeholder="IBAN" id="IBAN" type="text">
        <input placeholder="CCV" id="CCV" type="number">
        <input placeholder="MM/YY" id="expiration" type="text">

        <button class="btn" data-create>Submit</button>
    </form>
</section>

<script src="assets/js/functions.js"></script>
<script src="assets/js/signup.js"></script>
</body>
</html>
