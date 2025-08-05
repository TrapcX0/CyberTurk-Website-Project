<?php
session_start();
require 'db.php';

if (!isset($_SESSION["user_id"])) {
    die("Giriş yapmadınız!");
}

$user_id = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $old_password = trim($_POST["old_password"]);
    $new_password = trim($_POST["new_password"]);

    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($old_password, $user["password"])) { //eski şifrenin doğruluğu kontrol ediyor
        $_SESSION["error_message"] = "Eski şifre yanlış!";
    } else {
        if (!empty($new_password)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$hashed_password, $user_id]);
        }

        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        if ($stmt->execute([$username, $email, $user_id])) {
            $_SESSION["success_message"] = "Bilgiler başarıyla güncellendi!";
        } else {
            $_SESSION["error_message"] = "Güncelleme sırasında hata oluştu!";
        }
    }
}

//yönlendirme yerine geri dönüş mesajı veriyoruz
header("Refresh:0; url=hesap-ayarlari.php");
exit();
?>