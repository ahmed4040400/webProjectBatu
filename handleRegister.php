<?php
session_start();
$phonePattern = "/^01[0-9]{9}$/"; // regular expression for phone number


$errors = [];

if (empty($_REQUEST['email'])) {
    $errors["email"] = 'Email is required';
}
if (empty($_REQUEST['username'])) {
    $errors["username"] = 'Username is required';
}



if (empty($_REQUEST['phone'])) {
    $errors['phone'] = 'Phone number is required';
} elseif (!preg_match($phonePattern, $_REQUEST['phone'])) {
    $errors['phone'] = 'Phone number is invalid';
}

if (empty($_REQUEST['password'])) {
    $errors["password"] = 'Password is required';
}
if (empty($_REQUEST['confirm-password'])) {
    $errors["confirm-password"] = 'Confirm Password is required';
} elseif ($_REQUEST['password'] != $_REQUEST['confirm-password']) {
    $errors["confirm-password"] = 'Passwords do not match';
}


$email = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars($_REQUEST['password']);
$username = htmlspecialchars($_REQUEST['username']);
$confirmPassword = htmlspecialchars($_REQUEST['confirm-password']);
$phoneNumber = htmlspecialchars($_REQUEST['phone']);
$userType = $_REQUEST['user-type'];







if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = 'Email is invalid';
}


if (empty($errors)) {

    require_once ('entities/user.php');

    try {
        if ($userType == User::RECRUITER) {
            $result = Recruiter::register($email, md5($password), $username, $phoneNumber);

        } elseif ($userType == User::SEEKER) {
            $result = Seeker::register($email, md5($password), $username, $phoneNumber);
        }

        header("Location:index.php?msg=sr");

    } catch (Exception $e) {
        header("Location:index.php?msg=already-exists");

    }
    $_SESSION['errors'] = null;
} else {

    $_SESSION['errors'] = $errors;

    header("Location:register.php");
}