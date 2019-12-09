<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cocktail edit</title>
    
</head>
<body>
<span id="editPage"></span>
<div id="cocktail">
    <section id="update-ingredient" data-update-cocktail>
        <input id="cName" name="cName">
        <input id="cCocktailRecipe" name="cCocktailRecipe">
        <input id="eShakenStirred" name="eShakenStirred">
        <input id="eCubedCrushed" name="eCubedCrushed">
        <template data-ingredient-template>
            <div id="ingredients">
                <span>
                    <input disabled id="cIngredientName" name="cIngredientName">
                    <input disabled id="nMeasurement" name="nMeasurement">
                    <input disabled id="eMeasurementType" name="eMeasurementType">
                    <div id="remove-ingredient" style="display:inline;">delete</div>
                </span>
            </div>
        </template>
    </section>
</div>

<script src="assets/js/functions.js"></script>
<script src="assets/js/cocktail.js"></script>
</body>
</html>