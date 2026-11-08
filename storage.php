<?php
    require_once "connect.php";

    if($_SESSION['role'] === '' || $_SESSION['user_id'] === ''){
         header("Location: index.php"); 
     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLMS Storage</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="site-header">
        <div class="header-inner">
            <a class="site-brand" href="home.php"><span class="brand-mark" aria-hidden="true">🍌</span> Banana Len</a>
            <nav class="nav" aria-label="Main navigation">
                <a href="home.php">Home</a>
                <a href="storage.php" aria-current="page">Storage</a>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="profile.php">Profile</a>
                <?php endif; ?>
                <a href="logout.php">Log out</a>
            </nav>
        </div>
    </header>
    <main class="page-content">
        <section class="page-card">
            <p class="eyebrow">Banana Len Management System</p>
            <h1>Storage</h1>
            <p>Your storage dashboard will appear here.</p>
            <div class="main storage-layout">
                <section class="storage-panel">
                    <h3>Storage Overview</h3>
                    <form class="product-form" action="" method="POST">
                        <div class="form-field">
                            <label for="product_name">Product Name</label>
                            <input id="product_name" type="text" name="product_name" placeholder="Product Name" required>
                        </div>
                        <div class="form-field">
                            <label for="product_description">Product Description</label>
                            <input id="product_description" type="text" name="product_description" placeholder="Product Description" required>
                        </div>
                        <div class="form-field">
                            <label for="product_quantity">Quantity</label>
                            <input id="product_quantity" type="number" name="product_quantity" placeholder="Quantity" required>
                        </div>
                        <div class="form-field">
                            <label for="product_price">Price</label>
                            <input id="product_price" type="number" name="product_price" placeholder="Price" required>
                        </div>
                        <div class="form-actions">
                            <button class="button" type="submit" name="addproductbtn">Add product</button>
                        </div>
                    </form>
                </section>
                <section class="storage-panel">
                    <h3>Storage Details</h3>
                    <div class="table-wrap">
                    <table class="data-table products-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Inserted At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $fetchquery = "SELECT * FROM products";

                                $fetch = mysqli_query($conn, $fetchquery);
                                
                                if(mysqli_num_rows($fetch) > 0){
                                    while($products = mysqli_fetch_assoc($fetch)){
                                        ?>
                                        <tr>
                                            <td><?php echo $products['ID']; ?></td>
                                            <td><?php echo $products['name']; ?></td>
                                            <td><?php echo $products['description']; ?></td>
                                            <td><?php echo $products['quantity']; ?></td>
                                            <td><?php echo $products['price']; ?></td>
                                            <td><?php echo $products['created_at']; ?></td>
                                            <td>
                                                <button class="table-button" type="button" onclick="window.location.href='edit.php?productid=<?php echo $products['ID']; ?>'">Edit</button>
                                                <button class="table-button danger" type="button" onclick="window.location.href='delete.php?productid=<?php echo $products['ID']; ?>'">Delete</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7">No products found.</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                        </tbody>
                    </table>
                    </div>
                </section>
            </div>
        </section>
    </main>
</body>
</html>


<?php
    if(isset($_POST['addproductbtn'])){
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $quantity = $_POST['product_quantity'];
        $price = $_POST['product_price'];

        $userid = $_SESSION['user_id'];

        $insertquery = "INSERT INTO products (name, description, quantity, price, created_by) VALUES ('$name', '$description', '$quantity', '$price', '$userid')";

        $insertfuction = mysqli_query($conn, $insertquery);

        if($insertfuction){
            echo "<script>alert('Product added successfully.'); window.location.href='storage.php';</script>";
        } else {
            echo "<script>alert('Error adding product.'); window.location.href='storage.php';</script>";
        }
    }
?>