<?php
require 'db.php';

$hata_mesaji = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL) ? trim($_POST['email']) : null;
    $password = trim($_POST["password"]);

    //kullanıcı adının geçerli olup olmadığını kontrol ediyoz çünkü kısıtlama koyduk
    if (!$email || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $hata_mesaji = "Hata: Kullanıcı adı yalnızca harf, rakam ve alt çizgi içermelidir!";
    } elseif (strlen($password) < 8) {
        $hata_mesaji = "Hata: Şifre en az 8 karakter olmalıdır!";
    } else {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //kullanıcıadı eposta kontrolü
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $username_exists = $stmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $email_exists = $stmt->fetchColumn();

            if ($username_exists > 0) {
                $hata_mesaji = "Hata: Bu kullanıcı adı zaten alınmış!";
            } elseif ($email_exists > 0) {
                $hata_mesaji = "Hata: Bu e-posta zaten kayıtlı!";
            } else {
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password]);

                header("Location: giris.php");
                exit;
            }
        } catch (PDOException $e) {
            $hata_mesaji = "Hata: " . $e->getMessage();
        }
    }
}
?>

<body>
<div style="width: 600px; padding: 50px; margin: auto; background: white; border-radius: 12px; text-align: center; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
    <link rel="stylesheet" href="assets/css/main.css">
    <h2 style="color: #333; font-weight: bold; padding: 15px;">Kayıt Ol</h2>

    <form action="kayitol.php" method="POST">
        <div style="padding: 20px;">
            <input type="text" name="username" placeholder="Kullanıcı Adı" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8') : ''; ?>" style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px;">
            
            <input type="email" name="email" placeholder="E-posta Adresi" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 12px; border: 1px solid #ddd; border-radius: 8px;">
            
            <input type="password" name="password" id="password" placeholder="Şifre" required style="width: 100%; padding: 15px; font-size: 18px; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <span id="password-error" style="color: red; font-weight: bold; display: block; margin-bottom: 12px;"></span>
        </div>
        
        <button type="submit" style="width: 100%; padding: 15px; font-size: 18px; background-color: #009acd; color: white; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; text-align: center;">
            KAYIT OL
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

</body>