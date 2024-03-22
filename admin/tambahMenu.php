<?php
include '../koneksi.php'; 

if(isset($_POST['submit'])) {
    $namaMenu = $_POST['namaMenu'];
    $harga = $_POST['harga'];

    $query = "INSERT INTO menu (namaMenu, harga) VALUES ('$namaMenu', '$harga')";
    $result = $koneksi->query($query);

    if($result) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Gagal menyimpan data menu.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tambah Menu - TIMORESTO</title>
   
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="show bg-white ">
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h2>Tambah Menu</h2>
                        </div>
                        <form method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="namaMenu" name="namaMenu" placeholder="Nama Menu">
                                <label for="namaMenu">Nama Menu</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="harga" name="harga" placeholder="Kode Meja">
                                <label for="harga">Harga</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                            <a href="admin.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- JavaScript -->
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
