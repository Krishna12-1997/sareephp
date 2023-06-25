<!DOCTYPE html>
<html>

<head>
    <title>All Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php
    include "db.php";

    // Get the selected subcategory ID from the request
    $selectedSubcategory = $_GET['id'];

    // Fetch subcategory name
    $subCategoryQuery = "SELECT sub_name FROM subcategories WHERE id = '$selectedSubcategory'";
    $subCategoryResult = mysqli_query($conn, $subCategoryQuery);
    $subCategoryRow = mysqli_fetch_assoc($subCategoryResult);
    $subCategoryName = $subCategoryRow['sub_name'];

    // Fetch products based on the selected subcategory
    $productQuery = "SELECT * FROM products WHERE subcategory_id = '$selectedSubcategory'";
    $productResult = mysqli_query($conn, $productQuery);

    // Display the products
    while ($productRow = mysqli_fetch_assoc($productResult)) {
        echo '<div class="product-grid">';
        echo '<div class="product-card">';
        echo '<div>';
        echo '<img src="' . $productRow['image'] . '" alt="Product Image">';
        echo '<footer class="footer">';
        echo '<h5>' . $productRow['name'] . '</h5>';
        echo '<p>$' . $productRow['price'] . '</p>';
        echo '</footer></div>';
        echo '<p>' . $productRow['description'] . '</p>';
        echo '<a class="btn" href="singleproduct.php?id=' . $productRow['id'] . '">See Details </a>';
        echo '</div></div>';
    }

    ?>
</body>

</html>