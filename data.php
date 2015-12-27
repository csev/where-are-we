<?php

// Need this parameter
if ( !isset($_GET['lat']) ) die('Missing required parameter');
if ( !isset($_GET['lng']) ) die('Missing required parameter');

if ( ! isset($_COOKIE['user_key']) ) {
    die('Not logged in');
} else {
    $user_key = $_COOKIE['user_key'];
}

$lat = $_GET['lat'];
$lng = $_GET['lng'];

require_once 'pdo.php';
header("Content-type: application/json; charset=utf-8");

$current = isset($_COOKIE['emoji']) ? $_COOKIE['emoji'] : null;
$name = isset($_COOKIE['name']) ? $_COOKIE['name'] : null;

$pdo->query('DELETE FROM user WHERE login_at < DATE_SUB(NOW(), INTERVAL 72 MINUTE)');
$pdo->query('DELETE FROM context_map WHERE updated_at < DATE_SUB(NOW(), INTERVAL 72 MINUTE)');

$stmt = $pdo->prepare('INSERT INTO user 
    (user_key, user_sha256, displayname, emoji, login_at) 
    VALUES ( :sid, :sid, :name, :emoji, NOW() )
    ON DUPLICATE KEY 
    UPDATE displayname=:name, emoji=:emoji, login_at = NOW()');
$stmt->execute(array( 
    ':sid' => $user_key,
    ':emoji' => $current,
    ':name' => $name
));

$stmt = $pdo->prepare('SELECT user.user_id,lat0,lng0,when0 
    FROM user LEFT JOIN context_map ON context_map.user_id = user.user_id
    WHERE user_sha256 = :sid');
$stmt->execute(array( ':sid' => $user_key ));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $row['user_id'];

if ( is_null($row['lat0']) ) {
    $delta = 0.0;
} else {
    $delta = abs($row['lat0']-$lat) + abs($row['lng0']-$lng);
}

if ( $delta < 0.002 ) {
    $stmt = $pdo->prepare('INSERT INTO context_map 
        ( context_id, user_id, lat0, lng0, when0, updated_at )
        VALUES ( 1, :uid, :lat, :lng, NOW(), NOW() )
        ON DUPLICATE KEY UPDATE lat0=:lat,lng0=:lng,when0=NOW(),updated_at=NOW()');
    $stmt->execute(array( ':uid' => $user_id, ':lat' => $lat, ':lng' => $lng ));
} else { 
    $stmt = $pdo->prepare('INSERT INTO context_map 
        ( context_id, user_id, lat0, lng0, when0, updated_at )
        VALUES ( 1, :uid, :lat, :lng, NOW(), NOW() )
        ON DUPLICATE KEY UPDATE 
            lat3=lat2, lng3=lng2, when3=when2,
            lat2=lat1, lng2=lng1, when2=when1,
            lat1=lat0, lng1=lng0, when1=when0,
            lat0=:lat, lng0=:lng, when0=NOW(),
            updated_at=NOW()');
    $stmt->execute(array( ':uid' => $user_id, ':lat' => $lat, ':lng' => $lng ));
}


$stmt = $pdo->prepare('SELECT displayname,emoji,lat0,lng0,lat1,lng1,lat2,lng2,lat3,lng3
    FROM context_map JOIN user ON context_map.user_id = user.user_id 
    WHERE context_id = 1 AND context_map.user_id != :uid');
$stmt->execute(array( ':uid' => $user_id ));
$rows = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    $dat = array();
    $dat['displayname'] = $row['displayname'];
    $dat['emoji'] = $row['emoji'];

    $latdat = array();
    $latdat[] = $row['lat0'];

    $lngdat = array();
    $lngdat[] = $row['lng0'];
    for($i=1;$i<=3;$i++) {
        if ( is_null($row['lat'.$i]) || is_null($row['lng'.$i]) ) continue;
        $latdat[] = $row['lat'.$i];
        $lngdat[] = $row['lng'.$i];
    }
    $dat['lat'] = $latdat;
    $dat['lng'] = $lngdat;
    $rows[] = $dat;
}
echo(json_encode($rows,JSON_PRETTY_PRINT));

