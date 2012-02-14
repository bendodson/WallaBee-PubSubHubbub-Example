<?php require_once('Superfeedr.class.php') ?>
<?php

$superfeedr = new Superfeedr('http://api.wallab.ee/storeitems.atom', '/your/callback/url/goes/here.php', 'http://wallabee.superfeedr.com/');
$superfeedr->verbose = true;
$superfeedr->subscribe();

?>