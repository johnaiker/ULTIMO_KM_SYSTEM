<?php

// include 'conection_db.php';
    
$servername = "localhost";
$username = "root";
$password = "246678";
$database = "km_airlines";


//Conectamos con la base de datos en mysql, usando el host, usuario, contraseña y la base de datos a usar.
$conn = new mysqli($servername,$username,$password,$database);

// $servername = "localhost";
// $username = "root";
// $password = "246678";

// Create connection
// $conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";