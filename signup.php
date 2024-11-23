<?php
session_start();
include('includes/config.php');
if(isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,"SELECT * FROM register WHERE email = '$email'") or die(mysqli_error($conn));
    $count = mysqli_num_rows($query);

    if ($count > 0) { 
        echo "<script>alert('Data Already Exist');</script>";
    } else {
        mysqli_query($conn,"INSERT INTO register(fullName, email, password) VALUES('$name','$email','$password')") or die(mysqli_error($conn));
        echo "<script>alert('Records Successfully Added'); window.location = 'index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Notebook | Web Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    /* General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        line-height: 1.6;
    }
    
    .container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    
    h1, h2, h3, h4, h5, h6 {
        color: #333;
    }
    
    /* Navbar */
    .navbar-brand {
        font-size: 24px;
        font-weight: bold;
        color: #4CAF50;
        text-align: center;
        display: block;
        margin-bottom: 20px;
        text-decoration: none;
    }
    
    /* Panel styles */
    .panel {
        border: 1px solid #ddd;
        border-radius: 10px;
        background-color: #fff;
    }
    
    .panel-heading {
        background-color: #4CAF50;
        color: #fff;
        padding: 15px;
        border-bottom: 1px solid #ddd;
        border-radius: 10px 10px 0 0;
        text-align: center;
    }
    
    .panel-body {
        padding: 20px;
    }
    
    /* Form styles */
    .form-group {
        margin-bottom: 15px;
    }
    
    label {
        font-weight: bold;
        color: #333;
    }
    
    input[type="text"], 
    input[type="email"], 
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 5px;
        font-size: 16px;
    }
    
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #4CAF50;
        outline: none;
    }
    
    /* General Button Styles */
    button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }
    
    /* Primary button (Sign up) */
    .btn-primary {
        background-color: #4CAF50;
        color: #fff;
    }
    
    .btn-primary:hover {
        background-color: #45a049;
    }
    
    /* Default button (Login) */
    .btn-default {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        margin: unset; 
        display: block; /* Makes it a block element */
        text-align: center; /* Center the text */
        background-color: #007BFF; 
        color: #fff; 
    }
    
    .btn-default:hover {
        background-color: #0056b3; 
    }
  </style>
</head>
<body>
  <section id="content" class="wrapper-md animated fadeInDown">
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="signup.php">Notebook</a>
      <section class="panel panel-default bg-white">
        <header class="panel-heading text-center">
          <strong>Sign up Form</strong>
        </header>
        <form name="signup" method="POST">
          <div class="panel-body wrapper-lg">
            <div class="form-group">
              <label class="control-label">Name</label>
              <input name="name" type="text" placeholder="Your name or company" class="form-control input-lg" required>
            </div>
            <div class="form-group">
              <label class="control-label">Email</label>
              <input name="email" type="email" placeholder="test@example.com" class="form-control input-lg" required>
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input name="password" type="password" placeholder="Type a password" class="form-control input-lg" required>
            </div>
            <button name="signup" type="submit" class="btn btn-primary btn-block">Sign up</button>
            <p class="text-muted text-center"><big>Already have an account?</big></p>
            <a href="index.php" class="btn btn-default btn-block">Login</a>
          </div>
        </form>
      </section>
    </div>
  </section>
</body>
</html>
