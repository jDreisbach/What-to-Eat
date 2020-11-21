<?php
    require_once "header.php";

    require_once "./src/login.php";
    $conn = new mysqli($hostName, $username, $pw, $db);

    if($conn->connect_error) die ("Could not connect to database");

    $user_id = $_SESSION['id'];
    $user_name = $_SESSION['firstName'];
    $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

    echo "<h1 class='text-center text-info '>Weekly Menu Planner</h1><br /><br />";

    echo "<div class='text-center'>
            <form method='post' action = 'mymenu.php'>
                <button type='submit' class='btn btn-primary text-center' name='generate'>Generate New Menu</button>
                <br/><br/><br/>
            </form>
          </div>";     
    
    if(isset($_POST['generate'])) $_SESSION['isgenerated'] = true;
    else $_SESSION['isgenerated'] = false;

    if(isset($_SESSION['isgenerated'])==true){   
        if(!$user_id){
            header('location: ./login.php?login=false');
        }
    if(!isset($_SESSION['menuItems'])|| (isset($_POST['generate']))){
        $query = "SELECT * FROM entrees WHERE user_id = $user_id ORDER BY RAND() LIMIT 7";
        $result = $conn->query($query);
    
        if (!$result) die ("You must first add recipes to your cookbook");
        $rows = $result->num_rows; 

        if ($rows >= 7){
            echo "<div class='card container bg-light'>
                    <div class='card-title'>
                        <h3 class='text-center bg-info text-light w-100'>Dinner Menu</h3>
                    </div>
                    <div class=text-center '>
                        <div class='row'>";
            $menu = array();
            $menuItems=array();
            for ($i=0; $i<$rows; ++$i){
                $row = $result->fetch_array(MYSQLI_NUM);
                $items = $_SESSION['gen'] = $row[2];
                echo 
                    "<div class='col-1 w-100 text-center mx-auto'>
                        <div class='mx-auto align-items-stretch card h-75 bg-light mb-5'  style='width: 6rem;'>
                            <p class='bg-info text-light w-100'><strong>$days[$i]</strong></p>
                            <p>$items</p>
                        </div>
                        </div>";
                        
                        $val = $row[0];
                        $temp_array= explode(',', $val);
                            for($j=0; $j<sizeof($temp_array); ++$j){
                                array_push($menu,$temp_array[$j]);
                            }
                        $tmp_items = explode(',', $items);
                            for($k=0; $k<sizeof($tmp_items); ++$k){
                                array_push($menuItems, $tmp_items[$k]);
                            }
            }

            $_SESSION['menu'] = $menu;
            $_SESSION['menuItems'] = $menuItems;
            echo "</div></div></div><br /><br />";
        } else echo "<br /><h3 class='text-center'>Please enter 7 or more recipes to use this feature.</h3><br/>
                    <p class='text-center'><a href='./addRecipe.php'>Click here to add more recipes!</a></p>";
    
    } else {
        $menuItems = $_SESSION['menuItems'];
        
            // $menu = $_SESSION['menu'];
            // $query = "SELECT * FROM entrees WHERE id = $menu[$i]";
            // $result = $conn->query($query);

            // if (!$result) die ('Click the generate button');

            //$rows = $result->num_rows; 

            if (sizeof($menuItems) >= 7){
                echo "<div class='card container bg-light'>
                        <div class='card-title'>
                            <h3 class='text-center bg-info text-light w-100'>Dinner Menu</h3>
                        </div>
                        <div class=text-center '>
                            <div class='row'>";
                //$menu = array();
                // for ($i=0; $i<$rows; ++$i){
                    // $row = $result->fetch_array(MYSQLI_NUM);
                    // $items = $_SESSION['gen'] = $row[2];
                    for ($i=0; $i<sizeof($menuItems); ++$i){
                    echo 
                        "<div class='col-1 w-100 text-center mx-auto'>
                            <div class='mx-auto align-items-stretch card h-75 bg-light mb-5'  style='width: 6rem;'>
                                <p class='bg-info text-light w-100'><strong>$days[$i]</strong></p>
                                <p>$menuItems[$i]</p>
                            </div>
                            </div>";
                    }
                            // $val = $row[0];
                            // $temp_array= explode(',', $val);
                            //     for($j=0; $j<sizeof($temp_array); ++$j){
                            //         array_push($menu,$temp_array[$j]);
                            //     }
                // }

                // $_SESSION['menu'] = $menu;
                
                echo "</div></div></div><br /><br />";
            } else echo "<br /><h3 class='text-center'>Please enter 7 or more recipes to use this feature.</h3><br/>
                        <p class='text-center'><a href='./addRecipe.php'>Click here to add more recipes!</a></p>";
        }
        //}
    
}   
// else echo "Click the Generate Menu button to begin";
?>