var map;
var regMap;
var marker;
var sheep_;
var loca;
var markers = new Array();
var img = "http://m111b.studby.ntnu.no/img/icon-sheep.png";
var editableMarker;
var test;
var regRect = false;
var farmMap;

/**
 * Hovedkart
*/
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
        $("#menutitle").html("Saueliste");
        $('#sheepinfo').html('');

    });

    google.maps.event.addListener(rectangle, 'click', function () {
        removeAnimations();
        $(".sheep").show();
        $('.deletesheep').remove();
        $("#menutitle").html("Saueliste");
        $('#sheepinfo').html('');

    });

    for (var i = 0; i < sheep.length; i++) {
        //Sauemarkører
        markers[i] = new google.maps.Marker({
            position: new google.maps.LatLng(sheep[i].xpos, sheep[i].ypos),
            animation: google.maps.Animation.DROP,
            map: map,
            icon: img,
            title: sheep[i].navn,
            id: sheep[i].ID
        });

        //Lyttere til markørene
        google.maps.event.addListener(markers[i], 'click', function () {
            removeAnimations();
            this.setAnimation(google.maps.Animation.BOUNCE);
            $(".sheep").hide();
            $("#menutitle").html(this.title);
            $('.deletesheep').remove();
            $('.endre').remove();
            $('#sheepinfo').html('');
            $.ajax({
				type: "POST",
				dataType:'json',
                                                // url:"http://localhost:8888/ultimateSheepTracker3000/index.php/ajax/getsheepinfo",
				url: "http://m111b.studby.ntnu.no/index.php/ajax/getsheepinfo",
				data: { id: this.id }
				})
				.done(function( msg ) {
                                                           $("#sheepinfo").append('<tr><td>ID: '+msg.ID+'</td></tr>');
					$("#sheepinfo").append('<tr><td>Født: '+msg.birthYear+'</td></tr>');
					$("#sheepinfo").append('<tr><td>Vekt: '+msg.weight+' kg</td></tr>');
					$("#sheepinfo").append('<tr><td>Helse: '+msg.health+'</td></tr>');
					console.log(msg);
					test = msg;
			});
            $("#menu").append("<a class='deletesheep' href=delete/" + this.id + ">Slett</a>    ");
            $("#menu").append("<a class='endre' href=endre/" + this.id + ">Endre</a>");
        });

    }
}

function removeAnimations() {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setAnimation(null);
    };
}

/**
 * Kart for registrering av sauer
*/
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

/**
 * Plasser sauemarkør
*/
function placeMarker(location, theMap) {
	console.log(location);
    $("#lat").attr("value", location.lb);
    $("#lng").attr("value", location.mb);
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


/**
 * Kart for registrering av gård
*/
function initBondeMap() {
    farmMap = new google.maps.Map(document.getElementById('map-canvas'), {
        mapTypeId: google.maps.MapTypeId.HYBRID
    });
    var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(63.3902, 10.1759),
        new google.maps.LatLng(63.3474, 10.2631));
    farmMap.fitBounds(defaultBounds);

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

            markers.push(marker);

            bounds.extend(place.geometry.location);
        }

        farmMap.fitBounds(bounds);
    });

    google.maps.event.addListener(farmMap, 'bounds_changed', function () {
        var bounds = farmMap.getBounds();
        searchBox.setBounds(bounds);
    });

    google.maps.event.addListener(farmMap, 'click', function (event) {
        if(regRect){
            regRect.setMap(null);
        }
        regRect = new google.maps.Rectangle({
            strokeColor: '#00FF00',
            strokeOpacity: 0.8,
            strokeWeight: 2,
            editable: true,
            fillColor: '#00FF00',
            fillOpacity: 0.35,
            bounds: new google.maps.LatLngBounds(
                new google.maps.LatLng(event.latLng.lb-0.0005, event.latLng.mb),
                new google.maps.LatLng(event.latLng.lb, event.latLng.mb+0.0005)
            )
        });
        regRect.setMap(farmMap);
        regRect.setDraggable(true);
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
