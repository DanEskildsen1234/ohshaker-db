<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Ingredient</title>
</head>
<body>
<?php
include_once('components/header.php');
?>
<span id="ingredientsPage"></span>
    <section id="ingredient-section" data-ingredient-section>
        <template data-ingredient-template>
            <div class="ingredientSection" style="margin-bottom:20px">
                <div class="ingredient-field" id="cName"></div>
                <a class="edit-ingredient">edit</a>
                <div class="delete-ingredient btn">Delete</div>
            </div>
        </template>
    </section>

    <script src="assets/js/functions.js"></script>
    <script src="assets/js/ingredient.js"></script>
</body>
</html>
