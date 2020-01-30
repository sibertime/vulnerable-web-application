<!DOCTYPE html>
<?php
session_start();
require_once 'config/config.php';
?>
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
        <p class="w3-left">XSS</p>
    </header>
    <div class="w3-container w3-black w3-padding-32">
        <h3>SiberTime Zaman Tüneli</h3>
        <?php
        if (!isset($_SESSION["username"])) {
            ?>
            <form method="POST">
                <input name="username" class="w3-input w3-border" type="text" placeholder="Kullanıcı Adı"
                       style="width:100%"/><br>
                <input name="password" class="w3-input w3-border" type="password" placeholder="Şifre"
                       style="width:100%"/><br>
                <input type="submit" value="Giriş Yap" class="w3-button w3-red w3-margin-bottom"/>
            </form>
            <?php
        } else {
            echo '<b> Kullanıcı Adı : <i style="color: yellow">' . $_SESSION['username'] . '</i></b> || <a style="color: red;text-decoration: none" href="logout-xss.php">Çıkış Yap</a>';
            echo "<form method='POST'>";
            echo "<input name='postContent' class='w3-input w3-border' type='text' placeholder='Merhaba " . $_SESSION['username'] . " bugün ne düşünüyorsun?' style='width:100%'/>";
            echo "<br><input type='submit' value='Paylaş' class='w3-button w3-red w3-margin-bottom'/>";
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
                echo "<div id='demoAcc' class='w3-bar-block w3-hide w3-padding-large w3-medium w3-show'><a href='#' class='w3-bar-item w3-button w3-light-grey'>" . $row['post_content'] . "</a>";
                echo "Paylaşan Kişi : " . $row['post_user'] . " | Paylaşım Tarihi : " . $row['post_date'];
                echo "</div>";
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
            $_SESSION["username"] = $_POST["username"];
            echo '<script>window.location = "xss.php"</script>';
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
            $_SESSION['username'], $content
        ));

        if ($insert) {
            echo '<script>window.location = "xss.php"</script>';
        }
    }
    ?>
</div>
</body>
</html>