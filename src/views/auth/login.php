<?php
require_once __DIR__ . "/../../../app/init.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin | Sistem Informasi Geografis Pemetaan Pohon Mangrove</title>
  <script src="<?= base("/src/assets/js/all.min.js") ?>" defer></script>
  <script src="<?= base("/src/assets/js/tailwindcss.js") ?>"></script>
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
  <main class="p-5 h-screen relative">
    <div class="absolute top-5 left-5">
      <?php require_once __DIR__ . "/../../components/logo.php"; ?>
    </div>
    <div onclick="window.location.href='<?= base() ?>'"
      class="absolute top-10 right-5 text-sm text-gray-700 cursor-pointer hover:opacity-70">
      <i class="fas fa-fw fa-arrow-left"></i>
      Kembali
    </div>
    <div class="flex items-center h-full">
      <div class="bg-gray-200 w-full max-w-xs m-auto p-5 rounded-md">
        <h2 class="text-center mb-5 text-xl capitalize font-semibold">login admin</h2>
        <form>
          <div class="mb-4">
            <label class="mb-2 text-sm block">Username</label>
            <input class="block w-full p-2 border border-gray-300 bg-gray-50 text-sm rounded-md" type="text"
              name="username" required>
          </div>
          <div class="mb-4">
            <label class="mb-2 text-sm block">Kata Sandi</label>
            <input class="block w-full p-2 border border-gray-300 bg-gray-50 text-sm rounded-md" type="password"
              name="sandi" required>
          </div>
          <div class="bg-blue-500 cursor-pointer flex justify-center font-medium hover:opacity-70 p-1 rounded-md text-white">
            Login
          </div>
        </form>
      </div>
    </div>
  </main>
</body>

</html>