<?php

require_once "pdo.php";

if ( ! isset($_COOKIE['beta']) ) {
    setcookie('beta','xyzzy',time() + (86400 * 30));
}

?>
<html>
<head>
<title>Beta Test</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
</head>
<body>
<h2 id="please">Please share your location with Where-Are-We<br/>
<img src="static/ajaxSpinner.gif">
</h2>
<div id="map_canvas" style="display: none; width:100%; height:100%"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js"></script>
<script src="static/map.js?x=<?= rand() ?>"></script>
<script>
setTimeout(function(){ window.location.reload(true); }, 4*60000);
</script>
</body>

