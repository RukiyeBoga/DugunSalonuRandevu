<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikah Memuru Seçimi</title>
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
        .memur-container {
            float: left;
            margin: 20px;
        }
        .memur {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .memur img {
            width: 200px;
            height: auto;
            border-radius: 5px;
        }
        .memur p {
            margin-top: 5px;
            text-align: center;
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
    <div class="memur-container">
        <form action="nikah_memuru_sec.php" method="POST">
            <label class="memur">
                <input type="radio" name="memur" value="memur1.png">
                <img src="fotolar/memur1.png" alt="Memur 1 (Ahmet Sadık)">
                <p>Ahmet Sadık</p>
            </label>
            <label class="memur">
                <input type="radio" name="memur" value="memur2.png">
                <img src="fotolar/memur2.png" alt="Memur 2 (Canan Ersoy)">
                <p>Canan Ersoy</p>
            </label>
            <label class="memur">
                <input type="radio" name="memur" value="memur3.png">
                <img src="fotolar/memur3.png" alt="Memur 3 (Celal Sıtkı Cahitoğlu)">
                <p>Celal Sıtkı Cahitoğlu</p>
            </label>
            <label class="memur">
                <input type="radio" name="memur" value="memur4.png">
                <img src="fotolar/memur4.png" alt="Memur 4 (Kendal Burmaz)">
                <p>Kendal Burmaz</p>
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
            $selectedMemur = $_POST['memur'];
            if (!empty($selectedMemur)) {
                // SQL sorgusu
                $sql = "INSERT INTO nikah_memuru_secimleri (memur) VALUES ('$selectedMemur')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                        document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedMemur) . "';
                        document.getElementById('save-button').classList.add('saved');
                        document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                        document.getElementById('save-button').disabled = true;
                        document.querySelectorAll('.memur').forEach(memur => {
                            memur.querySelector('input').disabled = true;
                            memur.classList.add('disabled');
                        });
                    </script>";
                } else {
                    echo "Hata: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Lütfen bir memur seçin.');</script>";
            }
        }

        $conn->close();
        ?>
    </div>

    <script>
        const memurlar = document.querySelectorAll('.memur');
        const saveButton = document.getElementById('save-button');

        memurlar.forEach(memur => {
            memur.addEventListener('click', function() {
                memurlar.forEach(memur => {
                    memur.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
