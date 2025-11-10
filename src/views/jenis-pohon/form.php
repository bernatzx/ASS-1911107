<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <div><span id="form-title"></span> Data Jenis Pohon</div>
    <div class="text-gray-400 text-sm"><span id="form-subtitle"></span> data jenis pohon yang telah didapatkan</div>
  </div>
  <div onclick="window.location.href='<?= base('src/views/jenis-pohon') ?>'"
    class="border-2 border-blue-500 text-xs bg-blue-500 py-2 px-3 rounded-md shadow-md text-gray-200 cursor-pointer hover:opacity-70">
    <i class="fas fa-arrow-left"></i>
    Kembali
  </div>
</div>
<form class="max-w-lg mx-auto" id="add-form">
  <div class="mb-4">
    <label class="block text-sm mb-2">Jenis Pohon</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="jenis_pohon">
  </div>
  <div id="errorBox"
    class="hidden mb-4 font-medium text-sm flex items-center gap-2 p-2 bg-red-400 text-red-800 rounded-md">
    <i class="fas fa-circle-info"></i>
    <span id="errorMsg" class="flex-auto"></span>
    <div id="closeErrorBoxBtn">
      <i class="cursor-pointer fas fa-times"></i>
    </div>
  </div>
  <div>
    <button type="submit"
      class="bg-green-500 w-full rounded-md p-2 text-center text-white text-gray-900 hover:opacity-70 font-medium shadow-md">
      <i class="fas fa-fw fa-floppy-disk"></i>
      Simpan
    </button>
  </div>
</form>

<script>
  const form = document.getElementById("add-form");
  const formTitle = document.getElementById("form-title");
  const formSubtitle = document.getElementById("form-subtitle");
  const errorBox = document.getElementById('errorBox');
  const errorMsg = document.getElementById('errorMsg');
  const closeErrorBoxBtn = document.getElementById('closeErrorBoxBtn');

  // CEK TIPE FORM ANTARA EDIT ATAU TAMBAH
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get("id");
  (async () => {
    if (id) {
      formTitle.textContent = "Edit";
      formSubtitle.textContent = "Edit";
      const res = await fetch(`/api/jenis.php?id=${id}`, {
        method: "GET",
        headers: { "Content-Type": "application/json" }
      })
      const result = await res.json();
      console.log(result.data);
      if (result.success && result.data) {
        Object.keys(result.data).forEach((key) => {
          if (form.elements[key]) {
            form.elements[key].value = result.data[key];
          }
        })
      } else {
        alert(result.msg || 'Data tidak ditemukan');
      }
    } else {
      formTitle.textContent = "Tambah";
      formSubtitle.textContent = "Tambah";
    }
  })();

  // TOMBOL EXIT PESAN ERROR
  if (closeErrorBoxBtn) {
    closeErrorBoxBtn.addEventListener('click', () => {
      errorBox.classList.toggle('hidden');
    });
  }

  // SUBMIT FORM
  form.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(form);
    const payload = Object.fromEntries(formData.entries());

    if (id) payload.id = id;

    try {
      const res = await fetch(`/api/jenis.php${id ? `?id=${id}` : ""}`, {
        method: id ? "PUT" : "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(payload)
      })
      const data = await res.json();
      if (data.success) {
        window.location.href = "<?= base('src/views/jenis-pohon') ?>";
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