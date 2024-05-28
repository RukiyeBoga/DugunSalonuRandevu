<?php
// Veritabanı bağlantısı
include 'db_config.php';

// Formdan gelen verileri al
$damat_adi = $_POST["damat_adi"];
$damat_tc = $_POST["damat_tc"];
$damat_telefon = $_POST["damat_telefon"];
$damat_email = $_POST["damat_email"];

// Damat bilgilerini veritabanına ekle
$sql_damat = "INSERT INTO damat_bilgileri (damat_adi, damat_tc, damat_telefon, damat_email) VALUES ('$damat_adi', '$damat_tc', '$damat_telefon', '$damat_email')";

if ($conn->query($sql_damat) === TRUE) {
    // Başarılı ekleme durumunda yapılacak işlemler buraya gelecek
    header("Location: welcome.php"); // Örneğin, kullanıcıyı hoş geldiniz sayfasına yönlendirme
    exit;
} else {
    echo "Hata: " . $sql_damat . "<br>" . $conn->error;
}
?>
