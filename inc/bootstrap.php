<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";
// include the base controllers file
require_once PROJECT_ROOT_PATH . "/controllers/api/BaseController.php";
// include the use models file
require_once PROJECT_ROOT_PATH . "/models/BeerModel.php";
require_once PROJECT_ROOT_PATH . "/controllers/api/BeerController.php";

require_once PROJECT_ROOT_PATH . "/models/UserModel.php";
require_once PROJECT_ROOT_PATH . "/controllers/api/UserController.php";

require_once PROJECT_ROOT_PATH . "/models/LikeModel.php";
require_once PROJECT_ROOT_PATH . "/controllers/api/LikeController.php";

require_once PROJECT_ROOT_PATH . "/models/ReviewModel.php";
require_once PROJECT_ROOT_PATH . "/controllers/api/ReviewController.php";
?>
