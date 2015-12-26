
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

    $('#prefs_save').click(function(event) {
        $('#spinner').show();
        var form = $('#prefs_form');
        var allow_name = form.find('input[name="allow_name"]').is(':checked') ? 1 : 0 ;
        var allow_first = form.find('input[name="allow_first"]').is(':checked') ? 1 : 0 ;
        var allow_email = form.find('input[name="allow_email"]').is(':checked') ? 1 : 0 ;
        window.console && console.log('Sending POST');
        $.post( '<?php echo(addSession('update.php')); ?>',
           { 'allow_name': allow_name, 'allow_first': allow_first, 'allow_email': allow_email },
          function( data ) {
              window.console && console.log(data);
              $('#spinner').hide();
              $('#prefs').modal('hide');
          }
        ).error( function() {
            window.console && console.log('POST returned error');
            $('#spinner').hide();
            $('#save_fail').show();
        });
        return false;
      });
} );
