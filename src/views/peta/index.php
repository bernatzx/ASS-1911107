<?php include_once __DIR__ . "/../../layout/header.php"; ?>

<div class="font-bold mb-[30px]">
  <span>Peta Interaktif</span>
  <br>
  <span class="text-gray-400 text-sm">Persebaran pohon mangrove</span>
</div>

<div class="flex gap-5 h-[500px]">
  <!-- MAP -->
  <div id="map" class="h-full w-full rounded-lg shadow-lg border-2 border-gray-500"></div>

  <!-- INFOTAB -->
  <div class="w-[500px] bg-gray-100 shadow-lg flex flex-col h-full rounded-lg border-2 border-gray-500">
    <div class="p-5 border-b-2 border-gray-300 text-center">Detail Box</div>
    <div class="p-3 relative flex-1">
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

  fetch('/api/pohon.php')
    .then(res => res.json())
    .then(data => {
      data.data.forEach(function (lokasi) {
        var marker = L.marker([lokasi.latitude, lokasi.longitude])
          .addTo(map)
          .bindPopup(`<b>${lokasi.nama_pohon}</b><br><span class='detail-btn cursor-pointer'>Detail <i class='fas fa-arrow-right'></i></span>`);
        marker.lokasiData = lokasi;
      });

      map.on('popupopen', function (e) {
        const popupEl = e.popup.getElement();
        const namaEl = popupEl.querySelector('.detail-btn');
        if (namaEl) {
          namaEl.addEventListener('click', function () {
            const marker = e.popup._source;
            const lokasi = marker.lokasiData;

            // tampilkan seluruh data di #detailinfo
            const infoDiv = document.getElementById('detailinfo');
            infoDiv.innerHTML = `
              <h2 class="font-bold text-lg mb-2">${lokasi.nama_pohon}</h2>
              <p><b>Lokasi:</b> ${lokasi.nama_lokasi}</p>
              <p><b>Latitude:</b> ${lokasi.latitude}</p>
              <p><b>Longitude:</b> ${lokasi.longitude}</p>
              ${lokasi.deskripsi ? `<p><b>Deskripsi:</b> ${lokasi.deskripsi}</p>` : ""}
              ${lokasi.gambar ? `<img src="/public/uploads/${lokasi.gambar}" class="mt-3 rounded-lg h-40 shadow w-full" alt="${lokasi.nama_pohon}">` : ""}
            `;
          });
        }
      });
    })
    .catch(err => console.error('Error:', err));
</script>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>