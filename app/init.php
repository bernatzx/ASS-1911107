<?php
declare(strict_types=1);

function base($url = null)
{
    $base = 'http://localhost:8000';
    if ($url != null) {
        return $base . '/' . $url;
    } else {
        return $base;
    }
}