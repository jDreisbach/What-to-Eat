
<?php
    require "header.php";

    require_once "./src/login.php";
    $conn= new mysqli($hostName, $username, $pw, $db);

    if ($conn->connect_error) die ('Could not connect to the database');

    
    $user_name = $_SESSION['firstName'];
    $user_id=$_SESSION['id'];

    if (!$user_id){
        header("location: ./login.php?login=false");
    } else {
        echo "<h1 class='text-center'>$user_name's Dinner Cookbook</h1><br /><br>
                <div class='container'>
                    <div class='row mx-auto mb-5'>
                    <div class='card bg-light mb-5 mt-5 mx-auto' style='width: 45rem; margin-top:200px;'>";

        $query2 = "SELECT * FROM instruction inc 
                    LEFT JOIN entrees e ON inc.entree_id = e.id OR inc.entree_id = e.origin_id WHERE e.user_id = $user_id";
        $result2= $conn->query($query2);

        if (!$result2) die('invalid');

        $rs = $result2->num_rows;

        for($i=0; $i<$rs; ++$i){
            $r= $result2->fetch_array(MYSQLI_NUM);

            $eid = $r[1];
            $entree=$r[10];
            $instruction=$r[2];
            $uid=$r[9];
            $origin_id=$r[11];

            echo "<h3 id='entree' class='card-title text-center bg-info text-light'>$entree
                    <input type='submit' onClick='return deleteRecipe($eid, \"$entree\", $uid)' class='btn btn-primary' value='Delete'/></h3>";

            $query = "SELECT * FROM `ingredients`i 
            LEFT JOIN entrees e ON i.entree_id = e.id OR i.entree_id = e.origin_id
            LEFT JOIN instruction inc ON e.id = inc.entree_id
            LEFT JOIN users u ON e.user_id = u.id WHERE u.id = $user_id";
            $result = $conn->query($query);

            $rows = $result->num_rows;

            for($j=0; $j<$rows; ++$j){
                $row = $result->fetch_array(MYSQLI_NUM);
        
                $measure = $row[2];
                $amount = $row[3];
                $ingredient=$row[4];
                $firstName = $row[22];
                $entree_id = $row[1];
                $entree_fk_id = $row[0];
                $entree_name = $row[12];

                if ($entree_id == $eid||$entree_id == $origin_id){
                    /*<input type='hidden' value='$entree_id' id='id".$entree_id."D".$entree_fk_id."'/>
                                <input type='hidden' value='$entree_name' id='name".$entree_id."D".$entree_fk_id."'/>
                                <input type='hidden' value='$entree_fk_id' id='".$entree_fk_id."D".$entree_fk_id."'/>*/
                    echo "<div class='text-center card-text'>
                            <div class='row mx-auto'>
                                
                                
                                <div id='amount' class='col-4'>
                                    <p>$amount</p>
                                </div>
                                <div id='meaure' class='col-4'>
                                    <p>$measure</p>
                                </div>
                                <div id='ingredient' class='col-4'>
                                    <p>$ingredient</p>
                                </div>
                            </div><br/>";
                    
                }

                
        }

        echo "   <div class='row mx-auto'>
                    <div id='instruction' class='col-12'>
                        <p class='text-center p-5'>$instruction</p>
                    </div><br/><br/>
                </div>
                <input type='submit' onclick='return save($eid, \"$entree\", $uid);' class='btn btn-primary mb-3' name='share' value='Share'/>
                
                
            "; 
           
            //<button id='share' type='submit' class='btn btn-primary mb-3' name='share'>Share</button>

    } 
        
    echo "</div>
        </div>
    </div><br/><br/>
    </div>";

    

}

?>

<script>
    function save(entId, entree, uid){
        console.log("ent: " + entree);
        console.log("entId: " + entId);
        console.log("user_id: " + uid);

        $.ajax({
            url: './src/addDinner.php',
            type: 'POST',
            data: {entId,
                    entree,
                    uid},

        });
    }

    function deleteRecipe(entId, entree, uid, instruction){
        $.ajax({
            url: './src/deleteRecipe.php',
            type: 'POST',
            data: {entId, entree, uid, instruction}
        });
    }
</script>