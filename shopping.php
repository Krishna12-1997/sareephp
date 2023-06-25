<!DOCTYPE html>
<html>

<head>
    <title>Shopping Cart UI</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    .body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom right, #E3F0FF, #FAFCFF);
        height: 80vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    img {
        height: 120px;
    }
</style>

<body>
    <!-- Navbar -->
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
                </ul>
                <form class="d-flex">
                    <a class="nav-link" href="#">Card</a>
                    <button class="btn btn-outline-success" type="submit">Login</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="body">
        <div class="CartContainer">
            <div class="Header">
                <h3 class="Heading">Shopping Cart</h3>
                <h5 class="Action">Remove all</h5>
            </div>

            <div class="Cart-Items">
                <div class="image-box">
                    <?php
                    include 'db.php';

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM products WHERE id='$id'";
                        $result = $conn->query($sql);
                        $item = $result->fetch_assoc();

                        if ($item) {
                            echo '<img src="' . $item['image'] . '" alt="Product Image"">';
                            // Display other details of the item
                        } else {
                            echo 'Item not found';
                        }

                    }
                    ?>
                </div>
                <div class="about">
                    <h1 class="title">
                        <?php echo $item['name'] ?>
                    </h1>
                </div>

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
                        $count-1;
                    }
                    ?>
                    <form method="post" class="d-flex">
                        <button type="submit" name="addButton" class="mr-3" style=" border-radius: 50%;">+</button>
                        <div class="count">
                            <?php echo $count; ?>
                        </div>
                        <button class="ml-3" type="submit" name="removeButton" style=" border-radius: 50%;">-</button>
                    </form>

                </div>
                <div class="prices">
                    <div class="amount">
                        <?php echo $item['price'] ?>
                    </div>
                    <div class="save"><u>Save for later</u></div>
                    <div class="remove"><u>Remove</u></div>
                </div>
            </div>


            <hr>
            <div class="checkout">
                <div class="total">
                    <div>
                        <div class="Subtotal">Sub-Total</div>
                        <div class="items">
                            <?php echo $count; ?> items
                        </div>
                    </div>
                    <div class="total-amount"><?php echo $item['price'] ?></div>
                </div>
                <button class="button">Checkout</button>
            </div>
        </div>
    </div>

</body>

</html>