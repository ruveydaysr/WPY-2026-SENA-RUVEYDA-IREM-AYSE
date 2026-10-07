<?php

session_start();

include("baglanti.php");

if (!isset($_SESSION["kullanici_id"])) {
    header("Location: giris.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $kullanici_id = $_SESSION["kullanici_id"];

    $cihaz = $_POST["cihaz"];
    $marka = $_POST["marka"];
    $model = $_POST["model"];
    $ariza = $_POST["ariza"];

    $sorgu = "INSERT INTO servisler
              (kullanici_id, cihaz, marka, model, ariza)
              VALUES
              ('$kullanici_id', '$cihaz', '$marka', '$model', '$ariza')";

    if (mysqli_query($baglanti, $sorgu)) {

        echo "Servis kaydı başarıyla oluşturuldu.";

    } else {

        echo "Servis kaydı oluşturulurken hata oluştu: "
             . mysqli_error($baglanti);

    }
}

?>