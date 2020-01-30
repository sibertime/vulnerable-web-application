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
        <p class="w3-left">Sql Injection</p>
    </header>
    <form method="POST">
        <div class="w3-container w3-black w3-padding-32">
            <h3>İndirim fırsatlarından ve kampanyalardan haberdar olmak için e-bültenimize kayıt olun!</h3>
            <input name="email" class="w3-input w3-border" type="text" placeholder="E-mail giriniz"
                   style="width:100%"/><br>
            <input type="submit" value="Gönder" class="w3-button w3-red w3-margin-bottom"/>
        </div>
    </form>
    <?php
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        $selectQuery = "SELECT newsletter_email FROM newsletter WHERE newsletter_email='$email' limit 1";
        $result = $con->query($selectQuery);
        if ($result->num_rows > 0) {
            echo '<br>';
            echo '<div style="background-color: red;color:white" class="w3-container">';
            echo '<p>E-mail adresi sistemimize daha önceden kayıt olmuştur.</p>';
            echo '<p>'.$selectQuery.'</p>';
            echo '</div>';
        } else {
            $insertQuery = "insert into newsletter (newsletter_email) values ('$email')";
            if ($con->query($insertQuery) === TRUE) {
                echo '<br>';
                echo '<div style="background-color: green;color:white" class="w3-container">';
                echo '<p>E-mail adresiniz başarıyla kayıt edilmiştir.</p>';
                echo '<p>'.$selectQuery.'</p>';
                echo '</div>';
            }else{
                echo '<br>';
                echo '<div style="background-color: red;color:white" class="w3-container">';
                echo '<p>Kayıt eklenirken hata oluştu.</p>';
                echo '<p>'.$selectQuery.'</p>';
                echo '</div>';
            }
        }
        $con->close();
    }
    ?>
</div>
</body>
</html>