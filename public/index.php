<?php 
require_once("../includes/database.php");
if (isset($database)) {echo "true<br>";} else {echo "false<br>";}

echo $database->escape_value("Radi li ovvoooo, a'ooooo???") . "<br>";

// $sql = "INSERT INTO users (id, username, password, first_name, last_name) ";
// $sql .= "VALUES (1, 'Mihailo23', 'Micagablade23', 'Mihailo', 'Pantovic')";

// $result = $database->query($sql);

$sql = "SELECT * FROM users WHERE id=1";
$result_set = $database->query($sql);
$found_user = $database->fetch_array($result_set);

echo $found_user['username'];

?>