<?php
if (session_status() === PHP_SESSION_NONE){ // //status oturum durmunu kontrol ediyor, henüz none başlatılmamış demektir. start zaten oturum başlatıyo. id true ise yeni oturum kmiliği oluşturur eskisini kabul etmez artık
	session_start();
	session_regenerate_id(true); // oturum kimliğini yeniliyo
}
?>



<head>
	<title>Cyber Türk</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
	<noscript>
		<link rel="stylesheet" href="assets/css/noscript.css" />
	</noscript>
</head>

<body class="is-preload">
<div id="top-navbar" style="display: flex; align-items: center; justify-content: space-between;">
	
    <?php if (!empty($_SESSION['user_id'])): ?>
      <?php

require 'db.php';
$user_id = intval($_SESSION['user_id']); // veriyi integer olarak alıyorum güvenlik için
$stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?"); //prepare sql injece önlem. bide burda profil_pic i çekiyom
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

//eğer resim varsa ekrana yazdır yoksa default resim kullan
$profilePic = !empty($user['profile_pic']) ? $user['profile_pic'] : "profil_resimleri/default.png";
?>

<img src="<?php echo htmlspecialchars($profilePic, ENT_QUOTES, 'UTF-8'); ?>" width="60" height="60" style="border-radius: 50%;" alt="Profil Resmi">
        <div class="profile-menu" style="display: flex; gap: 30px; margin-left: auto;">
			
            <a href="hesap-ayarlari.php" style="color: white; font-weight: bold; text-decoration: none; padding: 10px; border: 2px solid #009acd; border-radius: 5px; background-color: #009acd;"> 
                <?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
            <a href="cikis.php" style="color: white; font-weight: bold; text-decoration: none; padding: 10px; border: 2px solid #009acd; border-radius: 5px; background-color: #009acd;"> 
                Çıkış Yap
            </a>
        </div>
    <?php else: ?>
        <div class="button-container" style="margin-left: auto;">
            <a href="kayitol.php" style="background-color: #009acd; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Kayıt Ol</a>
            <a href="giris.php" style="background-color: #009acd; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none;">Giriş Yap</a>
        </div>
    <?php endif; ?>
</div>
		</div>
	</div>
	<!-- Wrapper -->
	<div id="wrapper" class="fade-in">

		<!-- Intro -->
		<div id="intro">
			<h1>Welcome to CyberTürk</h1>
			<p>Cybertürk, siber güvenlik dünyasını Türkçe ve sade bir dille anlatan bağımsız bir blogdur.
				Zafiyetler, araçlar, rehberler ve gerçek deneyimlerle dolu bu blog, meraklısına yol gösterir.</p>
			<ul class="actions">
				<li><a href="#header" class="button icon solid solo fa-arrow-down scrolly">Continue</a></li>
			</ul>
		</div>

		<!-- Header -->
		<header id="header">
			<a href="index.php" class="logo">CyberTürk</a>
		</header>

		<!-- Nav -->
		<nav id="nav">

			<ul class="links">
				<li class="active"><a href="index.php">This is CyberTürk</a></li>
			</ul>
			<ul class="icons">
				<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
				<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
				<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
				<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
			</ul>

		</nav>

		<!-- Main -->
		<div id="main">

			<!-- Featured Post -->
			<article class="post featured">
				<header class="major">
					<h2><a href="cyberturk.php">Cyber Türk'ün Hikayesi!</a></h2>
					<p>CyberTürk, Türkiye’nin dijital savunma bilincini artırmak, siber güvenlik konularını herkes için
						anlaşılır ve erişilebilir kılmak amacıyla kuruldu. Günümüzde bilgi kadar güvenlik de güçtür ve
						bu güç, sadece izleyerek değil, üreterek elde edilir. CyberTürk; teknik analizlerden rehber
						içeriklere, güncel zafiyetlerden siber farkındalığa kadar geniş bir yelpazede içerik sunar.
						Yerli düşüncenin küresel tehditler karşısındaki duruşunu temsil eden bu blog, sadece bir bilgi
						kaynağı değil, aynı zamanda bir vizyonun dijital yansımasıdır.</p>
				</header>
				<a href="cyberturk.php" class="image main"><img src="images/im2.jpg" alt="" /></a>
				<ul class="actions special">
					<li><a href="cyberturk.php" class="button large">Devamını Oku</a></li>
				</ul>
			</article>

			<!-- Posts -->
			<section class="posts">
				<article>
					<header>
						<h2><a href="sbrgvnlk.php">Siber Güvenlik Nedir?</a></h2>
					</header>
					<a href="sbrgvnlk.php" class="image fit"><img src="images/im1.jpg" alt="" /></a>
					<p>Siber güvenlik, dijital dünyadaki bilgi ve sistemleri koruma sürecidir. Her internet
						kullanıcısını ilgilendirir ve veri hırsızlığı, saldırı gibi tehditlere karşı alınan önlemleri
						kapsar. Güvende kalmak için bilgi ve farkındalık şarttır.</p>
					<ul class="actions special">
						<li><a href="sbrgvnlk.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
				<article>
					<header>
						<h2><a href="sbrsal.php">Siber Saldırı Nedir?</a></h2>
					</header>
					<a href="sbrsal.php" class="image fit"><img src="images/im3.jpg" alt="" /></a>
					<p>Siber saldırı, dijital sistemlere zarar vermek veya bilgi çalmak için yapılan kötü niyetli
						girişimlerdir. Güvenlik önlemleri ve bilinçli kullanım saldırılardan korunmanın en etkili
						yoludur.
					</p>
					<ul class="actions special">
						<li><a href="sbrsal.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
				<article>
					<header>
						<h2><a href="bilvesib.php">Bilgisayar Ağları ve Siber Güvenlik</a></h2>
					</header>
					<a href="bilvesib.php" class="image fit"><img src="images/im4.jpg" alt="" /></a>
					<p>Bilgisayar ağları, cihazların veri alışverişi yapmasını sağlar ancak siber saldırılara açıktır.
						Siber güvenlik, bu ağları ve verileri yetkisiz erişim ve zararlardan korumak için kullanılan
						yöntemlerdir. Güvenlik duvarları, şifreleme ve izleme ile ağların güvenliği sağlanır, böylece
						veri akışı kesintisiz ve güvenli olur.</p>
					<ul class="actions special">
						<li><a href="bilvesib.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
				<article>
					<header>
						<h2><a href="yazvesib.php">Yazılım ve Siber Güvenlik</a></h2>
					</header>
					<a href="yazvesib.php" class="image fit"><img src="images/im5.jpg" alt="" /></a>
					<p>Yazılımlar hayatımızın her alanında kullanılır ve siber saldırıların önemli hedefidir. Güvenli
						yazılım geliştirme, kodlama aşamasından başlayarak güvenlik açıklarının önlenmesini sağlar.
						Yazılımların düzenli güncellenmesi ve yamalanması, güvenliği artırır. Yazılım ve siber güvenlik
						birlikte çalışarak sistemlerin ve verilerin korunmasını sağlar.</p>
					<ul class="actions special">
						<li><a href="yazvesib.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
				<article>
					<header>
						<h2><a href="parolavesifre.php">Parola ve Şifre Kırma</a></h2>
					</header>
					<a href="parolavesifre.php" class="image fit"><img src="images/im6.jpg" alt="" /></a>
					<p>Parolalar, dijital hesapları koruyan temel güvenlik aracıdır. Şifre kırma ise bu parolaları
						tahmin etmek veya denemek için yapılan saldırılardır. Güçlü parolalar ve çok faktörlü kimlik
						doğrulama, şifre kırma riskini azaltır ve hesapları güvende tutar.
					</p>
					<ul class="actions special">
						<li><a href="parolavesifre.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
				<article>
					<header>
						<h2><a href="vpn.php">VPN Nedir Güvenilir mi?</a></h2>
					</header>
					<a href="vpn.php" class="image fit"><img src="images/im7.jpg" alt="" /></a>
					<p>VPN, internet bağlantınızı şifreleyerek güvenli ve özel hale getiren bir hizmettir. İnternet
						trafiğinizi gizler ve coğrafi engelleri aşmanızı sağlar. Ancak VPN’in güvenilirliği seçilen
						hizmete bağlıdır; güvenilir ve şeffaf sağlayıcılar tercih edilmelidir.</p>
					<ul class="actions special">
						<li><a href="vpn.php" class="button">Devamını Oku</a></li>
					</ul>
				</article>
			</section>

			<!-- Footer -->
			<footer>
				<div class="pagination">
					<!--<a href="#" class="previous">Prev</a>-->
					<a href="#" class="page active">1</a>
					<a href="sayfa2.php" class="page">2</a>
					<a href="#" class="page">3</a>
					<span class="extra">&hellip;</span>
					<a href="#" class="page">8</a>
					<a href="#" class="page">9</a>
					<a href="#" class="page">10</a>
					<a href="#" class="next">Next</a>
				</div>
			</footer>

		</div>

			<!-- Footer -->
		<footer id="footer">
		<section>
        <form id="messageForm">
            <div class="fields">
                <div class="field">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="3" required></textarea>
                </div>
            </div>
            <ul class="actions">
                <li><input type="submit" value="Send Message" /></li>
            </ul>
            <span id="message-status" style="color: green; font-weight: bold; display: block; margin-top: 12px;"></span>
        </form>
    </section>
			<section class="split contact">
				<section class="alt">
					<h3>Address</h3>
					<p>Balıkesir, Bandırma</p>
				</section>
				<section>
					<h3>Phone</h3>
					<p><a href="#">(000) 000-0000</a></p>
				</section>
				<section>
					<h3>Email</h3>
					<p><a href="#">cyberturk@gmail.com</a></p>
				</section>
				<section>
					<h3>Social</h3>
					<ul class="icons alt">
						<li><a href="#" class="icon brands alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon brands alt fa-facebook-f"><span class="label">Facebook</span></a>
						</li>
						<li><a href="#" class="icon brands alt fa-instagram"><span class="label">Instagram</span></a>
						</li>
						<li><a href="#" class="icon brands alt fa-github"><span class="label">GitHub</span></a></li>
					</ul>
				</section>
			</section>
		</footer>

		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
$("#messageForm").submit(function(e) {
e.preventDefault(); // sayfayönlendirmeyiengellyioruz

var message = $("#message").val().trim();
        
 //sql injection engelliyoz
var forbiddenWords = ['SELECT', 'INSERT', 'UPDATE', 'DELETE', 'DROP', 'ALTER', 'CREATE', 'WHERE', 'OR', 'AND'];
var regex = new RegExp('\\b(' + forbiddenWords.join('|') + ')\\b', 'i');

if (regex.test(message)) {
alert("Hata: Mesajda yasaklı kelimeler var!");
return;
}

var formData = $(this).serialize();
    $.ajax({
            url: "mesaj_iletme.php",
            method: "POST",
            data: formData,
            success: function(response) {
                $("#message-status").text(response).css("color", response.includes("Hata") ? "red" : "green");
                if (!response.includes("Hata")) {
                    $("#messageForm")[0].reset();
                }
            },
            error: function() {
                $("#message-status").text("Hata: Mesaj gönderilemedi!").css("color", "red");
            }
        });
    });
});
</script>

	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery.scrollex.min.js"></script>
	<script src="assets/js/jquery.scrolly.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>

</html>