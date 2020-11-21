<?php
  require "header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body class='text-center'>

    <form class="form-signin card mx-auto text-center" style="width: 18rem; margin-top:200px;" method='post' action='./src/registerUser.php'>
      <div class='card-title bg-info text-light'>
        <h1 class="h3 mb-3 font-weight-normal">Register</h1>
        <h6>Already a member? <a class='text-light' href='./login.php'>Login here!</a></h6>
      </div>
        <label for="firstName" class="sr-only">First Name</label>
        <input type="text" name='firstName' id="firstName" class="form-control" placeholder="First Name" required="" autofocus="">
        <label for="lastName" class="sr-only">Last Name</label>
        <input type="text" name='lastName' id="lastName" class="form-control" placeholder="Last Name" required="" autofocus="">
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name='email' id="email" class="form-control" placeholder="Email address" required="" autofocus="">
        <label for="password" class="sr-only">Password</label>
        <input type="password" name='password' id="password" class="form-control" placeholder="Password" required="">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
      </form>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>