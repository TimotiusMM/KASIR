<?php
include '../koneksi.php'; 

$query_pesanan = "SELECT * FROM pesanan";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);

if(isset($_POST['submit'])) {
    $idPesanan = $_POST['idPesanan'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    
    $query = "INSERT INTO transaksi (idPesanan, total, bayar) VALUES ('$idPesanan', '$total', '$bayar')";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header("Location: kasir.php");
        exit;
    } else {
        echo "Gagal menyimpan data pesanan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Pesanan - TIMORESTO</title>
   
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Tambah Pesanan</h2>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idPesanan" name="idPesanan">
                                    <?php
                                    while($row_pesanan = mysqli_fetch_assoc($result_pesanan)) {
                                        echo "<option value='".$row_pesanan['idPesanan']."'>".$row_pesanan['idPesanan']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="idPesanan">ID Pesanan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="total" name="total" placeholder="Total">
                                <label for="total">Total</label>
                                <span style="color: red">*Harga x Pesanan</span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="bayar" name="bayar" placeholder="Bayar">
                                <label for="bayar">Bayar</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="kasir.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
