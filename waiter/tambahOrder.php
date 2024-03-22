<?php
include '../koneksi.php'; 

$query_menu = "SELECT * FROM menu";
$result_menu = mysqli_query($koneksi, $query_menu);

$query_pelanggan = "SELECT * FROM pelanggan";
$result_pelanggan = mysqli_query($koneksi, $query_pelanggan);

$query_meja = "SELECT * FROM meja";
$result_meja = mysqli_query($koneksi, $query_meja);

$query_user = "SELECT * FROM user WHERE level='waiter'";
$result_user = mysqli_query($koneksi, $query_user);

if(isset($_POST['submit'])) {
    $idMenu = $_POST['idMenu'];
    $idPelanggan = $_POST['idPelanggan'];
    $jumlah = $_POST['jumlah'];
    $idMeja = $_POST['idMeja'];
    $idUser = $_POST['idUser'];

    $query = "INSERT INTO pesanan (idMenu, idPelanggan, jumlah, idMeja, idUser) VALUES ('$idMenu', '$idPelanggan', '$jumlah', '$idMeja', '$idUser')";
    $result = mysqli_query($koneksi, $query);

    if($result) {
        header("Location: order.php");
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
    <div class="show bg-white">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Tambah Pesanan</h2>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idPelanggan" name="idPelanggan">
                                    <?php while($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) { ?>
                                        <option value="<?php echo $row_pelanggan['idPelanggan']; ?>"><?php echo $row_pelanggan['namaPelanggan']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="idPelanggan">Nama Pelanggan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idMenu" name="idMenu">
                                    <?php while($row_menu = mysqli_fetch_assoc($result_menu)) { ?>
                                        <option value="<?php echo $row_menu['idMenu']; ?>"><?php echo $row_menu['namaMenu']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="idMenu">Nama Menu</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                                <label for="jumlah">Jumlah</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idMeja" name="idMeja">
                                    <?php while($row_meja = mysqli_fetch_assoc($result_meja)) { ?>
                                        <option value="<?php echo $row_meja['idMeja']; ?>"><?php echo $row_meja['kodeMeja']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="idMeja">Kode Meja</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idUser" name="idUser">
                                    <?php while($row_user = mysqli_fetch_assoc($result_user)) { ?>
                                        <option value="<?php echo $row_user['idUser']; ?>"><?php echo $row_user['namaUser']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="idUser">Nama User</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="order.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
