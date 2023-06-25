<?php
include 'db.php';
// Retrieve the form data
$product_name = $_POST['product_name'];
$category_id = $_POST['category'];
$product_prize = $_POST['product_prize'];
$product_description = $_POST['product_description'];
$url_image = $_POST['url_image'];

// Perform necessary validation and sanitation of the input data

// Insert the product into the products table
$sql = "INSERT INTO products (name, category_id , price , description, image) VALUES ('$product_name', '$category_id', '$product_prize', '$product_description', '$url_image')";

// Execute the SQL query using your preferred database connection method
// Replace with your own code to execute the SQL query
$result = mysqli_query($conn, $sql);// Implement this function to execute the query

// Check if the product insertion was successful
if ($result) {
  echo "Product added successfully.";
} else {
  echo "Error adding product.";
}
?>