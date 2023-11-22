<?php

$pageTitle = "Products Add";

require_once 'includes/header.php';
require_once '../App/Database/Database.php';
require_once '../App/Controllers/ProductController.php';
require_once '../App/Controllers/Controller.php';

$productController = new ProductController();
$productController->store();

?>

<div class="header-container">
    <h1>Product Add</h1>
    <div class="btn-container">
        <button class="btn btn-success" type="submit" form="product_form">Save</button>
        <a class="btn btn-secondary" href="/">Cancel</a>
    </div>
</div>

<div class="container form-container">
    <?php if (isset($_SESSION['errors'])) : ?>
        <div class="alert alert-danger">
           
                <ul>
                <?php foreach ($_SESSION['errors'] as $error) : ?>
                    <li>
                        <?= $error; ?>
                    </li>
                <?php endforeach; ?>
                </ul>
        </div>
    <?php
            unset($_SESSION['errors']);
        endif;
    ?>


<form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="product_form">

    <div class="form-group">
        <label for="sku">SKU:</label>
        <input type="text" class="form-control" id="sku" name="sku" value="<?= isset($_POST['sku']) ? htmlspecialchars($_POST['sku']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="price">Price ($):</label>
        <input type="text" class="form-control" id="price" name="price" value="<?= isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>">
    </div>

    <div class="form-group">
        <label for="type">Product Type:</label>
        <select class="form-control" id="productType" name="productType" onchange="showAdditionalFields()">
            <option value="">Type Switcher</option>
            <option value="DVD" id="DVD" <?= (isset($_POST['productType']) && $_POST['productType'] === 'DVD') ? 'selected' : ''; ?> >DVD</option>
            <option value="Book" id="Book" <?= (isset($_POST['productType']) && $_POST['productType'] === 'Book') ? 'selected' : ''; ?> >Book</option>
            <option value="Furniture" id="Furniture" <?= (isset($_POST['productType']) && $_POST['productType'] === 'Furniture') ? 'selected' : ''; ?> >Furniture</option>
        </select>
    </div>

    <div class="form-group" id="sizeField" style="<?= (isset($_POST['productType']) && $_POST['productType'] === 'DVD') ? 'display:block;' : 'display:none;'; ?>">
        <label for="size">Size (MB):</label>
        <input type="text" class="form-control" id="size" name="size" value="<?= isset($_POST['size']) ? htmlspecialchars($_POST['size']) : ''; ?>">
        <small>Please, provide size in MB</small>
    </div>

    <div class="form-group" id="weightField" style="<?= (isset($_POST['productType']) && $_POST['productType'] === 'Book') ? 'display:block;' : 'display:none;'; ?>">
        <label for="weight">Weight (KG):</label>
        <input type="text" class="form-control" id="weight" name="weight" value="<?= isset($_POST['weight']) ? htmlspecialchars($_POST['weight']) : ''; ?>">
        <small>Please, provide weight in KG</small>
    </div>

    <div class="form-group" id="dimensionsField" style="<?= (isset($_POST['productType']) && $_POST['productType'] === 'Furniture') ? 'display:block;' : 'display:none;'; ?>">
        <label for="height">Height (CM):</label>
        <input type="text" class="form-control" id="height" name="height" value="<?= isset($_POST['height']) ? htmlspecialchars($_POST['height']) : ''; ?>">
        <label for="width">Width (CM):</label>
        <input type="text" class="form-control" id="width" name="width" value="<?= isset($_POST['width']) ? htmlspecialchars($_POST['width']) : ''; ?>">
        <label for="length">Length (CM):</label>
        <input type="text" class="form-control" id="length" name="length" value="<?= isset($_POST['length']) ? htmlspecialchars($_POST['length']) : ''; ?>">
        <small>Please, provide dimensions in format HxWxL</small>
    </div>

</form>

</div>

<?php require_once 'includes/footer.php'; ?>