<?php
session_start();
require 'db.php';

// Kullanıcı giriş yapmamışsa hata ver
if (!isset($_SESSION["user_id"])) {
    echo "Hata: Mesaj göndermek için giriş yapmalısınız!";
    exit;
}

//kullanıcının adını ve eposta adresini almak için
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user_id"]]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Hata: Kullanıcı bilgileri alınamadı!";
    exit;
}

$name = htmlspecialchars($user["username"], ENT_QUOTES, 'UTF-8'); 
$email = htmlspecialchars($user["email"], ENT_QUOTES, 'UTF-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mesaj = trim($_POST["message"] ?? "");

    //sql injec ve xss önlemleri
    $mesaj = htmlspecialchars(strip_tags($mesaj), ENT_QUOTES, 'UTF-8'); 
    
    // sql komutlarını temizleme
    $sql_keywords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'ALTER', 'CREATE', 'WHERE', 'OR', 'AND'];
    $mesaj = preg_replace('/\b(' . implode('|', $sql_keywords) . ')\b/i', '', $mesaj);

    //eksik veri var mı kontrol ediyoz
    if (empty($mesaj)) {
        echo "Hata: Mesaj boş olamaz!";
        exit;
    } elseif (strlen($mesaj) > 1000) { 
        echo "Hata: Mesaj en fazla 1000 karakter olabilir!";
        exit;
    }

try {
        //hazırlıklı sorgu ile güvenli işlem
$stmt = $pdo->prepare("INSERT INTO messages (name, email, message, sent_at) VALUES (:name, :email, :message, NOW())");
$stmt->bindValue(":name", $name, PDO::PARAM_STR);
$stmt->bindValue(":email", $email, PDO::PARAM_STR);
$stmt->bindValue(":message", $mesaj, PDO::PARAM_STR);

if ($stmt->execute()) {
echo "Mesaj başarıyla gönderildi!";
} else {
echo "Hata: Mesaj gönderilirken bir hata oluştu!";
}
} catch (PDOException $e) {
echo "Hata: " . $e->getMessage();
 }
}
?>