<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Create cocktail</title>
</head>
<body>
    <?php
        session_start();
        if(empty($_SESSION['managerID'])) {
            header('Location: index.php');
        }
    ?>

    <div id="card-field-input">
        <span data-error class="error-box"></span>
        <span data-success class="success-box"></span>

    </div>
    <a href="index.php">Back</a>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/card.js"></script>
</body>
</html>
