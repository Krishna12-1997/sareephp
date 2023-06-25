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
    <!----------------------- Navbar ----------------------------->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/saree">Saree Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/saree">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="products.php">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="products.php" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Maharashtrian Sarees</a></li>
                            <li><a class="dropdown-item" href="#">Gujarati Sarees</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Other</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="btn-c" type="submit">Login</a>
                    <a class="btn btn-outline-success disabled ml-3" href="addcategory.php">Add Product</a>
                </form>
            </div>
        </div>
    </nav>
    <!--------------------------- end of navbar --------------------------->

    <div class="container">
        <h3 style="text-align: center">All Products</h3>
        <div class='underline'></div>
        <!-- <div id="breadcrumb"></div> -->

        <!-- Filter Search Bar -->
        <div class="filter-bar">
            <input type="text" id="search-input" placeholder="Search...">
            <select name="category" id="category-filter">
                <option value="all">All Categories</option>
                <?php

                // PHP code to fetch and display products
                include "db.php";

                $query = "SELECT * FROM categories";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<option value="' . $row['id'] . '" id="categorySelect">' . $row['name'] . '</option>';

                    // Fetch and display subcategories for each category
                    $categoryId = $row['id'];
                    $subQuery = "SELECT * FROM subcategories WHERE category_id = '$categoryId'";
                    $subResult = mysqli_query($conn, $subQuery);
                    while ($subRow = mysqli_fetch_assoc($subResult)) {
                        echo '<option value="' . $subRow['id'] . '" >- ' . $subRow['sub_name'] . '</option>';
                    }
                }



                ?>
            </select>
        </div>

        <div class="product-grid" id="items">

        </div>
    </div>

    <script>

        $(document).ready(function () {
            // Fetch product data using PHP (existing code)

            // Filter Products based on search input
            $('#search-input').on('keyup', function () {
                var searchValue = $(this).val().toLowerCase();
                $('.product-card').each(function () {
                    var productName = $(this).find('h3').text().toLowerCase();
                    if (productName.includes(searchValue)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });


        $(document).ready(function () {
            // Fetch product data using PHP (existing code)

            // Filter Products based on search, category, company, and price range
            function filterProducts() {
                var searchValue = $('#search-input').val().toLowerCase();
                var categoryValue = $('#category-filter').val();
                var companyValue = $('#company-filter').val();
                var minPriceValue = $('#min-price-input').val();
                var maxPriceValue = $('#max-price-input').val();

                $('.product-card').each(function () {
                    var productName = $(this).find('h3').text().toLowerCase();
                    var productCategory = $(this).data('category');
                    var productCompany = $(this).data('company');
                    var productPrice = parseFloat($(this).data('price'));

                    var isNameMatch = productName.includes(searchValue);
                    var isCategoryMatch = (categoryValue === '' || productCategory === categoryValue);
                    var isCompanyMatch = (companyValue === '' || productCompany === companyValue);
                    var isPriceInRange = ((minPriceValue === '' || productPrice >= parseFloat(minPriceValue)) &&
                        (maxPriceValue === '' || productPrice <= parseFloat(maxPriceValue)));

                    if (isNameMatch && isCategoryMatch && isCompanyMatch && isPriceInRange) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            }

            // Event listeners for filter options
            $('#search-input, #category-filter, #company-filter, #min-price-input, #max-price-input').on('keyup change', filterProducts);

            // Clear Filter
            $('#clear-filter-btn').on('click', function () {
                $('#search-input').val('');
                $('#category-filter').val('');
                $('#company-filter').val('');
                $('#min-price-input').val('');
                $('#max-price-input').val('');
                filterProducts();
            });
        });

        $(document).ready(function () {
            // Trigger filtering when category selection changes
            $('#category-filter').on('change', function () {
                var selectedValue = $(this).val();
                filterItems(selectedValue);
            });

            // Initial filtering on page load
            filterItems('all');
        });

        function filterItems(selectedValue) {
            // Send AJAX request to fetch items based on selected category or subcategory
            $.ajax({
                url: 'filter_products.php', // PHP script to retrieve items based on category or subcategory
                method: 'POST',
                data: { selectedValue: selectedValue },
                success: function (response) {
                    // Update the items section with the retrieved items
                    $('#items').html(response);
                }
            });
        }

    </script>
</body>

</html>