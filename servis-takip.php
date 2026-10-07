
<?php

session_start();

include("baglanti.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}

$kullanici_id = $_SESSION["kullanici_id"];

$sorgu = "SELECT * FROM servisler
          WHERE kullanici_id = '$kullanici_id'
          ORDER BY id DESC";

$sonuc = mysqli_query($baglanti, $sorgu);

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servis Takip</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <h1>Bilgisayar Teknik Servis</h1>

    <nav>
        <a href="musteri-panel.html">Müşteri Paneli</a>
        <a href="servis-olustur.php">Servis Oluştur</a>
        <a href="servis-takip.php">Servis Takip</a>
        <a href="cikis.php">Çıkış Yap</a>
    </nav>
</header>

<main>

    <section class="servis-alani">

        <h2>Servis Kayıtlarım</h2>

        <table>

            <tr>
                <th>Servis No</th>
                <th>Cihaz</th>
                <th>Marka</th>
                <th>Model</th>
                <th>Arıza</th>
                <th>Durum</th>
                <th>Tarih</th>
            </tr>

            <?php while ($servis = mysqli_fetch_assoc($sonuc)) { ?>

                <tr>
                    <td><?php echo $servis["id"]; ?></td>
                    <td><?php echo $servis["cihaz"]; ?></td>
                    <td><?php echo $servis["marka"]; ?></td>
                    <td><?php echo $servis["model"]; ?></td>
                    <td><?php echo $servis["ariza"]; ?></td>
                    <td><?php echo $servis["durum"]; ?></td>
                    <td><?php echo $servis["tarih"]; ?></td>
                </tr>

            <?php } ?>

        </table>

    </section>

</main>

</body>
</html>