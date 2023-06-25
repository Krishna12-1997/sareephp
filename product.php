<!DOCTYPE html>
<html>

<head>
    <title>Saree Shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Saree Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Product</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
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
                    <!-- <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li> -->
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Subcategories -->
    <!-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="subcategoriesDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Subcategories
                        </a>
                        <div class="dropdown-menu" aria-labelledby="subcategoriesDropdown">
                            <a class="dropdown-item" href="#">Paithani Saree</a>
                            <a class="dropdown-item" href="#">Kohlapuri Saree</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Bandhani Silk Saree</a>
                            <a class="dropdown-item" href="#">Peach Organza Saree</a>
                        </div>
                    </li> -->


    <!-- #===========  product   ===================== -->

    <div class="container box">
        <h3 class="align-center">
            Geeks for Geeks Import JSON
            data into database
        </h3><br />

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "saree";

        // Create a connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = '';
        $table_data = '';

        // json file name
        $filename = "saree.json";

        // Read the JSON file in PHP
        $data = file_get_contents($filename);

        // Convert the JSON String into PHP Array
        $array = json_decode($data, true);

        // Extracting row by row
        foreach ($array as $row) {

            // Database query to insert data 
            // into database Make Multiple 
            // Insert Query  
        
            $query .=
                "INSERT INTO products (name, category_id, price, description, image) VALUES 
                ('" . $row["name"] . "', '" . $row["category_id"] . "', '" . $row["price"] . "', 
                '" . $row["description"] . "', '" . $row["image"] . "'); ";

            $table_data .= '
                <tr>
                    <td>' . $row["name"] . '</td>
                    <td>' . $row["price"] . '</td>
                    <td>' . $row["description"] . '</td>
                    <td><img style="width: 200px; height: 200px" src="' . $row["image"] . '" alt="Image"></td>
                </tr>
                '; // Data for display on Web page
        }

        if (mysqli_multi_query($conn, $query)) {
            // echo '<h3>Inserted JSON Data</h3><br />';
            // echo '
            //     <table class="table table-bordered">
            //     <tr>
            //         <th width="45%">Name</th>
            //         <th width="10%">Price</th>
            //         <th width="45%">Description</th>
            //         <th width="20%">Image</th>
            //     </tr>
            //     ';
            // echo $table_data;
             echo 'data inserted successfully';
        

        }
        ?>
        <br />
    </div>


</body>

</html>