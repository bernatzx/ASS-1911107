<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="mb-[30px] flex items-center justify-between">
  <div class="font-bold">
    <span>Data Jenis Pohon</span>
    <br>
    <span class="text-gray-400 text-sm">Jenis jenis pohon yang telah didata</span>
  </div>
  <div class="flex gap-2">
    <div onclick="window.location=''"
      class="border-2 text-gray-700 border-gray-200 rounded-md py-2 px-3 text-xs hover:bg-gray-200 cursor-pointer">
      <i class="fas fa-refresh"></i>
    </div>
    <div onclick="window.location.href='<?= base('src/views/jenis-pohon/add.php') ?>'"
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
        <th class="tracking-wider text-left p-3">Jenis</th>
        <th class="tracking-wider text-center p-3">
          <i class="fas fa-gear"></i>
        </th>
      </tr>
    </thead>
    <tbody>
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="tracking-wider text-left p-3">1</td>
        <td class="tracking-wider text-left p-3">Bakau Minyak</td>
        <td class="tracking-wider justify-center p-3 flex gap-2">
          <div class="border border-yellow-600 py-1 px-2 text-yellow-600 rounded-md cursor-pointer hover:bg-gray-200">
            <i class="fas fa-pencil"></i>
          </div>
          <div class="border border-red-600 py-1 px-2 text-red-600 rounded-md cursor-pointer hover:bg-gray-200">
            <i class="fas fa-trash"></i>
          </div>
        </td>
      </tr>
      <tr class="odd:bg-white even:bg-gray-50">
        <td class="tracking-wider text-left p-3">1</td>
        <td class="tracking-wider text-left p-3">Bakau Minyak</td>
        <td class="tracking-wider justify-center p-3 flex gap-2">
          <div class="border border-yellow-600 py-1 px-2 text-yellow-600 rounded-md cursor-pointer hover:bg-gray-200">
            <i class="fas fa-pencil"></i>
          </div>
          <div class="border border-red-600 py-1 px-2 text-red-600 rounded-md cursor-pointer hover:bg-gray-200">
            <i class="fas fa-trash"></i>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<?php include_once __DIR__ . "/../../layout/footer.php"; ?>