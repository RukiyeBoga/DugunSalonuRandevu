<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizasyon Seçimleri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4eae6;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        #button-container {
            width: 200px;
            padding: 20px;
            background-color: #f4eae6;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        #buttons {
            width: 100%;
            flex-grow: 1;
        }
        #button-container a {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #4CAF50;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        #button-container a:hover {
            background-color: #45a049;
        }
        #logo-container {
            width: 80%;
            padding: 10px;
            text-align: center;
        }
        #logo-container img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        #content-container {
            flex: 1;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }
        iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>
    <div id="button-container">
        <div id="logo-container">
            <img src="fotolar/logo.png" alt="Logo">
        </div>
        <div id="buttons">
            <a href="gelinlik_sec.php" target="content-frame">Gelinlik Seç</a>
            <a href="damatlik_sec.php" target="content-frame">Damatlık Seç</a>
            <a href="mekan_sec.php" target="content-frame">Mekan Seç</a>
            <a href="dj_sec.php" target="content-frame">DJ Seç</a>
            <a href="garson_sec.php" target="content-frame">Garson Seç</a>
            <a href="nikah_memuru_sec.php" target="content-frame">Nikah Memuru Seç</a>
            <a href="menu_sec.php" target="content-frame">Menü Seç</a>
            <a href="tatli_sec.php" target="content-frame">Tatlı Seç</a>
            <a href="tarih_sec.php" target="content-frame">Tarih Seç</a>
            <a href="dugun_salonu_listele.php" target="content-frame">gelin ve damat bilgileri listele</a>
            <a href="bilgi_duzenle.php" target="content-frame">Bilgi Güncelleme</a>
            <a href="bilgi_silme.php" target="content-frame">Bilgi Silme</a>
        </div>
    </div>

    <div id="content-container">
        <iframe name="content-frame"></iframe>
    </div>
</body>
</html>
