<?php
session_start();

// Veritabanı bağlantısı
include 'db_config.php';

// Kayıt Olma İşlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kullanıcı adı ve şifre veritabanına ekleniyor
    $sql_user = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql_user) === TRUE) {
        // Gelin ve Damat bilgileri
        $gelin_adi = $_POST["gelin_adi"];
        $gelin_tc = $_POST["gelin_tc"];
        $gelin_telefon = $_POST["gelin_telefon"];
        $gelin_email = $_POST["gelin_email"];
        $damat_adi = $_POST["damat_adi"];
        $damat_tc = $_POST["damat_tc"];
        $damat_telefon = $_POST["damat_telefon"];
        $damat_email = $_POST["damat_email"];

        // Gelin ve Damat bilgileri veritabanına ekleniyor
        $sql_gelin = "INSERT INTO gelin_bilgileri (gelin_adi, gelin_tc, gelin_telefon, gelin_email) VALUES ('$gelin_adi', '$gelin_tc', '$gelin_telefon', '$gelin_email')";
        $sql_damat = "INSERT INTO damat_bilgileri (damat_adi, damat_tc, damat_telefon, damat_email) VALUES ('$damat_adi', '$damat_tc', '$damat_telefon', '$damat_email')";
        
        if ($conn->query($sql_gelin) === TRUE && $conn->query($sql_damat) === TRUE) {
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("Location: organizasyon_secim.php"); // Kayıt başarılıysa yönlendirme
            exit;
        } else {
            $error = "Kayıt olma hatası: " . $conn->error;
        }
    } else {
        $error = "Kayıt olma hatası: " . $conn->error;
    }
}

// Giriş Yapma İşlemi
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Giriş kodu buraya eklenecek
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gelin ve Damat Bilgi Formu</title>
    <style>
        body {
            background-color: #f4eae6; /* Pudra rengi arka plan */
            font-family: Arial, sans-serif;
        }
        #logo {
            display: block;
            margin: 20px auto; /* Logoyu ortala */
        }
        .form-container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .github-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            font-size: 1.2em;
        }
        .github-link a {
            color: #333;
            text-decoration: none;
            font-weight: bold;
        }
        .github-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <img id="logo" src="fotolar/logo.png" alt="Düğün Salonu Logo">

    <div class="github-link">
        <a href="https://github.com/RukiyeBoga/DugunSalonuRandevu" target="_blank">GitHub Linkim</a>
    </div>

    <div class="form-container">
        <h2>Kayıt Ol</h2>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="register_username">Kullanıcı Adı:</label>
            <input type="text" id="register_username" name="username" required><br><br>
            <label for="register_password">Şifre:</label>
            <input type="password" id="register_password" name="password" required><br><br>
            <label for="gelin_adi">Gelin Adı:</label>
            <input type="text" id="gelin_adi" name="gelin_adi" required><br><br>
            <label for="gelin_tc">Gelin TC Kimlik Numarası:</label>
            <input type="text" id="gelin_tc" name="gelin_tc" required><br><br>
            <label for="gelin_telefon">Gelin Telefon Numarası:</label>
            <input type="text" id="gelin_telefon" name="gelin_telefon" required><br><br>
            <label for="gelin_email">Gelin E-posta Adresi:</label>
            <input type="email" id="gelin_email" name="gelin_email" required><br><br>
            <label for="damat_adi">Damat Adı:</label>
            <input type="text" id="damat_adi" name="damat_adi" required><br><br>
            <label for="damat_tc">Damat TC Kimlik Numarası:</label>
            <input type="text" id="damat_tc" name="damat_tc" required><br><br>
            <label for="damat_telefon">Damat Telefon Numarası:</label>
            <input type="text" id="damat_telefon" name="damat_telefon" required><br><br>
            <label for="damat_email">Damat E-posta Adresi:</label>
            <input type="email" id="damat_email" name="damat_email" required><br><br>
            <input type="submit" name="register" value="Kayıt Ol">
        </form>
    </div>

    <div class="form-container">
        <h2>Giriş Yap</h2>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="login_username">Kullanıcı Adı:</label>
            <input type="text" id="login_username" name="username" required><br><br>
            <label for="login_password">Şifre:</label>
            <input type="password" id="login_password" name="password" required><br><br>
            <input type="submit" name="login" value="Giriş Yap">
        </form>
    </div>
</body>
</html>
