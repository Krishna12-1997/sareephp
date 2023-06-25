<?php
include 'db.php';

// PHP code to fetch and display products
$selectedValue = $_POST['selectedValue'];

$query = "SELECT * FROM products ";
if ($selectedValue !== 'all') {
  //  $query .= " WHERE category_id = '$category'";
  $subQuery = "SELECT category_id FROM subcategories WHERE id = '$selectedValue'";
  $subResult = mysqli_query($conn, $subQuery);

  if ($subResult && mysqli_num_rows($subResult) > 0) {
    // Selected value is a subcategory, filter items by subcategory
    $query .= " WHERE subcategory_id = '$selectedValue'";
  } else {
    // Selected value is a category, filter items by category
    $query .= " WHERE category_id = '$selectedValue'";
  }
}

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="product-card">';
    echo '<div>';
    echo '<img src="' . $row['image'] . '" alt="Product Image">';
    echo '<footer class="footer">';
    echo '<h5>' . $row['name'] . '</h5>';
    echo '<p>$' . $row['price'] . '</p>';
    echo '</footer></div>';
    echo '<p>' . $row['description'] . '</p>';
    echo '<a class="btn" href="singleproduct.php?id=' . $row['id'] . '">See Details </a>';
    echo '</div>';
  }
} else {
  echo 'No products found.';
}

mysqli_close($conn);

?>