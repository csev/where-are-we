<?php

require_once "util.php";

if ( isset($_COOKIE['user_key']) ) {
    $user_key = $_COOKIE['user_key'];
} else {
    $user_key = bin2hex(openssl_random_pseudo_bytes(32));
    setcookie('user_key',$user_key,time() + (86400 * 120));
}

$emoji_path = './static/emoji/e1-png/sel/';
$emojis = load_emojis($emoji_path);

$current = isset($_COOKIE['emoji']) ? $_COOKIE['emoji'] : false;
$name = isset($_COOKIE['name']) ? $_COOKIE['name'] : false;
?>
<html>
<head>
<title>Beta Test</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<?php require_once "head.php"; ?>
</head>
<body style="font-family: sans-serif;">
<center>
<h2><a href="beta.php">Exit Configuration</a></h2>
<form>
<p>
Enter Your Name:
<input type="text" name="name" onchange="saveName(this);return false;" size="40"
value="<?= htmlentities($name) ?>" >
<input type="button" name="save" value="Save" onchange="return false;">
</form>
<hr/>
<p>Select Your Emoji</p>
<?php 
foreach($emojis as $emoji) {
    echo('<a href="#" onclick="setEmoji(\''.$emoji.'\');return false;">');
    if ( $current == $emoji ) {
        echo('<img style="margin: 1px; border: 1px black solid;" src="'.$emoji_path.$emoji.'">');
    } else {
        echo('<img style="margin: 2px;" src="'.$emoji_path.$emoji.'">');
    }
    echo("</a>\n");
}
?>
<?php require_once "foot-begin.php"; ?>
<script>
function saveName(elem) {
    window.console && console.log('Set name to '+elem.value);
    setCookie('name', elem.value, 365);
}
function setEmoji(emoji) {
    window.console && console.log('Set emoji to '+emoji);
    setCookie('emoji',emoji,365);
    document.location.href = 'beta.php';
    // window.location.reload(true);
}

</script>
<?php require_once "foot-end.php"; ?>
</body>

