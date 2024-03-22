<?php
include '../koneksi.php'; 

if(isset($_POST['submit'])) {
    $idMenu = $_POST['idMenu'];
    $namaMenu = $_POST['namaMenu'];
    $harga = $_POST['harga'];

    $query = "UPDATE menu SET namaMenu='$namaMenu', harga='$harga' WHERE idMenu=$idMenu";
    $result = $koneksi->query($query);

    if($result) {
        header("Location: waiter.php");
        exit;
    } else {
        echo "Gagal mengedit data.";
    }
}

if(isset($_GET['idMenu'])) {
    $idMenu = $_GET['idMenu'];
    $query = "SELECT * FROM menu WHERE idMenu=$idMenu";
    $result = $koneksi->query($query);

    if($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $namaMenu = $row['namaMenu'];
        $harga = $row['harga'];
    } else {
        echo "Data menu tidak ditemukan.";
        exit;
    }
} else {
    echo "ID menu tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Edit Menu - TIMORESTO</title>
   
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
                            <h2>Edit Menu</h2>
                        </div>
                        <form method="POST">
                            <input type="hidden" name="idMenu" value="<?php echo $idMenu; ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="namaMenu" name="namaMenu" value="<?php echo $namaMenu; ?>" placeholder="Nama Menu">
                                <label for="namaMenu">Nama Menu</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" placeholder="Harga" >
                                <label for="harga">Harga</label>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="waiter.php" class="btn btn-secondary">Cancel</a>
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
