<?php
session_start();
require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);

$comment = htmlspecialchars($_REQUEST['content']);
$postId = htmlspecialchars($_REQUEST['postId']);
if (!empty($comment)) {
    try {
        $user->commentAPost($postId, $comment);
        header("Location:home.php");

    } catch (Exception $e) {
        header("Location:home.php?msg=error");

    }


} else {
    header("Location:home.php?msg=comment_required");
}