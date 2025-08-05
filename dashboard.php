<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    session_regenerate_id(true);    //oturum sabitleme saldırılarına karşı önlem aldım unutma ha!
}
require 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: giris.php, true, 302");          //kullanıcı sisteme düştüyse giriş sayfasına yönlendiriliyor.
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberTürk Dashboard</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <header>
        <h1 style="color: #ffffff; font-weight: bold;">Hoş Geldiniz, <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>!</h1>
        <p style="color: #ddd; font-size: 18px;">CyberTürk sistemine giriş yaptınız.</p>
        <a href="cikis.php" style="display: inline-block; padding: 10px 15px; background-color: #ff0000; color: white; text-decoration: none; border-radius: 5px;">Çıkış Yap</a>


    </header>

</body>

</html>