<?php
// Include necessary files
require_once '../includes/config.php';
require_once '../classes/Product.php';

// Initialize Product class
$productModel = new Product();

// Get category from URL parameter
$category = isset($_GET['category']) ? $_GET['category'] : null;
$subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : null;

// Set page title based on category
if ($category) {
    $pageTitle = ucfirst($category);
    if ($subcategory) {
        $pageTitle .= ' - ' . ucfirst($subcategory);
    }
} else {
    $pageTitle = 'All Products';
}

// Get products based on category
if ($category) {
    $products = $productModel->getProductsByCategory($category);
} else {
    $products = $productModel->getProducts();
}

// Include header
require_once '../includes/header.php';
?>

<div class="container py-5">
    <div class="row">
        <!-- Sidebar / Filters -->
        <div class="col-lg-3 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4">Filter Products</h5>
                    
                    <!-- Categories -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Categories</h6>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="products.php" class="text-decoration-none <?php echo !$category ? 'text-primary fw-bold' : 'text-muted'; ?>">
                                    All Products
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="products.php?category=skincare" class="text-decoration-none <?php echo $category == 'skincare' ? 'text-primary fw-bold' : 'text-muted'; ?>">
                                    Skincare
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="products.php?category=haircare" class="text-decoration-none <?php echo $category == 'haircare' ? 'text-primary fw-bold' : 'text-muted'; ?>">
                                    Haircare
                                </a>
                            </li>
                            <li class="mb-2">
                                <a href="products.php?category=cosmetics" class="text-decoration-none <?php echo $category == 'cosmetics' ? 'text-primary fw-bold' : 'text-muted'; ?>">
                                    Cosmetics
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Price Range -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Price Range</h6>
                        <div class="range-slider">
                            <input type="range" class="form-range" min="0" max="100" id="priceRange">
                        </div>
                        <div class="d-flex justify-content-between mt-2">
                            <span class="small text-muted">$0</span>
                            <span class="small text-muted">$100+</span>
                        </div>
                    </div>
                    
                    <!-- Rating -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3">Rating</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="rating5">
                            <label class="form-check-label" for="rating5">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="rating4">
                            <label class="form-check-label" for="rating4">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                & Up
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" value="" id="rating3">
                            <label class="form-check-label" for="rating3">
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="fas fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                <i class="far fa-star text-warning"></i>
                                & Up
                            </label>
                        </div>
                    </div>
                    
                    <!-- Apply Filters Button -->
                    <button class="btn btn-primary w-100">Apply Filters</button>
                </div>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 mb-0"><?php echo $pageTitle; ?></h2>
                
                <div class="d-flex align-items-center">
                    <span class="text-muted me-2">Sort by:</span>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option value="featured">Featured</option>
                        <option value="price-low-high">Price: Low to High</option>
                        <option value="price-high-low">Price: High to Low</option>
                        <option value="rating">Top Rated</option>
                    </select>
                </div>
            </div>
            
            <?php if (empty($products)) : ?>
                <div class="alert alert-info">
                    No products found in this category. Please check back later or browse other categories.
                </div>
            <?php else : ?>
                <div class="row">
                    <?php foreach ($products as $product) : ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="product-card">
                                <div class="product-badge"><?php echo ucfirst($product['category']); ?></div>
                                <div class="product-image">
                                    <img src="../<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                                    <div class="product-overlay">
                                        <a href="product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-light">Quick View</a>
                                    </div>
                                </div>
                                <div class="product-content">
                                    <h4 class="product-title"><?php echo $product['name']; ?></h4>
                                    <div class="product-price">
                                        <?php if (!empty($product['sale_price']) && $product['sale_price'] > 0) : ?>
                                            <span class="text-muted text-decoration-line-through me-2"><?php echo formatPrice($product['price']); ?></span>
                                            <span><?php echo formatPrice($product['sale_price']); ?></span>
                                        <?php else : ?>
                                            <span><?php echo formatPrice($product['price']); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-rating">
                                        <?php echo generateStarRating($product['rating'] ?? 0); ?>
                                        <span class="rating-count">(<?php echo $product['rating'] ?? 0; ?>)</span>
                                    </div>
                                    <button class="btn btn-primary btn-sm w-100 mt-2 add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// Include footer
require_once '../includes/footer.php';
?>