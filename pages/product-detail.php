<?php
// Include necessary files
require_once '../includes/config.php';
require_once '../classes/Product.php';

// Initialize Product class
$productModel = new Product();

// Get product ID from URL parameter
$productId = isset($_GET['id']) ? $_GET['id'] : null;

// If no product ID provided, redirect to products page
if (!$productId) {
    header('Location: products.php');
    exit;
}

// Get product details
$product = $productModel->getProductById($productId);

// If product not found, redirect to products page
if (!$product) {
    header('Location: products.php');
    exit;
}

// Get related products
$relatedProducts = $productModel->getRelatedProducts($productId, $product['category'], 4);

// Include header
require_once '../includes/header.php';
?>

<div class="container py-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="products.php">Products</a></li>
            <li class="breadcrumb-item"><a href="products.php?category=<?php echo $product['category']; ?>"><?php echo ucfirst($product['category']); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $product['name']; ?></li>
        </ol>
    </nav>
    
    <!-- Product Details -->
    <div class="row">
        <!-- Product Images -->
        <div class="col-