<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "layanan_rs";

$conn = new mysqli($host, $user, $password, $database);

if( $conn->connect_error ){
    die("Gagal terhubung dengan database: " . $conn->connect_error);
}
?>