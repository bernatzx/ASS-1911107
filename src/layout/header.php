<?php
require_once __DIR__ . "/../../app/init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Informasi Geografis Pemetaan Pohon Mangrove</title>
  <script src="<?= base("/src/assets/js/all.min.js") ?>" defer></script>
  <script src="<?= base("/src/assets/js/tailwindcss.js") ?>"></script>
  <style>
    body {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
  </style>
</head>

<body>
  <main class="flex bg-white h-screen font-medium">
    <div class="flex flex-col w-[250px] p-5" style="background-color: #c9c6c6;">
      <div class="mb-5">logo</div>
      <div class="flex-auto">
        <?php require_once __DIR__ . "/../components/navbar.php"; ?>
      </div>
      <div class="cursor-pointer hover:bg-red-400 py-2 px-3 rounded-md hover:shadow-md">
        <i class="fas fa-door-open"></i>
        <span>Logout</span>
      </div>
    </div>
    <div>