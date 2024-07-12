<?php

session_start();

require_once ("../../entities/user.php");
$user = unserialize($_SESSION['user']);

if (empty($user)) {
    header("Location:../../index.php");
}
$errors = [];


$title = htmlspecialchars($_POST['title']);
$content = htmlspecialchars($_POST['content']);
$location = htmlspecialchars($_POST['location']);

if (empty($title) || empty($content) || empty($location)) {
    $errors['error'] = "All fields are required";
    header("Location:profile.php?msg=fields_required");

} else {
    $user->postAJob($title, $content, $location);
    header("Location:profile.php");
}




