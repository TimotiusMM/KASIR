<?php
include '../koneksi.php'; 


if(isset($_GET['idMeja'])) {

    $idMeja = $_GET['idMeja'];
    
    $query = "DELETE FROM meja WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);
    
    if($result) {

        header("Location: meja.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID meja tidak ditemukan.";
    exit;
}
?>
