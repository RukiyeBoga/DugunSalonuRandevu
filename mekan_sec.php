<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mekan Seçimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4eae6;
            margin: 0;
            padding: 0;
        }
        #button-container {
            clear: both;
            padding: 20px;
            text-align: center;
        }
        #button-container button {
            display: inline-block;
            width: 150px;
            padding: 10px;
            margin-right: 10px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #button-container button:hover {
            background-color: #45a049;
        }
        .mekan-container {
            float: left;
            margin: 20px;
        }
        .mekan {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .mekan img {
            width: 200px;
            height: auto;
            border-radius: 5px;
        }
        .selected {
            border-color: green;
        }
        .saved {
            background-color: #008CBA;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="mekan-container">
        <form action="mekan_sec.php" method="POST">
            <label class="mekan">
                <input type="radio" name="mekan" value="salon1.png">
                <img src="fotolar/salon1.png" alt="Salon 1">
            </label>
            <label class="mekan">
                <input type="radio" name="mekan" value="salon2.png">
                <img src="fotolar/salon2.png" alt="Salon 2">
            </label>
            <label class="mekan">
                <input type="radio" name="mekan" value="salon3.png">
                <img src="fotolar/salon3.png" alt="Salon 3">
            </label>
            <label class="mekan">
                <input type="radio" name="mekan" value="salon4.png">
                <img src="fotolar/salon4.png" alt="Salon 4">
            </label>
            <div id="button-container">
                <button type="submit" id="save-button">Seçimi Kaydet</button>
            </div>
        </form>
    </div>

    <div id="message">
        <?php
        // Veritabanı bağlantısı
        $servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

        // Bağlantıyı oluştur
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $selectedMekan = $_POST['mekan'];
            if (!empty($selectedMekan)) {
                // SQL sorgusu
                $sql = "INSERT INTO mekan_secimleri (mekan) VALUES ('$selectedMekan')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                        document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedMekan) . "';
                        document.getElementById('save-button').classList.add('saved');
                        document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                        document.getElementById('save-button').disabled = true;
                        document.querySelectorAll('.mekan').forEach(mekan => {
                            mekan.querySelector('input').disabled = true;
                            mekan.classList.add('disabled');
                        });
                    </script>";
                } else {
                    echo "Hata: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Lütfen bir mekan seçin.');</script>";
            }
        }

        $conn->close();
        ?>
    </div>

    <script>
        const mekanlar = document.querySelectorAll('.mekan');
        const saveButton = document.getElementById('save-button');

        mekanlar.forEach(mekan => {
            mekan.addEventListener('click', function() {
                mekanlar.forEach(mekan => {
                    mekan.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
