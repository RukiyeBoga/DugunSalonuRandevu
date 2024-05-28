<?php
// Veritabanı bağlantısı
$servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

// Veritabanına bağlanma
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

// Silme işlemi için gelen parametreleri al
$type = $_GET['type'];
$id = $_GET['id'];

// Sorguyu hazırla ve çalıştır
if ($type == 'Gelin') {
    $sql = "DELETE FROM gelin_bilgileri WHERE gelin_id=$id";
} elseif ($type == 'Damat') {
    $sql = "DELETE FROM damat_bilgileri WHERE damat_id=$id";
}

if ($conn->query($sql) === TRUE) {
    echo "Kayıt başarıyla silindi.";
} else {
    echo "Silme hatası: " . $conn->error;
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
