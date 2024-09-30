<?php
session_start(); // Memulai session untuk menyimpan data

// Inisialisasi daftar tugas jika belum ada
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Menangani notfikasi pesan sukses dan error
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']); // Menghapus notifikasi pesan setelah ditampilkan

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']); // Menghapus notifikasi pesan error setelah ditampilkan

// Menandai tugas sebagai selesai
if (isset($_GET['mark_done']) && isset($_SESSION['todos'][$_GET['mark_done']])) {
    $_SESSION['todos'][$_GET['mark_done']]['status'] = 'Selesai'; // Memperbarui status
    $_SESSION['success_message'] = "Tugas berhasil ditandai sebagai selesai!"; // Menerima notifikasi pesan sukses
    header("Location: index.php"); // Mengalihkan kembali ke halaman index
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List Sederhana</title>
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Aplikasi To-Do List</h1>
        
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <div class="mb-3">
            <a href="tambah.php" class="btn btn-primary">Tambah Tugas</a> <!-- Tombol untuk menambah tugas -->
        </div>
        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Daftar Tugas</h2>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Tugas</th>
                            <th>Prioritas</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($_SESSION['todos']) > 0): ?>
                            <?php foreach ($_SESSION['todos'] as $index => $todo): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($todo['task']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['priority']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['description']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['status']); ?></td>
                                    <td>
                                        <a href="ubah.php?index=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a> <!-- Tombol untuk mengedit tugas -->
                                        <a href="hapus.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Hapus</a> <!-- Tombol untuk menghapus tugas -->
                                        <?php if ($todo['status'] === 'Belum Dikerjakan'): ?>
                                            <a href="?mark_done=<?php echo $index; ?>" class="btn btn-success btn-sm">Tandai Selesai</a> <!-- Tombol untuk menandai tugas sebagai selesai -->
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada tugas yang tersedia</td> <!-- Pesan jika tidak ada tugas -->
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Script JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
