<?php

session_start();
require_once ('../../entities/user.php');
$user = unserialize($_SESSION['user']);

$title = htmlspecialchars($_REQUEST['title']);
$content = htmlspecialchars($_REQUEST['content']);
$jobId = htmlspecialchars($_REQUEST['jobId']);


if (empty($title) || empty($content)) {
    header("Location:applicationForm.php?msg=fields_required");
} else {
    try {
        $user->sendApplication($jobId, $title, $content);
        header("Location:findJob.php?msg=sent");

    } catch (Exception $e) {

        header("Location:applicationForm.php?jobId=$jobId&msg=error");
    }

}

