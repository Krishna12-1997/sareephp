<!DOCTYPE html>
<html>

<head>
    <title>All Products</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .section-c {
        width: 90vw;
        height: 100vh;
        margin: 0 auto;
        max-width: 1170px;
        gap: 8rem;
        grid-template-columns: repeat(2, 1fr);
        place-items: center;
    }

    .h4 {
        text-align: center !important;
        color: hsl(22, 28%, 29%);
        font-size: 1.8em;
        padding: 3%;
        border-radius: 10%;
    }
</style>

<body>
    <!----------------------------------- Navbar -------------------->
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

    <!--------------------------- Single Product --------------------------->
    <div>
        <?php
        include 'db.php';

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM products WHERE id='$id'";
            $result = $conn->query($sql);
            $item = $result->fetch_assoc();

            if ($item) {
                ?>
        <h4 class="h4">
            <?php echo $item['name'] ?>
        </h4>
        <div class='section section-c page'>
            <a href="products.php" class='btn-c'>
                back to products
            </a>
            <div class='product-center'>
                <?php echo '<img src="' . $item['image'] . '" alt="Product Image"">'; ?>
                <section class='content'>
                    <h2>
                        <?php echo $item['name'] ?>
                    </h2>
                    <?php

                    $rating = 3.5;
                    echo '<div class="stars">';
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                            echo '<span class="star">&#9733;</span>'; // Filled star icon
                        } else {
                            echo '<span class="star">&#9734;</span>'; // Empty star icon
                        }
                    }
                    echo '</div>';

                    ?>
                    <h5 class='price'>
                        <?php echo $item['price'] ?>
                    </h5>
                    <p class='desc'>
                        <?php echo $item['description'] ?>
                    </p>
                    <p class='info'>
                        <span>Available : </span>
                        <?php $item ? "In stock" : 'out of stock' ?>
                    </p>
                    <p class='info'>
                        <?php $token = bin2hex(random_bytes(8)); ?>
                        <span>SKU :</span>
                        <?php echo $token ?>
                    </p>
                    <p class='info'>
                        <span>Brand :</span>
                        ABC
                    </p>
                    <hr />
                    <div class="counter">
                        <?php
                        // Initialize the count variable
                        $count = 1;

                        // Check if the form is submitted
                        if (isset($_POST['addButton'])) {
                            // Increment the count by 1
                            $count++;
                        } elseif (isset($_POST['removeButton'])) {
                            // Decrement the count by 1
                            $count - 1;
                        }
                        ?>
                        <form method="post" class="d-flex mt-2">
                            <button type="submit" name="addButton" class="mr-3" style=" border-radius: 50%;">+</button>
                            <div class="count">
                                <?php echo $count; ?>
                            </div>
                            <button class="ml-3" type="submit" name="removeButton"
                                style=" border-radius: 50%;">-</button>
                        </form>

                    </div>
                   <?php echo '<a class="btn-c mt-4" href="shopping.php?id='. $item['id'] . '">Add to Cart</a>' ?>
                </section>
            </div>
        </div>
    </div>

    <?php } ?>
    <?php } ?>
</body>

</html>