<!-- delete_gelin_damat.php -->
<?php
// Veritabanı bağlantısı
include 'db_config.php';

// Silinecek gelin veya damatın ID'sini al
$id = $_GET['id'];

// Veritabanından gelin veya damat bilgilerini sil
$sql = "DELETE FROM gelin_bilgileri WHERE gelin_id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Gelin veya Damat bilgileri başarıyla silindi.";
} else {
    echo "Hata: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();
?>
