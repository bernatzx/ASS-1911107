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
      const res = await fetch("/api/auth.php", {
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

  (async () => {
    try {
      const res = await fetch("/api/auth.php", {
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
      logoutBtn.classList.remove('hidden');
      gt.innerText = 'Selamat datang Admin';
    }
  })();
</script>

</body>

</html>