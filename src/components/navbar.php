<?php
declare(strict_types=1);

$role = $_SESSION['role'] ?? 'guest';
$valid = $_SESSION['valid'] ?? false;

$halamanAktif = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$menu = [
  ["icon" => "fa-home", "label" => "Beranda", "url" => base("src/views/beranda"), "roles" => ["admin", "guest"]],
  ["icon" => "fa-earth-asia", "label" => "Peta Interaktif", "url" => base("src/views/peta"), "roles" => ["admin", "guest"]],
  ["icon" => "fa-tree", "label" => "Data Pohon", "url" => base("src/views/pohon"), "roles" => ["admin"]],
  ["icon" => "fa-list", "label" => "Data Jenis Pohon", "url" => base("src/views/jenis-pohon"), "roles" => ["admin"]],
];
foreach ($menu as $col) {
  if (!in_array($role, $col['roles']))
    continue;
  $aktif = (strpos($halamanAktif, $col['url']) === 0); ?>
  <div onclick="window.location.href='<?= htmlspecialchars($col['url'], ENT_QUOTES) ?>'"
    class="py-2 flex gap-3 px-3 rounded-md hover:shadow-md hover:bg-blue-500 hover:text-white cursor-pointer mb-3 <?= $aktif ? 'bg-blue-500 text-white shadow-md' : '' ?>">
    <div>
      <i class="fas <?= $col['icon'] ?> fa-fw"></i>
    </div>
    <div>
      <?= $col["label"] ?>
    </div>
  </div>
<?php } ?>