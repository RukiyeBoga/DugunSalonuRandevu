<?php
// Veritabanı bağlantısı
include 'db_config.php';

// Formdan gelen verileri al
$gelin_adi = $_POST["gelin_adi"];
$gelin_tc = $_POST["gelin_tc"];
$gelin_telefon = $_POST["gelin_telefon"];
$gelin_email = $_POST["gelin_email"];
$damat_adi = $_POST["damat_adi"];
$damat_tc = $_POST["damat_tc"];
$damat_telefon = $_POST["damat_telefon"];
$damat_email = $_POST["damat_email"];

// Gelin ve Damat bilgilerini veritabanına ekle
$sql_gelin = "INSERT INTO gelin_bilgileri (gelin_adi, gelin_tc, gelin_telefon, gelin_email) VALUES ('$gelin_adi', '$gelin_tc', '$gelin_telefon', '$gelin_email')";
$sql_damat = "INSERT INTO damat_bilgileri (damat_adi, damat_tc, damat_telefon, damat_email) VALUES ('$damat_adi', '$damat_tc', '$damat_telefon', '$damat_email')";

if ($conn->query($sql_gelin) === TRUE && $conn->query($sql_damat) === TRUE) {
    // Başarılı ekleme durumunda yapılacak işlemler buraya gelecek
    header("Location: welcome.php"); // Örneğin, kullanıcıyı hoş geldiniz sayfasına yönlendirme
    exit;
} else {
    echo "Hata: " . $sql_gelin . "<br>" . $conn->error;
}
?>
