<?php include_once __DIR__ . "/../../layout/header.php"; ?>

<div class="font-bold mb-[60px]">
  <span>Beranda</span>
  <br>
  <span id="greet" class="text-gray-400 text-sm"></span>
</div>
<div class="w-[600px] m-auto text-center">
  <div style="text-transform: uppercase;" class="font-medium text-xl">
    sistem informasi geografis untuk pemetaan pohon manghrove di kota ternate dan kota tidore
  </div>
  <div class="mt-2 text-gray-400 cursor-pointer" onclick="window.location.href='<?= base('src/views/peta') ?>'">
    Lihat Peta ->
  </div>
  <!-- STATISTIK SEDERHANA -->
  <div id="admin-only" class="flex justify-between font-bold mt-[60px]">
    <div>
      <span class="text-7xl">15</span>
      <br>
      <span class="text-gray-400">Pohon</span>
    </div>
    <div class="border-gray-200 border-2"></div>
    <div>
      <span class="text-7xl">11</span>
      <br>
      <span class="text-gray-400">Jenis Pohon</span>
    </div>
  </div>
</div>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>