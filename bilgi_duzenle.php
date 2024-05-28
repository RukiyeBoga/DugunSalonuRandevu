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

// Veritabanından gelin bilgilerini getirme
$select_gelin_sql = "SELECT * FROM gelin_bilgileri";
$result_gelin = $conn->query($select_gelin_sql);

// Veritabanından damat bilgilerini getirme
$select_damat_sql = "SELECT * FROM damat_bilgileri";
$result_damat = $conn->query($select_damat_sql);

if ($result_gelin->num_rows > 0 || $result_damat->num_rows > 0) {
    // Verileri tablo şeklinde gösterme
    echo "<h2>Gelin Bilgileri</h2>";
    echo "<table><tr><th>ID</th><th>Ad</th><th>Email</th><th>Düzenle</th></tr>";
    while($row = $result_gelin->fetch_assoc()) {
        echo "<tr><td>".$row["gelin_id"]."</td><td>".$row["gelin_adi"]."</td><td>".$row["gelin_email"]."</td><td><a href='edit.php?type=gelin&id=".$row["gelin_id"]."'>Düzenle</a></td></tr>";
    }
    echo "</table>";

    echo "<h2>Damat Bilgileri</h2>";
    echo "<table><tr><th>ID</th><th>Ad</th><th>Email</th><th>Düzenle</th></tr>";
    while($row = $result_damat->fetch_assoc()) {
        echo "<tr><td>".$row["damat_id"]."</td><td>".$row["damat_adi"]."</td><td>".$row["damat_email"]."</td><td><a href='edit.php?type=damat&id=".$row["damat_id"]."'>Düzenle</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Gelin ve damat bilgileri bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
