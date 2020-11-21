<?php
    require_once "login.php";
    $conn = new mysqli($hostName, $username, $pw, $db);

    if ($conn->connect_error) die ('Could not connect to database');

    if (isset($_POST['email'])) $email = $_POST['email'];
    if (isset($_POST['password'])) $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);

    if (!$result) die('User not found');
    elseif ($result->num_rows)
    {
        $row=$result->fetch_array(MYSQLI_NUM);

        $result->close();

    if (password_verify($password, $row[4]))
        {
            session_start();
            $_SESSION['id'] = $row[0];
            $_SESSION['email'] = $row[3];
            $_SESSION['firstName'] = $row[1];
            $_SESSION['lastName'] = $row[2];
            $_SESSION['isLoggedIn'] = true;
            $_SESSION['menu']=[];
            header('location: ../index.php?login=success');
        }
    }
    else die("invalid username password combo");

    $conn->close();
?>