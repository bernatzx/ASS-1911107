</div>
</main>

<script>
  const loginBtn = document.getElementById("login-btn");
  const logoutBtn = document.getElementById("logout-btn");
  const gt = document.getElementById("greet");
  const ao = document.getElementById('admin-only');
  let sessionRole = "guest";
  let valid = false;

  async function logout() {
    try {
      const res = await fetch("<?= base('/api/auth.php') ?>", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ action: "logout" }),
      })
      const result = await res.json();
      if (result.success) {
        location.reload();
      }
    } catch (err) {
      console.error("Gagal memeriksa sesi:", err);
    }
  }

  async function totalLokasi() {
    const el = document.getElementById('total-lokasi');
    try {
      const res = await fetch("<?= base('api/lokasi.php') ?>");
      const data = await res.json();
      if (data.success) {
        el.textContent = data.data.length;
      }
    } catch (err) {
      console.error("Gagal menggapai API:", err);
    }
  }

  async function totalJenis() {
    const el = document.getElementById('total-jenis');
    try {
      const res = await fetch("<?= base('api/jenis.php') ?>");
      const data = await res.json();
      if (data.success) {
        el.textContent = data.data.length;
      }
    } catch (err) {
      console.error("Gagal menggapai API:", err);
    }
  }

  (async () => {

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

    if (sessionRole === "guest" || !valid) {
      loginBtn.classList.remove('hidden');
      gt.innerText = 'Selamat datang';
      ao.classList.add('hidden');
    }

    if (sessionRole === "admin" && valid) {
      await totalLokasi();
      await totalJenis();
      logoutBtn.classList.remove('hidden');
      gt.innerText = 'Selamat datang Admin';
    }
  })();
</script>

</body>

</html>