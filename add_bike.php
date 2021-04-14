<?php

// Get the product data
$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$name = filter_input(INPUT_POST, 'name');
$engineSize = filter_input(INPUT_POST, 'engineSize');
$price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
$lastService = filter_input(INPUT_POST, 'lastService');

// Validate inputs
if ($category_id == null || $category_id == false ||
    $name == null || $engineSize == null || $price == null || $lastService == false || $price == false ) {
    $error = "Invalid bike data. Check all fields and try again.";
    include('error.php');
    exit();
} else {

    /**************************** Image upload ****************************/

    error_reporting(~E_NOTICE); 

// avoid notice

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    echo $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];

    if (empty($imgFile)) {
        $image = "";
    } else {
        $upload_dir = 'image_uploads/'; // upload directory

        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        // rename uploading image
        $image = rand(1000, 1000000) . "." . $imgExt;
        // allow valid image file formats
        if (in_array($imgExt, $valid_extensions)) {
        // Check file size '5MB'
            if ($imgSize < 5000000) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $image)) {
                    echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
                } else {
                    $error =  "Sorry, there was an error uploading your file.";
                    include('error.php');
                    exit();
                }
            } else {
                $error = "Sorry, your file is too large.";
                include('error.php');
                exit();
            }
        } else {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            include('error.php');
            exit();
        }
    }

    /************************** End Image upload **************************/
    
    require_once('database.php');

    // Add the product to the database 
    $query = "INSERT INTO bikes
                 (categoryID, name, engineSize, price, lastService, image)
              VALUES
                 (:category_id, :name, :engineSize, :price, :lastService, :image)";
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':engineSize', $engineSize);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':lastService', $lastService);
    $statement->bindValue(':image', $image);
    $statement->execute();
    $statement->closeCursor();

    // Display the Product List page
    include('index.php');
}