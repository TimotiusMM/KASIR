<?php
$koneksi = mysqli_connect("localhost", "root", "", "kasirtimo");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE namaUser='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);


    if (mysqli_num_rows($result) == 1) {
        $user_data = mysqli_fetch_assoc($result);
        $level = $user_data['level'];

        switch ($level) {
            case 'administrator':
                header("Location: admin/admin.php");
                break;
            case 'waiter':
                header("Location: waiter/waiter.php");
                break;
            case 'kasir':
                header("Location: kasir/kasir.php");
                break;
            case 'owner':
                header("Location: owner/owner.php");
                break;
            default:
                header("Location: index.php");
                break;
        }
    } else {
        header("Location: index.php");
    }
}
?>
