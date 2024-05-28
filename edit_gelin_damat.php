<!-- edit_gelin_damat.php -->
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelin ve Damat Bilgilerini Düzenle</title>
</head>
<body>
    <h2>Gelin ve Damat Bilgilerini Düzenle</h2>
    <?php
    // Veritabanı bağlantısı
    include 'db_config.php';

    // Düzenlenecek gelin veya damatın ID'sini al
    $id = $_GET['id'];

    // Veritabanından gelin veya damat bilgilerini seç
    $sql = "SELECT * FROM gelin_bilgileri WHERE gelin_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Düzenleme formunu göster
        ?>
        <form action="update_gelin_damat.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="gelin_adi">Gelin Adı:</label>
            <input type="text" id="gelin_adi" name="gelin_adi" value="<?php echo $row['gelin_adi']; ?>" required><br><br>
            <!-- Diğer gerekli alanları buraya ekleyin -->
            <input type="submit" value="Güncelle">
        </form>
        <?php
    } else {
        echo "Gelin veya Damat bilgileri bulunamadı.";
    }
    ?>
</body>
</html>
