<?php
//oturum başlatılmışssa tekrar başlatma diyoz burda
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'db.php';

//kullanıcı admin değilse indexe yönlendirme yapıyoz
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: index.php");
    exit;
}

//csrf token oluşturuyorum
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

//kullanıcı silme işlemini yapıyoz burda
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"], $_POST["csrf_token"])) {
    if ($_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        die("Geçersiz CSRF token!");
    }

    $user_id = intval($_POST["user_id"]);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user_id]);
}

//mesaj silme işlemi yapıyoz
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message_id"], $_POST["csrf_token"])) {
    if ($_POST["csrf_token"] !== $_SESSION["csrf_token"]) {
        die("Geçersiz CSRF token!");
    }

    $mesaj_id = intval($_POST["message_id"]);
    $stmt = $pdo->prepare("DELETE FROM messages WHERE id = ?");
    $stmt->execute([$mesaj_id]);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Admin Paneli</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
        }

        .message, .user {
            text-align: left;
            background: #fff;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        }

        button {
            background-color: red;
            color: white;
            padding: 5px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <a href="index.php" style="
    display: inline-block;
    padding: 10px 20px;
    background-color: #009acd;
    color: white;
    font-weight: bold;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;">
    🏠 Ana Sayfa Dönüş
</a>
    <div class="container">
        <h2>Admin Paneli – Kullanıcı Yönetimi</h2>

        <?php
        try {
            $stmt = $pdo->prepare("SELECT id, username, email FROM users ORDER BY id ASC");
            $stmt->execute();
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("SQL Hatası: " . $e->getMessage(), 0);
            die("Bir hata oluştu, lütfen daha sonra tekrar deneyiniz.");
        }

        if (!$users) {
            echo "<p>Henüz hiç kullanıcı yok.</p>";
        } else {
            foreach ($users as $user) {
                echo "<div class='user'>";
                echo "<p><strong>Kullanıcı Adı:</strong> " . htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') . "</p>";

                // Kullanıcıyı silme butonu
                echo "<form method='POST' style='display: inline;'>";
                echo "<input type='hidden' name='csrf_token' value='" . $_SESSION['csrf_token'] . "'>";
                echo "<input type='hidden' name='user_id' value='" . intval($user['id']) . "'>";
                echo "<button type='submit'>Kullanıcıyı Sil</button>";
                echo "</form>";
                echo "</div>";
            }
        }
        ?>

        <h2>Admin Paneli – Kullanıcı Mesajları</h2>

        <?php
        $stmt = $pdo->prepare("SELECT id, name, email, message, sent_at FROM messages ORDER BY sent_at DESC");
        $stmt->execute();
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$messages) {
            echo "<p>Henüz hiç mesaj gönderilmemiş.</p>";
        } else {
            foreach ($messages as $msg) {
                echo "<div class='message'>";
                echo "<strong>" . htmlspecialchars($msg['name'], ENT_QUOTES, 'UTF-8') . " (" . htmlspecialchars($msg['email'], ENT_QUOTES, 'UTF-8') . ")</strong><br>";
                echo "<p>" . htmlspecialchars($msg['message'], ENT_QUOTES, 'UTF-8') . "</p>";
                echo "<small>{$msg['sent_at']}</small>";

                // Mesaj silme formu
                echo "<form method='POST' style='display: inline;'>
                        <input type='hidden' name='csrf_token' value='" . $_SESSION['csrf_token'] . "'>
                        <input type='hidden' name='message_id' value='{$msg['id']}'>
                        <button type='submit'>Mesajı Sil</button>
                      </form>";
                echo "</div>";
            }
        }
        ?>
    </div>
</body>
</html>