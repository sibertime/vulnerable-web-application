<!DOCTYPE html>
<?php require_once 'config/config.php'; ?>
<html>
<title>SiberTime | Zafiyetli Web Uygulaması</title>
<?php require_once 'header.php'; ?>
<body class="w3-content" style="max-width:1200px">
<?php require_once 'sidebar.php'; ?>
<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu"
     id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="w3-hide-large" style="margin-top:83px"></div>

    <!-- Top header -->
    <header class="w3-container w3-xlarge">
        <p class="w3-left">Open Redirect</p>
    </header>

    <div class="w3-container w3-black w3-padding-32">
        <header style="background-color: whitesmoke;color: black" class="w3-container w3-xlarge">
            <p class="w3-left">
                <a style="text-decoration: none" href="open-redirect.php?redirect=open-redirect.php">Anasayfa</a>
                <a style="text-decoration: none" href="open-redirect.php?redirect=open-redirect-hakkimizda.php">Hakkımızda</a>
                <a style="text-decoration: none" href="open-redirect.php?redirect=open-redirect-iletisim.php">İletişim</a>
            <p class="w3-right">
                Sibertime
            </p>
        </header>
        <br>
        Bu bir iletişim sayfasıdır.
    </div>
    <?php
    if (isset($_GET['redirect'])) {
        $url = $_GET["redirect"];
        header("Location: $url");
    }
    ?>
</div>
</body>
</html>