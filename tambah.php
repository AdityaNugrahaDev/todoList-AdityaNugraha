<?php
session_start(); // Memulai session untuk menyimpan data

// Memproses pengiriman form jika metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = htmlspecialchars(trim($_POST['task'])); // Mengambil dan memangkas input tugas
    $priority = htmlspecialchars(trim($_POST['priority'])); // Mengambil prioritas tugas
    $description = htmlspecialchars(trim($_POST['description'])); // Mengambil deskripsi tugas

    // Validasi panjang karakter
    if (strlen($task) > 255 || strlen($description) > 500) {
        $_SESSION['error_message'] = "Karakter terlalu panjang!";
    } else {
        // Inisialisasi array tugas jika belum ada
        if (!isset($_SESSION['todos'])) {
            $_SESSION['todos'] = [];
        }
        
        // Menambahkan tugas ke dalam daftar
        $_SESSION['todos'][] = [
            'task' => $task,
            'priority' => $priority,
            'description' => $description,
            'status' => 'Belum Dikerjakan' // Status awal setelah menambahkan tugas
        ];
        $_SESSION['success_message'] = "Tugas berhasil ditambahkan!"; // Notifikasi pesan tugas berhasil ditambahkan ke daftar list
    }

    header("Location: index.php"); // Mengalihkan kembali ke halaman index
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Tugas</title>
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Tugas</h1>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['error_message']); unset($_SESSION['error_message']); ?></div> <!-- Menampilkan pesan error -->
        <?php endif; ?>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="task" class="form-label">Nama Tugas</label>
                <input type="text" name="task" id="task" class="form-control" required> <!-- Input untuk nama tugas -->
            </div>
            <div class="mb-3">
                <label for="priority" class="form-label">Prioritas</label>
                <select name="priority" id="priority" class="form-select" required> <!-- Pilihan untuk prioritas tugas -->
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Keterangan Tugas</label>
                <textarea name="description" id="description" class="form-control" rows="3" required></textarea> <!-- Input untuk keterangan tugas -->
            </div>
            <button type="submit" class="btn btn-primary">Tambah Tugas</button> <!-- Tombol untuk menambah tugas -->
            <a href="index.php" class="btn btn-secondary">Kembali</a> <!-- Tombol untuk kembali ke halaman index -->
        </form>
    </div>
    <!-- Script JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
