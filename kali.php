<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    session_regenerate_id(true); // Oturum kimliğini yenileyerek güvenliği artırıyoruz
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
            $stmt = $pdo->prepare("SELECT profile_pic FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Eğer resim varsa ekrana yazdır, yoksa default resim kullan
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

            <article>
                <header>
                    <h2>NEDEN KALİ LİNUX KULLANMALISIN?</h2>
                </header>
                <img src="images/im12.jpg" width="1000px" height="500px" alt="" />
                <p>Neden Kali Linux Kullanmalısın?
                    Kali Linux, siber güvenlik alanında uzmanlaşmak isteyenler için geliştirilmiş, en kapsamlı ve güçlü Linux dağıtımlarından biridir. İçerisinde yüzlerce ön yüklü güvenlik aracı barındırması ve açık kaynak olması nedeniyle dünya genelinde hem amatörler hem de profesyoneller tarafından tercih edilir. Peki, Kali Linux’u neden kullanmalısın? İşte başlıca sebepler:

                    1. Hazır ve Geniş Araç Seti
                    Kali Linux, sızma testleri, ağ analizleri, parola kırma, zafiyet tarama, kablosuz ağ saldırıları ve daha pek çok güvenlik testi için yüzlerce araç içerir. Bu araçları ayrı ayrı indirip kurmakla uğraşmazsın; hepsi tek bir paket içinde hazırdır. Böylece vakit kaybetmeden doğrudan işine odaklanabilirsin.

                    2. Açık Kaynak ve Ücretsiz
                    Kali Linux tamamen açık kaynak kodludur ve ücretsizdir. Bu, istediğin gibi özelleştirebileceğin, geliştirici topluluğuna katkıda bulunabileceğin ve maliyetsiz bir şekilde siber güvenlik öğrenebileceğin anlamına gelir. Ayrıca, sürekli güncellenen ve geliştirilen bir sistemdir.

                    3. Profesyonel ve Endüstri Standardı
                    Siber güvenlik uzmanları, etik hackerlar ve pentesterlar Kali Linux’u yaygın olarak kullanır. Birçok şirket, kurum ve eğitim programı Kali tabanlı test ortamları kurar. Dolayısıyla Kali Linux bilgisi, kariyerinde sana büyük avantaj sağlar.

                    4. Çok Yönlü Kullanım İmkanı
                    Kali Linux’u sadece bilgisayarına kurmakla kalmaz, sanal makinelerde, canlı USB’lerde veya bulut ortamlarında da rahatlıkla çalıştırabilirsin. Bu esneklik, farklı senaryolarda test ve analiz yapmanı sağlar.

                    5. Güçlü Komut Satırı ve Otomasyon
                    Kali Linux, Linux temelli olduğu için terminal üzerinden güçlü ve hızlı işlemler yapabilirsin. Ayrıca Python, Bash gibi dillerle otomasyon scriptleri hazırlayabilir, testlerini otomatikleştirerek daha verimli çalışabilirsin.

                    6. Geniş Topluluk ve Kaynak Desteği
                    Kali Linux kullanıcıları dünya çapında büyük bir topluluğa sahiptir. Forumlar, bloglar, eğitim videoları ve dokümanlar sayesinde öğrenme sürecin hızlanır, karşılaştığın sorunlara kolayca çözüm bulabilirsin.

                    7. Etik Hackerlık ve Güvenlik Testlerinde Güvenilirlik
                    Kali Linux, sadece saldırı araçları değil aynı zamanda savunma ve güvenlik artırıcı araçlar da sunar. Bu da seni hem saldırgan hem savunmacı olarak yetiştirir. Bu sayede sistemlerin güvenliğini etkili biçimde test edip iyileştirebilirsin.

                    Sonuç
                    Eğer siber güvenlik alanında profesyonelleşmek, sistemlerin açıklarını anlamak ve onları kapatmak istiyorsan Kali Linux sana en uygun platformdur. Sunduğu zengin araç seti, esnek kullanım olanakları ve endüstri standardı olması sayesinde hem öğrenme hem de iş hayatında büyük avantaj sağlar. Unutma, Kali Linux’u etkin kullanmak için temel Linux bilgisine ve etik kurallara hâkim olmak önemlidir.

                    Kısacası, siber güvenlik dünyasına sağlam adımlarla girmek istiyorsan Kali Linux vazgeçilmez bir dosttur.</p>
            </article>
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
                <form method="post" action="mesaj_iletme.php">
                    <div class="fields">
                        <div class="field">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'], ENT_QUOTES, 'UTF-8')) : ''; ?>" />
                        </div>
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email" value="<?php echo (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : ''; ?>" />
                        </div>
                        <div class="field">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" rows="3"><?php echo isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'], ENT_QUOTES, 'UTF-8')) : ''; ?></textarea>
                        </div>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="Send Message" /></li>
                    </ul>
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