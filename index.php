<?php
require __DIR__ . "/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

foreach($uri as $key => $value) {
	if ($value == 'index.php') {
		$model = $uri[$key + 1];
		$method = $uri[$key + 2];
	}
}

if (isset($model)) {
	switch($model) {
		case 'beer':
			$objFeedController = new BeerController();
			break;
		case 'user':
			$objFeedController = new UserController();
			break;
		case 'like':
			$objFeedController = new LikeController();
			break;
		case 'review':
			$objFeedController = new ReviewController();
			break;
	}

	$strMethodName = $method . 'Action';
	$objFeedController->{$strMethodName}();
}
?>
