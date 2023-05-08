<?php
require_once PROJECT_ROOT_PATH . "/models/database.php";

class LikeModel extends Database {
	public function getLikes() {
		return $this->select("SELECT * FROM beer_likes");
	}

	public function getIp($ip) {
		return $this->select("SELECT * FROM beer_likes WHERE ip = '" . $ip . "'");
	}

	public function createLike($id, $ip) {
		return $this->create("INSERT INTO beer_likes (`id_bier`, `ip`) VALUES ('" . $id . "', '" . $ip . "')");
	}
}
?>