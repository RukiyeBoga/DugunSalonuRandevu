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

// Gelin bilgilerini listeleme
$gelin_sql = "SELECT * FROM gelin_bilgileri";
$gelin_result = $conn->query($gelin_sql);

echo "<h2>Gelin Bilgileri</h2>";
if ($gelin_result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Ad</th><th>Telefon</th><th>E-Mail</th><th>İşlem</th></tr>";
    while ($row = $gelin_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["gelin_id"] . "</td>";
        echo "<td>" . $row["gelin_adi"] . "</td>";
        echo "<td>" . $row["gelin_telefon"] . "</td>";
        echo "<td>" . $row["gelin_email"] . "</td>";
        echo "<td><a href='sil.php?type=Gelin&id=" . $row["gelin_id"] . "'>Sil</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Gelin bilgisi bulunamadı.";
}

// Damat bilgilerini listeleme
$damat_sql = "SELECT * FROM damat_bilgileri";
$damat_result = $conn->query($damat_sql);

echo "<h2>Damat Bilgileri</h2>";
if ($damat_result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Ad</th><th>Telefon</th><th>E-Mail</th><th>İşlem</th></tr>";
    while ($row = $damat_result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["damat_id"] . "</td>";
        echo "<td>" . $row["damat_adi"] . "</td>";
        echo "<td>" . $row["damat_telefon"] . "</td>";
        echo "<td>" . $row["damat_email"] . "</td>";
        echo "<td><a href='sil.php?type=Damat&id=" . $row["damat_id"] . "'>Sil</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Damat bilgisi bulunamadı.";
}

// Veritabanı bağlantısını kapatma
$conn->close();
?>
