let LocsA = [];

let originLat = 8.951097684123816;
let originLong = 125.54126008205894;

let USER_LATITUDE = null;
let USER_LONGITUDE = null;

var point_latitude = null;
var point_longitude = null;

function findMe() {
    if (navigator.geolocation) {
        navigator.geolocation.watchPosition(showPosition);
    } else { 
        console.log("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    USER_LATITUDE = position.coords.latitude;
    USER_LONGITUDE = position.coords.longitude;

    document.cookie = "USER_LATITUDE="+USER_LATITUDE+"; max-age=864000;";
    document.cookie = "USER_LONGITUDE="+USER_LONGITUDE+"; max-age=864000;";

    window.location.href = $('#pages-home').val();
}

if(getCookie("USER_LATITUDE") || getCookie("USER_LONGITUDE")) {
    USER_LATITUDE = getCookie("USER_LATITUDE");
    USER_LONGITUDE = getCookie("USER_LONGITUDE");
} 
else {
    USER_LATITUDE = null;
    USER_LONGITUDE = null;
}

if(USER_LATITUDE || USER_LONGITUDE) {
    LocsA.push(
        {
            name: 'I am here',
            location_latitude: originLat,
            location_longitude: originLong,
            map_image_url: '',
            name_point: 'I am here',
            url_point: ''
        },
    );
}


if(locationDataTours) {
    for(let x = 0; x < locationDataTours.length; x++) {
        LocsA.push(
            {
                name: locationDataTours[x]['title'],
                location_latitude: locationDataTours[x]['latitude'],
                location_longitude: locationDataTours[x]['longitude'],
                map_image_url: '/storage/'+locationDataTours[x]['main_photo'],
                name_point: locationDataTours[x]['title'],
                url_point: urlTourEndpoint + locationDataTours[x]['id'],
                type: 'tour',
            },
        );
    }
}

if(locationDataHotels) {
    for(let i = 0; i < locationDataHotels.length; i++) {
        LocsA.push(
            {
                name: locationDataHotels[i]['name'],
                location_latitude: locationDataHotels[i]['latitude'],
                location_longitude: locationDataHotels[i]['longitude'],
                map_image_url: '/storage/'+locationDataHotels[i]['main_photo'],
                name_point: locationDataHotels[i]['name'],
                url_point: urlEndpoint + locationDataHotels[i]['id'],
                type: 'hotel',
            },
        );
    }
}

(function(A) {
    if (!Array.prototype.forEach)
    A.forEach = A.forEach || function(action, that) {
        for (var i = 0, l = this.length; i < l; i++)
            if (i in this)
                action.call(that, this[i], i, this);
        };

})(Array.prototype);

    var mapObject, markers = [], markersData = {
        'Hotels': LocsA
    };

    var mapOptions = {
        zoom: 12,
        center: new google.maps.LatLng(8.9559536672309, 125.52851005253486),
        mapTypeId: google.maps.MapTypeId.ROADMAP,

        mapTypeControl: false,
    };

    var marker;
    mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);

    //create a DirectionsService object to use the route method and get a result for our request
    var directionsService = new google.maps.DirectionsService();

    //create a DirectionsRenderer object which we will use to display the route
    var directionsDisplay = new google.maps.DirectionsRenderer();

    //bind the DirectionsRenderer to the map
    directionsDisplay.setMap(mapObject);

    for (var key in markersData)
        markersData[key].forEach(function (item) {
            let icon = '/assets/img/pins/' + key + '.png';
            if(!item.url_point) {
                icon = '/assets/img/pins/user-marker.png';
            }
            else if(item.type == 'tour') {
                icon = '/assets/img/pins/Sightseeing.png';
            }
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                map: mapObject,
                icon: icon,
            });

            point_latitude = item.location_latitude;
            point_longitude = item.location_longitude;

            if ('undefined' === typeof markers[key])
                markers[key] = [];
            markers[key].push(marker);
            google.maps.event.addListener(marker, 'click', (function () {
                closeInfoBox();
                getInfoBox(item).open(mapObject, this);
                mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
            }));

            if(!item.url_point) {
                var circle = new google.maps.Circle({
                    map: mapObject,
                    radius: 1000,
                    fillColor: '#AA0000'
                });
                circle.bindTo('center', marker, 'position');
            }
});

function pointLocation()
{
    calcRoute(point_latitude, point_longitude);
}

function calcRoute(destinationLat, destinationLong) {
    closeInfoBox();

    var request = {
        origin: new google.maps.LatLng(originLat, originLong),
        destination: new google.maps.LatLng(destinationLat, destinationLong),
        travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
        unitSystem: google.maps.UnitSystem.IMPERIAL,
        // preserveViewport: true
    }

    //pass the request to the route method
    directionsService.route(request, function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        } else {
            directionsDisplay.setDirections({ routes: [] });
            map.setCenter(myLatLng);
        }
    });
}

function getInfoBox(item) {
    let url_point = '';
    let map_image_url = '';

    if(item.url_point) {
        let routeButton = '<button onclick="calcRoute('+item.location_latitude+','+item.location_longitude+')" class="btn_infobox btn btn-block" target="_blank">Route Direction</button>';

        if(!USER_LATITUDE && !USER_LONGITUDE) {
            routeButton = '';
        }

        url_point = '<div class="marker_tools">' +
            '<a href="'+ item.url_point + '" class="btn_infobox btn btn-block" target="_blank">Details</a>' +
            routeButton +
        '</div>';
    }
    if(item.map_image_url) {
        map_image_url = '<img src="' + item.map_image_url + '" alt="Image" style="width: 280px; height: 140px;"/>'
    }
    
    return new InfoBox({
        content:
        '<div class="marker_info" id="marker_info">' +
        map_image_url +
        '<h3>'+ item.name_point +'</h3>' + url_point,
        disableAutoPan: false,
        maxWidth: 0,
        pixelOffset: new google.maps.Size(10, 125),
        closeBoxMargin: '5px -20px 2px 2px',
        closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
        isHidden: false,
        alignBottom: true,
        pane: 'floatPane',
        enableEventPropagation: true
    });
}

function hideAllMarkers () {
    for (var key in markers)
        markers[key].forEach(function (marker) {
            marker.setMap(null);
        });
};

function closeInfoBox() {
    $('div.infoBox').remove();
};

function getCookie(name) {
    let cookie = {};
    document.cookie.split(';').forEach(function(el) {
        let [k,v] = el.split('=');
        cookie[k.trim()] = v;
    })
    return cookie[name];
}

$('.access_link').magnificPopup({
	type: 'inline',
	fixedContentPos: true,
	fixedBgPos: true,
	overflowY: 'auto',
	closeBtnInside: true,
	preloader: false,
	midClick: true,
	removalDelay: 300,
	mainClass: 'my-mfp-zoom-in'
});