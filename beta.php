<?php

if ( ! isset($_COOKIE['beta']) ) {
    setcookie('beta','xyzzy',time() + (86400 * 30));
}
echo("Welcome to the Beta Test of whrwe.com");

