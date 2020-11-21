<?php
require "profileHeader.php";

if(!isset($_GET['id'])) die("Profile does not exist");

else if(isset($_GET['id'])){
    require_once "./src/login.php";

    $conn = new mysqli($hostName, $username, $pw, $db);
    if($conn->connect_error) die('Database could not be accessed');

    $userId = $_GET['id'];

    $query="SELECT * FROM users u
            LEFT JOIN bio b ON u.id = b.user_id
            WHERE u.id = $userId";

    $result = $conn->query($query);

    //$rows = $result->num_rows;

    //for($i=0; $i<$rows; ++$i){
        $row = $result->fetch_array(MYSQLI_NUM);

        $firstName=$row[1];
        $lastName=$row[2];
        $email = $row[3];
        $bio = $row[8];
    //}

   if (file_exists("$userId.jpg"))

                echo "<div class='container text-center mt-5'>
                        <h1 class='text-center text-info'>$firstName $lastName</h1>
                        <p>$email</p>
                        <img class='rounded-circle float-left mr-3' src='../$userId.jpg'/><br/>
                      </div>
                      <div class='container float-left'>
                        <div class='text-center card ml-5' style='width:34rem;'>
                            <div class='card-title bg-info'>
                                <h3 class='text-light'>Who am I?</h3>
                            </div>
                            <div class='card-body'>
                                <h4 class='text-center'>$bio</h4>
                            </div>
                        </div>
                      </div>";
                      
    
}
?>