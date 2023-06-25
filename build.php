<?php

// Set the output directory where the static files will be generated
$outputDir = 'static';

// Create the output directory if it doesn't exist
if (!file_exists($outputDir)) {
    mkdir($outputDir);
}

// Your build tasks and preprocessing logic
// Modify this section according to your project's requirements

// Example: Copy PHP files from the source directory to the output directory
$sourceDir = 'src';
$phpFiles = glob($sourceDir . '/*.php');
foreach ($phpFiles as $phpFile) {
    $fileName = basename($phpFile);
    $outputFile = $outputDir . '/' . $fileName;
    copy($phpFile, $outputFile);
}

// Example: Generate static HTML files for saree categories and subcategories
include "db.php";

// Fetch and generate static files for categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = mysqli_query($conn, $categoryQuery);
while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
    $categoryId = $categoryRow['id'];
    $categoryName = $categoryRow['name'];
    $categorySlug = strtolower(str_replace(' ', '-', $categoryName));
    $categoryOutputDir = $outputDir . '/' . $categorySlug;
    if (!file_exists($categoryOutputDir)) {
        mkdir($categoryOutputDir);
    }
    $categoryOutputFile = $categoryOutputDir . '/index.html';
    $categoryContent = "<h1>$categoryName Sarees</h1>";
    file_put_contents($categoryOutputFile, $categoryContent);

    // Fetch and generate static files for subcategories within each category
    $subcategoryQuery = "SELECT * FROM subcategories WHERE category_id = '$categoryId'";
    $subcategoryResult = mysqli_query($conn, $subcategoryQuery);
    while ($subcategoryRow = mysqli_fetch_assoc($subcategoryResult)) {
        $subcategoryName = $subcategoryRow['sub_name'];
        $subcategorySlug = strtolower(str_replace(' ', '-', $subcategoryName));
        $subcategoryOutputDir = $categoryOutputDir . '/' . $subcategorySlug;
        if (!file_exists($subcategoryOutputDir)) {
            mkdir($subcategoryOutputDir);
        }
        $subcategoryOutputFile = $subcategoryOutputDir . '/index.html';
        $subcategoryContent = "<h2>$subcategoryName Sarees</h2>";
        file_put_contents($subcategoryOutputFile, $subcategoryContent);
    }
}

// End of build tasks

echo 'Build complete!';

?>