 
       //Google maps inicializācija sakumlapai
     function initialize() {
     var styles = [
          {
            "featureType": "water",
            "stylers": [
              { "color": "#6b7176" }
            ]
          },{
            "featureType": "landscape.natural",
            "stylers": [
              { "color": "#ccd0d0" }
            ]
          },{
            "featureType": "road.arterial",
            "stylers": [
              { "color": "#ffffff" }
            ]
          },{
            "featureType": "road.highway",
            "stylers": [
              { "color": "#759f80" }
            ]
          },{
            "featureType": "road.highway",
            "elementType": "labels.text.stroke",
            "stylers": [
              { "color": "#000000" }
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
    
    //Kartes inicializacija objekta pievienoshanai
    function initAddObject(){
      var styles = [
          {
            "featureType": "water",
            "stylers": [
              { "color": "#6b7176" }
            ]
          },{
            "featureType": "landscape.natural",
            "stylers": [
              { "color": "#ccd0d0" }
            ]
          },{
            "featureType": "road.arterial",
            "stylers": [
              { "color": "#ffffff" }
            ]
          },{
            "featureType": "road.highway",
            "stylers": [
              { "color": "#759f80" }
            ]
          },{
            "featureType": "road.highway",
            "elementType": "labels.text.stroke",
            "stylers": [
              { "color": "#000000" }
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
     var map = new google.maps.Map(document.getElementById("map_canvas_addobject"),mapOptions);
     
     map.mapTypes.set('map_style', styledMap);
     map.setMapTypeId('map_style');

              // Limitē tuvināšanas līmeni
              google.maps.event.addListener(map, 'zoom_changed', function() {
                if (map.getZoom() < minZoomLevel) map.setZoom(minZoomLevel);
              });
              /* Clear Markers */
              
              var markersArray = [];
              
              function clearOverlays() {
                for (var i = 0; i < markersArray.length; i++ ) {
                  markersArray[i].setMap(null);
                }
              }
              /* End */
              google.maps.event.addListener(map, 'click', function(e) {
                    var image = '/digdig/img/pointer.png';
                    var title = e.latLng.lng().toFixed(3)+'|'+e.latLng.lng().toFixed(3);
                    console.log(markersArray);
                    clearOverlays();
                    var marker = new google.maps.Marker({
                          position: new google.maps.LatLng(e.latLng.lat().toFixed(3), e.latLng.lng().toFixed(3)),
                          map: map,
                          title: title,
                          icon:image
                    });
                    $('#coordx').val(e.latLng.lat().toFixed(3));
                    $('#coordy').val(e.latLng.lng().toFixed(3));
                    markersArray.push(marker);
          });
    }
    