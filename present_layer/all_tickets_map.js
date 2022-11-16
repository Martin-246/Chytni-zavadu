let all_tickets;

setInterval(function () {
  $.ajax({
        url:'all_tickets_map_data.php',
        success: function(response){
            all_tickets = JSON.parse(response);
            //console.log(JSON.stringify(all_tickets));      
        }
  });
}, 1000);

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 15,
        center: { lat: 49.2269, lng: 16.59689 },
    });
    if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                map.setCenter(pos);
            },
            () => {
                handleLocationError(true, infoWindow, map.getCenter());
            }
        );
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    setInterval(function () {
        for(let i=0;i<all_tickets.length;i++){
            var marker = new google.maps.Marker({});
            var myLatlng = new google.maps.LatLng(all_tickets[i]["lat"],all_tickets[i]["lng"]);
            marker = new google.maps.Marker({
                position: myLatlng,
                title: all_tickets[i]["category"]
            });
            marker.setMap(map);
        }
    }, 1500);
    
}
function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(
      browserHasGeolocation
        ? "Error: The Geolocation service failed."
        : "Error: Your browser doesn't support geolocation."
    );
    infoWindow.open(map);
}

window.initMap = initMap;