<?php
include 'config/database.php';

$no = $_GET['no'];
$query = "SELECT * FROM lagu WHERE no = $no";
$result = mysqli_query($connection, $query);
$lagu = mysqli_fetch_assoc($result);

if (!$lagu) {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = mysqli_real_escape_string($connection, $_POST['judul']);
    $artis = mysqli_real_escape_string($connection, $_POST['artis']);
    $album = mysqli_real_escape_string($connection, $_POST['album']);
    $genre = mysqli_real_escape_string($connection, $_POST['genre']);
    $tahunRilis = mysqli_real_escape_string($connection, $_POST['tahunRilis']);
    $durasi = mysqli_real_escape_string($connection, $_POST['durasi']);

    $query = "UPDATE lagu SET 
              judul = '$judul', 
              artis = '$artis', 
              album = '$album', 
              genre = '$genre',
              tahunRilis = '$tahunRilis',
              durasi = '$durasi'
              WHERE no = $no";
    
    if (mysqli_query($connection, $query)) {
        header("Location: index.php?message=Lagu berhasil diupdate");
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
    <title>Edit Lagu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="text-center">Edit Lagu</h3>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>

                        <form method="POST">
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Lagu</label>
                                <input type="text" class="form-control" id="judul" name="judul" 
                                       value="<?php echo htmlspecialchars($lagu['judul']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="artis" class="form-label">Artis</label>
                                <input type="text" class="form-control" id="artis" name="artis" 
                                       value="<?php echo htmlspecialchars($lagu['artis']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="album" class="form-label">Album</label>
                                <input type="text" class="form-control" id="album" name="album" 
                                       value="<?php echo htmlspecialchars($lagu['album']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="genre" class="form-label">Genre</label>
                                <select class="form-control" id="genre" name="genre">
                                    <option value="">Pilih Genre</option>
                                    <option value="Pop" <?php echo ($lagu['genre'] == 'Pop') ? 'selected' : ''; ?>>Pop</option>
                                    <option value="Pop" <?php echo ($lagu['genre'] == 'Rock Pop') ? 'selected' : ''; ?>>Pop</option>
                                    <option value="Rock" <?php echo ($lagu['genre'] == 'Rock') ? 'selected' : ''; ?>>Rock</option>
                                    <option value="Jazz" <?php echo ($lagu['genre'] == 'Jazz') ? 'selected' : ''; ?>>Jazz</option>
                                    <option value="Classical" <?php echo ($lagu['genre'] == 'Classical') ? 'selected' : ''; ?>>Classical</option>
                                    <option value="Hip Hop" <?php echo ($lagu['genre'] == 'Hip Hop') ? 'selected' : ''; ?>>Hip Hop</option>
                                    <option value="R&B" <?php echo ($lagu['genre'] == 'R&B') ? 'selected' : ''; ?>>R&B</option>
                                    <option value="Electronic" <?php echo ($lagu['genre'] == 'Electronic') ? 'selected' : ''; ?>>Electronic</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="tahunRilis" class="form-label">Tahun Rilis</label>
                                <input type="number" class="form-control" id="tahunRilis" name="tahunRilis" 
                                       value="<?php echo $lagu['tahunRilis']; ?>" min="1900" max="2024">
                            </div>
                            <div class="mb-3">
                                <label for="durasi" class="form-label">Durasi</label>
                                <input type="text" class="form-control" id="durasi" name="durasi" 
                                       value="<?php echo $lagu['durasi']; ?>" placeholder="3:45">
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning">Update Lagu</button>
                                <a href="index.php" class="btn btn-secondary">Kembali</a>
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