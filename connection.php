<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "kreativ";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn){
        die('Error: Cannot connect to database');
    }
?>