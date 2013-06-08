(function($) {
    var methods = {
        init: function(options) {
            var autoCompleteSettings = {
                useGeolocation: false,
                attr: {
                    bounds: makeMapBounds(34.68826995260992, 19.511187500000005, 41.98475544185287, 28.695757812500005),
                    types: ['geocode']
                },
                place_changed: null
            };
            return this.each(function() {
                var settings = $.extend(autoCompleteSettings, options);
                pacSelectFirst($(this)[0]);
                $(this).keypress(function (evt) {
                    //Deterime where our character code is coming from within the event
                    var charCode = evt.charCode || evt.keyCode;
                    if (charCode  == 13) { //Enter key's keycode
                        return false;
                    }
                });
                var autocomplete = new google.maps.places.Autocomplete($(this)[0], autoCompleteSettings.attr);
                var $this = $(this);
                google.maps.event.addListener(autocomplete, 'place_changed', function() {
                    setTimeout(function() {
                        // Search on the same page
                        var place = autocomplete.getPlace();
                        if (!place.geometry) {
                          // Inform the user that a place was not found and return.
                          return;
                        }
                        settings.place_changed.apply($this, [place]);
                    }, 1);
                });
            });
        },
    };

    $.fn.placesAutocomplete = function(method) {
        // Method calling logic
        if (methods[method]) {
            return methods[ method ].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === 'object' || !method) {
            return methods.init.apply(this, arguments);
        } else {
            $.error('Method ' + method + ' does not exist on jQuery.placesAutocomplete');
        }
    };

    // Helper function to add keyboard shortcut to google autocomplete
    function pacSelectFirst(input) {
            // store the original event binding function
            var _addEventListener = (input.addEventListener) ? input.addEventListener : input.attachEvent;

            var addEventListenerWrapper = function(type, listener) {
                // Simulate a 'down arrow' keypress on hitting 'return' when no pac suggestion is selected,
                // and then trigger the original listener.
                if (type == "keydown") {
                    var orig_listener = listener;
                    listener = function(event) {
                        var suggestion_selected = $(".pac-item.pac-selected").length > 0;
                        if (event.which == 13 && !suggestion_selected) {
                            var simulated_downarrow = $.Event("keydown", {
                                keyCode: 40,
                                which: 40
                            });
                            orig_listener.apply(input, [simulated_downarrow]);
                        }

                        orig_listener.apply(input, [event]);
                    };
                }

                _addEventListener.apply(input, [type, listener]);
            }

            // Internet Explorer 8 is bugged here so we ignore this feature if the suer is using that
            input.addEventListener = addEventListenerWrapper;
            input.attachEvent = addEventListenerWrapper;
    };
})(jQuery);