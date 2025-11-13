<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <div><span id="form-title"></span> Data Lokasi</div>
    <div class="text-gray-400 text-sm"><span id="form-subtitle"></span> data lokasi pohon yang telah didapatkan</div>
  </div>
  <div onclick="window.location.href='<?= base('src/views/lokasi') ?>'"
    class="border-2 border-blue-500 text-xs bg-blue-500 py-2 px-3 rounded-md shadow-md text-gray-200 cursor-pointer hover:opacity-70">
    <i class="fas fa-arrow-left"></i>
    Kembali
  </div>
</div>
<form class="max-w-lg mx-auto" id="form-data">
  <div class="mb-5">
    <label class="block text-sm mb-2">Lokasi</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="nama_lokasi">
  </div>
  <div class="mb-5">
    <label class="block text-sm mb-2">Jenis Pohon</label>
    <select id="jenis_pohon" name="jenis_pohon"
      class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md">
      <option value="">-- Pilih Jenis Pohon --</option>
    </select>
  </div>
  <div class="grid mb-5 grid-cols-2 gap-6">
    <div>
      <label class="block text-sm mb-2">Latitude</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="latitude">
    </div>
    <div>
      <label class="block text-sm mb-2">Longitude</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="longitude">
    </div>
  </div>
  <div class="mb-5 grid grid-cols-2 gap-6">
    <div>
      <label class="block text-sm mb-2">Desa</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="desa">
    </div>
    <div>
      <label class="block text-sm mb-2">Kota</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="kota">
    </div>
  </div>
  <div class="mb-5">
    <button
      class="bg-green-500 w-full rounded-md p-2 text-center text-white text-gray-900 hover:opacity-70 font-medium shadow-md">
      <i class="fas fa-fw fa-floppy-disk"></i>
      Simpan
    </button>
  </div>
  <div id="errorBox"
    class="hidden mb-4 font-medium text-sm flex items-center gap-2 p-2 bg-red-400 text-red-800 rounded-md">
    <i class="fas fa-circle-info"></i>
    <span id="errorMsg" class="flex-auto"></span>
    <div id="closeErrorBoxBtn">
      <i class="cursor-pointer fas fa-times"></i>
    </div>
  </div>
</form>

<script>
  const form = document.getElementById("form-data");
  const formTitle = document.getElementById("form-title");
  const formSubtitle = document.getElementById("form-subtitle");
  const errorBox = document.getElementById('errorBox');
  const errorMsg = document.getElementById('errorMsg');
  const closeErrorBoxBtn = document.getElementById('closeErrorBoxBtn');
  const jenisSelect = document.getElementById('jenis_pohon');

  async function loadJenis() {
    try {
      const res = await fetch("<?= base('/api/jenis.php') ?>");
      const data = await res.json();
      if (data.success && Array.isArray(data.data)) {
        data.data.forEach(item => {
          const opt = document.createElement("option");
          opt.value = item.id;
          opt.textContent = item.jenis_pohon;
          jenisSelect.appendChild(opt);
        });
      }
    } catch (err) {
      console.error("Gagal ambil data jenis:", err);
    }
  }

  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get("id");
  (async () => {
    await loadJenis();

    if (id) {
      formTitle.textContent = "Edit";
      formSubtitle.textContent = "Edit";
      const res = await fetch(`<?= base('/api/lokasi.php') ?>?id=${id}`, {
        method: "GET",
        headers: { "Content-Type": "application/json" }
      })
      const result = await res.json();
      if (result.success && result.data) {
        const d = result.data;
        if (form.elements["nama_lokasi"]) form.elements["nama_lokasi"].value = d.nama_lokasi || "";
        if (form.elements["latitude"]) form.elements["latitude"].value = d.latitude || "";
        if (form.elements["longitude"]) form.elements["longitude"].value = d.longitude || "";
        if (form.elements["desa"]) form.elements["desa"].value = d.desa || "";
        if (form.elements["kota"]) form.elements["kota"].value = d.kota || "";

        if (form.elements["jenis_pohon"]) form.elements["jenis_pohon"].value = d.id_jenis || "";
      } else {
        alert(result.msg || 'Data tidak ditemukan');
      }
    } else {
      formTitle.textContent = "Tambah";
      formSubtitle.textContent = "Tambah";
    }
  })();

  if (closeErrorBoxBtn) {
    closeErrorBoxBtn.addEventListener('click', () => {
      errorBox.classList.toggle('hidden');
    });
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    if (id) payload.id = id;

    try {
      const res = await fetch(`<?= base('api/lokasi.php') ?>${id ? `?id=${id}` : ""}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      })
      const data = await res.json();
      if (data.success) {
        window.location.href = "<?= base('src/views/lokasi') ?>";
      } else {
        errorMsg.textContent = data.msg;
        errorBox.classList.remove("hidden");
      }
    } catch (err) {
      errorMsg.textContent = 'Terjadi kesalahan.';
      errorBox.classList.remove('hidden');
      console.error(err);
    }
  })
</script>
<?php include_once __DIR__ . "/../../layout/footer.php"; ?>