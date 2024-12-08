<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Peta Interaktif</title>

  <!-- Leaflet.js CDN -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC4lKVb0eLSNyhEO-C_8JoHhAvba6aZc3U"></script>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h1 {
      text-align: center;
      padding: 10px;
    }

    .map-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
      margin: 20px auto;
      max-width: 90%;
    }

    #leaflet-map, #google-map {
      flex: 1 1 45%;
      height: 400px;
    }
  </style>
</head>
<body>
  <h1>Peta Interaktif dengan Laravel</h1>

  <div class="map-container">
    <div id="leaflet-map"></div>
    <div id="google-map"></div>
  </div>

  <script>
    // Leaflet.js Map
    const leafletMap = L.map('leaflet-map').setView([-8.7984047, 115.1698715], 15);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(leafletMap);

    const leafletMarker = L.marker([-8.7984047, 115.1698715]).addTo(leafletMap);
    leafletMarker.bindPopup("<b>Kantor:</b><br>Rektorat Universitas Udayana").openPopup();

    leafletMarker.on('click', () => {
      leafletMap.setView(leafletMarker.getLatLng(), 18); // Zoom otomatis
    });

    const leafletHomeMarker = L.marker([-8.664350894329225, 115.21561952580757]).addTo(leafletMap);
    leafletHomeMarker.bindPopup("<b>Rumah Saya</b>");

    leafletHomeMarker.on('click', () => {
      leafletMap.setView(leafletHomeMarker.getLatLng(), 18); // Zoom otomatis
    });

    // Google Maps API Map
    const googleMapDiv = document.getElementById('google-map');
    const googleMap = new google.maps.Map(googleMapDiv, {
      center: { lat: -8.7984047, lng: 115.1698715 },
      zoom: 15,
    });

    const googleMarker = new google.maps.Marker({
      position: { lat: -8.7984047, lng: 115.1698715 },
      map: googleMap,
      title: "Kantor: Rektorat Universitas Udayana",
    });

    const infoWindow = new google.maps.InfoWindow({
      content: "<b>Kantor:</b><br>Rektorat Universitas Udayana",
    });

    googleMarker.addListener('click', () => {
      infoWindow.open(googleMap, googleMarker);
      googleMap.setZoom(18); // Zoom otomatis
      googleMap.setCenter(googleMarker.getPosition()); // Pusatkan pada marker
    });

    const googleHomeMarker = new google.maps.Marker({
      position: { lat: -8.664350894329225, lng: 115.21561952580757 },
      map: googleMap,
      title: "Rumah Saya",
    });

    const homeInfoWindow = new google.maps.InfoWindow({
      content: "<b>Rumah Saya</b>",
    });

    googleHomeMarker.addListener('click', () => {
      homeInfoWindow.open(googleMap, googleHomeMarker);
      googleMap.setZoom(18); // Zoom otomatis
      googleMap.setCenter(googleHomeMarker.getPosition()); // Pusatkan pada marker
    });
  </script>
</body>
</html>