<?php
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($connection, $_POST['judul']);
    $artis = mysqli_real_escape_string($connection, $_POST['artis']);
    $album = mysqli_real_escape_string($connection, $_POST['album']);
    $genre = mysqli_real_escape_string($connection, $_POST['genre']);
    $tahunRilis = mysqli_real_escape_string($connection, $_POST['tahunRilis']);
    $durasi = mysqli_real_escape_string($connection, $_POST['durasi']);

    $query = "INSERT INTO lagu (judul, artis, album, genre, tahunRilis, durasi) 
              VALUES ('$judul', '$artis', '$album', '$genre', '$tahunRilis', '$durasi')";
    
    if (mysqli_query($connection, $query)) {
        header("Location: index.php?message=Lagu berhasil ditambahkan");
        exit();
    } else {
        $error = "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Lagu Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="text-center">TAMBAH LAGU</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Lagu</label>
                                <input type="text" class="form-control" id="judul" name="judul" required>
                            </div>
                            <div class="mb-3">
                                <label for="artis" class="form-label">Artis</label>
                                <input type="text" class="form-control" id="artis" name="artis" required>
                            </div>
                            <div class="mb-3">
                                <label for="album" class="form-label">Album</label>
                                <input type="text" class="form-control" id="album" name="album">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <select class="form-control" id="genre" name="genre">
                                    <option value="">Pilih Genre</option>
                                    <option value="Pop">Pop</option>
                                    <option value="Pop Soul">Pop Rock</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="R&B">R&B</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tahunRilis" class="form-label">Tahun Rilis</label>
                                <input type="number" class="form-control" id="tahunRilis" name="tahunRilis" 
                                       min="1950" max="2025" value="2025">
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi</label>
                                <input type="text" class="form-control" id="durasi" name="durasi" placeholder="00:00">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">SIMPAN</button>
                                <a href="index.php" class="btn btn-secondary">KEMBALI</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php mysqli_close($connection); ?>