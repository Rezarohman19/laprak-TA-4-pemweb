<?php include 'data.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kontak</title>
    <button id="darkToggle" class="dark-btn">Dark Mode</button>
   <link rel="stylesheet" href="style.css">
</head>
<script>
    const toggle = document.getElementById('darkToggle');
    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');

        // simpan preferensi
        if (document.body.classList.contains('dark')) {
            localStorage.setItem('theme', 'dark');
            toggle.textContent = " Light Mode";
        } else {
            localStorage.setItem('theme', 'light');
            toggle.textContent = " Dark Mode";
        }
    });

    // ambil preferensi saat halaman dibuka
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        toggle.textContent = " Light Mode";
    }
</script>
<body>


<h2>Daftar Kontak</h2>

<p><a href="add.php">+ Tambah Kontak Baru</a></p>

<?php
// Hapus kontak
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['contacts'][$id]);
    echo "<p style='color:red;'>Kontak berhasil dihapus.</p>";
}
?>

<table>
    <tr>
        <th>Nama</th>
        <th>Email</th>
        <th>No. HP</th>
        <th>Aksi</th>
    </tr>

    <?php if (!empty($_SESSION['contacts'])): ?>
        <?php foreach ($_SESSION['contacts'] as $id => $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nama']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['hp']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $id ?>">Edit</a> | 
                    <a href="index.php?hapus=<?= $id ?>" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="4">Belum ada kontak.</td></tr>
    <?php endif; ?>

</table>

</body>
</html>
