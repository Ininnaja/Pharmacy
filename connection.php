<?php 
    $servername = "localhost:3307";
    $username = "root";
    $password ="";
    $dbname = "Pharmacy";

    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if (!$conn) {
        die("conect failed" . mysqli_connect_error());
    } else {

    }
?>
