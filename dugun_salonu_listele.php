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

// Gelin bilgilerini almak için SQL sorgusu
$gelin_sql = "SELECT * FROM gelin_bilgileri";

// SQL sorgusunu çalıştırma
$gelin_result = $conn->query($gelin_sql);

// Gelin bilgilerini listeleme
if ($gelin_result->num_rows > 0) {
    echo "<h2>Gelin Bilgileri</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Gelin ID</th><th>Gelin Adı</th><th>Gelin TC</th><th>Gelin Telefon</th><th>Gelin Email</th></tr>";
    while($row = $gelin_result->fetch_assoc()) {
        echo "<tr><td>".$row["gelin_id"]."</td><td>".$row["gelin_adi"]."</td><td>".$row["gelin_tc"]."</td><td>".$row["gelin_telefon"]."</td><td>".$row["gelin_email"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Gelin bilgisi bulunamadı.";
}

// Damat bilgilerini almak için SQL sorgusu
$damat_sql = "SELECT * FROM damat_bilgileri";

// SQL sorgusunu çalıştırma
$damat_result = $conn->query($damat_sql);

// Damat bilgilerini listeleme
if ($damat_result->num_rows > 0) {
    echo "<h2>Damat Bilgileri</h2>";
    echo "<table border='1'>";
    echo "<tr><th>Damat ID</th><th>Damat Adı</th><th>Damat TC</th><th>Damat Telefon</th><th>Damat Email</th></tr>";
    while($row = $damat_result->fetch_assoc()) {
        echo "<tr><td>".$row["damat_id"]."</td><td>".$row["damat_adi"]."</td><td>".$row["damat_tc"]."</td><td>".$row["damat_telefon"]."</td><td>".$row["damat_email"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Damat bilgisi bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
