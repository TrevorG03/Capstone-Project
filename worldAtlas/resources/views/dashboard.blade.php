<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Interactive World Map</title>
  <!-- Include Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <style>
  /* Ensure the map displays properly */
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
  /* Styling for the Back and Logout buttons */
  .button {
    background: rgba(255, 255, 255, 0.8);
    padding: 10px 20px; /* Increased padding */
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

  <!-- Include Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script>
    // Define the bounds of the world to prevent wrap-around
    var southWest = L.latLng(-90, -180),
        northEast = L.latLng(90, 180),
        worldBounds = L.latLngBounds(southWest, northEast);

    // Initialize the map with restricted bounds
    var map = L.map('map', {
      center: [20, 0],
      zoom: 2,
      maxBounds: worldBounds,
      maxBoundsViscosity: 1.0,
      worldCopyJump: false
    });

    // Add a tile layer with no wrapping
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      noWrap: true,
      bounds: worldBounds
    }).addTo(map);

    // Global variable to store the full continents layer
    var continentsLayer, countriesLayer;

    // Custom style function for the continent features
    function styleFeature(continent) {
      var fillColor = "#3388ff"; // default color
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

    // Function to highlight a clicked continent
    function highlightFeature(e) {
        var layer = e.target;
        layer.setStyle({
            fillColor: "yellow",
            fillOpacity: 0.7
        });
    }

    // Function to reset continent styles
    function resetHighlight() {
        continentsLayer.eachLayer(function(layer) {
            layer.setStyle(styleFeature(layer.feature));
        });
    }

    // Function to add a Back button control
    function addBackButton() {
      var backButton = document.getElementById('back-button');
      backButton.style.display = 'block';
      backButton.onclick = function() {
        map.flyTo([20, 0], 2, { animate: true, duration: 1.5 });
        resetHighlight();
        backButton.style.display = 'none';
        if (countriesLayer) {
          map.removeLayer(countriesLayer);
        }
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
        { name: "Egypt", coordinates: [26, 30] }
      ],
      "Asia": [
        { name: "China", coordinates: [35, 105] },
        { name: "India", coordinates: [20, 77] }
      ],
      "Europe": [
        { name: "Germany", coordinates: [51, 10] },
        { name: "France", coordinates: [46, 2] }
      ],
      "North America": [
        { name: "United States", coordinates: [37, -95] },
        { name: "Canada", coordinates: [56, -106] }
      ],
      "South America": [
        { name: "Brazil", coordinates: [-14, -51] },
        { name: "Argentina", coordinates: [-34, -64] }
      ],
      "Oceania": [
        { name: "Australia", coordinates: [-25, 133] },
        { name: "New Zealand", coordinates: [-41, 174] }
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
      if (countriesLayer) {
        map.removeLayer(countriesLayer);
      }
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

    // Event listener for the dropdown
    document.getElementById('country-dropdown').addEventListener('change', function() {
      var coordinates = JSON.parse(this.value);
      if (coordinates) {
        map.flyTo(coordinates, 6, { animate: true, duration: 1.5 });
      }
    });

    addContinents();

    document.getElementById('logout-button').onclick = function() {
      window.location.href = '{{ route("logout") }}';
    };
  </script>
</body>
</html>
