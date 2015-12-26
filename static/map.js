
var map;

// https://developers.google.com/maps/documentation/javascript/reference
function initialize_map(lat,lng) {
  var myLatlng = new google.maps.LatLng(lat,lng);
  window.console && console.log("Building map...");

  var myOptions = {
     zoom: 10,
     center: myLatlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
/*
  var marker = new google.maps.Marker({
    draggable: true,
    position: myLatlng,
    map: map,
    title: "Yo"
  });
*/
    $.getJSON('data.php?lat='+lat+'&lng='+lng, function(other_points) {
        window.console && console.log("Loading "+other_points.length+" points");
        for ( var i = 0; i < other_points.length; i++ ) {
            var row = other_points[i];
            var newLatlng = new google.maps.LatLng(row.lat, row.lng);
            var iconpath = 'static/img/icons/';
            console.log(row);
            var icon = row[3] ? 'green-dot.png' : 'green.png';
            var marker = new google.maps.Marker({
                position: newLatlng,
                map: map,
                icon: iconpath + icon,
                title : 'row[3]'
            });
    }
    }).fail( function() { alert('getJSON fail'); } );
}

function GetLocation(location) {
    $('#please').hide();
    $('#map_canvas').show();
    window.console && console.log(location.coords.latitude);
    window.console && console.log(location.coords.longitude);
    window.console && console.log(location.coords.accuracy);
    initialize_map(location.coords.latitude, location.coords.longitude);
}

$(document).ready(function() {
    navigator.geolocation.getCurrentPosition(GetLocation);
} );
