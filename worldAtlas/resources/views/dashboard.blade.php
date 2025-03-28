<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Interactive World Map</title>
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css"/>
  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
    }
    #map {
      height: 100vh;
      width: 100%;
    }
    .button {
      background: rgba(255, 255, 255, 0.8);
      padding: 10px 20px;
      border-radius: 4px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.65);
      cursor: pointer;
      margin: 5px;
    }
    .button-container {
      position: absolute;
      top: 10px;
      left: 10px;
      z-index: 1000;
    }
    .dropdown-container {
      position: absolute;
      top: 50px;
      left: 10px;
      z-index: 1000;
      background: rgba(255, 255, 255, 0.8);
      padding: 10px;
      border-radius: 4px;
      box-shadow: 0 1px 5px rgba(0,0,0,0.65);
    }
  </style>
</head>
<body>
  <div id="map"></div>
  <div class="button-container">
    <div class="button" id="back-button" style="display: none;">Back</div>
    <div class="button" id="logout-button">Logout</div>
  </div>
  <div class="dropdown-container">
    <select id="country-dropdown">
      <option value="">Select a country</option>
    </select>
  </div>

  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    var southWest = L.latLng(-90, -180),
        northEast = L.latLng(90, 180),
        worldBounds = L.latLngBounds(southWest, northEast);

    var map = L.map('map', {
      center: [20, 0],
      zoom: 2,
      maxBounds: worldBounds,
      maxBoundsViscosity: 1.0,
      worldCopyJump: false
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      noWrap: true,
      bounds: worldBounds
    }).addTo(map);

    var continentsLayer, countriesLayer, allCountriesLayer;

    function styleFeature(continent) {
      var fillColor = "#3388ff";
      switch (continent.name) {
        case "Africa": fillColor = "#f28cb1"; break;
        case "Asia": fillColor = "#51bbd6"; break;
        case "Europe": fillColor = "#f1f075"; break;
        case "North America": fillColor = "#e55e5e"; break;
        case "South America": fillColor = "#3bb2d0"; break;
        case "Oceania": fillColor = "#223b53"; break;
        case "Antarctica": fillColor = "#b2e2e2"; break;
      }
      return {
        color: '#555',
        weight: 2,
        fillColor: fillColor,
        fillOpacity: 0.5
      };
    }

    function highlightFeature(e) {
      var layer = e.target;
      layer.setStyle({
        fillColor: "yellow",
        fillOpacity: 0.7
      });
    }

    function resetHighlight() {
      continentsLayer.eachLayer(function(layer) {
        layer.setStyle(styleFeature(layer.feature));
      });
    }

    function addBackButton() {
      var backButton = document.getElementById('back-button');
      backButton.style.display = 'block';
      backButton.onclick = function() {
        map.flyTo([20, 0], 2, { animate: true, duration: 1.5 });
        resetHighlight();
        backButton.style.display = 'none';
        if (countriesLayer) map.removeLayer(countriesLayer);
      };
    }

    var continentsData = [
      { name: "Africa", coordinates: [1, 20] },
      { name: "Asia", coordinates: [34, 100] },
      { name: "Europe", coordinates: [55, 15] },
      { name: "North America", coordinates: [40, -100] },
      { name: "South America", coordinates: [-15, -60] },
      { name: "Oceania", coordinates: [-20, 135] },
      { name: "Antarctica", coordinates: [-75, 0] }
    ];

    var countriesData = {
  "Africa": [
    { name: "Nigeria", coordinates: [10, 8] },
    { name: "Egypt", coordinates: [26, 30] },
    { name: "South Africa", coordinates: [-30, 25] },
    { name: "Kenya", coordinates: [1, 38] },
    { name: "Morocco", coordinates: [32, -5] },
    { name: "Ethiopia", coordinates: [9, 38] },
    { name: "Ghana", coordinates: [8, -2] },
    { name: "Tanzania", coordinates: [-6, 35] },
    { name: "Uganda", coordinates: [1, 32] },
    { name: "Zimbabwe", coordinates: [-20, 30] },
    { name: "Algeria", coordinates: [28, 3] },
    { name: "Angola", coordinates: [-12, 18] },
    { name: "Cameroon", coordinates: [5, 12] },
    { name: "Ivory Coast", coordinates: [7, -5] },
    { name: "Congo", coordinates: [-1, 15] },
    { name: "Democratic Republic of the Congo", coordinates: [-4, 15] },
    { name: "Madagascar", coordinates: [-20, 47] },
    { name: "Mozambique", coordinates: [-18, 35] },
    { name: "Zambia", coordinates: [-15, 30] },
    { name: "Rwanda", coordinates: [-2, 30] },
    { name: "Botswana", coordinates: [-22, 24] },
    { name: "Namibia", coordinates: [-22, 17] },
    { name: "Senegal", coordinates: [14, -14] },
    { name: "Mali", coordinates: [12, -8] },
    { name: "Burkina Faso", coordinates: [13, -1] },
    { name: "Niger", coordinates: [16, 8] },
    { name: "Chad", coordinates: [15, 19] },
    { name: "Gabon", coordinates: [-1, 11] },
    { name: "Benin", coordinates: [9, 2] },
    { name: "Burundi", coordinates: [-3, 30] },
    { name: "Swaziland", coordinates: [-26, 31] }
  ],
  "Asia": [
    { name: "China", coordinates: [35, 105] },
    { name: "Bangladesh", coordinates: [24, 90] },
    { name: "India", coordinates: [20, 77] },
    { name: "Indonesia", coordinates: [-5, 120] },
    { name: "Pakistan", coordinates: [30, 70] },
    { name: "Japan", coordinates: [36, 138] },
    { name: "Philippines", coordinates: [13, 122] },
    { name: "Vietnam", coordinates: [16, 106] },
    { name: "Turkey", coordinates: [39, 35] },
    { name: "Iran", coordinates: [32, 53] },
    { name: "South Korea", coordinates: [37, 127] },
    { name: "Iraq", coordinates: [33, 44] },
    { name: "Afghanistan", coordinates: [33, 65] },
    { name: "Saudi Arabia", coordinates: [25, 45] },
    { name: "Uzbekistan", coordinates: [41, 64] },
    { name: "Malaysia", coordinates: [4, 112] },
    { name: "Yemen", coordinates: [15, 48] },
    { name: "Nepal", coordinates: [28, 84] },
    { name: "North Korea", coordinates: [40, 127] },
    { name: "Sri Lanka", coordinates: [7, 81] },
    { name: "Kazakhstan", coordinates: [48, 68] },
    { name: "Syria", coordinates: [35, 38] },
    { name: "Jordan", coordinates: [31, 36] },
    { name: "Azerbaijan", coordinates: [40, 47] },
    { name: "Tajikistan", coordinates: [39, 71] },
    { name: "Israel", coordinates: [31, 35] }
  ],
  "Europe": [
    { name: "Germany", coordinates: [51, 10] },
    { name: "France", coordinates: [46, 2] },
    { name: "United Kingdom", coordinates: [54, -2] },
    { name: "Italy", coordinates: [42, 12] },
    { name: "Spain", coordinates: [40, -4] },
    { name: "Russia", coordinates: [55, 37] },
    { name: "Ukraine", coordinates: [49, 32] },
    { name: "Poland", coordinates: [52, 20] },
    { name: "Romania", coordinates: [45, 25] },
    { name: "Netherlands", coordinates: [52, 5] },
    { name: "Belgium", coordinates: [50, 4] },
    { name: "Greece", coordinates: [39, 22] },
    { name: "Portugal", coordinates: [39, -8] },
    { name: "Czech Republic", coordinates: [49, 15] },
    { name: "Sweden", coordinates: [60, 18] },
    { name: "Hungary", coordinates: [47, 20] },
    { name: "Belarus", coordinates: [53, 28] },
    { name: "Austria", coordinates: [47, 13] },
    { name: "Switzerland", coordinates: [47, 8] },
    { name: "Finland", coordinates: [64, 26] }
  ],
  "North America": [
    { name: "United States", coordinates: [37, -95] },
    { name: "Canada", coordinates: [56, -106] },
    { name: "Mexico", coordinates: [23, -102] },
    { name: "Guatemala", coordinates: [15, -90] },
    { name: "Honduras", coordinates: [13, -83] },
    { name: "El Salvador", coordinates: [13, -88] },
    { name: "Costa Rica", coordinates: [10, -84] },
    { name: "Panama", coordinates: [9, -80] },
    { name: "Jamaica", coordinates: [18, -77] }
  ],
  "South America": [
    { name: "Brazil", coordinates: [-14, -51] },
    { name: "Argentina", coordinates: [-34, -64] },
    { name: "Colombia", coordinates: [4, -72] },
    { name: "Chile", coordinates: [-33, -70] },
    { name: "Peru", coordinates: [-10, -75] },
    { name: "Venezuela", coordinates: [7, -66] },
    { name: "Ecuador", coordinates: [-2, -78] },
    { name: "Bolivia", coordinates: [-17, -65] },
    { name: "Paraguay", coordinates: [-23, -58] },
    { name: "Uruguay", coordinates: [-33, -56] }
  ],
      "Oceania": [
    { name: "Australia", coordinates: [-25, 133] },
    { name: "New Zealand", coordinates: [-41, 174] },
    { name: "Fiji", coordinates: [-18, 178] },
    { name: "Papua New Guinea", coordinates: [-6, 147] },
    { name: "Solomon Islands", coordinates: [-9, 160] },
    { name: "Vanuatu", coordinates: [-16, 167] },
    { name: 'Samoa', coordinates: [-13, -172] },
    { name: "Tonga", coordinates: [-20, -175] },
    { name: "Kiribati", coordinates: [1, -157] }
  ],
      "Antarctica": [
        { name: "Antarctica", coordinates: [-75, 0] }
      ]
    };

    function addContinents() {
      continentsLayer = L.layerGroup();
      continentsData.forEach(function(continent) {
        var layer = L.circleMarker(continent.coordinates, styleFeature(continent));
        layer.bindTooltip(continent.name, { direction: 'auto' });

        layer.on('click', function(e) {
          highlightFeature(e);
          map.flyTo(e.latlng, 4, { animate: true, duration: 1.5 });
          addBackButton();
          addCountries(continent.name);
        });
        continentsLayer.addLayer(layer);
      });
      continentsLayer.addTo(map);
    }

    function addCountries(continentName) {
  if (countriesLayer) map.removeLayer(countriesLayer);
  countriesLayer = L.layerGroup();
  var countries = countriesData[continentName];
  countries.forEach(function(country) {
    var layer = L.circleMarker(country.coordinates, {
      color: '#555',
      weight: 2,
      fillColor: '#ff7800',
      fillOpacity: 0.5
    });
    layer.bindTooltip(country.name, { direction: 'auto' });

    layer.on('click', function(e) {
      map.flyTo(e.latlng, 6, { animate: true, duration: 1.5 });

      // Delay redirect until after zoom animation
      setTimeout(function() {
        window.location.href = '/countries/' + encodeURIComponent(country.name);
      }, 1600); // 1.6 seconds to match zoom duration
    });

    countriesLayer.addLayer(layer);
  });
  countriesLayer.addTo(map);
  populateDropdown(countries);
}

    function populateDropdown(countries) {
      var dropdown = document.getElementById('country-dropdown');
      dropdown.innerHTML = '<option value="">Select a country</option>';
      countries.forEach(function(country) {
        var option = document.createElement('option');
        option.value = JSON.stringify(country.coordinates);
        option.text = country.name;
        dropdown.add(option);
      });
    }

    document.getElementById('country-dropdown').addEventListener('change', function() {
  var selectedOption = this.options[this.selectedIndex];
  var coordinates = JSON.parse(this.value);
  var countryName = selectedOption.text;

  if (coordinates) {
    map.flyTo(coordinates, 6, { animate: true, duration: 1.5 });
    setTimeout(function() {
      window.location.href = '/countries/' + encodeURIComponent(countryName);
    }, 1600);
  }
});


    // Load full country borders with English names
//     fetch('https://geojson-maps.ash.ms/world-110m.geo.json')
//       .then(response => response.json())
//       .then(data => {
//         allCountriesLayer = L.geoJSON(data, {
//           style: function(feature) {
//             return {
//               color: '#666',
//               weight: 1,
//               fillColor: '#88ccff',
//               fillOpacity: 0.4
//             };
//           },
//           onEachFeature: function(feature, layer) {
//   var name = feature.properties.name;
//   layer.bindTooltip(name, { direction: 'auto' });

//   layer.on('click', function(e) {
//     // Redirect to Laravel country page
//     window.location.href = '/countries/' + encodeURIComponent(name);
//   });
// }

//         }).addTo(map);
//       });

    addContinents();

    document.getElementById('logout-button').onclick = function() {
  fetch('{{ route("logout") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
  })
  .then(response => {
    window.location.href = '{{ route("login") }}'; // Redirect to login page
  })
  .catch(error => {
    console.error('Logout error:', error);
  });
};

  </script>
</body>
</html>
