<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menü Seçimi</title>
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
        .menu-container {
            float: left;
            margin: 20px;
        }
        .menu {
            display: block;
            margin-bottom: 20px;
            border: 2px solid transparent;
            cursor: pointer;
        }
        .menu img {
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
        .menu p {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <form action="menu_sec.php" method="POST">
            <label class="menu">
                <input type="radio" name="menu" value="menu1.png">
                <img src="fotolar/menu1.png" alt="Menü 1">
                <p>Menü 1</p>
            </label>
            <label class="menu">
                <input type="radio" name="menu" value="menu2.png">
                <img src="fotolar/menu2.png" alt="Menü 2">
                <p>Menü 2</p>
            </label>
            <label class="menu">
                <input type="radio" name="menu" value="menu3.png">
                <img src="fotolar/menu3.png" alt="Menü 3">
                <p>Menü 3</p>
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
            $selectedMenu = $_POST['menu'];
            if (!empty($selectedMenu)) {
                // SQL sorgusu
                $sql = "INSERT INTO menu_secimleri (menu) VALUES ('$selectedMenu')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<script>
                        document.getElementById('message').innerText = 'Seçim Kaydedildi: " . htmlspecialchars($selectedMenu) . "';
                        document.getElementById('save-button').classList.add('saved');
                        document.getElementById('save-button').innerText = 'Seçim Kaydedildi';
                        document.getElementById('save-button').disabled = true;
                        document.querySelectorAll('.menu').forEach(menu => {
                            menu.querySelector('input').disabled = true;
                            menu.classList.add('disabled');
                        });
                    </script>";
                } else {
                    echo "Hata: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "<script>alert('Lütfen bir menü seçin.');</script>";
            }
        }

        $conn->close();
        ?>
    </div>

    <script>
        const menus = document.querySelectorAll('.menu');
        const saveButton = document.getElementById('save-button');

        menus.forEach(menu => {
            menu.addEventListener('click', function() {
                menus.forEach(menu => {
                    menu.classList.remove('selected');
                });
                this
