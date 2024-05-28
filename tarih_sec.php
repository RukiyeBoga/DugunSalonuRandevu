<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarih Seçimi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4eae6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        #date-time-container {
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #date-time-container input[type="datetime-local"] {
            width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }
        #date-time-container button {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #date-time-container button:hover {
            background-color: #45a049;
        }
        #message {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div id="date-time-container">
        <form action="tarih_sec.php" method="POST">
            <input type="datetime-local" id="date-time" name="date-time">
            <button type="submit" id="save-button">Tarihi Kaydet</button>
        </form>
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
                $selectedDateTime = $_POST['date-time'];
                if (!empty($selectedDateTime)) {
                    // SQL sorgusu
                    $sql = "INSERT INTO randevular (tarih) VALUES ('$selectedDateTime')";
                    
                    if ($conn->query($sql) === TRUE) {
                        echo "Tarih Kaydedildi: " . htmlspecialchars($selectedDateTime) . ". Randevunuz başarıyla oluşturulmuştur.";
                    } else {
                        echo "Hata: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Lütfen bir tarih ve saat seçin.";
                }
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
