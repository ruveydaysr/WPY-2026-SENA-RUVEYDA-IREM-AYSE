<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Bilgisayar Teknik Servis</h1>

    <nav>
        <a href="index.html">Ana Sayfa</a>
        <a href="kayit.php">Kayıt Ol</a>
        <a href="giris.php">Giriş Yap</a>
    </nav>
</header>

<main>

    <section class="form-alani">

        <h2>Müşteri Girişi</h2>

        <form action="giris-islem.php" method="POST">

            <label for="email">E-posta:</label>
            <input type="email" id="email" name="email" required>

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required>

            <button type="submit">Giriş Yap</button>

        </form>

        <p>
            Hesabınız yok mu?
            <a href="kayit.php">Kayıt Ol</a>
        </p>

    </section>

</main>

</body>
</html>