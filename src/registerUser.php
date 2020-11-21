<?php
    require_once "login.php";
    $conn = new mysqli($hostName, $username, $pw, $db);

    if ($conn->connect_error) die("Could not connect to database");

    if (isset($_POST['firstName'])) $firstName=$_POST['firstName'];
    if (isset($_POST['lastName'])) $lastName=$_POST['lastName'];
    if (isset($_POST['email'])) $email=$_POST['email'];
    if (isset($_POST['password'])) 
    {
        $password=$_POST['password'];
        $hash=password_hash($password, PASSWORD_DEFAULT);
    }
    

    $query="INSERT INTO users VALUES(NULL, '$firstName', '$lastName', '$email', '$hash', NULL)";
    $result = $conn->query($query);

    if (!$result) die('Database could not be accessed');
    else header("location: ../login.php");
?>