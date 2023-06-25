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

  <div class="container">
    <form action="add_product.php" method="POST">

      <label for="product_name">Product Name:</label>
      <input type="text" name="product_name" required>

      <label for="category_id">Category:</label>
      <select name="category" required>
        <option value="">Select a category</option>
        <!-- Retrieve categories from the database and populate the dropdown -->
        <?php

        // PHP code to fetch and display products
        include "db.php";

        $query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
        }


        ?>
      </select>
      <label for="product_prize">Product Prize:</label>
      <input type="text" name="product_prize" required>

      <label for="product_description">Product Description:</label>
      <textarea name="product_description" required></textarea>

      <label for="url_image">URL Image :</label>
      <input type="text" name="url_image" required>
      

      <button class="mt-4" type="submit">Add Product</button>
    </form>

  </div>
</body>

</html>