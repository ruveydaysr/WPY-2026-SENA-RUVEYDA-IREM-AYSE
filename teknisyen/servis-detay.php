<?php
session_start();
require_once("../baglanti.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: ../giris.php");
    exit();
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    die("Geçerli bir servis numarası belirtilmedi.");
}

$sorgu = "SELECT servisler.id,
                 kullanicilar.adsoyad,
                 servisler.cihaz,
                 servisler.marka,
                 servisler.model,
                 servisler.ariza,
                 servisler.durum
          FROM servisler
          INNER JOIN kullanicilar
          ON servisler.kullanici_id = kullanicilar.id
          WHERE servisler.id = ?";

$stmt = mysqli_prepare($baglanti, $sorgu);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$sonuc = mysqli_stmt_get_result($stmt);
$servis = mysqli_fetch_assoc($sonuc);

if (!$servis) {
    die("Servis kaydı bulunamadı.");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servis Detayı</title>
    <link rel="stylesheet" href="teknisyen-style.css">
</head>
<body>

<div class="servis-detay">

    <h1>Servis Detayı</h1>

    <a href="atanan-servisler.php" class="geri-butonu">
        ← Atanan Servislere Dön
    </a>

    <div class="cihaz-bilgileri">
        <h2>Cihaz Bilgileri</h2>

        <p><strong>Servis No:</strong>
            <?= htmlspecialchars($servis["id"]) ?>
        </p>

        <p><strong>Müşteri:</strong>
            <?= htmlspecialchars($servis["adsoyad"]) ?>
        </p>

        <p><strong>Cihaz:</strong>
            <?= htmlspecialchars(
                $servis["cihaz"] . " - " .
                $servis["marka"] . " " .
                $servis["model"]
            ) ?>
        </p>

        <p><strong>Şikayet:</strong>
            <?= htmlspecialchars($servis["ariza"]) ?>
        </p>

        <p><strong>Durum:</strong>
            <?= htmlspecialchars($servis["durum"]) ?>
        </p>
    </div>

</div>

</body>
</html>