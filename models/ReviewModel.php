<?php
require_once PROJECT_ROOT_PATH . "/models/database.php";

class ReviewModel extends Database {
	public function getReview($id) {
		return $this->select("SELECT * FROM reviews WHERE id = " . $id);
	}

	public function createReview($userId, $beerId, $stars, $note) {
		return $this->create("INSERT INTO reviews (`user_id`, `beer_id`, `stars`, `note`) VALUES ('" . $userId . "', '" . $beerId . "', '" . $stars . "', '" . $note . "')");
	}

	public function getAllReviews() {
    return $this->select("SELECT * FROM reviews");
  }

	public function getReviewsByBeerId($beerId) {
		return $this->select("SELECT * FROM reviews WHERE beer_id = " . $beerId);
	}
}
?>