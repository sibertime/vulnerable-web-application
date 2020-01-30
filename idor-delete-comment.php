<?php
session_start();
if (isset($_SESSION['usernameForIdor'])) {
    require_once 'config/config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $updateQuery = $connect->prepare("update post_comments SET post_comment_status = '0' where post_comment_id = ?");
        $update = $updateQuery->execute(array(
            $id
        ));
        if ($update) {
            ?>
            <script>
                var sure = 10; //5 sn sonra
                function geri(){
                    history.go(-1);
                }
                setTimeout('geri()', sure);
            </script>
            <?php
            die();
        }

    }
} else {
    echo "<script>window.location = 'idor.php'</script>";
    die();
}