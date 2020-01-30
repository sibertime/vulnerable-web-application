<!DOCTYPE html>
<?php
session_start();
require_once 'config/config.php';
?>
<html>
<title>SiberTime | Zafiyetli Web Uygulaması</title>
<?php require_once 'header.php'; ?>
<style>
    #menuidor a:hover {
        color: red;
    }
</style>
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
        <p class="w3-left">IDOR(İnsecure Direct Object References)</p>
    </header>
    <div class="w3-container w3-black w3-padding-32">
        <?php
        if (!isset($_SESSION["usernameForIdor"])) {
            ?>
            <h3>SiberTime Sosyal Ağ Platformu</h3>
            <form method="POST">
                <input name="username" class="w3-input w3-border" type="text" placeholder="Kullanıcı Adı"
                       style="width:100%"/><br>
                <input name="password" class="w3-input w3-border" type="password" placeholder="Şifre"
                       style="width:100%"/><br>
                <input type="submit" value="Giriş Yap" class="w3-button w3-red w3-margin-bottom"/>
            </form>
            <?php
        } else {
            ?>
            <header style="background-color: whitesmoke;color: black;margin-bottom: 15px;"
                    class="w3-container w3-xlarge">
                <p id="menuidor" class="w3-left">
                    <a style="text-decoration: none;" href="idor.php">Anasayfa </a>|
                    <a style="text-decoration: none" href="">Profil(<?php echo $_SESSION['usernameForIdor'] ?>) </a>|
                    <a style="text-decoration: none" href="logout-idor.php">Çıkış Yap</a>
                <p class="w3-right">
                    SiberTime Sosyal Ağ Platformu
                </p>
            </header>
            <?php
            echo "<form method='POST'>";
            echo "<input name='postContent' class='w3-input w3-border' type='text' placeholder='Merhaba " . htmlspecialchars($_SESSION['usernameForIdor']) . " bugün ne düşünüyorsun?' style='width:100%'/>";
            echo "<br><input type='submit' value='Paylaş' class='w3-button w3-red w3-margin-bottom'/>";
            echo "</form>";
            $postQuery = "SELECT * FROM posts WHERE post_status = :post_status order by post_id desc";
            $postStatement = $connect->prepare($postQuery);
            $postStatement->execute(
                array(
                    'post_status' => 1
                )
            );
            $count = $postStatement->rowCount();
            $result = $postStatement->fetchAll(\PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                echo "<div id='demoAcc' class='w3-bar-block w3-hide w3-padding-large w3-medium w3-show'><a href='idor-post.php?post_id=" . $row['post_id'] . "' class='w3-bar-item w3-button w3-light-grey'>" . htmlspecialchars($row['post_content']) . "</a>";
                echo "Paylaşan Kişi : " . $row['post_user'] . " | Paylaşım Tarihi : " . $row['post_date'];
                if ($_SESSION['usernameForIdor'] == $row['post_user']) {
                    echo " | <a style='color: red;text-decoration: none' href='idor-delete-post.php?id=" . $row['post_id'] . "'> Durumu Sil</a>" . "</div>";
                } else {
                    echo "</div>";
                }
            }
            ?>
            <?php
        }
        ?>
    </div>
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
            $_SESSION["usernameForIdor"] = $_POST["username"];
            echo '<script>window.location = "idor.php"</script>';
        } else {
            echo '<br>';
            echo '<div style="background-color: red;color:white" class="w3-container">';
            echo '<p>Kullanıcı Adı veya şifre hatalı.</p>';
            echo '</div>';
        }
        $con->close();
    }
    ?>
    <?php
    if (isset($_POST['postContent'])) {

        $content = $_POST['postContent'];

        $insertQuery = $connect->prepare("INSERT INTO posts SET post_user = ?, post_content = ?");

        $insert = $insertQuery->execute(array(
            $_SESSION['usernameForIdor'], $content
        ));

        if ($insert) {
            echo '<script>window.location = "idor.php"</script>';
        }
    }
    ?>
</div>
</body>
</html>