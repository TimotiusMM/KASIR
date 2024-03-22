<?php
include '../koneksi.php'; 

if(isset($_GET['idTransaksi'])) {

    $idTransaksi = $_GET['idTransaksi'];
    
    $query = "DELETE FROM transaksi WHERE idTransaksi=$idTransaksi";
    $result = $koneksi->query($query);
    
    if($result) {
        header("Location: kasir.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID transaksi tidak ditemukan.";
    exit;
}
?>
