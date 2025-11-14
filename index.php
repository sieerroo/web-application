<?php
include 'config/database.php';
$search = isset($_GET['search']) ? $_GET['search'] : '';

if(!empty($search)) {
    $query = "SELECT * FROM lagu WHERE judul LIKE '%$search%' OR artis LIKE '%$search%' OR album LIKE '%$search%' OR genre LIKE '%$search%' OR tahunRilis LIKE '%$search%' OR durasi LIKE '%$search%'";
} else {
    $query = "SELECT * FROM lagu ORDER BY no ASC";
}

$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Music Management</h1>

        <form method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="search song.." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit">CARI</button>
            </div>
        </form>

        <div class="mb-3">
            <a href="create.php" class="btn btn-success">TAMBAH LAGU</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Artis</th>
                        <th>Album</th>
                        <th>Genre</th>
                        <th>Tahun Rilis</th>
                        <th>Durasi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['no']; ?></td>
                        <td><?php echo htmlspecialchars($row['judul']); ?></td>
                        <td><?php echo htmlspecialchars($row['artis']); ?></td>
                        <td><?php echo htmlspecialchars($row['album']); ?></td>
                        <td><?php echo htmlspecialchars($row['genre']); ?></td>
                        <td><?php echo $row['tahunRilis']; ?></td>
                        <td><?php echo $row['durasi']; ?></td>
                        <td>
                            <a href="edit.php?no=<?php echo $row['no']; ?>" class="btn btn-warning btn-sm">EDIT</a>
                            <a href="delete.php?no=<?php echo $row['no']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Mau hapus lagu ini?')">HAPUS</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php if(mysqli_num_rows($result) === 0): ?>
        <div class="alert alert-info text-center">
            <?php echo empty($search) ? 'Gak ada data lagu nih!' : 'Waduh, gak ada nih :)'; ?>
        </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php mysqli_close($connection); ?>