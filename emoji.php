<?php

// Need this parameter
if ( ! isset($_COOKIE['user_key']) ) {
    die('Not logged in');
} else {
    $user_key = $_COOKIE['user_key'];
}

header("Content-type: application/json; charset=utf-8");

$files1 = scandir('./static/emoji/e1-png/sel/');
foreach( $files1 as $fn ) {
    if ( strpos($fn,'.png') === false ) continue;
    $files2[] = $fn;
}
sort($files2);
$output = array(
'path' => 'static/emoji/e1-png/sel',
'emojis' => $files2
);

echo(json_encode($output,JSON_PRETTY_PRINT));

