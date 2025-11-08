<?php
declare(strict_types=1);

$halamanAktif = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$menu = [
  ["icon" => "fa-home", "label" => "Beranda", "url" => base("src/views/beranda")],
  ["icon" => "fa-earth-asia", "label" => "Peta Interaktif", "url" => base("src/views/peta")],
  ["icon" => "fa-tree", "label" => "Data Pohon", "url" => base("src/views/pohon")],
  ["icon" => "fa-list", "label" => "Data Jenis Pohon", "url" => base("src/views/jenis-pohon")],
];
foreach ($menu as $col) {
  $aktif = (strpos($halamanAktif, $col['url']) === 0); ?>
  <div onclick="window.location.href='<?= htmlspecialchars($col['url'], ENT_QUOTES) ?>'"
    class="py-2 px-3 rounded-md hover:shadow-md hover:bg-blue-500 hover:text-white cursor-pointer mb-3 <?= $aktif ? 'bg-blue-500 text-white shadow-md' : '' ?>">
    <i class="fas <?= $col['icon'] ?> fa-fw"></i>
    <?= $col["label"] ?>
  </div>
<?php } ?>