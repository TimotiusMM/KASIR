<?php
include '../koneksi.php';

if(isset($_POST['submit'])) {
    $idPesanan = $_POST['idPesanan'];
    $total = $_POST['total'];
    $bayar = $_POST['bayar'];
    $idTransaksi = $_POST['idTransaksi']; 

    $query = "UPDATE transaksi SET idPesanan='$idPesanan', total='$total', bayar='$bayar' WHERE idTransaksi='$idTransaksi'";
    $result = $koneksi->query($query);

    if($result) {
        header("Location: kasir.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}

if(isset($_GET['idTransaksi'])) {
    $idTransaksi = $_GET['idTransaksi'];
    $query = "SELECT * FROM transaksi WHERE idTransaksi=$idTransaksi";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idPesanan = $row['idPesanan'];
        $total = $row['total'];
        $bayar = $row['bayar'];
    } else {
        echo "Data Transaksi tidak ditemukan.";
        exit;
    }
} else {
    echo "ID Transaksi tidak ditemukan.";
    exit;
}

$query_pesanan = "SELECT * FROM pesanan";
$result_pesanan = mysqli_query($koneksi, $query_pesanan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Transaksi - TIMORESTO</title>
    
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="show bg-white">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Edit Transaksi</h2>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="idTransaksi" value="<?php echo $idTransaksi; ?>">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idPesanan" name="idPesanan">
                                    <?php
                                    while($row_pesanan = mysqli_fetch_assoc($result_pesanan)) {
                                        if($row_pesanan['idPesanan'] == $idPesanan) {
                                            echo "<option value='".$row_pesanan['idPesanan']."' selected>".$row_pesanan['idPesanan']."</option>";
                                        } else {
                                            echo "<option value='".$row_pesanan['idPesanan']."'>".$row_pesanan['idPesanan']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="idPesanan">ID Pesanan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="total" name="total" value="<?php echo $total; ?>" placeholder="Total">
                                <label for="total">Total</label>
                                <span style="color: red">*Harga x Pesanan</span>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="bayar" name="bayar" value="<?php echo $bayar; ?>" placeholder="Bayar">
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
