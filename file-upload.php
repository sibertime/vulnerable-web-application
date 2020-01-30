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
        <p class="w3-left">File Upload</p>
    </header>

    <div class="w3-container w3-black w3-padding-32">
        <header style="background-color: whitesmoke;color: black" class="w3-container w3-xlarge">
            <p class="w3-left">
                SiberTime Oyunları Destek Sistemi
            </p>
            <p class="w3-right">
                Sibertime
            </p>
        </header>
        <br>
        <?php
        if (isset($_POST['supportInput'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $title = $_POST['title'];
            $content = $_POST['content'];

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $target_file = $target_dir . uniqid() . '.' . $imageFileType;
            $uploadOk = 1;

            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                #echo "Yüklediğiniz dosya bir resim değil";
                $uploadOk = 1;
            }

            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Üzgünüz, yüklediğiniz dosya boyutu oldukça fazla.";
                $uploadOk = 0;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {
                #echo "Üzgünüz sadece, JPG, JPEG, PNG ve GIF uzantılı dosyalar yükleyebilirsiniz.";
                $uploadOk = 1;
            }

            if ((!isset($name) or empty($name)) or (!isset($email) or empty($email)) or (!isset($title) or empty($title)) or (!isset($content) or empty($content))) {
                echo 'Lütfen boş bir alan bırakmayınız!';
            } else {
                $uniqueCode = md5(uniqid(rand(), true));
                $support_id = substr($uniqueCode, 0, 10);
                $support_secure_code = substr($uniqueCode, 12, 10);
                $insertQuery = $connect->prepare("INSERT INTO supports (support_id,support_secure_code,support_title,support_content,support_email,image_path) values (?,?,?,?,?,?)");
                $insert = $insertQuery->execute([$support_id, $support_secure_code, $name, $content, $email, $target_file]);
                if ($insert and $uploadOk == 1) {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        echo 'Destek Kodunuz : ' . $support_id;
                        echo '<br>';
                        echo 'Şifreniz : ' . $support_secure_code;
                    } else {
                        echo "Resim yüklenirken hata oluştu.";
                    }
                }
            }
        } elseif (!isset($_POST['supportCode'])) {
            ?>
            <div class="w3-col s4">
                <h4>Destek Telebini Sorgula</h4>
                <form method="POST">
                    <input name="supportCode" class="w3-input w3-border" type="text" placeholder="Destek Kodu"
                           style="width:100%"/><br>
                    <input name="secureCode" class="w3-input w3-border" type="text" placeholder="Güvenlik Kodu"
                           style="width:100%"/><br>
                    <input type="submit" value="Sorgula" class="w3-button w3-red w3-margin-bottom"/>
                </form>
            </div>
            <div style="margin-left: 5px;" class="w3-col s7">
                <h4>Destek Telebini Oluştur</h4>
                <form enctype="multipart/form-data" method="POST">
                    <input name="name" class="w3-input w3-border" type="text" placeholder="İsim"
                           style="width:100%"/><br>
                    <input name="email" class="w3-input w3-border" type="text" placeholder="E-Posta Adresi"
                           style="width:100%"/><br>
                    <input name="title" class="w3-input w3-border" type="text" placeholder="Başlık"
                           style="width:100%"/><br>
                    <textarea name="content" class="w3-input w3-border" placeholder="Mesaj"></textarea><br>
                    <input type="file" name="fileToUpload" class="w3-input w3-border" id="fileToUpload">
                    <input type="hidden" value="1" name="supportInput"/>
                    <br>
                    <input type="submit" value="Oluştur" class="w3-button w3-red w3-margin-bottom"/>
                </form>
            </div>
            <?php
        } else {
            $supportCode = $_POST['supportCode'];
            $secureCode = $_POST['secureCode'];
            $getSupportData = "SELECT * FROM supports WHERE support_id ='" . $supportCode . "' and support_secure_code='" . $secureCode . "' limit 1";
            $getSupportDataStatement = $connect->prepare($getSupportData);
            $getSupportDataStatement->execute();
            $row = $getSupportDataStatement->fetch();
            ?>
            <p style="background-color: white;color: black">
                Destek Numarası : <?php echo htmlspecialchars($row['support_id']) ?><br>
                Destek Başlığı : <?php echo htmlspecialchars($row['support_title']) ?><br>
                Destek İçeriği : <?php echo htmlspecialchars($row['support_content']) ?><br>
                Destek Resmi : <img src="<?php echo htmlspecialchars($row['image_path']) ?>"><br>
                Destek Okunma Durumu : <?php echo $row['support_status'] == 1 ? 'Okunmuş' : 'Okunmamış' ?><br>
            </p>
            <?php
        }
        ?>
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