<?php
    require_once 'login.php';
    $conn = new mysqli($hostName, $username, $pw, $db);

    if($conn->connect_error) die('Could not connect to the database');

        $id= $_POST['entId'];
        $item = $_POST['entree'];
        $user = $_POST['uid'];
        $instruction = $_POST['instruction'];

    $query2 = "DELETE FROM dessert WHERE (id = $id AND user_id = $user) OR (origin_id = $id AND user_id = $user)";
    $result2 = $conn->query($query2);

    if(!$result2) die('Could not delete ingredients');

?>