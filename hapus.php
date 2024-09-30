<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];
    // Hapus tugas dari daftar
    unset($_SESSION['todos'][$index]);
    // Mengatur ulang indeks
    $_SESSION['todos'] = array_values($_SESSION['todos']);
    // mengatur notifikasi tugas telah dihapus dari daftar
    $_SESSION['success_message'] = "Tugas berhasil dihapus!";
}

header("Location: index.php");
exit;
?>
