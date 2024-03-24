<?php
include '../koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cetak Laporan - TIMORESTO</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class=" me-2"></i>TIMORESTO</h3>
            </a>
            <div class="navbar-nav w-100">
                <a href="kasir.php" class="btn btn-primary m-2 ">Generate Laporan</a>
            </div>
        </nav>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN KASIR</span>
            <div class="navbar-nav align-items-center ms-auto">
                <div>
                    <a>
                        <div class="m-3">
                            <a href="kasir.php" class="btn btn-outline-danger">Kembali</a>
                        </div>
                    </a>
                </div>
            </div>
        </nav>

        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">DATA TRANSAKSI</h6>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-dark">
                                <th scope="col">No</th>
                                <th scope="col">ID Pesanan</th>
                                <th scope="col">Total</th>
                                <th scope="col">Bayar</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include '../koneksi.php';

                            $query = "SELECT * FROM transaksi";
                            $result = $koneksi->query($query);

                            if ($result && $result->num_rows > 0) {
                                $no = 1;

                                while ($row = $result->fetch_assoc()) {
                                    $query_idPesanan = "SELECT idPesanan FROM pesanan WHERE idPesanan = '" . $row['idPesanan'] . "'";
                                    $result_idPesanan = mysqli_query($koneksi, $query_idPesanan);
                                    $row_idPesanan = mysqli_fetch_assoc($result_idPesanan);
                                    $idPesanan = $row_idPesanan['idPesanan'];
                            ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $idPesanan; ?></td>
                                        <td>Rp. <?php echo number_format($row['total'], 0, ',', '.'); ?></td>
                                        <td>Rp. <?php echo number_format($row['bayar'], 0, ',', '.'); ?></td>
                                       
                                    </tr>
                                    
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='7'>Tidak ada data yang tersedia</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="mt-4">
                    <a href="#" onclick="printTable()" class="btn btn-secondary float-start">Generate Laporan</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        Copyright © 2024 All rights reserved.
                    </div>
                    <div class="col-12 col-sm-6 text-center text-sm-end">
                        Create By Timotius Marcelino Modo
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function printTable() {
        var table = document.querySelector(".table");

        var tableClone = table.cloneNode(true);

        var printWindow = window.open('', '', 'height=600,width=800');
        printWindow.document.write('<html><head><title>Cetak Tabel</title>');

        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');

        printWindow.document.write('</head><body>');

        printWindow.document.write('<h2 class="text-center">Laporan Transaksi</h2>');
        printWindow.document.write(tableClone.outerHTML);
        printWindow.document.write('</body></html>');

        printWindow.document.close(); 
        printWindow.print();
    }
</script>
</body>

</html>
