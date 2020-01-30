<?php
session_start();
if (isset($_SESSION['usernameForIdor'])) {
    require_once 'config/config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $userControlQuery = "SELECT post_user FROM posts WHERE post_id = :post_id order by post_id desc limit 1";
        $userControlQueryStatement = $connect->prepare($userControlQuery);
        $userControlQueryStatement->execute(
            array(
                'post_id' => $id
            )
        );
        $row = $userControlQueryStatement->fetch();

        if ($row['post_user'] == $_SESSION['usernameForIdor']) {
            $updateQuery = $connect->prepare("update posts SET post_status = 0 where post_id = ?");
            $update = $updateQuery->execute(array(
                $id
            ));
            if ($update) {
                echo "<script>window.location = 'idor.php'</script>";
                die();
            }
        } else {
            echo 'Bu post size ait bir post değildir.';
            echo "<script>setTimeout(function(){window.location.assign('idor.php');}, 1500);</script>";
            die();
        }
    }
} else {
    echo "<script>window.location = 'idor.php'</script>";
    die();
}