var map;
var regMap;
var marker;
var sheep_;
var loca;
var markers = new Array();
var img = "http://localhost:8888/ci/img/icon-sheep.png";
var editableMarker;
var test;
//HOVEDKART

function initialize(sheep) {
    sheep_ = sheep_;
    var mapOptions = {
        center: new google.maps.LatLng(63.368727, 10.323715),
        zoom: 15,
        disableDefaultUI: true,
        zoomControl: false,
        panControl: false,
        draggable: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);


    var rectangle = new google.maps.Rectangle({
        strokeColor: '#00FF00',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#81F781',
        fillOpacity: 0.35,
        map: map,
        bounds: new google.maps.LatLngBounds(
            new google.maps.LatLng(63.365727, 10.313942),
            new google.maps.LatLng(63.371727, 10.333128)
        )
    });

    google.maps.event.addListener(map, 'click', function () {
        removeAnimations();
        $(".sheep").show();
        $('.deletesheep').remove();
        $("#menutitle").html("Saueliste")

    });

    google.maps.event.addListener(rectangle, 'click', function () {
        removeAnimations();
        $(".sheep").show();
        $('.deletesheep').remove();
        $("#menutitle").html("Saueliste")

    });

    for (var i = 0; i < sheep.length; i++) {
        //Sauemarkører
        markers[i] = new google.maps.Marker({
            position: new google.maps.LatLng(sheep[i].lat, sheep[i].lng),
            animation: google.maps.Animation.DROP,
            map: map,
            icon: img,
            title: sheep[i].name,
            id: sheep[i].id
        });

        //Lyttere til markørene
        google.maps.event.addListener(markers[i], 'click', function () {
            removeAnimations();
            this.setAnimation(google.maps.Animation.BOUNCE);
            $(".sheep").hide();
            $("#menutitle").html(this.title);
            $('.deletesheep').remove();
            $("#menu").append("<a class='deletesheep' href=delete/" + this.id + ">Slett</a>");
        });

    }
}

function removeAnimations() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setAnimation(null);
    };
}

//KART FOR REGISTRERING AV SAUER

function initRegSheep() {
    var mapOptions = {
        center: new google.maps.LatLng(63.368727, 10.323715),
        zoom: 15,
        disableDefaultUI: true,
        zoomControl: false,
        panControl: false,
        draggable: false,
        scrollwheel: false,
        disableDoubleClickZoom: true,
        mapTypeId: google.maps.MapTypeId.HYBRID
    };

    regMap = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);

    var rectangle = new google.maps.Rectangle({
        strokeColor: '#00FF00',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#81F781',
        fillOpacity: 0.35,
        map: regMap,
        bounds: new google.maps.LatLngBounds(
            new google.maps.LatLng(63.365727, 10.313942),
            new google.maps.LatLng(63.371727, 10.333128)
        )
    });

    google.maps.event.addListener(rectangle, 'click', function (event) {
        placeMarker(event.latLng, regMap);
        $("#warning").html('');
    });

    google.maps.event.addListener(regMap, 'click', function (event) {
        $("#warning").html('');
        $("#warning").append("<div class='alert alert-danger'>Du kan ikke plassere sauen her!</div>");
    });


}

function placeMarker(location, theMap) {
    $("#lat").attr("value", location.ob);
    $("#lng").attr("value", location.pb);
    if (marker) {
        marker.setPosition(location);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: theMap,
            icon: img
        });
    }
}

function initBondeMap() {
    var map = new google.maps.Map(document.getElementById('map-canvas'), {
        mapTypeId: google.maps.MapTypeId.HYBRID
    });
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(-33.8902, 151.1759),
        new google.maps.LatLng(-33.8474, 151.2631));
    map.fitBounds(defaultBounds);

    var input = /** @type {HTMLInputElement} */ (document.getElementById('target'));
    var searchBox = new google.maps.places.SearchBox(input);
    var markers = [];

    google.maps.event.addListener(searchBox, 'places_changed', function () {
        var places = searchBox.getPlaces();

        for (var i = 0, marker; marker = markers[i]; i++) {
            marker.setMap(null);
        }

        markers = [];
        var bounds = new google.maps.LatLngBounds();
        for (var i = 0, place; place = places[i]; i++) {
            var image = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // var marker = new google.maps.Marker({
            //   map: map,
            //   icon: image,
            //   title: place.name,
            //   position: place.geometry.location
            // });

            markers.push(marker);

            bounds.extend(place.geometry.location);
        }

        map.fitBounds(bounds);
    });

    google.maps.event.addListener(map, 'bounds_changed', function () {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
    });

    google.maps.event.addListener(map, 'click', function (event) {

    });


}

google.maps.event.addDomListener(window, 'load', initialize);
