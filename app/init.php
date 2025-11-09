<?php
declare(strict_types=1);
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/handlers/AdminHandler.php';
function base($url = null)
{
    $base = 'http://localhost:8000';
    if ($url != null) {
        return $base . '/' . $url;
    } else {
        return $base;
    }
}