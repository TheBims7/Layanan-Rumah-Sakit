<?php

include("../database.php");

if( isset($_GET['id']) ){

    $id = $_GET['id'];

    $sql = "DELETE FROM poliklinik WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if( $query ){
        header('Location: data_poli.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}

?>