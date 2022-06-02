function init() {
    const position = {
        lat: 5.3510144,
        lng: -4.0075264,
    }
    
    ;const zoomlevel = 14;

    const map = L.map('map').setView([position.lat, position.lng], zoomlevel); 

    const mainLayer = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    tileSize: 512,
    zoomOffset: -1,
    accessToken: 'pk.eyJ1IjoidGluaG81NSIsImEiOiJja3dkcW9yZXEwbWp1Mm9xdjJsejc0MmNoIn0.3816Zi6PILQeUAst62NdUg'});

   
mainLayer.addTo(map);
//     var circle = L.circle([position.lat, position.lng], {
//     color: 'red',
//     fillColor: '#f03',
//     fillOpacity: 0.5,
//     radius: 500
// }).addTo(map);
var marker = L.marker([position.lat, position.lng]).addTo(map)
    .bindPopup('Simplon CI.')
    .openPopup();
    
}
map = new goo