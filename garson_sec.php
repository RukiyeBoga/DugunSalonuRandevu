<?php
// Veritabanına bağlanma işlemi
$servername = "sql108.infinityfree.com";
$username = "if0_36633708";
$password = "bSLHb74kU7";
$database = "if0_36633708_dugun_veritabani";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Veritabanına bağlanırken hata oluştu: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedGarsonlarNames = json_decode(file_get_contents('php://input'), true);

    // Seçilen garsonların veritabanına kaydedilmesi
    $stmt = $conn->prepare("INSERT INTO garsonlar (name) VALUES (?)");

    foreach ($selectedGarsonlarNames as $name) {
        $stmt->bind_param("s", $name);
        $stmt->execute();
    }

    if ($stmt->affected_rows > 0) {
        echo json_encode(array("success" => true));
    } else {
        echo json_encode(array("success" => false, "error" => $stmt->error));
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garson Seçimi</title>
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
        #save-button {
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
        #save-button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        .garson-container {
            float: left;
            margin: 20px;
        }
        .garson {
            display: inline-block;
            margin-right: 20px;
            cursor: pointer;
            border: 2px solid transparent;
        }
        .garson img {
            width: 150px;
            height: auto;
            border-radius: 5px;
        }
        .selected {
            border: 2px solid green;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="garson-container">
        <div class="garson">
            <img src="fotolar/garson1.png" alt="Garson 1" data-name="Selin">
            <p>Selin</p>
        </div>
        <div class="garson">
            <img src="fotolar/garson2.png" alt="Garson 2" data-name="Suat">
            <p>Suat</p>
        </div>
        <div class="garson">
            <img src="fotolar/garson3.png" alt="Garson 3" data-name="Cemil">
            <p>Cemil</p>
        </div>
        <div class="garson">
            <img src="fotolar/garson4.png" alt="Garson 4" data-name="Seda">
            <p>Seda</p>
        </div>
        <div class="garson">
            <img src="fotolar/garson5.png" alt="Garson 5" data-name="Yusuf">
            <p>Yusuf</p>
        </div>
        <div class="garson">
            <img src="fotolar/garson6.png" alt="Garson 6" data-name="Orhan">
            <p>Orhan</p>
        </div>
    </div>

    <div id="button-container">
        <button id="save-button">Seçimi Kaydet</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const garsonlar = document.querySelectorAll('.garson');
            const saveButton = document.getElementById('save-button');
            let selectedGarsonlar = [];

            function handleClick() {
                if (selectedGarsonlar.length < 3 || selectedGarsonlar.includes(this)) {
                    if (selectedGarsonlar.includes(this)) {
                        const index = selectedGarsonlar.indexOf(this);
                        selectedGarsonlar.splice(index, 1);
                        this.classList.remove('selected');
                    } else {
                        selectedGarsonlar.push(this);
                        this.classList.add('selected');
                    }
                } else {
                    alert('En fazla 3 garson seçebilirsiniz.');
                }
            }

            garsonlar.forEach(garson => {
                garson.addEventListener('click', handleClick);
            });

            saveButton.addEventListener('click', function() {
                if (selectedGarsonlar.length === 3) {
                    const selectedGarsonlarNames = selectedGarsonlar.map(garson => garson.querySelector('img').getAttribute('data-name'));

                    // AJAX ile seçilen garsonları PHP dosyasına gönderme
                    const xhr = new XMLHttpRequest();
                    const url = window.location.href;
                    xhr.open("POST", url, true);
                    xhr.setRequestHeader("Content-Type", "application/json");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const response = JSON.parse(xhr.responseText);
                            if (response.success) {
                                alert('Seçilen garsonlar başarıyla kaydedildi.');
                                saveButton.innerText = 'Seçim Kaydedildi';
                                saveButton.disabled = true;
                                garsonlar.forEach(garson => {
                                    garson.removeEventListener('click', handleClick);
                                    garson.classList.add('disabled');
                                });
                            } else {
                                alert('Bir hata oluştu. Lütfen tekrar deneyin.');
                            }
                        }
                    };
                    const data = JSON.stringify(selectedGarsonlarNames);
                    xhr.send(data);
                } else {
                    alert('Lütfen 3 garson seçin.');
                }
            });
        });
    </script>
</body>
</html>
