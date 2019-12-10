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
            <div>
                <span>
                    <input disabled id="cIngredientName" name="cIngredientName">
                    <input disabled id="nMeasurement" name="nMeasurement">
                    <input disabled id="eMeasurementType" name="eMeasurementType">
                    <div id="remove-ingredient" style="display:inline;">delete</div>
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
</div>
</div>

<script src="assets/js/functions.js"></script>
<script src="assets/js/cocktail.js"></script>
</body>
</html>