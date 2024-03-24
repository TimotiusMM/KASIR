<?php
include '../koneksi.php'; // Sisipkan file koneksi.php untuk mengakses variabel $namaUser
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TIMORESTO</title>
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
                    <a href="admin.php" class="btn btn-primary m-2 active">Entri Barang</a>
                    <a href="meja.php" class="btn btn-primary m-2">Entri Meja</a>
                </div>


            </nav>
        </div>

        <!-- Content -->
        <div class="content">

            <!-- Navbar -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">

                </a>
                <span class="d-none d-lg-inline-flex ms-auto text-secondary">HALAMAN ADMIN</span>

                <div class="navbar-nav align-items-center ms-auto">
                    <div>
                        <div class=" bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>
                    <div>
                        <div class=" bg-light border-0 rounded-0 rounded-bottom m-0">
                        </div>
                    </div>

                    <div >
                        <a >
                            <div class="m-3">
                            <a href="../index.php" class="btn btn-outline-danger">Log Out</a>
                            </div>
                        </a>

                    </div>
                </div>
            </nav>


<!-- Main Content -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded p-4">
        <div class="row mb-3">
            <div class="col">
                <h6 class="mb-0">DATA MENU</h6>
            </div>
            <div class="col text-end">
                <a href="tambahMenu.php" class="btn btn-outline-success">Tambah Menu</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi.php';

                    $query = "SELECT * FROM menu";
                    $result = $koneksi->query($query);

                    if ($result && $result->num_rows > 0) {
                        $no = 1;
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $row['namaMenu']; ?></td>
                                <td>Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm edit-btn" onclick="window.location.href='editMenu.php?idMenu=<?php echo $row['idMenu']; ?>'">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?php echo $row['idMenu']; ?>">Hapus</button>
                                </td>
                            </tr>
                            <div class="modal fade" id="hapusModal<?php echo $row['idMenu']; ?>" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                            <a href="hapusMenu.php?idMenu=<?php echo $row['idMenu']; ?>" class="btn btn-danger">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada data yang tersedia</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchInput").addEventListener("keyup", function() {
            var input = this.value.toLowerCase();
            var rows = document.querySelectorAll("tbody tr");

            rows.forEach(function(row) {
                var namaMenu = row.querySelector("td:nth-child(2)").textContent.toLowerCase();
                if (namaMenu.includes(input)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    });
</script>

</body>

</html>

