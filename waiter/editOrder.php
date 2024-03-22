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
    $idPesanan = $_POST['idPesanan'];
    $idMenu = $_POST['idMenu'];
    $idPelanggan = $_POST['idPelanggan'];
    $jumlah = $_POST['jumlah'];
    $idMeja = $_POST['idMeja'];
    $idUser = $_POST['idUser'];

    $query = "UPDATE pesanan SET idMenu='$idMenu', idPelanggan='$idPelanggan', jumlah='$jumlah', idMeja='$idMeja', idUser='$idUser' WHERE idPesanan=$idPesanan";
    $result = $koneksi->query($query);

    if($result) {
        header("Location: order.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}

if(isset($_GET['idPesanan'])) {
    $idPesanan = $_GET['idPesanan'];
    $query = "SELECT * FROM pesanan WHERE idPesanan=$idPesanan";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idPelanggan = $row['idPelanggan'];
        $idMenu = $row['idMenu'];
        $jumlah = $row['jumlah'];
        $idMeja = $row['idMeja'];
        $idUser = $row['idUser'];
    } else {
        echo "Data pesanan tidak ditemukan.";
        exit;
    }
} else {
    echo "ID pesanan tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Pesanan - TIMORESTO</title>
    
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
                            <h2>Edit Pesanan</h2>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="idPesanan" value="<?php echo $idPesanan; ?>">
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idPelanggan" name="idPelanggan">
                                    <?php while($row_pelanggan = mysqli_fetch_assoc($result_pelanggan)) { ?>
                                        <option value="<?php echo $row_pelanggan['idPelanggan']; ?>" <?php if($row_pelanggan['idPelanggan'] == $idPelanggan) echo "selected"; ?>>
                                            <?php echo $row_pelanggan['namaPelanggan']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="idPelanggan">Nama Pelanggan</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idMenu" name="idMenu">
                                    <?php while($row_menu = mysqli_fetch_assoc($result_menu)) { ?>
                                        <option value="<?php echo $row_menu['idMenu']; ?>" <?php if($row_menu['idMenu'] == $idMenu) echo "selected"; ?>>
                                            <?php echo $row_menu['namaMenu']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="idMenu">Nama Menu</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" placeholder="Jumlah">
                                <label for="jumlah">Jumlah</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idMeja" name="idMeja">
                                    <?php while($row_meja = mysqli_fetch_assoc($result_meja)) { ?>
                                        <option value="<?php echo $row_meja['idMeja']; ?>" <?php if($row_meja['idMeja'] == $idMeja) echo "selected"; ?>>
                                            <?php echo $row_meja['kodeMeja']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <label for="idMeja">Kode Meja</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="idUser" name="idUser">
                                    <?php while($row_user = mysqli_fetch_assoc($result_user)) { ?>
                                        <option value="<?php echo $row_user['idUser']; ?>" <?php if($row_user['idUser'] == $idUser) echo "selected"; ?>>
                                            <?php echo $row_user['namaUser']; ?>
                                        </option>
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
