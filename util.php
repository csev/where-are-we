<?php

function load_emojis($dir='./static/emoji/e1-png/sel/') {
    $files1 = scandir('./static/emoji/e1-png/sel/');
    foreach( $files1 as $fn ) {
        if ( strpos($fn,'.png') === false ) continue;
        $files2[] = $fn;
    }
    sort($files2);
    return $files2;
}

