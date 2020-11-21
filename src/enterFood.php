
<?php
    require_once 'login.php';
    $conn = new mysqli($hostName, $username, $pw, $db);
    session_start();
    if($conn->connect_error) die('Could not connect to database');
    else echo "Successfully connected to the database\n";

    if (isset($_POST['food'])) $food= $_POST['food'];
    else echo ("No items have been entered");

    if (isset($_POST['ingredient'])) $ingredients = ($_POST['ingredient']);
    if (isset($_POST['instruction'])) $instruction = $_POST['instruction'];

    $recipe_type = $_POST['recipe_type'];
    $user_id = $_SESSION['id'];

    if (!$recipe_type){
        die ('You must choose a recipe type');
    }

    for ($i=0; $i <count($recipe_type); ++$i){

        if ($recipe_type[$i] == "Breakfast") {

            $query= "INSERT INTO breakfast VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Recipe not saved");
        
            $query2 = "SELECT * FROM breakfast WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get Recipe');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $breakfast_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, NULL, '$instruction', '$breakfast_id', NULL, NULL, NULL, NULL )";
            $result3=$conn->query($query3);
        
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, NULL, '$measure[$i]',' $amount[$i]', '$ingredient[$i]', NULL, '$breakfast_id', NULL, NULL, NULL)";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }
            header("location: ../breakfastRecipes.php");
        }elseif ($recipe_type[$i] == "Lunch"){
            $query= "INSERT INTO lunch VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Recipe not saved");
        
            $query2 = "SELECT * FROM lunch WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get entrees');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $lunch_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, NULL, '$instruction', NULL, '$lunch_id', NULL, NULL, NULL )";
            $result3=$conn->query($query3);
        
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, NULL, '$measure[$i]',' $amount[$i]', '$ingredient[$i]', NULL, NULL, '$lunch_id', NULL, NULL)";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }
            header("location: ../lunchRecipes.php");

        }elseif ($recipe_type[$i] == "Dinner"){

            $query= "INSERT INTO entrees VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Entrees not saved");
        
            $query2 = "SELECT * FROM entrees WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get entrees');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $entree_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, '$entree_id', '$instruction', NULL, NULL, NULL, NULL, NULL)";
            $result3=$conn->query($query3);
        
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, '$entree_id', '$measure[$i]',' $amount[$i]', '$ingredient[$i]', NULL, NULL, NULL, NULL, NULL)";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }

            header("location: ../dinnerRecipes.php");

        }elseif ($recipe_type[$i] == "Appetizer"){
            
            $query= "INSERT INTO apps VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Recipe not saved");
        
            $query2 = "SELECT * FROM apps WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get entrees');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $app_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, NULL, '$instruction', NULL, NULL, '$app_id', NULL, NULL)";
            $result3=$conn->query($query3);
            
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, NULL, '$measure[$i]',' $amount[$i]', '$ingredient[$i]', '$app_id', NULL, NULL, NULL, NULL)";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }
            header("location: ../appRecipes.php");
        }elseif ($recipe_type[$i] == "Dessert"){
            $query= "INSERT INTO dessert VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Recipe not saved");
        
            $query2 = "SELECT * FROM dessert WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get entrees');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $dessert_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, NULL, '$instruction', NULL, NULL, NULL, '$dessert_id', NULL )";
            $result3=$conn->query($query3);
        
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, NULL, '$measure[$i]',' $amount[$i]', '$ingredient[$i]', NULL, NULL, NULL, '$dessert_id', NULL)";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }
            header("location: ../dessertRecipes.php");

        }elseif ($recipe_type[$i]== "Other"){

            $query= "INSERT INTO other VALUES(NULL, '$user_id', '$food', NULL)";
            $result = $conn->query($query);
        
            if(!$result) die(" Recipe not saved");
        
            $query2 = "SELECT * FROM other WHERE user_id = $user_id";
            $result2= $conn->query($query2);
        
            if (!$result2) die(' Could Not get entrees');
        
            $rows = $result2->num_rows;
        
            for ($j=0;$j<$rows;++$j)
            {
                $row=$result2->fetch_array(MYSQLI_NUM);
                $other_id=$row[0];
            }
        
            $query3 = "INSERT INTO instruction VALUES(NULL, NULL, '$instruction', NULL, NULL, NULL, NULL, '$other_id' )";
            $result3=$conn->query($query3);
        
            if (isset($_POST['measure'])) $measure =$_POST['measure'];
            if (isset($_POST['amount'])) $amount = $_POST['amount'];
            if (isset($_POST['ingredient'])) $ingredient = $_POST['ingredient'];
        
            for ($i=0, $count = count($ingredient); $i<$count; ++$i) {
          
                $query4 = "INSERT INTO ingredients VALUES(NULL, NULL, '$measure[$i]',' $amount[$i]', '$ingredient[$i]', NULL, NULL, NULL, NULL, '$other_id')";
                $result4 = $conn->query($query4);
            
                if (!$result4) die ('something here is seriously fucked up');
            }
            header("location: ../otherRecipes.php");


        }else die ("You must choose a recipe type");

    }
?>