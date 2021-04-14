<?php
require_once('database.php');

// Get IDs
$bike_id = filter_input(INPUT_POST, 'bike_id', FILTER_VALIDATE_INT);
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

// Delete the product from the database
if ($bike_id != false && $category_id != false) {
    $query = "DELETE FROM bikes
              WHERE bikeID = :bike_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':bike_id', $bike_id);
    $statement->execute();
    $statement->closeCursor();
}

// display the Product List page
include('index.php');
?>