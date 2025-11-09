<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <span>Tambah Data Pohon</span>
    <br>
    <span class="text-gray-400 text-sm">Tambah data pohon yang telah didapatkan</span>
  </div>
  <div onclick="window.location.href='<?= base('src/views/pohon') ?>'"
    class="border-2 border-blue-500 text-xs bg-blue-500 py-2 px-3 rounded-md shadow-md text-gray-200 cursor-pointer hover:opacity-70">
    <i class="fas fa-arrow-left"></i>
    Kembali
  </div>
</div>
<form class="max-w-lg mx-auto" id="add-form">
  <div class="mb-5">
    <label class="block text-sm mb-2">Nama Pohon</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="pohon">
  </div>
  <div class="mb-5">
    <label class="block text-sm mb-2">Jenis Pohon</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="jenis">
  </div>
  <div class="mb-5">
    <label class="block text-sm mb-2">Lokasi</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="lokasi">
  </div>
  <div class="grid mb-5 grid-cols-2 gap-6">
    <div>
      <label class="block text-sm mb-2">Latitude</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="lat">
    </div>
    <div>
      <label class="block text-sm mb-2">Longitude</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
        name="lng">
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
  <div class="mb-5 grid grid-cols-2 gap-6">
    <div>
      <label class="block text-sm mb-2">Gambar</label>
      <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="img"
        name="gambar">
    </div>
    <div class="relative">
      <button
        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 bg-green-500 w-full rounded-md p-2 text-center text-white text-gray-900 hover:opacity-70 font-medium shadow-md">
        <i class="fas fa-fw fa-floppy-disk"></i>
        Simpan
      </button>
    </div>
  </div>
</form>

<script>
  const form = document.getElementById("add-form");
  
</script>
<?php include_once __DIR__ . "/../../layout/footer.php"; ?>