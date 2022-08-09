<?php
    declare(strict_types=1);
    // Report all errors
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    require_once '../vendor/autoload.php';
    require_once './db.php';
?>