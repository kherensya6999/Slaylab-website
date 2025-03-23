<header class="header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/slaylablogo.webp" alt="SlayLab Beauty" class="img-fluid" style="max-height: 60px;">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="skincareDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Skincare
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="skincareDropdown">
                            <li><a class="dropdown-item" href="pages/products.php?category=skincare&subcategory=cleansers">Cleansers</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=skincare&subcategory=serums">Serums</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=skincare&subcategory=moisturizers">Moisturizers</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=skincare&subcategory=masks">Masks</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=skincare">All Skincare</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="haircareDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Haircare
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="haircareDropdown">
                            <li><a class="dropdown-item" href="pages/products.php?category=haircare&subcategory=shampoos">Shampoos</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=haircare&subcategory=conditioners">Conditioners</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=haircare&subcategory=treatments">Treatments</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=haircare&subcategory=styling">Styling</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=haircare">All Haircare</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="cosmeticsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Cosmetics
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="cosmeticsDropdown">
                            <li><a class="dropdown-item" href="pages/products.php?category=cosmetics&subcategory=face">Face</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=cosmetics&subcategory=eyes">Eyes</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=cosmetics&subcategory=lips">Lips</a></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=cosmetics&subcategory=sets">Sets</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="pages/products.php?category=cosmetics">All Cosmetics</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pages/about.php">About</a>
                    </li>
                </ul>
                
                <div class="navbar-actions d-flex align-items-center">
                    <div class="search-icon me-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <div class="account-icon me-3">
                        <a href="pages/account.php">
                            <i class="fas fa-user"></i>
                        </a>
                    </div>
                    <div class="cart-icon position-relative">
                        <a href="pages/cart.php">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="cart-count">0</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="searchModalLabel">Search Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="pages/search-results.php" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="query" placeholder="Search for products..." aria-label="Search">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>