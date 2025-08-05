<?php
session_start();
require 'db.php';
$_SESSION = array(); // bütün değişkenleri temizliyo

if (session_status() === PHP_SESSION_ACTIVE){
    session_destroy(); //oturumları tamamen yok eder
}

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 4200,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]);
}

header("Location: index.php");
exit;
?>
<a href="cikis.php" onclick="return confirm('Çıkış yapmak istediğinizden emin misiniz?');">Çıkış Yap</a>