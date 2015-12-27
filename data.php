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

$pdo->query('DELETE FROM user WHERE login_at < DATE_SUB(NOW(), INTERVAL 100 MINUTE)');
$pdo->query('DELETE FROM context_map WHERE updated_at < DATE_SUB(NOW(), INTERVAL 100 MINUTE)');

$stmt = $pdo->prepare('INSERT INTO user 
    (user_key, user_sha256, login_at) VALUES ( :sid, :sid, NOW() )
    ON DUPLICATE KEY UPDATE login_at = NOW()');
$stmt->execute(array( ':sid' => $user_key ));

$stmt = $pdo->prepare('SELECT user_id FROM user WHERE user_sha256 = :sid');
$stmt->execute(array( ':sid' => $user_key ));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$user_id = $row['user_id'];

$stmt = $pdo->prepare('INSERT INTO context_map 
   ( context_id, user_id, lat0, lng0, when0, updated_at )
   VALUES ( 1, :uid, :lat, :lng, NOW(), NOW() )
   ON DUPLICATE KEY UPDATE lat0=:lat,lng0=:lng,when0=NOW(),updated_at=NOW()');
$stmt->execute(array( ':uid' => $user_id, ':lat' => $lat, ':lng' => $lng ));


$stmt = $pdo->prepare('SELECT displayname,email,lat0,lng0
    FROM context_map JOIN user ON context_map.user_id = user.user_id 
    WHERE context_id = 1 AND context_map.user_id != :uid');
$stmt->execute(array( ':uid' => $user_id ));
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo(json_encode($rows,JSON_PRETTY_PRINT));

