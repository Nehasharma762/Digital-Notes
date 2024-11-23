<?php
define('DB_HOST', 'localhost'); 
define('DB_USER', 'root');       
define('DB_PASS', '');          
define('DB_NAME', 'note');       

// Establish database connection using MySQLi
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conn) {
    exit("Error: " . mysqli_connect_error());
}

// Set the character set to UTF-8
mysqli_set_charset($conn, "utf8");

?>
