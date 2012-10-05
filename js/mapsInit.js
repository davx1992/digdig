 
       //Google maps inicializācija
       function initialize() {
          var minZoomLevel = 5;
          
          var mapOptions = {
            center: new google.maps.LatLng(56.978,24.093),
            zoom: 8,
            disableDefaultUI: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP
          };

          var map = new google.maps.Map(document.getElementById("map_canvas"),
              mapOptions);

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