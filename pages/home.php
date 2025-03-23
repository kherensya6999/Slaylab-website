<!-- Hero Section -->
<section class="hero-section">
    <div class="container-fluid p-0">
        <div class="hero-slider">
            <div class="hero-slide" style="background-image: url('assets/images/hero-bg.jpg');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="hero-content">
                                <h1 class="hero-title">Tingkatkan Rutinitas Kecantikan Anda</h1>
                                <p class="hero-subtitle">Temukan kosmetik dan produk perawatan kulit premium yang dibuat dengan bahan alami untuk kulit sehat dan bercahaya.</p>
                                <a href="pages/products.php" class="btn btn-primary btn-lg rounded-pill">Shop Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Our Categories</h2>
            <p class="section-subtitle">Jelajahi berbagai produk kecantikan kami yang dirancang untuk membuat Anda tampil dan merasa terbaik.</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <div class="category-image">
                        <img src="assets/images/category-skincare.jpg" alt="Skincare" class="img-fluid">
                    </div>
                    <div class="category-content text-center">
                        <h3 class="category-title">Skincare</h3>
                        <p class="category-description">Nourish your skin with our premium products</p>
                        <a href="pages/products.php?category=skincare" class="btn btn-outline-primary btn-sm rounded-pill">Explore</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <div class="category-image">
                        <img src="assets/images/category-haircare.jpg" alt="Haircare" class="img-fluid">
                    </div>
                    <div class="category-content text-center">
                        <h3 class="category-title">Haircare</h3>
                        <p class="category-description">Revitalize your hair with our specialized formulas</p>
                        <a href="pages/products.php?category=haircare" class="btn btn-outline-primary btn-sm rounded-pill">Explore</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="category-card">
                    <div class="category-image">
                        <img src="assets/images/category-cosmetics.jpg" alt="Cosmetics" class="img-fluid">
                    </div>
                    <div class="category-content text-center">
                        <h3 class="category-title">Cosmetics</h3>
                        <p class="category-description">Enhance your beauty with our makeup collection</p>
                        <a href="pages/products.php?category=cosmetics" class="btn btn-outline-primary btn-sm rounded-pill">Explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Our most popular products loved by customers</p>
        </div>
        
        <div class="row">
            <?php
            // In a real application, you would fetch products from the database
            // This is just a placeholder for demonstration
            $featuredProducts = [
                [
                    'id' => 'product-1',
                    'name' => 'Glow Boost Serum',
                    'price' => 345000,
                    'image' => 'assets/images/product-1.jpg',
                    'rating' => 4.5,
                    'category' => 'skincare'
                ],
                [
                    'id' => 'product-2',
                    'name' => 'Hydrating Face Mask',
                    'price' => 85000,
                    'image' => 'assets/images/product-2.jpg',
                    'rating' => 4.2,
                    'category' => 'skincare'
                ],
                [
                    'id' => 'product-3',
                    'name' => 'Volumizing Shampoo',
                    'price' => 295000,
                    'image' => 'assets/images/product-3.jpg',
                    'rating' => 4.0,
                    'category' => 'haircare'
                ],
                [
                    'id' => 'product-4',
                    'name' => 'Matte Lipstick',
                    'price' => 550000,
                    'image' => 'assets/images/product-4.jpg',
                    'rating' => 4.7,
                    'category' => 'cosmetics'
                ]
            ];
            
            foreach ($featuredProducts as $product) :
            ?>
            <div class="col-sm-6 col-md-3 mb-4">
                <div class="product-card">
                    <div class="product-badge"><?php echo ucfirst($product['category']); ?></div>
                    <div class="product-image">
                        <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" class="img-fluid">
                        <div class="product-overlay">
                            <a href="pages/product-detail.php?id=<?php echo $product['id']; ?>" class="btn btn-sm btn-light">Quick View</a>
                        </div>
                    </div>
                    <div class="product-content">
                        <h4 class="product-title"><?php echo $product['name']; ?></h4>
                        <div class="product-price">Rp<?php echo number_format($product['price'], 2); ?></div>
                        <div class="product-rating">
                            <?php
                            $rating = $product['rating'];
                            $fullStars = floor($rating);
                            $halfStar = $rating - $fullStars >= 0.5;
                            
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $fullStars) {
                                    echo '<i class="fas fa-star"></i>';
                                } elseif ($i == $fullStars + 1 && $halfStar) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                            <span class="rating-count">(<?php echo $rating; ?>)</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100 mt-2 add-to-cart" data-product-id="<?php echo $product['id']; ?>">Add to Cart</button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <div class="text-center mt-4">
            <a href="pages/products.php" class="btn btn-outline-primary rounded-pill px-4">View All Products</a>
        </div>
    </div>
</section>

<!-- Subscription Banner -->
<section class="subscription-banner py-5">
    <div class="container">
        <div class="subscription-card">
            <div class="row align-items-center">
                <div class="col-md-8 mb-4 mb-md-0">
                    <h2 class="subscription-title">Subscribe & Save</h2>
                    <p class="subscription-text">Join our beauty subscription and get exclusive discounts on all your favorite SlayLab products delivered right to your door.</p>
                    <div class="discount-badge">15% OFF <span class="small">on subscription orders</span></div>
                </div>
                <div class="col-md-4 text-center">
                    <a href="pages/subscription.php" class="btn btn-primary btn-lg rounded-pill">Subscribe Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Customer Transformations</h2>
            <p class="section-subtitle">See the amazing results our customers have achieved</p>
        </div>
        
        <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="testimonial-card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="before-after-container">
                                <div class="row">
<div class="col-6 text-center">
        <p class="before-after-label">Before</p>
        <img src="assets/images/testimonial-before-1.jpg" alt="Before using SlayLab products" class="img-fluid w-75 rounded">
    </div>
    <div class="col-6 text-center">
        <p class="before-after-label">After</p>
        <img src="assets/images/testimonial-after-1.jpg" alt="After using SlayLab products" class="img-fluid w-75 rounded">
    </div>
</div>

                                </div>
                                <div class="testimonial-content mt-4">
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <blockquote class="testimonial-quote">
                                        "Saya sudah menggunakan foundation dari SlayLab selama 3 bulan, dan hasilnya luar biasa! Kulit saya terlihat lebih halus, pori-pori tersamarkan, dan daya tahannya sangat bagus seharian"
                                    </blockquote>
                                    <p class="testimonial-author">- Sarah J.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="carousel-item">
                    <div class="testimonial-card">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="before-after-container">
                                    <div class="row">
                                        <div class="col-6">
                                            <p class="before-after-label">Before</p>
                                            <img src="assets/images/testimonial-before-2.jpg" alt="Before using SlayLab products" class="img-fluid rounded">
                                        </div>
                                        <div class="col-6">
                                            <p class="before-after-label">After</p>
                                            <img src="assets/images/testimonial-after-2.jpg" alt="After using SlayLab products" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                                <div class="testimonial-content mt-4">
                                    <div class="testimonial-rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <blockquote class="testimonial-quote">
                                        "The Hydrating Mask is a game-changer! My dry skin is now consistently moisturized and glowing. I get compliments everywhere I go!"
                                    </blockquote>
                                    <p class="testimonial-author">- Michelle T.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
        </div>
        
        <div class="text-center mt-5">
            <div class="join-badge">Join thousands of satisfied customers!</div>
        </div>
    </div>
</section>