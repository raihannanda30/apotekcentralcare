<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan server Anda jika perlu
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "komentarDB"; // Nama database yang telah dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari permintaan POST
$name = $_POST['name'];
$comment = $_POST['comment'];

// Menyiapkan dan mengeksekusi pernyataan SQL
$stmt = $conn->prepare("INSERT INTO komentar (name, comment) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $comment);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Komentar berhasil disimpan."]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan komentar."]);
}

// Menutup koneksi
$stmt->close();
$conn->close();
?>
