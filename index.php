<?php
session_start(); // Memulai session

// Menginisialisasi daftar tugas jika belum ada
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Menampilkan pesan notifikasi
$success_message = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
unset($_SESSION['success_message']);

$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']);

// Menandai tugas sebagai selesai
if (isset($_GET['mark_done']) && isset($_SESSION['todos'][$_GET['mark_done']])) {
    $_SESSION['todos'][$_GET['mark_done']]['status'] = 'Sudah Dikerjakan';
    $_SESSION['success_message'] = "Tugas berhasil ditandai sebagai selesai!";
    header("Location: index.php"); // Mengalihkan kembali ke halaman index
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Aplikasi To-Do List Sederhana</h1>
        
        <?php if ($success_message): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        
        <div class="card mb-4">
            <div class="card-body">
                <form action="tambah.php" method="POST" class="d-flex">
                    <input type="text" name="task" class="form-control me-2" placeholder="Tambahkan keterangan tugas" required>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Daftar Tugas</h2>
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Keterangan Tugas</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($_SESSION['todos']) > 0): ?>
                            <?php foreach ($_SESSION['todos'] as $index => $todo): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($todo['task']); ?></td>
                                    <td><?php echo htmlspecialchars($todo['status']); ?></td>
                                    <td>
                                        <a href="ubah.php?index=<?php echo $index; ?>" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="hapus.php?index=<?php echo $index; ?>" class="btn btn-danger btn-sm">Hapus</a>
                                        <?php if ($todo['status'] === 'Belum Dikerjakan'): ?>
                                            <a href="?mark_done=<?php echo $index; ?>" class="btn btn-success btn-sm">Tandai Selesai</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada tugas yang tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
