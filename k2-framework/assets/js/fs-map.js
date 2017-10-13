/* Map */
var map = new google.maps.Map(document.getElementById('fs_map'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 13
});


var card = document.getElementById('pac-card');
var input = document.getElementById('pac-input');
var types = document.getElementById('type-selector');
var strictBounds = document.getElementById('strict-bounds-selector');

map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

var autocomplete = new google.maps.places.Autocomplete(input);

// Bind the map's bounds (viewport) property to the autocomplete object,
// so that the autocomplete requests use the current map bounds for the
// bounds option in the request.
autocomplete.bindTo('bounds', map);

var marker = new google.maps.Marker({
    map: map,
    anchorPoint: new google.maps.Point(0, -29),
});

if (jQuery('#fs_map_position').val() !== undefined && jQuery('#fs_map_position').val() !== null && jQuery('#fs_map_position').val() !== '') {
    map.setCenter(JSON.parse(jQuery('#fs_map_position').val()));
    map.setZoom(17);  // Why 17? Because it looks good.
    marker.setPosition(new google.maps.LatLng(JSON.parse(jQuery('#fs_map_position').val())));
    marker.setVisible(true);
}


autocomplete.addListener('place_changed', function () {
    marker.setVisible(false);
    var place = autocomplete.getPlace();
    if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
    }
    jQuery('input#fs_map_position').val(JSON.stringify(place.geometry.location.toJSON()));

    // If the place has a geometry, then present it on a map.
    if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
    } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
    }
    marker.setPosition(place.geometry.location);
    marker.setVisible(true);

    var address = '';
    if (place.address_components) {
        address = [
            (place.address_components[0] && place.address_components[0].short_name || ''),
            (place.address_components[1] && place.address_components[1].short_name || ''),
            (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
    }
});

// Sets a listener on a radio button to change the filter type on Places
// Autocomplete.
function setupClickListener(id, types) {
    var radioButton = document.getElementById(id);
    radioButton.addEventListener('click', function () {
        autocomplete.setTypes(types);
    });
}

setupClickListener('changetype-all', []);
setupClickListener('changetype-address', ['address']);
setupClickListener('changetype-establishment', ['establishment']);
setupClickListener('changetype-geocode', ['geocode']);

document.getElementById('use-strict-bounds')
    .addEventListener('click', function () {
        console.log('Checkbox clicked! New state=' + this.checked);
        autocomplete.setOptions({strictBounds: this.checked});
    });

jQuery('.nav-tabs a').on('click', function () {
    setTimeout(function () {
        google.maps.event.trigger(map, 'resize');
        if (jQuery('#fs_map_position').val() !== undefined && jQuery('#fs_map_position').val() !== null && jQuery('#fs_map_position').val() !== '') {
            map.setCenter(JSON.parse(jQuery('#fs_map_position').val()));
            map.setZoom(17);  // Why 17? Because it looks good.
        }
    }, 50);
});

jQuery(document).keypress(
    function (event) {
        if (event.which == '13') {
            event.preventDefault();
        }


    });