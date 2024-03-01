<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projects";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn){
    die("connection failded " . mysqli_connect_error());
}
