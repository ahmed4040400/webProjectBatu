<?php
session_start();

require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);

$target_dir = "http://localhost/hireup/images/posts/";

if (!empty($_REQUEST['content'])) {
    try {

        $content = htmlspecialchars($_REQUEST['content']);
        $imgPath = "../../images/posts/" . $_FILES['image']['name'];
        $target_file = $target_dir . basename($_FILES["image"]["name"]);

        move_uploaded_file($_FILES['image']['tmp_name'], $imgPath);
        $user->postAPost(
            $content,
            $target_file
        );
        header('location:home.php');
    } catch (Exception $e) {
        header('location:home.php?msg=error');
    }

} else {
    header('location:home.php?msg=content_required');
}