<?php
// Veritabanı bağlantısı için bilgiler
$servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

// Formdan gelen verileri kontrol etme ve veritabanına kaydetme
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["organizasyon_secim"])) {
    // Veritabanı bağlantısını oluştur
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Bağlantıyı kontrol et
    if ($conn->connect_error) {
        die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
    }
    
    // POST verilerini güvenli hale getir
    $organizasyon_tipi = htmlspecialchars($_POST["organizasyon_tipi"]);
    
    // Veritabanına ekleme sorgusu
    $sql = "INSERT INTO organizasyon_secimi (organizasyon_tipi) VALUES ('$organizasyon_tipi')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Seçiminiz başarıyla kaydedildi!');</script>";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }
    
    // Veritabanı bağlantısını kapat
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizasyon Seçimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        
        #logo {
            display: block;
            margin: 0 auto;
        }

        h1 {
            margin-top: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .option {
            text-align: center;
            margin: 10px;
            position: relative;
            cursor: pointer;
        }
        
        .option img {
            width: 150px;
            height: auto;
            border: 2px solid transparent;
            border-radius: 10px;
            transition: border-color 0.3s ease-in-out;
        }
        
        .option p {
            margin-top: 10px;
            font-size: 18px;
        }
        
        .selected img {
            border-color: green;
        }
        
        #kaydetButton, #devamButton {
            width: 200px;
            padding: 15px;
            font-size: 18px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
        
        #kaydetButton:hover, #devamButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <img id="logo" width="300" height="150" src="fotolar/logo.png" alt="Düğün Salonu Logo" >
    <h1>İstediğiniz Organizasyonu Seçin</h1>
    <div class="container">
        <div class="option" onclick="selectOption(this)">
            <img src="fotolar/kina.png" alt="Kına">
            <p>Kına Organizasyonu</p>
            <input type="hidden" name="organizasyon_tipi" value="kina">
        </div>
        <div class="option" onclick="selectOption(this)">
            <img src="fotolar/dugun.png" alt="Düğün">
            <p>Düğün Organizasyonu</p>
            <input type="hidden" name="organizasyon_tipi" value="dugun">
        </div>
    </div>
    
    <div style="text-align: center; margin-top: 30px;">
        <button id="kaydetButton" style="width: 200px; padding: 15px; font-size: 18px; background-color: #4CAF50; color: white; border: none; border-radius: 10px; margin-bottom: 10px;" onclick="kaydet()">Seçimimi Kaydet</button>
        <br>
        <button style="width: 200px; padding: 15px; font-size: 18px; background-color: #4CAF50; color: white; border: none; border-radius: 10px;" onclick="devamEt()">Devam Et</button>
    </div>
    
    <script>
        function selectOption(option) {
            var options = document.querySelectorAll('.option');
            options.forEach(function(opt) {
                opt.classList.remove('selected');
            });
            option.classList.add('selected');
            var kaydetButton = document.getElementById('kaydetButton');
            kaydetButton.style.backgroundColor = '#4CAF50';
            kaydetButton.innerHTML = 'Seçimimi Kaydet';
        }
    
        function kaydet() {
            // Seçilen organizasyonun değerini al
            var organizasyon_tipi = document.querySelector('.option.selected input[name="organizasyon_tipi"]').value;
            // AJAX kullanarak PHP'ye POST isteği gönder
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Seçiminiz kaydedildi!");
                    var kaydetButton = document.getElementById('kaydetButton');
                    kaydetButton.style.backgroundColor = 'green';
                    kaydetButton.innerHTML = 'Seçiminiz Kaydedildi!';
                }
            };
            xhr.send("organizasyon_secim=true&organizasyon_tipi=" + organizasyon_tipi);
        }
    
        function devamEt() {
            window.location.href = "tumsecimler.php";
        }
    </script>
</body>
</html>
