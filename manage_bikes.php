<?php

/**
 * Start the session.
 */
session_start();

/**
 * Check if the user is logged in.
 */
if(!isset($_SESSION['user_id']) || !isset($_SESSION['logged_in'])){
    //User not logged in. Redirect them back to the login.php page.
    header('Location: login.php');
    exit;
}


/**
 * Print out something that only logged in users can see.
 */

echo 'Congratulations! You are logged in!';

require_once('database.php');

// Get category ID
if (!isset($category_id)) {
$category_id = filter_input(INPUT_GET, 'category_id', 
FILTER_VALIDATE_INT);
if ($category_id == NULL || $category_id == FALSE) {
$category_id = 1;
}
}

$search = false;

// Get name
if (!isset($name)) {
$name = filter_input(INPUT_POST, 'name-searched');
$search = true;
// echo $name;
if ($name == NULL || $name == FALSE) {
$name = "";
$search = false;
}
}


// Get name for current category
$queryCategory = "SELECT * FROM categories
WHERE categoryID = :category_id";
$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$statement1->closeCursor();
$category_name = $category['categoryName'];

// Get all categories
$queryAllCategories = 'SELECT * FROM categories
ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get bikes for selected category
$queryRecords = "SELECT * FROM bikes
WHERE categoryID = :category_id
ORDER BY bikeID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$bikes = $statement3->fetchAll();
$statement3->closeCursor();

// $search = false;

$queryRecords = "SELECT * FROM bikes
WHERE bikes.name LIKE :name
ORDER BY bikeID";
$statement3 = $db->prepare($queryRecords);
$statement3->bindValue(':name', "$name%");
$statement3->execute();
$searchedBikes = $statement3->fetchAll();
$statement3->closeCursor();



?>
<div class="container">
<?php
include('includes/header.php');
?>
<div id="sub-header">
<h1 id="page-heading">Bike Shop</h1>

<form action="manage_bikes.php" method="post" id="search-form">
    <input type="text" id="name-searched" name="name-searched" placeholder="Make/Model of Bike" value="<?php echo $name?>" />
    <input class="green-button" type="submit" value="Search">
</form>
<form action="manage_bikes.php" method="post" id="reset-form">
    <input type="hidden" id="name-searched" name="name-searched" value=""/>
    <input class="red-button" type="submit" value="Reset">
</form>
</div>

<aside>
<!-- display a list of categories -->
<h2>Categories</h2>
<nav>
<ul id="category-list">
<?php foreach ($categories as $category) : ?>
<li class="button"><a href="?category_id=<?php echo $category['categoryID']; ?>">
<?php echo $category['categoryName']; ?>
</a>
</li>
<?php endforeach; ?>
</ul>
</nav>          
</aside>

<section>
<!-- display a table of bikes -->
<?php if(!$search){ ?>
<h2><?php echo $category_name; ?></h2>
<?php } ?>
<table>
<?php if($search && $searchedBikes == null) {?>
    <p>* No Bikes Found</p>
    <?php }else{?>
<thead>
<th>Image</th>
<th>Name</th>
<th>Engine Size</th>
<th>Price</th>
<th>Last Service</th>
<th>Delete</th>
<th>Edit</th>
</thead>
<?php }?>
<tbody>
<?php if(!$search){ ?>
<?php foreach ($bikes as $bike) : ?>
<tr>
<td><img src="image_uploads/<?php echo $bike['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $bike['name']; ?></td>
<td><?php echo $bike['engineSize']; ?></td>
<td class="right"><?php echo $bike['price']; ?></td>
<td><?php echo $bike['lastService']; ?></td>
<td><form action="delete_bike.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="red-button" type="submit" value="Delete">
</form></td>
<td><form action="edit_bike_form.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="green-button" type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
<?php } else { ?>
<?php foreach ($searchedBikes as $bike) : ?>
<tr>
<td><img src="image_uploads/<?php echo $bike['image']; ?>" width="100px" height="100px" /></td>
<td><?php echo $bike['name']; ?></td>
<td><?php echo $bike['engineSize']; ?></td>
<td class="right"><?php echo $bike['price']; ?></td>
<td><?php echo $bike['lastService']; ?></td>
<td><form action="delete_bike.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="red-button" type="submit" value="Delete">
</form></td>
<td><form action="edit_bike_form.php" method="post"
id="delete_bike_form">
<input type="hidden" name="bike_id"
value="<?php echo $bike['bikeID']; ?>">
<input type="hidden" name="category_id"
value="<?php echo $bike['categoryID']; ?>">
<input class="green-button" type="submit" value="Edit">
</form></td>
</tr>
<?php endforeach; ?>
<?php }  ?>
</tbody>
</table>

</section>
<?php
include('includes/footer.php');
?>