<?php
session_start();
require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);

$user->refuseApplication(
    $_GET['applicationId']
);
header('Location:profile.php?msg=aa');