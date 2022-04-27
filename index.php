<?php
session_start();
// session_destroy();
if ($_SESSION["role"] == 2) : ?>
<?php include  $_SERVER['DOCUMENT_ROOT'] . "/dashboard/user/main.php" ?>
<?php elseif ($_SESSION["role"] == 1) : ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . "/dashboard/admin/main.php" ?>
<?php else:?>
<?php header("location: login.php") ?>
<?php endif; ?>