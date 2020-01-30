<!DOCTYPE html>
<?php
session_start();
require_once 'config/config.php';
?>
<?php
if (isset($_POST['account_number'])) {
    $account_number = $_POST['account_number'];
    $account_password = $_POST['account_password'];

    $query = "SELECT * FROM bank_accounts WHERE account_number = :account_number AND account_password = :account_password limit 1";
    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            'account_number' => $account_number,
            'account_password' => $account_password
        )
    );
    $count = $statement->rowCount();
    $statement->execute();
    $row = $statement->fetch();
    if ($count > 0) {
        $_SESSION["account_number"] = $_POST["account_number"];
        header("location:csrf.php");
    } else {
        header("location:csrf.php?hata");
    }
    $con->close();
}
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
        <p class="w3-left">CSRF</p>
    </header>
    <div class="w3-container w3-black w3-padding-32">
        <h3>SiberTime Bankası İnternet Şubesi</h3>
        <?php
        if (!isset($_SESSION["account_number"])) {
            ?>
            <form method="POST">
                <input name="account_number" class="w3-input w3-border" type="text" placeholder="Banka Hesap Numarası"
                       style="width:100%"/><br>
                <input name="account_password" class="w3-input w3-border" type="password" placeholder="Şifre"
                       style="width:100%"/><br>
                <input type="submit" value="Giriş Yap" class="w3-button w3-red w3-margin-bottom"/>
            </form>
            <?php
            if (isset($_GET['hata'])) {
                echo '<br>';
                echo '<div style="background-color: red;color:white" class="w3-container">';
                echo '<p>Hesap bilgileriniz hatalı.</p>';
                echo '</div>';
            }
            ?>
            <?php
        } else {
            $getUserDataQuery = "SELECT * FROM bank_accounts WHERE account_number = :account_number limit 1";
            $getUserDataQueryStatement = $connect->prepare($getUserDataQuery);
            $getUserDataQueryStatement->execute(
                array(
                    'account_number' => $_SESSION["account_number"]
                )
            );
            $getUserDataQueryStatement->execute();
            $getUserDataQueryRow = $getUserDataQueryStatement->fetch();
            ?>
            <header style="background-color: whitesmoke;color: black" class="w3-container w3-xlarge">
                <p class="w3-left"><?php echo $getUserDataQueryRow['account_name'] . ' ' . $getUserDataQueryRow['account_surname'] . ' | <a style="color: red;text-decoration: none" href="logout-csrf.php">Çıkış Yap</a>' ?></p>
                <p class="w3-right">
                    Hesap Bakiyesi : <b><?php echo $getUserDataQueryRow['account_balance'] ?></b>
                    <i class="fa fa-try"></i>
                </p>
            </header>
            <div style="width: %100" class="w3-row-padding">
                <div class="w3-col s4">
                    <h4>Para Gönder</h4>
                    <form method="post">
                        <p><input class="w3-input w3-border" type="text" placeholder="Paranın Gönderileceği Hesap"
                                  name="account" required></p>
                        <p><input class="w3-input w3-border" type="text" placeholder="Gönderilecek Miktar" name="amount"
                                  required></p>
                        <p><input class="w3-input w3-border" type="text" placeholder="Açıklama" name="subject" required>
                        </p>
                        <input type="submit" value="Gönder" class="w3-button w3-red w3-margin-bottom"/>
                    </form>
                </div>
                <div class="w3-col s8">
                    <h4>Son İşlemler</h4>
                    <?php
                    $bankAccountsTransferQuery = "SELECT * FROM bank_accounts_transfer WHERE from_account = :from_account or to_account  = :to_account  order by request_id desc limit 15";
                    $bankAccountsTransferQueryStatement = $connect->prepare($bankAccountsTransferQuery);
                    $bankAccountsTransferQueryStatement->execute(
                        array(
                            'from_account' => $_SESSION['account_number'],
                            'to_account' => $_SESSION['account_number']
                        )
                    );
                    $bankAccountsTransferQueryResult = $bankAccountsTransferQueryStatement->fetchAll(\PDO::FETCH_ASSOC);
                    foreach ($bankAccountsTransferQueryResult as $bankAccountsTransferQueryRow) {
                        if ($_SESSION['account_number'] == $bankAccountsTransferQueryRow['from_account']) {
                            echo "<div style='background-color: red;margin-top: 3px;color:black'><p> <b style='color: white'> Tarih: </b>" . $bankAccountsTransferQueryRow['request_date'] . " <b style='color:white' >Açıklama :</b> " . $bankAccountsTransferQueryRow['to_account'] . " numaralı hesaba <b><x style='color: white'>" . $bankAccountsTransferQueryRow['amount'] . "</x></b> TL gönderildi.</p></div>";
                        }else{
                            echo "<div style='background-color: green;margin-top: 3px;color:white'><p> <b style='color: white'> Tarih: </b>" . $bankAccountsTransferQueryRow['request_date'] . " <b style='color:white' >Açıklama :</b> " . $bankAccountsTransferQueryRow['from_account'] . " numaralı hesap size <b><x style='color: white'>" . $bankAccountsTransferQueryRow['amount'] . "</x></b> TL gönderdi.</p></div>";

                        }
                    }
                    ?>
                </div>
            </div>

            <?php
        }
        ?>
    </div>
    <?php
    if (isset($_POST['account'])) {
        $accountNumberSender = $_SESSION['account_number'];
        $account = $_POST['account'];
        $amount = abs($_POST['amount']);
        $subject = $_POST['subject'];
        #Bakiye Kontrol

        $getBalance = "SELECT account_balance FROM bank_accounts WHERE account_number =" . $accountNumberSender . " limit 1";
        $balanceStatement = $connect->prepare($getBalance);
        $balanceStatement->execute();
        $row = $balanceStatement->fetch();
        $accountControl = "SELECT account_number FROM bank_accounts WHERE account_number =:account_number limit 1";
        $accountControlStatement = $connect->prepare($accountControl);
        $accountControlStatement->execute(
            array(
                'account_number' => $account
            )
        );
        $accountControlCount = $accountControlStatement->rowCount();

        if ($amount > $row['account_balance'] or $accountControlCount <= 0 or $accountNumberSender == $account) {
            echo '<br>';
            echo '<div style="background-color: red;color:white" class="w3-container">';
            echo '<p>Para transferi sırasında bir hata oluştu.</p>';
            echo '</div>';
        } else {
            $updateQuery = $connect->prepare("update bank_accounts SET account_balance = account_balance - ? where account_number = ?");
            $insertQuery = $connect->prepare("INSERT INTO bank_accounts_transfer (from_account,to_account,amount,request_content) values (?,?,?,?)");
            $updateQueryForToAccount = $connect->prepare("update bank_accounts SET account_balance = account_balance + ? where account_number = ?");

            $update = $updateQuery->execute(array(
                $amount, $accountNumberSender
            ));

            $update2 = $updateQueryForToAccount->execute(array(
                $amount, $account
            ));

            $insert = $insertQuery->execute([$accountNumberSender, $account, $amount, $subject]);

            if ($update and $insert and $update2) {
                echo '<script>window.location = "csrf.php"</script>';
            }
        }
    }
    ?>
</div>
</body>
</html>