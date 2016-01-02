<?php

namespace Tsugi\Crypt;

require_once 'vendor/autoload.php';

// From: http://www.movable-type.co.uk/scripts/aes-php.html

  $timer = microtime(true);

  $pw = 'L0ck it up saf3';
  $pt = 'pssst ... đon’t tell anyøne!';
  $encr = AesCtr::encrypt($pt, $pw, 256) ;
  $decr = AesCtr::decrypt($encr, $pw, 256);
  echo("E: ".$encr."\n");
  echo("D: ".$decr."\n");

