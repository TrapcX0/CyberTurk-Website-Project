<?php
session_start();
require 'db.php';

//kullanıcı giriş yapmamışsa hata ver
if (!isset($_SESSION["user_id"])) {
    die("Giriş yapmadınız!");
}

$user_id = $_SESSION["user_id"];


if (!is_dir("uploads")) {
    mkdir("uploads", 0777, true);
}

//dosya yükleme işlemi burda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["profile_pic"])) {
    $dosya = $_FILES["profile_pic"];
    $dosyaAdi = basename($dosya["name"]);
    $dosyaTuru = strtolower(pathinfo($dosyaAdi, PATHINFO_EXTENSION));
    $mimeturu = mime_content_type($dosya["tmp_name"]); //gerçek mime türünü alıyoruz bu sayede burda
    $hedefYol = "uploads/" . $user_id . "_" . time() . "." . $dosyaTuru; 

    $izinliturler = ["jpg", "jpeg", "png", "gif"];
    $izinliMimeturleri = ["image/jpeg", "image/png", "image/gif"];

    if (!in_array($dosyaTuru, $izinliturler) || !in_array($mimeturu, $izinliMimeturleri)) {
        die("Hata: Sadece JPG, JPEG, PNG veya GIF formatındaki resimleri yükleyebilirsiniz!ayıkolun!");
    }

    // İzin verilen dosya türleri
    $izinliTurler = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($dosyaTuru, $izinliTurler)) {
        die("Sadece JPG, JPEG, PNG veya GIF formatındaki dosyaları yükleyebilirsiniz!");
    }

    //dosya boyutu 6mb olabilir en fazla
    if ($dosya["size"] > 6 * 1024 * 1024) {
        die("Dosya boyutu 6MB'ı geçemez!");
    }

    //dosyayı uploads/ klasörüne taşı
    if (move_uploaded_file($dosya["tmp_name"], $hedefYol)) {
        //beritabanında profil fotoğrafını günceller
        $stmt = $pdo->prepare("UPDATE users SET profile_pic = ? WHERE id = ?");
        if ($stmt->execute([$hedefYol, $user_id])) {
            echo "Profil fotoğrafı başarıyla güncellendi!";
        } else {
            echo "Veritabanına kaydedilirken hata oluştu!";
        }
    } else {
        echo "Dosya yüklenirken hata oluştu!";
    }
}
?>