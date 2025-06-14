
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "career_guidance";

// Create connection to databse
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection if not error 
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>