<?php

require_once 'login.php';
$conn = new mysqli($hostName, $username, $pw, $db);

if($conn->connect_error) die ('Could not connect to the database');

    $id = $_POST['entId'];
    $item = $_POST['entree'];
    $user = $_POST['uid'];

    $query = "REPLACE INTO community VALUES (null, '$user', '$item', null, null, '$id', null, null, null, '$id')";
    $result = $conn->query($query);

    if (!$result) die ('Something went wrong. Please try again.');

    header('location: ../index.php');

?>