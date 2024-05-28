<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DJ Seçimi</title>
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
        .dj-container {
            float: left;
            margin: 20px;
        }
        .dj {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .dj img {
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
    <div class="dj-container">
        <form action="dj_sec.php" method="POST">
            <label class="dj">
                <input type="radio" name="dj" value="dj1.png">
                <img src="fotolar/dj1.png" alt="DJ 1">
            </label>
            <label class="dj">
                <input type="radio" name="dj" value="dj2.png">
                <img src="fotolar/dj2.png" alt="DJ 2">
            </label>
            <label class="dj">
                <input type="radio" name="dj" value="dj3.png">
                <img src="fotolar/dj3.png" alt="DJ 3">
            </label>
            <label class="dj">
                <input type="radio" name="dj" value="dj4.png">
                <img src="fotolar/dj4.png" alt="DJ 4">
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
            $selectedDJ = $_POST['dj'];
            if (!empty($selectedDJ)) {
                // SQL sorgusu
                $sql = "INSERT INTO dj_secimleri (dj) VALUES ('$selectedDJ')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                        document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedDJ) . "';
                        document.getElementById('save-button').classList.add('saved');
                        document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                        document.getElementById('save-button').disabled = true;
                        document.querySelectorAll('.dj').forEach(dj => {
                            dj.querySelector('input').disabled = true;
                            dj.classList.add('disabled');
                        });
                    </script>";
                } else {
                    echo "Hata: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Lütfen bir DJ seçin.');</script>";
            }
        }

        $conn->close();
        ?>
    </div>

    <script>
        const djs = document.querySelectorAll('.dj');
        const saveButton = document.getElementById('save-button');

        djs.forEach(dj => {
            dj.addEventListener('click', function() {
                djs.forEach(dj => {
                    dj.classList.remove('selected');
                });
                this.classList.add('selected');
            });
        });
    </script>
</body>
</html>
