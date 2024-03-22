<?php
include '../koneksi.php'; 

if(isset($_GET['idPesanan'])) {

    $idPesanan = $_GET['idPesanan'];
    
    $query = "DELETE FROM pesanan WHERE idPesanan=$idPesanan";
    $result = $koneksi->query($query);
    
    if($result) {

        header("Location: order.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID pesanan tidak ditemukan.";
    exit;
}
?>
