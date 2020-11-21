<?php
  session_start();
    
  if(isset($_POST['logout-submit'])) 
  {
    session_destroy();
    header("location: ./login.php");
  }

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What To Eat!?</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./index.php">What to Eat</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="./index.php">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="./mymenu.php">My Menu</a>
            <a class="nav-item nav-link" href="./addRecipe.php">Add Recipe</a>
            <div class="nav-item dropdown" >
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" 
              aria-haspopup="true" aria-expanded="false">My Cookbook</a>
              <div class="dropdown-menu bg-light" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="./breakfastRecipes.php">Breakfast Recipes</a>
                <a class="dropdown-item" href="./lunchRecipes.php">Lunch Recipes</a>
                <a class="dropdown-item" href="./dinnerRecipes.php">Dinner Recipes</a>
                <a class="dropdown-item" href="./appRecipes.php">Appetizer Recipes</a>
                <a class="dropdown-item" href="./dessertRecipes.php">Dessert Recipes</a>
                <a class="dropdown-item" href="./otherRecipes.php">Other Recipes</a>
              </div>
            </div>
            <a class="nav-item nav-link" href="./shoppinglist.php">Shopping List</a>

            <?php 
            if (isset($_SESSION['isLoggedIn']) == false)
              echo '<a class="nav-item nav-link float-right" href="./login.php">Login</a>';
            else {
              $user = $_SESSION['id'];
              
              echo "<div class='nav-item dropdown float-right' style='float:right;'>
                      <a class='nav-link dropdown-toggle float-right' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' 
                      aria-haspopup='true' aria-expanded='false'>Welcome </a>
                        <div class='dropdown-menu bg-light' aria-labelledby='navbarDropdown'>
                          <a class='dropdown-item' href = './profile/$user'>My Profile</a>
                          <a class='dropdown-item' href = './myProfile.php'>Edit Profile</a>
                          <a class='dropdown-item' href='./src/logout.php'>Logout</a>";
              // echo '          <form action="" method="post"><input type="submit" name="logout-submit" value="logout" class="nav-item nav-link pull right" /></form>';
              //echo "          <p class='text-center'>" . " " . " Welcome " . $_SESSION['firstName'] . "</p>";
              echo '</div>';
            }
            ?>
          </div>
        </div>
      </nav>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>