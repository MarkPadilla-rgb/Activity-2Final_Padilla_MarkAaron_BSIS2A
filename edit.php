<?php
    require_once "connect.php";

    if(!isset($_SESSION['user_id']) && !isset($_SESSION['role']) && !isset($_SESSION['username'])){
        header("Location: index.php");
    }


    $productid = $_GET['productid'];

    $fetchproduct = mysqli_query($conn, "SELECT * FROM products WHERE ID = '$productid'");

    if(mysqli_num_rows($fetchproduct) > 0){
        $product = mysqli_fetch_assoc($fetchproduct);
    } else {
        echo "<script>alert('Product not found.'); window.location.href='storage.php';</script>";
    }
?>    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product | Banana Len</title>
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
        <section class="page-card edit-card">
            <p class="eyebrow">Storage management</p>
            <h1>Edit product</h1>
            <p>Update the details for product #<?php echo $product['ID']; ?>.</p>
            <form class="product-form edit-form" action="" method="POST">
                <div class="form-field">
                    <label for="product_name">Product Name</label>
                    <input id="product_name" type="text" name="product_name" placeholder="Product Name" value="<?php echo $product['name']; ?>" required>
                </div>
                <div class="form-field">
                    <label for="product_description">Product Description</label>
                    <input id="product_description" type="text" name="product_description" placeholder="Product Description" value="<?php echo $product['description']; ?>" required>
                </div>
                <div class="form-field">
                    <label for="product_quantity">Quantity</label>
                    <input id="product_quantity" type="number" name="product_quantity" placeholder="Quantity" value="<?php echo $product['quantity']; ?>" required>
                </div>
                <div class="form-field">
                    <label for="product_price">Price</label>
                    <input id="product_price" type="number" name="product_price" placeholder="Price" value="<?php echo $product['price']; ?>" required>
                </div>
                <div class="form-actions">
                    <button class="button" type="submit" name="editproductbtn">Save changes</button>
                    <a class="cancel-link" href="storage.php">Cancel</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>

<?php
    if(isset($_POST['editproductbtn'])){
        $name = $_POST['product_name'];
        $description = $_POST['product_description'];
        $quantity = $_POST['product_quantity'];
        $price = $_POST['product_price'];

        $updatequery = "UPDATE products SET name='$name', description='$description', quantity='$quantity', price='$price' WHERE ID='$productid'";

        $updatefunction = mysqli_query($conn, $updatequery);

        if($updatefunction){
            echo "<script>alert('Product updated successfully.'); window.location.href='storage.php';</script>";
        } else {
            echo "<script>alert('Error in updating the product.'); window.location.href='storage.php';</script>";
        }
    }
?>