<x-app-layout>
    @section('header_title', 'TYPHOON MONITORING')
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <div class="p-6 bg-slate-50 dark:bg-slate-950 min-h-screen">
        <div class="max-w-7xl mx-auto space-y-6">
            
            <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm transition-all">
                <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="text-center md:text-left">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-600">Active Monitoring</p>
                        <h1 id="locName" class="text-3xl font-black text-slate-900 dark:text-white mt-1 uppercase tracking-tight">
                            {{ $initialStatus['location'] ?? 'Barangay Center' }}
                        </h1>
                    </div>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 flex-1 w-full md:w-auto">
                        <div class="p-4 rounded-3xl bg-blue-50/50 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-900/20 text-center">
                            <p class="text-[9px] font-black text-blue-600 uppercase tracking-widest">Temp</p>
                            <p id="currTemp" class="text-xl font-black text-slate-900 dark:text-white">{{ $initialStatus['current_temperature'] ?? '0' }}°C</p>
                        </div>
                        <div class="p-4 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Wind</p>
                            <p id="currWind" class="text-xl font-black text-slate-900 dark:text-white">{{ $initialStatus['wind_speed'] ?? '0' }} <span class="text-[10px]">km/h</span></p>
                        </div>
                        <div class="p-4 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Humidity</p>
                            <p id="currHum" class="text-xl font-black text-slate-900 dark:text-white">{{ $initialStatus['humidity'] ?? '0' }}%</p>
                        </div>
                        <div class="p-4 rounded-3xl bg-slate-50 dark:bg-slate-800/50 border border-slate-100 dark:border-slate-800 text-center">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Rain</p>
                            <p id="currRain" class="text-xl font-black text-slate-900 dark:text-white">{{ $initialStatus['rain_chance'] ?? '0' }}%</p>
                        </div>
                    </div>

                    <button id="refreshBtn" class="p-4 rounded-2xl bg-slate-900 text-white hover:bg-blue-600 transition-all shadow-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 h-[600px]">
                
                <div class="relative rounded-[2.5rem] overflow-hidden border border-slate-200 dark:border-slate-800 shadow-xl bg-white dark:bg-slate-900">
                    <div class="absolute top-4 left-4 z-[1000] bg-white/90 dark:bg-slate-900/90 backdrop-blur px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest dark:text-white">PH Street View</p>
                    </div>
                    <div id="phMap" class="w-full h-full"></div>
                </div>

                <div class="relative rounded-[2.5rem] overflow-hidden border border-slate-200 dark:border-slate-800 shadow-xl bg-white dark:bg-slate-900">
                    <div class="absolute top-4 left-4 z-10 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-4 py-2 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <p class="text-[10px] font-black uppercase tracking-widest dark:text-white">Typhoon Tracker</p>
                    </div>
                    <iframe 
                        id="windyMap"
                        width="100%" 
                        height="100%" 
                        src="https://embed.windy.com/embed2.html?lat=12.8797&lon=121.7740&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=true&marker=&calendar=now&pressure=&type=map&location=coordinates&detail=&metricWind=km%2Fh&metricTemp=%C2%B0C&radarRange=-1" 
                        frameborder="0">
                    </iframe>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

   <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. Initialize Philippine Map (Leaflet)
        const phMap = L.map('phMap').setView([12.8797, 121.7740], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(phMap);

        // Exact Pinpoint Marker
        let marker = L.marker([14.5995, 120.9842]).addTo(phMap);

        // Function para makuha ang pangalan ng lugar (Reverse Geocoding)
        async function getLocationName(lat, lon) {
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lon}`);
                const data = await response.json();
                return data.address.suburb || data.address.neighbourhood || data.address.city || data.address.municipality || "Unknown Location";
            } catch (error) {
                return `Station (${lat.toFixed(2)}, ${lon.toFixed(2)})`;
            }
        }

        // 2. Main Update Function
        async function updateDashboard(lat, lon, isManual = false) {
            refreshBtn.classList.add('animate-spin');
            
            try {
                const [weatherRes, locationName] = await Promise.all([
                    fetch(`{{ route('typhoon.live') }}?lat=${lat}&lon=${lon}`),
                    getLocationName(lat, lon)
                ]);

                const data = await weatherRes.json();
                
                // Update UI
                document.getElementById('locName').innerText = locationName;
                document.getElementById('currTemp').innerText = `${data.current_temperature}°C`;
                document.getElementById('currWind').innerHTML = `${data.wind_speed} <span class="text-[10px]">km/h</span>`;
                document.getElementById('currHum').innerText = `${data.humidity}%`;
                document.getElementById('currRain').innerText = `${data.rain_chance}%`;

                // Update Marker and Center Map
                marker.setLatLng([lat, lon]);
                if(isManual) {
                    phMap.flyTo([lat, lon], 15); // Zoom sa location kung "Track Me" ang ginamit
                }
                
            } catch(e) {
                console.error("Update failed", e);
            } finally {
                setTimeout(() => refreshBtn.classList.remove('animate-spin'), 500);
            }
        }

        // --- GEOLOCATION LOGIC (TRACK ME) ---
        function trackMyLocation() {
            if (!navigator.geolocation) {
                alert("Hindi supported ng browser mo ang Geolocation.");
                return;
            }

            // Gamitin ang watchPosition para ma-track habang gumagalaw (optional) 
            // o getCurrentPosition para sa isang beses lang.
            navigator.geolocation.getCurrentPosition(
                (position) => {
                    const lat = position.coords.latitude;
                    const lon = position.coords.longitude;
                    updateDashboard(lat, lon, true);
                },
                (error) => {
                    alert("Hindi makuha ang location. Siguraduhing naka-ON ang GPS at pinayagan (Allow) ang browser.");
                },
                { enableHighAccuracy: true }
            );
        }

        // Event listener para sa click sa mapa
        phMap.on('click', function(e) {
            updateDashboard(e.latlng.lat, e.latlng.lng);
        });

        // I-bind ang track function sa refresh button o kaya gumawa ng bagong button
        const refreshBtn = document.getElementById('refreshBtn');
        refreshBtn.addEventListener('click', trackMyLocation);

        // Auto-track sa simula (Optional: Kung gusto mong itrack agad pag-load)
        // trackMyLocation();
    });
</script>
</x-app-layout>