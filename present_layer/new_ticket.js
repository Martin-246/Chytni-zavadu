// Initialize and add the map
let latLng;
function initMap() {
  //create new map
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 15,
    //center around fit :)
    center: { lat: 49.2269, lng: 16.59689 },
  });
    //if html5 geolocation is available, center around that position, else return error
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
    //new marker on map
    var marker = new google.maps.Marker({});
    //give marker new cordinates based on clicked location on map
    map.addListener("click",(mapsMouseEvent) => {
        marker.setMap(null);
        marker = new google.maps.Marker({
          position: mapsMouseEvent.latLng,
        });
        latLng = mapsMouseEvent.latLng.toJSON();
        //write lng and lat to html form
        document.getElementById("lng").setAttribute('value',latLng["lng"].toFixed(6));
        document.getElementById("lat").setAttribute('value',latLng["lat"].toFixed(6));
        marker.setMap(map);
    });

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


