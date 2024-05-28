<?php
// Düzenlenecek bilgi türü ve ID'sini alın
$type = $_GET['type']; // hangi tablo
$id = $_GET['id']; // güncellenecek ID

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

// Gelin veya damat tablosuna göre sorguyu hazırla
$select_sql = "";
if ($type == 'gelin') {
    $select_sql = "SELECT * FROM gelin_bilgileri WHERE gelin_id=$id";
} elseif ($type == 'damat') {
    $select_sql = "SELECT * FROM damat_bilgileri WHERE damat_id=$id";
}

// Sorguyu çalıştır
$result = $conn->query($select_sql);

// Veritabanından bilgileri al ve düzenleme formunu göster
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>$type Bilgileri Düzenle</h2>";
    echo "<form action='update.php' method='post'>";
    echo "Ad: <input type='text' name='ad' value='".$row["gelin_adi"]."'><br>";
    echo "Telefon: <input type='text' name='telefon' value='".$row["gelin_telefon"]."'><br>";
    echo "E-Mail: <input type='text' name='email' value='".$row["gelin_email"]."'><br>";
    echo "<input type='hidden' name='type' value='$type'>";
    echo "<input type='hidden' name='id' value='$id'>";
    echo "<input type='submit' value='Güncelle'>";
    echo "</form>";
} else {
    echo "Belirtilen bilgi bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
