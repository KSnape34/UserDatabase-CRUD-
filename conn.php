<?php

//Connection Settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_crud_php";

//Create Connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check Connection
if(!$conn) {
    die("connection failed: " . mysqli_connect_error());
}

//echo "Connected successfully";

?>