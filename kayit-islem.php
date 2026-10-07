<?php

include("baglanti.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $adsoyad = $_POST["adsoyad"];
    $email = $_POST["email"];
    $telefon = $_POST["telefon"];
    $sifre = $_POST["sifre"];

    $sifreli_sifre = password_hash($sifre, PASSWORD_DEFAULT);

    $sorgu = "INSERT INTO kullanicilar (adsoyad, email, telefon, sifre)
              VALUES ('$adsoyad', '$email', '$telefon', '$sifreli_sifre')";

    if (mysqli_query($baglanti, $sorgu)) {
        echo "Kayıt başarıyla oluşturuldu.";
    } else {
        echo "Kayıt sırasında hata oluştu: " . mysqli_error($baglanti);
    }
}

?>