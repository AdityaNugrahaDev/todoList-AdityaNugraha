<?php
session_start(); // Memulai session untuk menyimpan data

// Memeriksa apakah metode request adalah POST dan data tugas tidak kosong
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = trim($_POST['task']); // Mengambil dan memangkas input tugas

    // Validasi panjang tugas
    if (strlen($task) > 255) {
        $_SESSION['error_message'] = "Tugas terlalu panjang! Maksimal 255 karakter.";
    } else {
        // Menambahkan tugas dengan status awal
        $_SESSION['todos'][] = [
            'task' => $task,
            'status' => 'Belum Dikerjakan' // Status awal tugas
        ];
        $_SESSION['success_message'] = "Tugas berhasil ditambahkan!";
    }
}

// Mengalihkan kembali ke halaman index
header("Location: index.php");
exit;
?>
