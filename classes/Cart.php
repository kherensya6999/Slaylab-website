<?php
class Cart {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    // Add item to cart
    public function addToCart($userId, $productId, $quantity = 1) {
        // Check if product already in cart
        $this->db->query('SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);
        $existingItem = $this->db->single();
        
        if ($existingItem) {
            // Update quantity
            $newQuantity = $existingItem['quantity'] + $quantity;
            $this->db->query('UPDATE cart SET quantity = :quantity WHERE id = :id');
            $this->db->bind(':quantity', $newQuantity);
            $this->db->bind(':id', $existingItem['id']);
            return $this->db->execute();
        } else {
            // Add new item
            $this->db->query('INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)');
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':product_id', $productId);
            $this->db->bind(':quantity', $quantity);
            return $this->db->execute();
        }
    }
    
    // Update cart item quantity
    public function updateCartItem($cartId, $quantity) {
        $this->db->query('UPDATE cart SET quantity = :quantity WHERE id = :id');
        $this->db->bind(':quantity', $quantity);
        $this->db->bind(':id', $cartId);
        return $this->db->execute();
    }
    
    // Remove item from cart
    public function removeFromCart($cartId) {
        $this->db->query('DELETE FROM cart WHERE id = :id');
        $this->db->bind(':id', $cartId);
        return $this->db->execute();
    }
    
    // Get user's cart
    public function getCart($userId) {
        $this->db->query('SELECT c.id, c.product_id, c.quantity, p.name, p.price, p.sale_price, p.image 
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }
    
    // Get cart total
    public function getCartTotal($userId) {
        $this->db->query('SELECT SUM(CASE WHEN p.sale_price > 0 THEN p.sale_price * c.quantity ELSE p.price * c.quantity END) as total 
                         FROM cart c 
                         JOIN products p ON c.product_id = p.id 
                         WHERE c.user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $result = $this->db->single();
        return $result['total'] ?? 0;
    }
    
    // Get cart count
    public function getCartCount($userId) {
        $this->db->query('SELECT SUM(quantity) as count FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        $result = $this->db->single();
        return $result['count'] ?? 0;
    }
    
    // Clear cart
    public function clearCart($userId) {
        $this->db->query('DELETE FROM cart WHERE user_id = :user_id');
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
    
    // Create order from cart
    public function createOrder($userId, $shippingAddress, $paymentMethod) {
        try {
            // Start transaction
            $this->db->beginTransaction();
            
            // Create order
            $this->db->query('INSERT INTO orders (user_id, total, shipping_address, payment_method, status) VALUES (:user_id, :total, :shipping_address, :payment_method, "pending")');
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':total', $this->getCartTotal($userId));
            $this->db->bind(':shipping_address', json_encode($shippingAddress));
            $this->db->bind(':payment_method', $paymentMethod);
            $this->db->execute();
            
            $orderId = $this->db->lastInsertId();
            
            // Get cart items
            $cartItems = $this->getCart($userId);
            
            // Add order items
            foreach ($cartItems as $item) {
                $this->db->query('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)');
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['product_id']);
                $this->db->bind(':quantity', $item['quantity']);
                $this->db->bind(':price', ($item['sale_price'] > 0) ? $item['sale_price'] : $item['price']);
                $this->db->execute();
            }
            
            // Clear cart
            $this->clearCart($userId);
            
            // Commit transaction
            $this->db->endTransaction();
            
            return $orderId;
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->db->cancelTransaction();
            return false;
        }
    }
}