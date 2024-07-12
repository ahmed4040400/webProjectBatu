<?php
session_start();

if (!empty($_REQUEST['email']) && !empty($_REQUEST['password'])) {
    require_once ('entities/user.php');
    $email = htmlspecialchars($_REQUEST['email']);
    $password = htmlspecialchars($_REQUEST['password']);

    $user = User::login($email, md5($password));
    $_SESSION['user'] = serialize($user);
    if (!empty($user)) {

        header("Location:frontend/recruiter/home.php");


    } else {

        header("Location:login.php?msg=invalid-login");

    }


} else {
    header("Location:login.php?msg=empty-login");
}