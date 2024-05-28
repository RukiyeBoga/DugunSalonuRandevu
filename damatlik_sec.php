<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Damatlık Seçimi</title>
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
        .damatlik-container {
            float: left;
            margin: 20px;
        }
        .damatlik {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .damatlik img {
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
    <div class="damatlik-container">
        <form action="damatlik_sec.php" method="POST">
            <label class="damatlik">
                <input type="radio" name="damatlik" value="damatlik1.png">
                <img src="fotolar/damatlik1.png" alt="Damatlık 1">
            </label>
            <label class="damatlik">
                <input type="radio" name="damatlik" value="damatlik2.png">
                <img src="fotolar/damatlik2.png" alt="Damatlık 2">
            </label>
            <label class="damatlik">
                <input type="radio" name="damatlik" value="damatlik3.png">
                <img src="fotolar/damatlik3.png" alt="Damatlık 3">
            </label>
            <label class="damatlik">
                <input type="radio" name="damatlik" value="damatlik4.png">
                <img src="fotolar/damatlik4.png" alt="Damatlık 4">
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
            $selectedDamatlik = $_POST['damatlik'];
            if (!empty($selectedDamatlik)) {
                // SQL sorgusu
                $sql = "INSERT INTO damatlik_secimleri (damatlik) VALUES ('$selectedDamatlik')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                        document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedDamatlik) . "';
                        document.getElementById('save-button').classList.add('saved');
                        document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                        document.getElementById('save-button').disabled = true;
                        document.querySelectorAll('.damatlik').forEach(damatlik => {
                            damatlik.querySelector('input').disabled = true;
                            damatlik.classList.add('disabled');
                        });
                    </script>";
                } else {
                    echo "Hata: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Lütfen bir damatlık seçin.');</script>";
            }
        }

        $conn->close();
        ?>
    </div>

    <script>
        const damatliklar = document.querySelectorAll('.damatlik');
        const saveButton = document.getElementById('save-button');

        damatliklar.forEach(damatlik => {
            damatlik.addEventListener('click', function() {
                damatliklar.forEach(damatlik => {
                    damatlik.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
