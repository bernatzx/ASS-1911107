<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <span>Tambah Data Jenis Pohon</span>
    <br>
    <span class="text-gray-400 text-sm">Tambah data jenis pohon yang telah didapatkan</span>
  </div>
  <div onclick="window.location.href='<?= base('src/views/jenis-pohon') ?>'"
    class="border-2 border-blue-500 text-xs bg-blue-500 py-2 px-3 rounded-md shadow-md text-gray-200 cursor-pointer hover:opacity-70">
    <i class="fas fa-arrow-left"></i>
    Kembali
  </div>
</div>
<form class="max-w-lg mx-auto">
  <div class="mb-5">
    <label class="block text-sm mb-2">Jenis Pohon</label>
    <input class="block w-full bg-gray-50 border border-gray-300 text-gray-900 p-2 text-sm rounded-md" type="text"
      name="jenis">
  </div>
  <div>
    <button
      class="bg-green-500 w-full rounded-md p-2 text-center text-white text-gray-900 hover:opacity-70 font-medium shadow-md">
      <i class="fas fa-fw fa-floppy-disk"></i>
      Simpan
    </button>
  </div>
</form>
<?php include_once __DIR__ . "/../../layout/footer.php"; ?>