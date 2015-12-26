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
<h2>Welcome to the Beta Test of whrwe.com</h2>
<div id="map_canvas" style="margin: 10px; width:95%; height:600px"></div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="static/map.js"></script>
</body>

