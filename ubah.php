<?php
session_start(); // Memulai session

// Memeriksa apakah indeks tugas ada dalam URL
if (!isset($_GET['index']) || !isset($_SESSION['todos'][$_GET['index']])) {
    header("Location: index.php"); // Mengalihkan jika indeks tidak valid
    exit;
}

$index = $_GET['index']; // Mengambil indeks tugas yang akan diedit

// Memproses pengiriman form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = trim($_POST['task']); // Mengambil dan memangkas input tugas

    // Validasi panjang tugas
    if (strlen($task) > 255) {
        $_SESSION['error_message'] = "Tugas terlalu panjang! Maksimal 255 karakter.";
    } else {
        // Memperbarui tugas dalam daftar
        $_SESSION['todos'][$index]['task'] = $task; // Memperbarui hanya bagian tugas
        $_SESSION['success_message'] = "Tugas berhasil diubah!";
        header("Location: index.php"); // Mengalihkan kembali ke halaman index
        exit;
    }
}

// Mengambil detail tugas saat ini
$task = $_SESSION['todos'][$index]['task'];
$error_message = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';
unset($_SESSION['error_message']); // Menghapus pesan error dari session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Edit To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Tugas</h1>
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST" class="mb-3">
                    <div class="mb-3">
                        <label for="task" class="form-label">Nama Tugas</label>
                        <input type="text" name="task" id="task" class="form-control" value="<?php echo htmlspecialchars($task); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
