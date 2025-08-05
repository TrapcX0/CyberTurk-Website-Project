<?php
$host =  getenv('DB_HOST') ?:'localhost'; 
$dbname = getenv('DB_NAME') ?: 'cyberturk_db';            //sql bağlantıları
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?:'';

try {
    $pdo =new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO ::ERRMODE_EXCEPTION,          //PDO ile güvenli bağlantı oluşturduk
        PDO::ATTR_EMULATE_PREPARES => false                 //e bu da yine sql injece karşı alınan bi önlem
    ]);
} catch (PDOException $e) {
    error_log("Veritabanı bağlantı hatası: " . $e->getMessage(), 0);
    die("Bir hata oluştu, Lütfen daha sonra tekrar deneyiniz.");
}
