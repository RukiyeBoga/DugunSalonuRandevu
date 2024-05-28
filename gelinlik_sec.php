<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelinlik Seçimi</title>
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
        .gelinlik-container {
            float: left;
            margin: 20px;
        }
        .gelinlik {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .gelinlik img {
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
    <div class="gelinlik-container">
        <form action="gelinlik_sec.php" method="POST">
            <label class="gelinlik">
                <input type="radio" name="gelinlik" value="gelinlik1">
                <img src="fotolar/gelinlik1.png" alt="Gelinlik 1">
                <p>Prenses Model</p>
            </label>
            <label class="gelinlik">
                <input type="radio" name="gelinlik" value="gelinlik2">
                <img src="fotolar/gelinlik2.png" alt="Gelinlik 2">
                <p>İncili Kabarık Model</p>
            </label>
            <label class="gelinlik">
                <input type="radio" name="gelinlik" value="gelinlik3">
                <img src="fotolar/gelinlik3.png" alt="Gelinlik 3">
                <p>Dantelli Model</p>
            </label>
            <label class="gelinlik">
                <input type="radio" name="gelinlik" value="gelinlik4">
                <img src="fotolar/gelinlik4.png" alt="Gelinlik 4">
                <p>Balık Model</p>
            </label>
            <div id="button-container">
                <button type="submit" id="save-button">Seçimi Kaydet</button>
            </div>
        </form>
    </div>

    <div id="message">
        <?php
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

    // POST verisi gönderildiğinde
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Seçilen gelinlik değerini al
        $selectedGelinlik = $_POST['gelinlik'];

        // Boş olup olmadığını kontrol et
        if (!empty($selectedGelinlik)) {
            // SQL sorgusu
            $sql = "INSERT INTO gelinlik_secimleri (gelinlik) VALUES ('$selectedGelinlik')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                    document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedGelinlik) . "';
                    document.getElementById('save-button').classList.add('saved');
                    document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                    document.getElementById('save-button').disabled = true;
                    document.querySelectorAll('.gelinlik').forEach(gelinlik => {
                        gelinlik.querySelector('input').disabled = true;
                        gelinlik.classList.add('disabled');
                    });
                </script>";
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('Lütfen bir gelinlik seçin.');</script>";
        }
    }

    $conn->close();
    ?>
</div>

<script>
    const gelinlikler = document.querySelectorAll('.gelinlik');
    const saveButton = document.getElementById('save-button');

    gelinlikler.forEach(gelinlik => {
        gelinlik.addEventListener('click', function() {
            gelinlikler.forEach(gelinlik => {
                gelinlik.classList.remove('selected');
            });
            this.classList.add('selected');
        });
    });
</script>
</body>
</html>
