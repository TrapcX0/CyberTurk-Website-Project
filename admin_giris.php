<?php
session_start();
require 'db.php';
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //burada giriş bilgilerini xss saldırılarına karşı koruma önlemi aldık.
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

    //buradaysa sql injhectiona karşı önlem aldık 
    $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username AND role = 'admin'");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //şifre doğrulama ve giriş kontrolü yapıyoz
    if($user && password_verify($password, $user["password"])){
        $_SESSION["admin_logged_in"] = true;
        header("Location: admin-panel.php");
        exit;
    } else {
        $_SESSION["error_message"] = "Hatalı giriş! Lütfen tekrar deneyin.";
        header("Location: admin_giris.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Girişi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #009acd;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Paneli Girişi</h2>

        <?php if (!empty($_SESSION["error_message"])): ?>
            <p class="error"><?php echo $_SESSION["error_message"]; unset($_SESSION["error_message"]); ?></p>
        <?php endif; ?>

        <form action="admin_giris.php" method="POST">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            <input type="password" name="password" placeholder="Şifre" required>
            <button type="submit">Giriş Yap</button>
        </form>
    </div>
</body>
</html>