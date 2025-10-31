<?php
$servername = "localhost";
$username = "root";
$password = "";
$conn = new mysqli($servername, $username, $password);

function createnewuser($firstname, $lastname, $email, $phone, $picture){    
    global $conn;
    $sql = "INSERT INTO users (firstname, lastname, email, phone, picture) 
            VALUES ('$firstname', '$lastname', '$email', '$phone', '$picture')";
    
    mysqli_query($conn, $sql);
}
?>