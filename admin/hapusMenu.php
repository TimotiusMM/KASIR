<?php
include '../koneksi.php'; 

if(isset($_GET['idMenu'])) {

    $idMenu = $_GET['idMenu'];
    

    $query = "DELETE FROM menu WHERE idMenu=$idMenu";
    $result = $koneksi->query($query);
    
    
    if($result) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID menu tidak ditemukan.";
    exit;
}
?>
