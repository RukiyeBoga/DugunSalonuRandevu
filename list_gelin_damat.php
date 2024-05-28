<?php
// Veritabanı bağlantısı
include 'db_config.php';

// Gelin ve Damat bilgilerini al
$sql = "SELECT * FROM gelin_bilgileri";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelin ve Damat Bilgileri</title>
</head>
<body>
    <h2>Gelin ve Damat Bilgileri</h2>
    <table>
        <tr>
            <th>Gelin Adı</th>
            <th>Gelin TC Kimlik Numarası</th>
            <th>Gelin Telefon Numarası</th>
            <th>Gelin E-posta Adresi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["gelin_adi"] . "</td>";
                echo "<td>" . $row["gelin_tc"] . "</td>";
                echo "<td>" . $row["gelin_telefon"] . "</td>";
                echo "<td>" . $row["gelin_email"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Kayıt bulunamadı.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
