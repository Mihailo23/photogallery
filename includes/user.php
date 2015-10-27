<?php 
// If it's going to use the database, then it's probabaly smart to require it before we start
require_once("database.php");

class User {
	public function find_all() {
		global $database;
		$result_set = $database->query("SELECT * FROM users");
		return $result_set;
	}

	public function find_by_id($id = 0) {
		global $database;
		$result_set = $database->query("SELECT * FROM users WHERE id = {$id}");
		$found = $database->fetch_array($result_set);
		return $found;
	}
}

?>