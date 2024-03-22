<?php
include '../koneksi.php'; 

if(isset($_POST['submit'])) {
    $idMeja = $_POST['idMeja'];
    $kodeMeja = $_POST['kodeMeja'];
    $keterangan = $_POST['keterangan'];

    $query = "UPDATE meja SET kodeMeja='$kodeMeja', keterangan='$keterangan' WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);

    if($result) {
        header("Location: meja.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}


if(isset($_GET['idMeja'])) {
    $idMeja = $_GET['idMeja'];
    $query = "SELECT * FROM meja WHERE idMeja=$idMeja";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $kodeMeja = $row['kodeMeja'];
        $keterangan = $row['keterangan'];
    } else {
        echo "Data meja tidak ditemukan.";
        exit;
    }
} else {
    echo "ID meja tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Meja - TIMORESTO</title>
   
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
                        <h2>Edit Meja</h2>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="idMeja" value="<?php echo $idMeja; ?>">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="kodeMeja" name="kodeMeja" value="<?php echo $kodeMeja; ?>" placeholder="Kode Meja">
                            <label for="kodeMeja">Kode Meja</label>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" style="height: 100px;"><?php echo $keterangan; ?></textarea>
                            <label for="keterangan">Keterangan</label>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                        <a href="meja.php" class="btn btn-secondary">kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
