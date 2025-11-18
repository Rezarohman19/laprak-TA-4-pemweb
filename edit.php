<?php
include 'data.php';

// Jika ID tidak ada
if (!isset($_GET['id']) || !isset($_SESSION['contacts'][$_GET['id']])) {
    die("Kontak tidak ditemukan.");
}

$id = $_GET['id'];
$contact = $_SESSION['contacts'][$id];

$errors = [];
$nama = $contact['nama'];
$email = $contact['email'];
$hp = $contact['hp'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validasi sama seperti tambah
    if (empty($_POST['nama'])) $errors[] = "Nama wajib diisi!";
    else $nama = trim($_POST['nama']);

    if (empty($_POST['email'])) $errors[] = "Email wajib diisi!";
    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        $errors[] = "Format email tidak valid!";
    else $email = trim($_POST['email']);

    if (empty($_POST['hp'])) $errors[] = "Nomor HP wajib diisi!";
    else $hp = trim($_POST['hp']);

    if (empty($errors)) {
        $_SESSION['contacts'][$id] = [
            'nama'  => $nama,
            'email' => $email,
            'hp'    => $hp
        ];
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kontak</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Kontak</h2>

<?php if ($errors): ?>
    <ul>
    <?php foreach($errors as $e): ?>
        <li><?= $e ?></li>
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

    <button type="submit">Update</button>
    <a href="index.php">Batal</a>
</form>

</body>
</html>
