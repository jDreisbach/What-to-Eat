<?php
    require "header.php";
    require_once "./src/login.php";

    $conn=new mysqli($hostName, $username, $pw, $db);
    if($conn->connect_error) die('could not connect to the database');

        $menu = $_SESSION['menu'];
        
        if (sizeof($menu)>=6){

            echo "<div class='text-center'>
                    <div class='container'>
                        <br/><br/>
                        <div class='card bg-light'>
                            <div class='card-title bg-info text-light'>
                                <h4>Shopping List</h4>
                            </div>";

            for ($i=0; $i<sizeof($menu); ++$i){
            
                $query = "SELECT ingredient FROM ingredients i WHERE i.entree_id = $menu[$i]";
                $result = $conn->query($query);

                if(!$result) die ('Could not find ingredients');

                $rs = $result->num_rows;

                for($j=0; $j<$rs; ++$j){
                    $r = $result->fetch_array(MYSQLI_NUM);
                    echo "           <ul>
                                        <li>$r[0]</li>
                                    </ul>";
                }
            }
        }else echo "<br/><br/><h3 class='text-center'>You must first create a menu before using this feature</h3><br/>
                    <p class='text-center'><a href='./mymenu.php'>Click here to create a menu</a></p>";
    

        echo "  </div>
            </div>
        </div>";

?>