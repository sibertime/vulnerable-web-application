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
        <p class="w3-left">Brute Force</p>
    </header>
    <form method="POST">
        <div class="w3-container w3-black w3-padding-32">
            <h3>Kullanıcı Giriş Formu</h3>
            <input name="username" class="w3-input w3-border" type="text" placeholder="Kullanıcı Adı"
                   style="width:100%"/><br>
            <input name="password" class="w3-input w3-border" type="password" placeholder="Şifre"
                   style="width:100%"/><br>
            <input type="submit" value="Giriş Yap" class="w3-button w3-red w3-margin-bottom"/>
        </div>
    </form>
    <?php
    if (isset($_POST['username'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                'username' => $username,
                'password' => $password
            )
        );

        $count = $statement->rowCount();

        if ($count > 0) {
            echo '<br>';
            echo '<div style="background-color: green;color:white" class="w3-container">';
            echo '<p>Hoşgeldin ' . $username . '</p>';
            echo '</div>';
        } else {
            echo '<br>';
            echo '<div style="background-color: red;color:white" class="w3-container">';
            echo '<p>Kullanıcı Adı veya şifre hatalı.</p>';
            echo '</div>';
        }
        $con->close();
    }
    ?>
</div>
</body>
</html>