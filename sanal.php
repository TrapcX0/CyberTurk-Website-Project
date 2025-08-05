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
                    <h2>SANAL MAKİNE NEDİR?</h2>
                </header>
                <img src="images/im13.jpg" width="1000px" height="500px" alt="" />
                <p>Sanal Makine Nedir?
                    Sanal Makine (Virtual Machine - VM), fiziksel bir bilgisayarın içinde yazılım yoluyla oluşturulan ve gerçek bir bilgisayar gibi çalışan sanal bir ortamdır. Yani, bir bilgisayarın donanımı üzerinde çalışan, bağımsız bir işletim sistemi ve uygulamalar barındıran dijital bir bilgisayardır.

                    Sanal Makinenin Temel Özellikleri
                    Bağımsız Çalışma: Sanal makine, ana işletim sisteminden tamamen bağımsız olarak çalışır. Ana sistemdeki dosya ve ayarlara zarar vermeden farklı işletim sistemlerini çalıştırabilirsin.

                    Çoklu İşletim Sistemi: Aynı fiziksel bilgisayar üzerinde birden fazla işletim sistemi (Windows, Linux, macOS vb.) sanal makineler aracılığıyla aynı anda çalıştırılabilir. Bu, farklı yazılımları test etmek veya farklı sistemlerde çalışmak için çok faydalıdır.

                    Kaynak Paylaşımı: Sanal makineler, bilgisayarın RAM, işlemci ve disk gibi kaynaklarını ana sistemle paylaşır, ancak bu kaynaklar sınırlanabilir ve yönetilebilir.

                    Sanal Makine Kullanım Alanları
                    Test ve Geliştirme: Yazılım geliştiriciler, farklı işletim sistemlerinde uygulamalarını test etmek için sanal makineleri kullanır.

                    Eğitim: Yeni işletim sistemlerini veya yazılımları denemek isteyenler için risksiz bir ortam sağlar.

                    Siber Güvenlik: Penetrasyon testleri ve güvenlik araştırmaları için izole ve kontrol edilebilir ortam sunar.

                    Esneklik: Farklı işletim sistemlerine ihtiyaç duyan kullanıcılar için tek bir cihazda çoklu sistem kullanımı sağlar.

                    Popüler Sanal Makine Yazılımları
                    VirtualBox: Ücretsiz ve açık kaynaklı, kullanıcı dostu bir VM yazılımıdır.

                    VMware: Hem ücretsiz hem de profesyonel sürümleri olan, yaygın kullanılan güçlü bir platform.

                    Hyper-V: Microsoft’un Windows işletim sistemi içinde sunduğu yerleşik sanallaştırma çözümü.

                    Sonuç
                    Sanal makineler, fiziksel bilgisayarlar üzerinde bağımsız, güvenli ve esnek çalışma ortamları oluşturur. Böylece farklı işletim sistemlerini denemek, yazılım geliştirmek veya siber güvenlik testleri yapmak çok daha kolay ve güvenli hale gelir. Günümüzde teknoloji dünyasında sanallaştırma, hem bireysel kullanıcılar hem de kurumlar için vazgeçilmez bir araçtır.</p>
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