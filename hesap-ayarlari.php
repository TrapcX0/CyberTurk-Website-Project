<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    session_regenerate_id(true);
}

require 'db.php';

//kullanıcı bilgilerini veritabanından çekiyoruz
$user_id = intval($_SESSION['user_id']);
$stmt = $pdo->prepare("SELECT username, email, profile_pic FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//hata ve başarı mesajlarını kontrol ediyoruz
$error_message = $_SESSION['error_message'] ?? "";
$success_message = $_SESSION['success_message'] ?? "";
unset($_SESSION['error_message'], $_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Hesap Ayarları</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 450px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #009acd;
            color: white;
            cursor: pointer;
            font-weight: bold;
            border: none;
        }

        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
        img {
            border-radius: 50%;
            margin-bottom: 10px;
            width: 120px;
            height: 120px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Hesap Ayarları</h2>

        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p> <!--hata mesajları gösterme-->
        <?php endif; ?>

        <img id="profilResmi" src="<?php echo !empty($user['profile_pic']) ? htmlspecialchars($user['profile_pic']) : 'profil_resimleri/default.png'; ?>" alt="Profil Resmi">

        <form id="profilForm" enctype="multipart/form-data">
            <input type="file" id="profilePicInput" name="profile_pic" accept=".jpg, .jpeg, .png" required>
            <p id="fileSizeText" style="font-weight: bold; color: #009acd;"></p>
            <p id="fileSizeError" style="color: red; font-weight: bold; display: none;">Dosya boyutu 6MB'ı geçemez!</p>
            <button type="submit" id="uploadButton">Profil Resmini Güncelle</button>
        </form>

        <script>
        document.getElementById("profilForm").addEventListener("submit", function(event) {
            event.preventDefault(); 

            let formData = new FormData(this);

            fetch("profil_yukleme.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes("başarıyla")) {
                    let profilResmi = document.getElementById("profilResmi");
                    let timestamp = new Date().getTime(); // Tarayıcıyı yeni resmi yüklemeye zorlayacak
                    profilResmi.src = profilResmi.src.split("?")[0] + "?t=" + timestamp;
                }
                alert(data);
            });
        });

        document.getElementById("profilePicInput").addEventListener("change", function(event) {
            let file = event.target.files[0];
            if (file) {
                let fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                document.getElementById("fileSizeText").textContent = "Seçilen dosya boyutu: " + fileSizeMB + " MB";

                if (file.size > 6 * 1024 * 1024) {
                    document.getElementById("fileSizeError").style.display = "block";
                    document.getElementById("uploadButton").disabled = true;
                } else {
                    document.getElementById("fileSizeError").style.display = "none";
                    document.getElementById("uploadButton").disabled = false;
                }
            } else {
                document.getElementById("fileSizeText").textContent = "";
            }
        });
        </script>

        <form action="kullanici_guncelleme.php" method="POST">
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            <input type="password" name="old_password" placeholder="Eski Şifre" required>
            <input type="password" name="new_password" placeholder="Yeni Şifre">
            <button type="submit">Bilgileri Güncelle</button>
        </form>

        <a href="index.php" style="margin-top: 10px; text-decoration: none; color: #009acd;">Ana Sayfaya Dön</a>
    </div>
</body>
</html>