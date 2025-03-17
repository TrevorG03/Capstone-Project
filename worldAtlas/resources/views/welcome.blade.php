<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* Full-page styling */
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100%;
            width: 100%;
        }
        
        /* Ensure the map displays properly */
        #map {
            position: fixed;
            height: 100%;
            width: 100%;
            display: none; /* Initially hidden */
            z-index: 1; /* Lower z-index to ensure it is below the footer */
        }

        /* Styling for the welcome screen */
        .welcome-screen {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            transition: opacity 0.5s ease-in-out;
        }

        .welcome-screen h1 {
            font-size: 3em;
            margin-bottom: 10px;
        }

        .welcome-screen p {
            font-size: 1.2em;
            max-width: 600px;
            line-height: 1.5;
        }

        .start-button {
            background: #ffc107;
            padding: 12px 20px;
            font-size: 1.2em;
            color: #333;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* Styling for the footer */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px;
            z-index: 2; /* Higher z-index to ensure it is above the map */
        }

        .footer button {
            background: #ffc107;
            padding: 10px 20px;
            font-size: 1em;
            color: #333;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="map"></div>
    
    <div class="welcome-screen" id="welcomeScreen">
        <h1>Welcome to the Interactive World Map</h1>
        <p>Explore the world by clicking on the map. Once logged in you can see all our other features.</p>
        <button class="start-button" onclick="showMap()">Start Exploring</button>
    </div>

    <div class="footer">
    <div style="margin-top: 20px;">
            <a href="{{ route('login') }}" class="start-button">Login</a>
            <a href="{{ route('register') }}" class="start-button">Register</a>
        </div>
        <button onclick="hideMap()">Hide Map</button>
    </div>

    <!-- Include Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        function showMap() {
            document.getElementById('welcomeScreen').style.opacity = '0';
            setTimeout(() => {
                document.getElementById('welcomeScreen').style.display = 'none';
                document.getElementById('map').style.display = 'block';
                initMap();
            }, 500);
        }

        function hideMap() {
            document.getElementById('map').style.display = 'none';
            document.getElementById('welcomeScreen').style.display = 'flex';
            setTimeout(() => {
                document.getElementById('welcomeScreen').style.opacity = '1';
            }, 100);
        }

        function initMap() {
            // Define the bounds of the world to prevent wrap-around
            var southWest = L.latLng(-90, -180),
                northEast = L.latLng(90, 180),
                worldBounds = L.latLngBounds(southWest, northEast);

            // Initialize the map
            var map = L.map('map', {
                center: [20, 0],
                zoom: 2,
                maxBounds: worldBounds,
                maxBoundsViscosity: 1.0,
                worldCopyJump: false
            });

            // Add a base tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                noWrap: true,
                bounds: worldBounds
            }).addTo(map);
        }
    </script>

</body>
</html>
