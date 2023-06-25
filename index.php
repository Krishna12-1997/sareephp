<!DOCTYPE html>
<html>

<head>
    <title>Saree Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
  <style>
    hr{
        margin: 16px 100px;
    }
  </style>
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
                <ul class="navbar-list mx-auto">
                    <li class="navbar-item"><a href="index.php">Home</a></li>
                    <li class="navbar-item"><a href="products.php">Products</a></li>
                    <li class="navbar-item dropdown">
                        <a href="#" class="dropdown-toggle">Categories</a>
                        <ul class="dropdown-menu">
                            <?php
                            include 'db.php';

                            $query = "SELECT * FROM categories";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li class="dropdown-submenu">';
                                echo '<a href="#" class="dropdown-toggle">' . $row['name'] . '</a>';
                                echo '<ul class="dropdown-menu">';
                                $categoryId = $row['id'];
                                $subQuery = "SELECT * FROM subcategories WHERE category_id = '$categoryId'";
                                $subResult = mysqli_query($conn, $subQuery);
                                while ($subRow = mysqli_fetch_assoc($subResult)) {
                                    echo '<li><a href="category.php?id=' . $subRow['id'] . '">' . $subRow['sub_name'] . '</a></li><hr/>';
                                }
                                echo '</ul>';
                                echo '</li>';
                            }
                            ?>
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

    <div class="section-center">
        <article class='content'>
            <h1>
                design your
                comfort zone
            </h1>
            <p>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto, at
                sed omnis corporis doloremque possimus velit! Repudiandae nisi odit,
                aperiam odio ducimus, obcaecati libero et quia tempora excepturi quis
                alias?
            </p>
            <a href="products.php" class='btn-c hero-btn'>
                shop now
            </a>
        </article>
        <article class='img-container '>
            <img src="assets/img/bg.jpg" alt='nice saree' class='main-img' />
            <img src="assets/img/bg1.jpg" alt='saree' class='accent-img' />
        </article>
    </div>

    <!------------------- featured products Start ----------------------------->

    <div class='section'>
        <div class='title'>
            <h2>featured products</h2>
            <div class='underline'></div>
        </div>
        <div class='section-center featured'>
            <div>
                <img src="assets/img/f1.jpg" alt="f1" />
                <footer class="footer">
                    <h5>Kota Silk Saree</h5>
                    <p>$700</p>
                </footer>
            </div>
            <div>
                <img src="assets/img/f2.jpg" alt="f2" />
                <footer class="footer">
                    <h5>Patola Saree</h5>
                    <p>$600</p>
                </footer>
            </div>
            <div>
                <img src="assets/img/f3.jpg" alt="f3" />
                <footer class="footer">
                    <h5>Linen Saree</h5>
                    <p>$900</p>
                </footer>
            </div>
        </div>
        <a href="products.php" class='btn-c btn-f'>
            all products
        </a>
    </div>
    <!------------------- featured products End ----------------------------->

    <script>
        $(document).ready(function () {
            $(".dropdown-toggle").mousemove(function () {
                $(this).next(".dropdown-menu").css("display", "block");
            });

            // $(".dropdown-toggle").mouseout(function () {
            //     $(this).next(".dropdown-menu").css("display", "none");
            // });
        });
    </script>

</body>

</html>