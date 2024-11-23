<?php
session_start();
include('includes/config.php');

if (isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
    $query = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['alogin'] = $row['user_ID'];
            echo "<script type='text/javascript'> document.location = 'notebook.php'; </script>";
        }
    } else {
        echo "<script>alert('Invalid Details');</script>";
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

    .navbar-brand {
        font-size: 24px;
        font-weight: bold;
        color: #4CAF50;
        text-align: center;
        display: block;
        margin-bottom: 20px;
        text-decoration: none;
    }

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

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        color: #333;
    }

    input[type="email"], 
    input[type="password"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 5px;
        font-size: 16px;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #4CAF50;
        outline: none;
    }

    button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #4CAF50;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #45a049;
    }

    .btn-default {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        background-color: #007BFF;
        color: #fff;
    }
    
    .btn-default:hover {
        background-color: #0056b3;
    }
  </style>
</head>
<body>
  <section id="content" class="wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="login.php">Notebook</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>Login Form</strong>
        </header>
        <form name="signin" method="post">
          <div class="panel-body wrapper-lg">
          	<div class="form-group">
              <label class="control-label">Email</label>
              <input name="email" type="email" placeholder="Username@example.com" class="form-control input-lg" required>
            </div>
            <div class="form-group">
              <label class="control-label">Password</label>
              <input name="password" type="password" placeholder="Password" class="form-control input-lg" required>
            </div>
            <button name="signin" type="submit" class="btn btn-primary btn-block">Login</button>
            <p class="text-muted text-center"><big>Do not have an account?</big></p>
            <a href="signup.php" class="btn btn-default btn-block">Create an account</a>
          </div>
        </form>
      </section>
    </div>
  </section>
</body>
</html>
