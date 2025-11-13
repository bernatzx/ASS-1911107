<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <span>Data Lokasi</span>
    <br>
    <span class="text-gray-400 text-sm">Lokasi pohon yang telah didata</span>
  </div>
  <div class="flex gap-2">
    <div onclick="window.location.href=''"
      class="border-2 text-gray-700 border-gray-200 rounded-md py-2 px-3 text-xs hover:bg-gray-200 cursor-pointer">
      <i class="fas fa-refresh"></i>
    </div>
    <div onclick="window.location.href='<?= base('src/views/lokasi/form.php') ?>'"
      class="border-2 border-blue-500 text-xs bg-blue-500 py-2 px-3 rounded-md shadow-md text-gray-200 cursor-pointer hover:opacity-70">
      <i class="fas fa-add"></i>
      Tambah Data
    </div>
  </div>
</div>
<div class="border-2 rounded-md">
  <table class="w-full">
    <thead class="bg-gray-50 text-xs text-gray-700 uppercase border-b">
      <tr>
        <th class="tracking-wider text-left p-3">No.</th>
        <th class="tracking-wider text-left p-3">Lokasi</th>
        <th class="tracking-wider text-left p-3">Jenis</th>
        <th class="tracking-wider text-left p-3 w-20">Desa</th>
        <th class="tracking-wider text-left p-3 w-20">Kota</th>
        <th class="tracking-wider text-center p-3">
          <i class="fas fa-gear"></i>
        </th>
      </tr>
    </thead>
    <tbody id="data-body">
    </tbody>
  </table>
</div>

<script>
  const tbody = document.getElementById("data-body");

  async function loadData() {
    try {
      const res = await fetch("<?= base('/api/lokasi.php') ?>", {
        method: "GET",
        headers: { "Content-Type": "application/json" },
      });
      if (!res.ok) throw new Error("Gagal mengambil data");
      const data = await res.json();
      if (!data.data || data.data.length === 0) {
        tbody.className = "text-center";
        tbody.innerHTML = "<tr><td colspan='7' class='p-3'>Belum ada data</td></tr>";
        return;
      }

      const el = (tag, className = "", text = "") => {
        const e = document.createElement(tag);
        if (className) e.className = className;
        if (text) e.textContent = text;
        return e;
      };

      const tdClass = "tracking-wider text-left p-3";
      const tdAksiClass = "tracking-wider justify-center p-3 flex gap-2";

      data.data.forEach((row, i) => {
        const tr = el("tr", "odd:bg-white even:bg-gray-50");

        const tdNo = el("td", tdClass, i + 1);
        const tdLokasi = el("td", tdClass, row.nama_lokasi);
        const tdJenis = el("td", tdClass, row.jenis_pohon);
        const tdDesa = el("td", tdClass, row.desa);
        const tdKota = el("td", tdClass, row.kota);

        const tdAksi = el("td", tdAksiClass)

        const hapus = el("a", "border border-red-600 py-1 px-2 text-red-600 rounded-md cursor-pointer hover:bg-gray-200", "Hapus")
        const edit = el("a", "border border-yellow-600 py-1 px-2 text-yellow-600 rounded-md cursor-pointer hover:bg-gray-200", "Edit")


        hapus.addEventListener("click", async () => {
          if (confirm(`Yakin akan menghapus lokasi ${row.nama_lokasi}?`)) {
            const res = await fetch(`<?= base('/api/lokasi.php') ?>?id=${row.id}`, {
              method: "DELETE",
            });
            const result = await res.json();
            console.log(result);
            if (result.success) {
              window.location.reload();
            } else {
              alert(result.msg);
            }
          }
        });

        edit.addEventListener("click", () => {
          window.location.href = "<?= base('src/views/lokasi/form.php') ?>?id=" + row.id;
        });

        tdAksi.append(hapus, edit);

        tr.append(tdNo, tdLokasi, tdJenis, tdDesa, tdKota, tdAksi);

        tbody.append(tr);
      });
    } catch (error) {
      console.error(error);
    }
  }

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

    if (sessionRole !== 'admin' || !valid) {
      window.location.href = "<?= base('src/views/auth') ?>";
    } else {
      loadData();
    }
  })();
</script>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>