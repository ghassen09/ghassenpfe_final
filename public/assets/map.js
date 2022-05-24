var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {

        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = " Geolocation n’est pas prise en charge par ce navigateur.";
    }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
    mapholder = document.getElementById('mapholder')
    mapholder.style.height = '700px';
    mapholder.style.width = '1000px';
    x.innerHTML = "Latitude: " + lat + "<br>Longitude: " + lon;


    var myOptions = {
        center: latlon,
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: false,

        navigationControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        }
    };
    var map = new
    google.maps.Map(document.getElementById("mapholder"), myOptions);
    var marker = new
    google.maps.Marker({
        position: latlon,
        map: map,
        title: "You are here!"
    });
}


function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "localisation non autorisé par l'utilisateur."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "L'information sur la localisation et indisponible."
            break;
        case error.TIMEOUT:
            x.innerHTML = "le temps de réponce est dépasé."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "Une erreur inconu a été rencontrée."
            break;
    }
    
    
}