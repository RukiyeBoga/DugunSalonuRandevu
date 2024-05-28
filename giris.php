<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <style>
        body {
            background-color: #f4eae6; /* Pudra rengi arka plan */
            font-family: Arial, sans-serif;
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
        input[type="password"] {
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
    </style>
</head>
<body>
    <img id="logo" src="fotolar/logo.png" alt="Düğün Salonu Logo">

    <div class="form-container">
        <h2>Giriş Yap</h2>
        <?php if (isset($error)) { ?>
            <p><?php echo $error; ?></p>
        <?php } ?>
        <form method="post" action="organizasyon_secim.php"> <!-- Giriş yapıldıktan sonra yönlendirme organizasyon_secim.php sayfasına yapılacak -->
            <label for="login_username">Kullanıcı Adı:</label>
            <input type="text" id="login_username" name="username" required><br><br>
            <label for="login_password">Şifre:</label>
            <input type="password" id="login_password" name="password" required><br><br>
            <input type="submit" name="login" value="Giriş Yap">
        </form>
    </div>
</body>
</html>
