<?php
include 'data.php';

$errors = [];
$nama = $email = $hp = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validasi Nama
    if (empty($_POST['nama'])) {
        $errors[] = 'Nama wajib diisi!';
    } else {
        $nama = trim($_POST['nama']);
    }

    // Validasi Email
    if (empty($_POST['email'])) {
        $errors[] = 'Email wajib diisi!';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Format email tidak valid!';
    } else {
        $email = trim($_POST['email']);
    }

    // Validasi No HP
    if (empty($_POST['hp'])) {
        $errors[] = 'Nomor HP wajib diisi!';
    } else {
        $hp = trim($_POST['hp']);
    }

    // Jika tidak ada error → simpan & redirect
    if (empty($errors)) {

        $_SESSION['contacts'][] = [
            'nama'  => $nama,
            'email' => $email,
            'hp'    => $hp
        ];

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Tambah Kontak</h2>

<?php if (!empty($errors)): ?>
<div class="error-box">
    <ul>
        <?php foreach ($errors as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<form method="POST">
    Nama: <br>
    <input type="text" name="nama" value="<?= htmlspecialchars($nama) ?>"><br><br>

    Email: <br>
    <input type="text" name="email" value="<?= htmlspecialchars($email) ?>"><br><br>

    Nomor HP: <br>
    <input type="text" name="hp" value="<?= htmlspecialchars($hp) ?>"><br><br>

    <button type="submit">Simpan</button>
    <a href="index.php">Kembali</a>
</form>

</body>
</html>
