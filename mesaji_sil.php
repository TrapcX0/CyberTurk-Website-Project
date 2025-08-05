<?php
session_start();
require 'db.php';

//eğer mesaj id post ile gelmemişse işlem yapmadan çık diyoruz burada ha
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message_id"])) {
    $mesaj_id = intval($_POST["message_id"]); //yine aynı şey intval sayesinde güvenlik için idyi integera çeviriyoz

    //mesajı veritabanından silelim
    $sql = "DELETE FROM messages WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$mesaj_id]);

    //işlem bitince admin-panel.php ye geri dönelim
    echo "<script>window.location.href='admin-panel.php';</script>";
    exit();
}
?>