<?php
    session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hostName, $username, $pw, $db);

    if($conn->connect_error) die('database could not be accessed');

    $lunch = $_POST['item'];
    $lunch_id=$_POST['itemId'];
    $user_id=$_SESSION['id'];

    $query="INSERT INTO lunch VALUES(NULL, '$user_id', '$lunch', '$lunch_id')";
    $result = $conn->query($query);

    if(!$result) die('Could not save recipe');
?>