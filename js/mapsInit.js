 
       //Google maps inicializācija
       function initialize() {
            
            /*var styles = [
            {
              stylers: [
                { hue: "#216477" },
                { saturation: 10 }
              ]
            },{
              featureType: "road",
              elementType: "geometry",
              stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
              ]
            },{
              featureType: "road",
              elementType: "labels",
              stylers: [
                { visibility: "off" }
              ]
            }
            ];*/
            
            var styles = [
            {
              "featureType": "water",
              "stylers": [
                { "color": "#39aecf" },
                { "lightness": -30 },
                { "saturation": 24 },
                { "gamma": 1.13 }
              ]
            },{
              "featureType": "road.highway",
              "stylers": [
                { "hue": "#005eff" },
                { "saturation": -57 },
                { "weight": 0.4 },
                { "lightness": 4 },
                { "gamma": 0.34 },
                { "visibility": "on" }
              ]
            },{
              "featureType": "landscape",
              "stylers": [
                { "lightness": -2 },
                { "gamma": 0.76 },
                { "hue": "#00e5ff" },
                { "saturation": 28 }
              ]
            },{
              "featureType": "administrative.locality",
              "elementType": "labels",
              "stylers": [
                { "saturation": 32 },
                { "weight": 0.1 },
                { "hue": "#00ddff" },
                { "lightness": -18 },
                { "gamma": 0.25 }
              ]
            },{
              "featureType": "administrative.country",
              "stylers": [
                { "weight": 2.9 },
                { "gamma": 5.06 },
                { "lightness": -19 },
                { "hue": "#00ccff" },
                { "saturation": 33 }
              ]
            },{
              "featureType": "road.highway",
              "elementType": "labels",
              "stylers": [
                { "visibility": "off" }
              ]
            },{
            "featureType": "road.local",
            "stylers": [
              { "saturation": 41 },
              { "lightness": -12 },
              { "hue": "#0091ff" },
              { "gamma": 0.47 }
            ]
          },{
            "featureType": "road.arterial",
            "stylers": [
              { "color": "#61b7cf" }
            ]
          },{
            "featureType": "administrative.province",
            "stylers": [
              { "visibility": "off" }
            ]
          }
          ]
            
            var styledMap = new google.maps.StyledMapType(styles,{name: "Styled Map"});
            
            var minZoomLevel = 5;
             
            var mapOptions = {
              center: new google.maps.LatLng(56.978,24.093),
              zoom: 8,
              disableDefaultUI: true,
              mapTypeControlOptions: {
                  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
                }
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
            
            map.mapTypes.set('map_style', styledMap);
            map.setMapTypeId('map_style');
            
             // Limitē tuvināšanas līmeni
             google.maps.event.addListener(map, 'zoom_changed', function() {
               if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
             });
             
               google.maps.event.addListener(map, 'click', function(e) {
                    var image = '/digdig/img/pointer.png';
                    var title = e.latLng.lng().toFixed(3)+'|'+e.latLng.lng().toFixed(3);
                    var marker = new google.maps.Marker({
                           position: new google.maps.LatLng(e.latLng.lat().toFixed(3), e.latLng.lng().toFixed(3)),
                           map: map,
                           title: title,
                           icon:image
               });
    
          });
     }