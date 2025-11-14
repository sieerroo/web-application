<?php
include 'config/database.php';

if (isset($_GET['no'])) {
    $no = $_GET['no'];
    
    $query = "DELETE FROM lagu WHERE no = $no";
    
    if (mysqli_query($connection, $query)) {
        header("Location: index.php?message=Lagu berhasil dihapus");
    } else {
        header("Location: index.php?error=Gagal menghapus lagu");
    }
} else {
    header("Location: index.php");
}

mysqli_close($connection);
exit();
?>