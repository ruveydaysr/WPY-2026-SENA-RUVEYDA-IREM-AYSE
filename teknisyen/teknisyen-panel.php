
<?php
session_start();
require_once("../baglanti.php");

// Teknisyen veya admin yetkisi kontrolü
if (
    !isset($_SESSION["kullanici_id"]) ||
    !in_array($_SESSION["rol"] ?? "", ["teknisyen", "admin"], true)
) {
    header("Location: ../giris.php");
    exit();
}

// Sistemdeki toplam servis sayısı
$sonuc = mysqli_query($baglanti, "SELECT COUNT(*) AS toplam FROM servisler");
$toplam_servis = (int) mysqli_fetch_assoc($sonuc)["toplam"];

// Devam eden servisler
$sonuc = mysqli_query(
    $baglanti,
    "SELECT COUNT(*) AS toplam FROM servisler
     WHERE durum IN ('İnceleniyor', 'İşlemde', 'Parça Bekliyor')"
);
$devam_eden = (int) mysqli_fetch_assoc($sonuc)["toplam"];

// Tamamlanan servisler
$sonuc = mysqli_query(
    $baglanti,
    "SELECT COUNT(*) AS toplam FROM servisler
     WHERE durum IN ('Tamamlandı', 'Teslim Edildi')"
);
$tamamlanan = (int) mysqli_fetch_assoc($sonuc)["toplam"];

 
// Son eklenen 5 servis kaydını getir
$sql = "SELECT
            servisler.id,
            servisler.cihaz,
            servisler.marka,
            servisler.model,
            servisler.durum,
            kullanicilar.adsoyad
        FROM servisler
        INNER JOIN kullanicilar
            ON servisler.kullanici_id = kullanicilar.id
        ORDER BY servisler.id DESC
        LIMIT 5";

$son_servisler = mysqli_query($baglanti, $sql);

if (!$son_servisler) {
    die("Servis kayıtları alınamadı.");
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teknisyen Paneli | Bilgisayar Teknik Servis</title>

    <link rel="stylesheet" href="teknisyen-style.css">
</head>

<body>

    <div class="teknisyen-panel">

        <h1>Bilgisayar Teknik Servis</h1>
        <h2>Teknisyen Paneli</h2>


<a href="../cikis.php" class="cikis-butonu">
    Çıkış Yap
</a>

        <p>Hoş Geldiniz, Teknisyen</p>

        <div class="panel-kartlar">

            <a href="atanan-servisler.php" class="kart-link">
    <div class="panel-kart">
        <h3>Atanan Servisler</h3>
        <p><?= $toplam_servis ?></p>
    </div>
</a>
           <a href="devam-eden-servisler.php" class="kart-link">
    <div class="panel-kart">
        <h3>Devam Edenler</h3>
        <p><?= $devam_eden ?></p>
    </div>
</a>

           <a href="tamamlanan-servisler.php" class="kart-link">
    <div class="panel-kart">
        <h3>Tamamlananlar</h3>
        <p><?= $tamamlanan ?></p>
    </div>
</a>

        </div>

        <h2>Son Atanan Servisler</h2>

        
          
<table>
    <tr>
        <th>Servis No</th>
        <th>Cihaz</th>
        <th>Müşteri</th>
        <th>Durum</th>
        <th>İşlem</th>
    </tr>

    <?php if (mysqli_num_rows($son_servisler) > 0): ?>

        <?php while ($servis = mysqli_fetch_assoc($son_servisler)): ?>
            <tr>
                <td>
                    SRV-<?= str_pad($servis["id"], 3, "0", STR_PAD_LEFT) ?>
                </td>

                <td>
                    <?= htmlspecialchars(
                        $servis["cihaz"] . " - " .
                        $servis["marka"] . " " .
                        $servis["model"]
                    ) ?>
                </td>

                <td>
                    <?= htmlspecialchars($servis["adsoyad"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($servis["durum"]) ?>
                </td>

                <td>
                    <a href="servis-detay.php?id=<?= (int)$servis["id"] ?>">
                        <button type="button">Detay</button>
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>

    <?php else: ?>
        <tr>
            <td colspan="5">Henüz servis kaydı bulunmuyor.</td>
        </tr>
    <?php endif; ?>
</table>
  

    </div>

</body>
</html>