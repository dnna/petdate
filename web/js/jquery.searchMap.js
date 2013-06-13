(function($) {
    var methods = {
        init: function(options) {
            var settings = {
                center: {latitude: 38.008653, longitude: 23.790368},
                mapOptions: {
                    zoom: 15,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    maxZoom: 15,
                    disableDefaultUI: true
                },
                source: 'api'
            };
            $(this).data('settings', $.extend(settings, options));
            var settings = $(this).data('settings');
            return this.each(function() {
                // Map shouldn't never be initialized twice
                var ll = new google.maps.LatLng(settings.center.latitude, settings.center.longitude);
                $(this).data('mapObj', new google.maps.Map($(this)[0], $.extend({
                    center: ll
                }, settings.mapOptions)));
                methods.addMarkers.apply($(this), [settings.source]);
            });
        },
        clearMarkers: function() {
            for(var i in $(this).data('markers')) {
                $(this).data('markers')[i].setMap(null);
            };
            $(this).removeData('markers');
        },
        addMarkers: function(data) {
            var $this = $(this);
            var markers = [];
            var fullBounds = new google.maps.LatLngBounds();
            var ll = new google.maps.LatLng($(this).data('settings').center.latitude,$(this).data('settings').center.longitude);
            /*markers.push(new google.maps.Marker({ // My marker
                    position: ll,
                    map: $this.data('mapObj')
            }));
            fullBounds.extend(ll);*/
            var addMarker = function(value) {
                var ll = new google.maps.LatLng(value.user.point.latitude, value.user.point.longitude);
                markers.push(new google.maps.Marker({
                        position: ll,
                        map: $this.data('mapObj')
                }));
                fullBounds.extend(ll);
            };
            $.each(data, function(index, value) {
                addMarker(value);
            });
            $this.data('markers', markers);
            if(markers.length > 1) { // If the length is 0 do nothing otherwise the map bugs out
                $this.data('mapObj').fitBounds(fullBounds);
                //console.log(fullBounds.toString());
            }
        }
    };

    $.fn.searchMap = function(method) {
        // Method calling logic
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.searchMap');
        }
    };

})(jQuery);