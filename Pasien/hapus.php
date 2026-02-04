<?php

include("../database.php");

if( isset($_GET['id']) ){

    $id = (int) $_GET['id'];

    $sql = "DELETE FROM pendaftaran WHERE id=$id";
    $query = mysqli_query($conn, $sql);

    if( $query ){
        header('Location: riwayat_pendaftaran.php');
    } else {
        die("gagal menghapus...");
    }

} else {
    die("akses dilarang...");
}


?>
