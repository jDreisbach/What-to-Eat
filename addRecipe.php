<?php
  require "header.php";

  $user_id=$_SESSION['id'];

    if (!$user_id){
        header("location: ./login.php?login=false");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What to Eat</title>
</head>
<body style='text-align: center'>

    <br>
    <br>
    <div class='mx-auto'>
        <div class='card col-6 mx-auto border border-info rounded bg-light'> 
            <h3 class='bg-info text-light'>Add Entree</h3>
            <form class='form-signin mx-auto text-center' method='post' action='./src/enterFood.php'>
                Recipe Name: <input class='form-control' type='text' name='food' /><br /><br />
                <div class='row'>
                <div class='w-100'>
                    <input class='col-1' type='radio' name='recipe_type[]' value='Breakfast' />Breakfast
                    <input class='col-1' type='radio' name='recipe_type[]' value='Lunch' />Lunch
                    <input class='col-1' type='radio' name='recipe_type[]' value='Dinner' />Dinner
                    <input class='col-1' type='radio' name='recipe_type[]' value='Appetizer' />Appetizer
                    <input class='col-1' type='radio' name='recipe_type[]' value='Dessert' />Dessert
                    <input class='col-1' type='radio' name='recipe_type[]' value='Other' />Other
                </div>
            </div><br/><br/>
                <div id='ingredients' class="form-row align-items-center">
                </div>
                Add Ingredient <button class='btn btn-primary' id='add'>+</button><br /><br />
                <textarea name='instruction' class= 'form-control' rows="20" cols="50" placeholder='Enter cooking instructions here'></textarea><br /><br />
                <input type='submit' class='btn btn-primary'/>
            </form>
        </div>
    </div>

    <script src='./utils/recipes.js'></script>
</body>
</html>