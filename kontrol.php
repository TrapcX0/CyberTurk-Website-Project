<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {       //formun post isteğiyle atılıp atılmadığını tespit ediyoz.
$username = $_POST["username"];
if (preg_match('/[^a-zA-Z0-9_]/', $username)) {                 //önceki sayfalardaki gibi kısıtlama var sqle ve xss e karşı önlem için
        echo "Hata: Kullanıcı adı sadece harf, rakam ve alt çizgi içerebilir!";
    } else {
        echo "";
    }
}
?>