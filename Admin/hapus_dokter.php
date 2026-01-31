<?php

include("../database.php");

if( isset($_GET['id']) ){

    $id = $_GET['id'];

    $sql = "DELETE FROM dokter WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if( $query ){
        header('Location: data_dokter.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>