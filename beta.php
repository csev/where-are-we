<?php

require_once "pdo.php";

if ( ! isset($_COOKIE['beta']) ) {
    setcookie('beta','xyzzy',time() + (86400 * 30));
}

?>
<html>
<head>
<title>Beta Test</title>
</head>
<body>
<h2 id="please">Please share your location with Where-Are-We<br/>
<img src="static/ajaxSpinner.gif">
</h2>
<div id="map_canvas" style="display: none; margin: 10px; width:95%; height:600px"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="static/map.js"></script>
</body>

