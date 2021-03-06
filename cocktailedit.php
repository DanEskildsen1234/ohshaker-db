<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">

    <title>cocktail edit</title>
</head>
<body>
<?php
include_once('components/header.php');
?>
<span id="editPage"></span>
<div id="cocktail">
    <section id="update-ingredient" data-update-cocktail>
        <input placeholder="Cocktail name" id="cName" name="cName">
        <input placeholder="Recipe" id="cCocktailRecipe" name="cCocktailRecipe">
        <input placeholder="Shaken or stirred?" id="eShakenStirred" name="eShakenStirred">
        <input placeholder="Cubed or Crushed?" id="eCubedCrushed" name="eCubedCrushed">
        <template data-ingredient-template>
            <div>
                <span>
                    <input placeholder="Ingredient name" disabled id="cIngredientName" name="cIngredientName">
                    <input placeholder="Measurement" disabled id="nMeasurement" name="nMeasurement">
                    <input placeholder="Measurement type" disabled id="eMeasurementType" name="eMeasurementType">
                    <div id="remove-ingredient" style="display:inline;">delete ingredient</div>
                </span>
            </div>
        </template>
        <div style ="display:block" id="ingredientContainer">
        <select id="insert-ingredient">
        </select>
        <input id="measurement" placeholder="amount">
        <select id="measurementType">
            <option></option>
            <option>ml</option>
            <option>cl</option>
            <option>dl</option>
            <option>l</option>
            <option>gram</option>
            <option>slice</option>
            <option>wedge</option>
            <option>part</option>
            <option>dash</option>
            <option>tbsp</option>
            <option>tsp</option>
        </select>
        <div id="add-ingredient" style="display:inline;">submit ingredient</div>
    </section>
    <div id="delete-cocktail">delete cocktail</div>
</div>
</div>

<script src="assets/js/functions.js"></script>
<script src="assets/js/cocktail.js"></script>
</body>
</html>
