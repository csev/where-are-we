<?php
date_default_timezone_set('America/Detroit');

$live = "2016-02-22 00:00:01";
$url = "https://www.dr-chuck.com";
$url = "about:blank";
$previous = false;

$date1 = new DateTime($live);
$now = new DateTime();
$difference_in_seconds = $date1->format('U') - $now->format('U');

