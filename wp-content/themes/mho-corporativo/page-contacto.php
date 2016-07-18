<?php
/**
 * Template Name: Plantilla de Contacto
 */
if (have_posts()) the_post();

get_header();
?>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1HhCzSEk-fObvREdU1Cr_SR3I5XOLHPg&callback=initialize"></script>

    <script>
        var map;
        var markerData= [
            {lat: -33.405106 , lng: -70.576261  , zoom: 15 , name: "Chile"},
            {lat: -12.125999 , lng: -77.024808  , zoom: 15 , name: "Perú"}
        ];

        function initialize() {
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: {lat: -33.405106, lng: -70.576261}
            });


            var i=0;
            markerData.forEach(function(data) {
                var infowindow = new google.maps.InfoWindow({
                    content: '<div class="info_content"><h3>'+window.pais[i]+'</h3><p>'+window.direccion[i]+'</p><a title="'+window.email[i]+'" href="mailto:'+window.email[i]+'">'+window.email[i]+'</a><a title="'+window.fono[i]+'" href="tel:'+window.fono[i]+'">'+window.fono[i]+'</a></div>'
                });
                var newmarker= new google.maps.Marker({
                    map:map,
                    position:{lat:data.lat, lng:data.lng},
                    title: data.name
                });
                newmarker.addListener('click', function() {
                    infowindow.open(map, newmarker);
                });
                i++;

                jQuery("#selectlocation").append('<option value="'+[data.lat, data.lng,data.zoom].join('|')+'">'+data.name+'</option>');
            });

            var styles = [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#444444"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#46bcec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ];

            // Create a new StyledMapType object, passing it the array of styles,
            // as well as the name to be displayed on the map type control.
            var styledMap = new google.maps.StyledMapType(styles,
                {name: "Styled Map"});

            //Associate the styled map with the MapTypeId and set it to display.
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');

        }

        jQuery(document).on('change','#selectlocation',function() {
            var latlngzoom = jQuery(this).val().split('|');
            var newzoom = 1*latlngzoom[2],
                newlat = 1*latlngzoom[0],
                newlng = 1*latlngzoom[1];
            map.setZoom(newzoom);
            map.setCenter({lat:newlat, lng:newlng});
        });


    </script>



    <section>
        <div class="content-map">
            <select id="selectlocation">
                <option value="-30|-70|3">Selecciona país</option>
            </select>
            <div id="map" class="maps-contact">

            </div>
        </div>

    </section>

    <script>
        window.pais = ['Chile', 'Perú'];
        window.direccion = ['Pdte Riesco 5335, Las Condes, Región Metropolitana', 'Edificio Business Club, Calle Bolívar 472, Miraflores 15074, Perú'];
        window.email = ['', 'info@prueba.prueba'];
        window.fono = ['+562 26571625', '+511 3968053 '];
    </script>

<?php get_footer(); ?>