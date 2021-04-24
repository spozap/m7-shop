var map = L.map('map').setView([41.388, 2.159], 12);
L.esri.basemapLayer('Topographic').addTo(map);

fetch('../db/showMap.php')
.then(response => response.json())
.then(data => {

    console.log(data)

    data.forEach(user => {

        if (user.lat && user.lng) {

            const lat = user.lat
            const lng = user.lng

            let marker = L.marker([lat,lng]).addTo(map)

            

            marker.bindPopup(`<div>
                                <h5> Nombre del usuario: ${user.username} </h5><br/>
                                <h5>Contacto email: ${user.email} </h5><br/>
                                <p>Productos subidos</p>
                            </div>`)

        }

    })

});