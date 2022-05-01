var
    mapObject,
    markers = [],
    markersData = {
        'Churches': [
            {
                name: 'Notre Dame',
                location_latitude: 48.852729, 
                location_longitude: 2.350564,
                map_image_url: '/assets/img/thumb_map_1.jpg',
                name_point: 'Notre Dame',
                description_point: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                get_directions_start_address: '',
                phone: '+3934245255',
                url_point: 'single_tour.html'
            },
        ]
    };

    var mapOptions = {
            zoom: 14,
            center: new google.maps.LatLng(8.954232145105257, 125.53326418527058),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [
                {
                    "featureType": "administrative.country",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
            ]
    };

    var
    marker;
    mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
    for (var key in markersData)
        markersData[key].forEach(function (item) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                map: mapObject,
                icon: 'img/pins/' + key + '.png',
            });

            if ('undefined' === typeof markers[key])
                markers[key] = [];
            markers[key].push(marker);
            google.maps.event.addListener(marker, 'click', (function () {
    closeInfoBox();
    getInfoBox(item).open(mapObject, this);
    mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
    }));

    google.maps.event.addListener(mapObject, 'click', function(event) {
        marker.setMap(null);
        marker = new google.maps.Marker({position: event.latLng, map: mapObject});

        $('#map_lan').val(event.latLng.lat());
        $('#map_long').val(event.latLng.lng());
    });
});

function searchByAddress() {
    const address = $('#address').val();
    
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        "address": address
    }, function(results) {
        $('#map_lan').val(results[0].geometry.location.lat());
        $('#map_long').val(results[0].geometry.location.lng());

        marker.setMap(null);
        marker = new google.maps.Marker({position: results[0].geometry.location, map: mapObject});
    });
}