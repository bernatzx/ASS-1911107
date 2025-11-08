<?php include_once __DIR__ . "/../../layout/header.php"; ?>

<div class="font-bold mb-[30px]">
  <span>Peta Interaktif</span>
  <br>
  <span class="text-gray-400 text-sm">Persebaran pohon mangrove</span>
</div>
<div id="map" class="h-[500px] rounded-lg shadow-lg border-2 border-gray-500">
</div>

<script>
  var map = L.map('map').setView([0.7487861847420483, 127.39816189182466], 12);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);
</script>

<?php include_once __DIR__ . "/../../layout/footer.php"; ?>