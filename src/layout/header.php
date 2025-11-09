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
  <script src="<?= base("/src/assets/js/leaflet.js") ?>"></script>
  <link rel="stylesheet" href="<?= base("/src/assets/css/leaflet.css") ?>">
  <style>
    @font-face {
      font-family: 'Poppins';
      src: url('<?= base("src/assets/fonts/Poppins-Regular.ttf") ?>') format('truetype');
    }

    @font-face {
      font-family: 'Irish Grover';
      src: url('<?= base("src/assets/fonts/IrishGrover-Regular.ttf") ?>') format('truetype');
    }

    body {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Poppins', sans-serif;
    }

    .grover {
      font-family: 'Irish Grover', cursive;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
  </style>
</head>

<body>
  <main class="flex font-medium bg-white">
    <div class="fixed h-screen flex flex-col w-[300px] p-5" style="background-color: #c9c6c6;">
      <div class="mb-[50px]">
        <?php require_once __DIR__ . "/../components/logo.php"; ?>
      </div>
      <div class="flex-auto">
        <?php require_once __DIR__ . "/../components/navbar.php"; ?>
      </div>

      <div onclick="window.location.href='<?= base('src/views/auth') ?>'" id="login-btn"
        class="hidden cursor-pointer hover:bg-blue-500 py-2 px-3 rounded-md hover:shadow-md flex gap-3">
        <div>
          <i class="fas fa-user-tie fa-fw"></i>
        </div>
        <div>
          Login Admin
        </div>
      </div>
      <div onclick="logout()" id="logout-btn"
        class="hidden cursor-pointer hover:bg-red-400 py-2 px-3 rounded-md hover:shadow-md flex gap-3">
        <div>
          <i class="fas fa-door-open fa-fw"></i>
        </div>
        <div>
          Logout
        </div>
      </div>
    </div>

    <div class="flex-auto p-5 ml-[300px]">