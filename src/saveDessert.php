<?php
    session_start();
    
    require_once 'login.php';
    $conn = new mysqli($hostName, $username, $pw, $db);

    if($conn->connect_error) die('database could not be accessed');

    $entree = $_POST['item'];
    $entree_id=$_POST['itemId'];
    $user_id=$_SESSION['id'];

    $query="INSERT INTO dessert VALUES(NULL, '$user_id', '$entree', '$entree_id')";
    $result = $conn->query($query);

    if(!$result) die('Could not save recipe');
?>