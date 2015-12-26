
var map;

// https://developers.google.com/maps/documentation/javascript/reference
function initialize_map(lat,lng) {
  var myLatlng = new google.maps.LatLng(lat,lng);
  window.console && console.log("Building map...");

  var myOptions = {
     zoom: 3,
     center: myLatlng,
     mapTypeId: google.maps.MapTypeId.ROADMAP
  }

  map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

  var marker = new google.maps.Marker({
    draggable: true,
    position: myLatlng,
    map: map,
    title: "Yo"
  });

  // Add the other points
  window.console && console.log("Loading "+other_points.length+" points");
  for ( var i = 0; i < other_points.length; i++ ) {
    var row = other_points[i];
    // if ( i < 3 ) { alert(row); }
    var newLatlng = new google.maps.LatLng(row[0], row[1]);
    var iconpath = '<?php echo($CFG->staticroot); ?>/static/img/icons/';
    console.log(row);
    var icon = row[3] ? 'green-dot.png' : 'green.png';
    var marker = new google.maps.Marker({
      position: newLatlng,
      map: map,
      icon: iconpath + icon,
      title : row[2]
     });
  }
}

$(document).ready(function() {
    initialize_map();
} );
