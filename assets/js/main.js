// Main JavaScript file for SlayLab Beauty E-Commerce

document.addEventListener("DOMContentLoaded", function () {
  // Initialize tooltips
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]'),
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Add to cart functionality
  const addToCartButtons = document.querySelectorAll(".add-to-cart");
  addToCartButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();
      const productId = this.getAttribute("data-product-id");
      addToCart(productId);
    });
  });

  // Function to add product to cart
  function addToCart(productId) {
    // In a real application, this would make an AJAX request to add the product to the cart
    console.log(`Adding product ${productId} to cart`);

    // Show success message
    const toast = document.createElement("div");
    toast.className = "toast-notification";
    toast.innerHTML = `
            <div class="toast-content">
                <i class="fas fa-check-circle toast-icon"></i>
                <div class="toast-message">Product added to cart!</div>
            </div>
        `;
    document.body.appendChild(toast);

    // Show the toast
    setTimeout(() => {
      toast.classList.add("show");
    }, 100);

    // Hide and remove the toast after 3 seconds
    setTimeout(() => {
      toast.classList.remove("show");
      setTimeout(() => {
        document.body.removeChild(toast);
      }, 300);
    }, 3000);

    // Update cart count
    updateCartCount();
  }

  // Function to update cart count
  function updateCartCount() {
    const cartCountElement = document.querySelector(".cart-count");
    if (cartCountElement) {
      // In a real application, this would get the actual cart count from the server
      // For demo purposes, we'll just increment the current count
      let currentCount = parseInt(cartCountElement.textContent);
      cartCountElement.textContent = currentCount + 1;
    }
  }

  // Add CSS for toast notifications
  const style = document.createElement("style");
  style.textContent = `
        .toast-notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: white;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 15px;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        
        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        .toast-content {
            display: flex;
            align-items: center;
        }
        
        .toast-icon {
            color: #4CAF50;
            font-size: 20px;
            margin-right: 10px;
        }
        
        .toast-message {
            font-size: 14px;
            color: #333;
        }
    `;
  document.head.appendChild(style);
});
