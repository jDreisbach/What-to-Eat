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
        echo "<h1 class='text-center'>$user_name's Misc. Cookbook</h1><br /><br>
                <div class='container'>
                    <div class='row mx-auto'>
                    <div class='card bg-light mb-5 mt-5 mx-auto' style='width: 45rem; margin-top:200px;'>";

        $query2 = "SELECT * FROM instruction inc 
                    LEFT JOIN other o ON inc.other_id = o.id OR inc.other_id = o.origin_id WHERE o.user_id = $user_id";
        $result2= $conn->query($query2);

        if (!$result2) die('invalid');

        $rs = $result2->num_rows;

        for($i=0; $i<$rs; ++$i){
            $r= $result2->fetch_array(MYSQLI_NUM);

            $oid = $r[7];
            $other=$r[10];
            $instruction=$r[2];
            $uid = $r[9];
            $origin_id=$r[11];

            echo "<h3 class='card-title text-center bg-info text-light'>$other
            <input type='submit' onClick='return deleteRecipe($oid, \"$other\", $uid)' class='btn btn-primary' value='Delete'/></h3><br>";

            $query = "SELECT * FROM `ingredients`i 
            LEFT JOIN other o ON i.other_id = o.id OR i.other_id = o.origin_id
            LEFT JOIN instruction inc ON o.id = inc.other_id
            LEFT JOIN users u ON o.user_id = u.id WHERE u.id = $user_id";
            $result = $conn->query($query);

            $rows = $result->num_rows;

            for($j=0; $j<$rows; ++$j){
                $row = $result->fetch_array(MYSQLI_NUM);
        
                $measure = $row[2];
                $amount = $row[3];
                $ingredient=$row[4];
                $firstName = $row[22];
                $other_id = $row[9];

                if ($other_id == $oid||$other_id == $origin_id){
                    echo "<div class='text-center card-text'>
                            <div class='row mx-auto'>
                                <div class='col-4'>
                                    <p>$amount</p>
                                </div>
                                <div class='col-4'>
                                    <p>$measure</p>
                                </div>
                                <div class='col-4'>
                                    <p>$ingredient</p>
                                </div>
                            </div><br/>";
                    
                }

                
        }

        echo "   <div class='row mx-auto'>
                    <div class='col-12'>
                        <p class='text-center p-5'>$instruction</p>
                    </div><br/><br/>
                </div>
                <input type='submit' onclick='return save($oid, \"$other\", $uid);' class='btn btn-primary mb-3' name='share' value='Share'/>"; 

    } 
        
    echo "</div>
        </div>
    </div><br/><br/>
    </div>";

}
?>

<script>
    function save(entId, entree, uid){

        $.ajax({
            url: './src/addOther.php',
            type: 'POST',
            data: {entId,
                    entree,
                    uid},

        });
    }

    function deleteRecipe(entId, entree, uid, instruction){
        $.ajax({
            url: './src/deleteOther.php',
            type: 'POST',
            data: {entId, entree, uid, instruction}
        });
    }
</script>