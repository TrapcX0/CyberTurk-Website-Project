<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    session_regenerate_id(true); //oturum kimliğini yenileyerek güvenliği artırıyoruz oturum sabitlemeye önlem almış oluyoz
}

$hata_mesaji = "";

require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_or_email = trim($_POST['username']); 
    $password = trim($_POST['password']);

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username_or_email, $username_or_email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            
            if ($user['role'] === 'admin') {
                header("Location: admin-panel.php");
            } else {
                header("Location: hesap-ayarlari.php");
            }
            exit;

        } else {
            $_SESSION['error_message'] = "Hatalı kullanıcı adı veya şifre!";
            header("Location: giris.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
    }
}
?>

<div style="width: 600px; padding: 50px; margin: auto; background: white; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <link rel="stylesheet" href="assets/css/main.css">
    <h2 style="color: #333; font-weight: bold; padding: 15px;">Giriş Yap</h2>

    <form action="giris.php" method="POST">
        <div style="padding: 20px;">
            <input type="text" name="username" placeholder="Kullanıcı Adı veya E-posta" required style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px;">
            
            <input type="password" name="password" id="password" placeholder="Şifre" required style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <span id="password-error" style="color: red; font-weight: bold; display: block; margin-bottom: 12px;"></span>
        </div>
        
        <button type="submit" style="width: 100%; padding: -15px; font-size: 18px; background-color: #009acd; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center;">
            GİRİŞ YAP
        </button>

        <span style="color: red; font-weight: bold; display: block; margin-top: 15px;"><?php echo $hata_mesaji; ?></span>
    </form>
</div>

<script>
document.getElementById("password").addEventListener("input", function() {
    var password = this.value;
    var errorSpan = document.getElementById("password-error");
    
    if (password.length < 8) {
        errorSpan.textContent = "Hata: Şifre en az 8 karakter olmalıdır!";
    } else {
        errorSpan.textContent = "";
    }
});
</script>