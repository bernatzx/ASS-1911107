</div>
</main>

<script>
  const loginBtn = document.getElementById("login-btn");
  const logoutBtn = document.getElementById("logout-btn");
  let sessionRole = "guest";
  let valid = false;

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
    }
    
    if (sessionRole === "admin" && valid) {
      logoutBtn.classList.remove('hidden');
    }
  })();
</script>

</body>

</html>