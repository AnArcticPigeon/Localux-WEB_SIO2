// Add event listeners to the date inputs
document.getElementById("startDate").addEventListener("change", filterVehicles);
document.getElementById("endDate").addEventListener("change", filterVehicles);

function filterVehicles() {
    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;

    // Fetch available vehicles for the selected dates
    fetch(`/api/vehicles/available?start=${startDate}&end=${endDate}`)
        .then(response => response.json())
        .then(data => {
            let availableVehicleIds = data.vehicles.map(vehicle => vehicle.id);

            // Get all cards
            let mesCards = document.getElementsByClassName("cardClass");

            for (let i = 0; i < mesCards.length; i++) {
                let vehicleId = mesCards[i].dataset.vehicleId; // Assuming each card has a data-vehicle-id attribute

                // Check if the vehicle is available
                if (availableVehicleIds.includes(vehicleId)) {
                    mesCards[i].style.display = "block";
                } else {
                    mesCards[i].style.display = "none";
                }
            }
        })
        .catch(error => console.error('Error:', error));
}