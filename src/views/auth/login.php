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
        <form id="login-form">
          <div class="mb-4">
            <label class="mb-2 text-sm block">Username</label>
            <input class="block w-full p-2 border border-gray-300 bg-gray-50 text-sm rounded-md" type="text"
              name="username" required>
          </div>
          <div class="mb-4">
            <label class="mb-2 text-sm block">Kata Sandi</label>
            <input class="block w-full p-2 border border-gray-300 bg-gray-50 text-sm rounded-md" type="password"
              name="sandi" id="sandi" required>
          </div>
          <div class="mb-4 flex items-center gap-2">
            <input type="checkbox" id="show-sandi" class="w-4 h-4 cursor-pointer">
            <label for="show-sandi" class="text-sm text-gray-700 cursor-pointer select-none">
              Tampilkan kata sandi
            </label>
          </div>
          <div id="errorBox"
            class="hidden mb-4 font-medium text-sm flex items-center gap-2 p-2 bg-red-400 text-red-800 rounded-md">
            <i class="fas fa-circle-info"></i>
            <span id="errorMsg" class="flex-auto"></span>
            <div id="closeErrorBoxBtn">
              <i class="cursor-pointer fas fa-times"></i>
            </div>
          </div>
          <button type="submit"
            class="bg-blue-500 w-full flex justify-center font-medium hover:opacity-70 p-1 rounded-md text-white">
            Login
          </button>
        </form>
      </div>
    </div>
  </main>

  <script>
    const form = document.getElementById('login-form');
    const errorBox = document.getElementById('errorBox');
    const errorMsg = document.getElementById('errorMsg');
    const closeErrorBoxBtn = document.getElementById('closeErrorBoxBtn');
    const inputSandi = document.getElementById('sandi');
    const showSandi = document.getElementById('show-sandi');

    (async () => {
      let valid = false;
      try {
        const res = await fetch("<?= base('/api/auth.php') ?>", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          credentials: "include",
          body: JSON.stringify({ action: "me" }),
        });
        const data = await res.json();
        sessionRole = data.role || "guest";
        valid = !!data.valid;
      } catch (err) {
        console.error("Gagal memeriksa sesi:", err);
      }

      if (sessionRole === 'admin' || valid) {
        window.location.href = "<?= base('src/views/beranda') ?>";
      }
    })()

    showSandi.addEventListener('change', () => {
      inputSandi.type = showSandi.checked ? 'text' : 'password';
    });

    if (closeErrorBoxBtn) {
      closeErrorBoxBtn.addEventListener('click', () => {
        errorBox.classList.toggle('hidden');
      });
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const formData = new FormData(form);
      const data = Object.fromEntries(formData.entries());
      for (let key in data) {
        if (!data[key]) {
          errorMsg.textContent = "Semua field wajib diisi.";
          errorBox.classList.remove("hidden");
          return;
        }
      }
      try {
        const res = await fetch("<?= base('/api/auth.php') ?>", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ action: "login", ...data })
        });
        const result = await res.json();
        if (result.success) {
          window.location = '<?= base() ?>';
        } else {
          errorMsg.textContent = result.msg;
          errorBox.classList.remove('hidden');
        }
      } catch (error) {
        errorMsg.textContent = 'Terjadi kesalahan.';
        errorBox.classList.remove('hidden');
      }
    })
  </script>
</body>

</html>