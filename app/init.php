<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/handlers/AdminHandler.php';
require_once __DIR__ . '/handlers/LokasiHandler.php';
require_once __DIR__ . '/handlers/JPohonHandler.php';

function base($url = null)
{
    $base = 'http://localhost/asrul';
    if ($url != null) {
        return $base . '/' . $url;
    } else {
        return $base;
    }
}