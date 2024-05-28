<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasta Seçimi</title>
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
        .pasta-container {
            float: left;
            margin: 20px;
        }
        .pasta {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .pasta img {
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
        .pasta p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="pasta-container">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label class="pasta">
                <input type="radio" name="pasta" value="Pasta 1">
                <img src="fotolar/pasta1.png" alt="Pasta 1">
                <p>Pasta 1</p>
            </label>
            <label class="pasta">
                <input type="radio" name="pasta" value="Pasta 2">
                <img src="fotolar/pasta2.png" alt="Pasta 2">
                <p>Pasta 2</p>
            </label>
            <label class="pasta">
                <input type="radio" name="pasta" value="Pasta 3">
                <img src="fotolar/pasta3.png" alt="Pasta 3">
                <p>Pasta 3</p>
            </label>
            <div id="button-container">
                <button type="submit" id="save-button">Seçimi Kaydet</button>
            </div>
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // POST isteğiyle gelen seçilen pasta adını al
        $pastaAdi = $_POST['pasta'];

        // Veritabanına bağlan
        $servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bağlantıyı kontrol et
        if ($conn->connect_error) {
            die("Bağlantı hatası: " . $conn->connect_error);
        }

        // Seçilen pastayı veritabanına ekle
        $sql = "INSERT INTO pastalar (pasta_adı) VALUES ('$pastaAdi')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='text-align: center;'>Yeni pasta başarıyla eklendi</p>";
        } else {
            echo "<p style='text-align: center;'>Hata: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>

</body>
</html>
