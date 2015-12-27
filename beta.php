<?php

require_once "pdo.php";

if ( isset($_COOKIE['user_key']) ) {
    $user_key = $_COOKIE['user_key'];
} else {
    $user_key = bin2hex(openssl_random_pseudo_bytes(32));
    setcookie('user_key',$user_key,time() + (86400 * 120));
}

?>
<html>
<head>
<title>Beta Test</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<?php require_once "head.php"; ?>
</head>
<body>
<h2 id="please">Please share your location with Where-Are-We<br/>
<img src="static/ajaxSpinner.gif">
</h2>
<div id="map_canvas" style="display: none; width:100%; height:100%"></div>
<div id="hamburger" style="margin:20px; position: absolute; right: 0; top: 0; z-index: 10;"><a href="config.php"><img src="static/img/hamburger.png" style="height:7%;"></a></div>
<?php require_once "foot-begin.php"; ?>
<script src="static/map.js?x=<?= rand() ?>"></script>
<script>
setTimeout(function(){ window.location.reload(true); }, 4*60000);
</script>
<?php require_once "foot-end.php"; ?>
</body>

