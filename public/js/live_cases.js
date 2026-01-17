const container = document.getElementById("helmetsContainer");
let map;
let markers = [];

// Initialize Google Map
function initMap() {
    map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: -1.9445, lng: 30.0619 },
        zoom: 12
    });
}

// Load live incidents from API
function loadLiveCases() {
    fetch("../api/incidents/live_cases.php")
        .then(res => res.json())
        .then(data => {
            container.innerHTML = "";
            
            // Clear old markers
            markers.forEach(m => m.setMap(null));
            markers = [];

            data.data.forEach(incident => {
                // Create helmet circle
                const div = document.createElement("div");
                div.style.width = "80px";
                div.style.height = "80px";
                div.style.borderRadius = "50%";
                div.style.background = incident.alcohol_level > 0.05 ? "red" : "green";
                div.style.display = "flex";
                div.style.alignItems = "center";
                div.style.justifyContent = "center";
                div.style.color = "#fff";
                div.style.fontWeight = "bold";
                div.style.cursor = "pointer";
                div.textContent = incident.helmet_uid;

                div.addEventListener("click", () => {
                    alert(
                        `Helmet: ${incident.helmet_uid}\n` +
                        `Owner: ${incident.owner_name}\n` +
                        `Phone: ${incident.phone_number}\n` +
                        `Alcohol Level: ${incident.alcohol_level}\n` +
                        `Time: ${incident.detected_at}`
                    );

                    // Center map on this helmet
                    if (incident.latitude && incident.longitude) {
                        map.setCenter({ lat: parseFloat(incident.latitude), lng: parseFloat(incident.longitude) });
                        map.setZoom(15);
                    }
                });

                container.appendChild(div);

                // Add marker to map
                if (incident.latitude && incident.longitude) {
                    const marker = new google.maps.Marker({
                        position: { lat: parseFloat(incident.latitude), lng: parseFloat(incident.longitude) },
                        map: map,
                        title: `${incident.helmet_uid} (${incident.owner_name})`
                    });
                    markers.push(marker);
                }
            });
        });
}

initMap();
loadLiveCases();
setInterval(loadLiveCases, 30000); // refresh every 30 seconds
