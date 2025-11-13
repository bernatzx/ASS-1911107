<?php include_once __DIR__ . "/../../layout/header.php"; ?>
<div class="font-bold mb-[30px]">
  <span>Peta Interaktif</span>
  <br>
  <span class="text-gray-400 text-sm">Persebaran pohon mangrove</span>
</div>

<div class="flex gap-5 h-[500px]">
  <div id="map" class="h-full w-full rounded-lg shadow-lg border-2 border-gray-500"></div>
  <div class="w-[500px] bg-gray-100 shadow-lg flex flex-col h-full rounded-lg border-2 border-gray-500">
    <div class="p-5 border-b-2 border-gray-300 text-center">Detail Box</div>
    <div class="relative flex-1">
      <div id="detailinfo">
        <div class="absolute inset-0 flex justify-center items-center text-gray-400">Menunggu</div>
      </div>
    </div>
  </div>
</div>

<script>
  var map = L.map('map').setView([0.7487861847420483, 127.39816189182466], 12);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  function popUpBox(lokasi) {
    return `
      <span class='font-semibold'>${lokasi.jenis_pohon}</span>
      <br>
      <span class='hover:opacity-70 detail-btn text-blue-500 cursor-pointer'>
        Detail <i class='fas fa-arrow-right'></i>
      </span>
    `;
  };

  function showDetail(lokasi) {
    const infoDiv = document.getElementById('detailinfo');
    infoDiv.innerHTML = `
      <div class="font-semibold absolute inset-0 flex justify-center p-5 flex-col">
        <div class="mb-5 flex text-lg gap-3">
          <div>
            <i class="fas fa-tree fa-fw"></i>
          </div>
          <div>
            ${lokasi.jenis_pohon}
          </div>
        </div>
        <div class="mb-5 flex gap-4">
          <div>
            <i class="fas fa-location-pin fa-fw"></i>
          </div>
          <div class="text-sm text-gray-700">
            ${lokasi.nama_lokasi}, Desa ${lokasi.desa}, Kota ${lokasi.kota}
          </div>
        </div>
        ${lokasi.gambar ? `<img src="<?= base('/uploads/') ?>${lokasi.gambar}" class="mt-3 rounded-lg h-50 shadow w-full" alt="${lokasi.nama_pohon}">` : ""}
      </div>
    `;
  }

  (async () => {
    try {
      const res = await fetch("<?= base('api/lokasi.php') ?>", {
        method: "GET",
      })
      const data = await res.json();
      if (data.success) {
        data.data.forEach(function (lokasi) {
          var marker = L.marker([lokasi.latitude, lokasi.longitude])
            .addTo(map)
            .bindPopup(popUpBox(lokasi));
          marker.lokasiData = lokasi;
        });
        map.on('popupopen', function (e) {
          const popupEl = e.popup.getElement();
          const namaEl = popupEl.querySelector('.detail-btn');
          if (namaEl) {
            namaEl.addEventListener('click', function () {
              const marker = e.popup._source;
              showDetail(marker.lokasiData)
            });
          }
        });
      }
    } catch (err) {
      console.error(err);
    }
  })()
</script>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>