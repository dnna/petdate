function googleMapsReadyFunc() {
    for(var i in googleMapsReady) {
        googleMapsReady[i]();
    }
}

googleMapsReady.push(function() {
    $('#address_address').placesAutocomplete({
        place_changed: function(place) {
            $('#address_latitude').val(place.geometry.location.lat());
            $('#address_longitude').val(place.geometry.location.lng());
        }
    });
    $('#fos_user_profile_form_address').placesAutocomplete({
        place_changed: function(place) {
            $('#fos_user_profile_form_latitude').val(place.geometry.location.lat());
            $('#fos_user_profile_form_longitude').val(place.geometry.location.lng());
        }
    });
    $('#fos_user_registration_form_address').placesAutocomplete({
        place_changed: function(place) {
            $('#fos_user_registration_form_latitude').val(place.geometry.location.lat());
            $('#fos_user_registration_form_longitude').val(place.geometry.location.lng());
        }
    });
});

function makeMapBounds(swlat, swlng, nelat, nelng) {
    var sw, ne;
    sw = new google.maps.LatLng(parseFloat(swlat), parseFloat(swlng));
    ne = new google.maps.LatLng(parseFloat(nelat), parseFloat(nelng));
    return new google.maps.LatLngBounds(sw, ne);
}