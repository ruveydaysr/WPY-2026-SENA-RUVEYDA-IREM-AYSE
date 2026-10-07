<?php

$baglanti = mysqli_connect("localhost", "root", "", "teknik_servis");

if (!$baglanti) {
    die("Veritabanı bağlantısı başarısız: " . mysqli_connect_error());
}

?>