<?php

$pageTitle = "Products List";

require_once 'includes/header.php';
require_once '../App/Database/Database.php';
require_once '../App/Controllers/ProductController.php';
require_once '../App/Controllers/Controller.php';

$productController = new ProductController();
$products = $productController->getAll();
$products_delete = $productController->destroy();
$num = $products->rowCount();

?>

<div class="header-container">
    <h1>Product List</h1>
    <div class="btn-container">
        <a class="btn btn-success" href="/add-product.php">ADD</a>
        <button class="btn btn-danger" id="delete-product-btn" form="delete-form" type="submit">MASS DELETE</button>
    </div>
</div>

<div class="container mt-4">

    <div class="row">

        <?php if ($num > 0) : ?>
            <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="delete-form">

                <?php while ($product = $products->fetch(PDO::FETCH_OBJ)) : ?>
                    <!-- Product Cards -->
                    <div class="col-md-4 mb-4">
                        <div class="product-card">
                            <input type="checkbox" class="delete-checkbox" name="selected_items[]" value="<?= $product->id ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $product->sku ?></h5>
                                <p class="card-text"><?= $product->name ?></p>
                                <p class="card-text">$<?= $product->price ?></p>
                                <?= ($product->size) ? '<p class="card-text"> Size: ' . $product->size . ' MB</p>' : '' ?>
                                <?= ($product->weight) ? '<p class="card-text"> Weight: ' . $product->weight . ' KG</p>' : '' ?>
                                <?= ($product->height) ? '<p class="card-text"> Dimensions: ' . $product->height . 'x' . $product->width . 'x' . $product->length . '</p>' : '' ?>
                            </div>
                        </div>
                    </div>
                    <!-- Repeat this card structure for each product -->
                <?php endwhile; ?>
            </form>

        <?php else : ?>
            <div class='alert alert-info'>No products found.</div>
        <?php endif; ?>

    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
