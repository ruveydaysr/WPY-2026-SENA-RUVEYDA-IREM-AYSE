<?php
session_start();

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servis Oluştur</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Bilgisayar Teknik Servis</h1>

    <nav>
        <a href="musteri-panel.html">Müşteri Paneli</a>
        <a href="servis-olustur.php">Servis Oluştur</a>
        <a href="servis-takip.html">Servis Takip</a>
        <a href="index.html">Çıkış Yap</a>
    </nav>
</header>

<main>

    <section class="form-alani">

        <h2>Yeni Servis Kaydı</h2>

        <form action="servis-kaydet.php" method="POST">

            <label for="cihaz">Cihaz Türü:</label>
            <select id="cihaz" name="cihaz" required>
                <option value="">Cihaz Seçiniz</option>
                <option value="Masaüstü Bilgisayar">Masaüstü Bilgisayar</option>
                <option value="Dizüstü Bilgisayar">Dizüstü Bilgisayar</option>
                <option value="Tablet">Tablet</option>
                <option value="Diğer">Diğer</option>
            </select>

            <label for="marka">Marka:</label>
            <input type="text" id="marka" name="marka" required>

            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>

            <label for="ariza">Arıza Açıklaması:</label>
            <textarea id="ariza" name="ariza" rows="5" required></textarea>

            <button type="submit">Servis Kaydı Oluştur</button>

        </form>

    </section>

</main>

</body>
</html>