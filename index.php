<?php
require_once "setup.php";

if ( isset($_COOKIE['beta']) ) {
    require "beta.php";
    return;
}

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

// Add a skew based on IP address so they don't flood my server
$skew = 0;
if ( isset($_SERVER['REMOTE_ADDR']) ) {
	$addr = $_SERVER['REMOTE_ADDR'];
	$sha = sha1($addr,true);
	$skew = ord($sha[0]) % 20;
}

$difference_in_seconds = $difference_in_seconds + $skew;

if ( $difference_in_seconds < 1 ) {
        header("Location: ".$url);
        return;
}

$refresh = ($difference_in_seconds * 1000) / 2;
if ( $refresh > 5*60*1000 ) $refresh = 5*60*1000;
if ( $refresh < 10*1000 ) $refresh = 10*1000;

// Add up to 10 seconds so they don't hit my server all at the same time
$refresh = $refresh + rand(0,10*1000);

?>
<html>
	<head>
		<title>Where Are We - Group Tracking From whrwe.com - Coming Soon</title>
		<link rel="stylesheet" href="compiled/flipclock.css">

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

		<script src="compiled/flipclock.js"></script>
	</head>

	<body style="font-family: sans-serif;">
	<div class="clock" style="align: center; margin:2em;"></div>
	<div class="message"></div>

	<script type="text/javascript">

		function refresh() {
			window.location.reload();
		}

		window.console && console.log("Refresh <?= $refresh ?>");
		setTimeout(refresh, <?= $refresh ?>);

		var clock;
		
		$(document).ready(function() {
			var clock;

			clock = $('.clock').FlipClock({
		        clockFace: 'MonthlyCounter',
		        autoStart: false,
		        callbacks: {
		        	stop: function() {
		        		refresh();
		        	}
		        }
		    });

				    
		    clock.setTime(<?= $difference_in_seconds ?>);
		    clock.setCountdown(true);
		    clock.start();

		});
	</script>
<!--
<a href="http://flipclockjs.com/" target="_blank">Uses FlipClock.js</a>
-->
</body>
</html>
