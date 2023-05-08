<?php
require_once PROJECT_ROOT_PATH . "/models/database.php";

class BeerModel extends Database {
	public function getBeers($limit = 750, $order = ['id', 'a']) {
		$order[1] = strtolower($order[1]);
		if ($order[1] != 'a' && $order[1] != 'd') $order[1] = 'a';

		if ($order[1] == 'a') $order[1] = 'ASC';
		else $order[1] = 'DESC';
		
		return $this->select("SELECT * FROM beers ORDER BY " .$order[0] . " " . $order[1]. " LIMIT " . $limit);
	}

	public function getOneBeer($id) {
		return $this->select("SELECT * FROM beers WHERE id = " . $id)[0];
	}

	public function updateBeer($id, $field, $value) {
		return $this->update("UPDATE beers SET " . $field . " = '" . $value . "' WHERE id = " . $id);
	}
}
?>