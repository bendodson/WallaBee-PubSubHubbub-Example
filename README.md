This is an example of how you can use the WallaBee PubSubHubbub Real Time API via Superfeedr. You can find out more about the Real Time API at [http://wallab.ee/developers/realtime/](http://wallab.ee/developers/realtime/)

# Usage

You first of all need to change the Superfeedr.class.php file to send your Superfeedr username and password via basic auth.

Once that's done, you need to subscribe to a feed. This can be done via the subscribe.php file:

	<?php require_once('Superfeedr.class.php') ?>
	<?php

	$superfeedr = new Superfeedr('http://api.wallab.ee/storeitems.atom', '/your/callback/url/goes/here.php', 'http://wallabee.superfeedr.com/');
	$superfeedr->verbose = true;
	$superfeedr->subscribe();

	?>
	
This will subscribe to the storeitems.atom feed with your own callback (use the callback.php file as an example). I've set the "verbose" output to be true so when the subscription happens, you'll be able to see the debug headers from Superfeedr. A `204` status code means everything is OK.

Finally, you need to get your callback page sorted. Superfeedr will ping you via `php://input` so we take the data from there and then use it however we want (you'll want to parse it and then make use of it in your app):

	<?php

	date_default_timezone_set('UTC');

	// Authentication headers for when required
	if ($_GET['hub_challenge']) {
		echo $_GET['hub_challenge'];
		exit;
	}

	// here comes the feed! *om nom nom*
	$data = file_get_contents("php://input");

	// if you want to see the headers that have been sent, use this:
	// file_put_contents('headers.txt', print_r($_SERVER,true));

	// if you just want the data use this:
	// file_put_contents('data.txt', $data);

	?>
