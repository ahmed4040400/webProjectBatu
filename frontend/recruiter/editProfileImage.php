<?php
session_start();
require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);
$target_dir = "http://localhost/hireup/images/profile/";


if (!empty($_FILES["profileImage"]['full_path'])) {
    $imgPath = "../../images/profile/" . $_FILES['profileImage']['name'];
    $target_file = $target_dir . basename($_FILES["profileImage"]["name"]);


    move_uploaded_file($_FILES['profileImage']['tmp_name'], $imgPath);

    $user->editProfileImg($target_file);

    header('Location: profile.php');
} else {
    header('Location: profile.php?msg=error');
}

