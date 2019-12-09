<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cocktail</title>
    
</head>
<body>
<span id="cocktailPage"></span>
<div id="cocktail"></div>


    <div id="cocktailDetails">
        <input id="shakenStirred" name="shakenStirred" placeholder="Shaken or Stirred?">
        <input id="cubedCrushed" name="cubedCrushed" placeholder="Cubed or Crushed?">
        <input id="cocktailName" name="cocktailName" placeholder="Cocktail Name">
        <input id="recipe" name="recipe" placeholder="recipe">
    </div>
    <div class="cocktailIngredients">
            <input id="ingredient[]" name="ingredient[]" placeholder="ingredient">
            <input id="measurement[]" name="measurement[]" placeholder="measurement(number)">
            <input id="measurementType[]" name="measurementType[]" placeholder="measurement type (ml, l, grams)">
    <div id="addIngredientField">add an ingredient field</div>
    </div>
        <div>Submit</div>
</form>

<script src="assets/js/functions.js"></script>
<script src="assets/js/cocktail.js"></script>
</body>
</html>