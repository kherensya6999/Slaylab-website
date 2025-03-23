<?php
class Product {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    // Get all products
    public function getProducts($limit = null, $category = null) {
        $sql = 'SELECT * FROM products WHERE active = 1';
        
        if ($category) {
            $sql .= ' AND category = :category';
        }
        
        $sql .= ' ORDER BY created_at DESC';
        
        if ($limit) {
            $sql .= ' LIMIT :limit';
        }
        
        $this->db->query($sql);
        
        if ($category) {
            $this->db->bind(':category', $category);
        }
        
        if ($limit) {
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    // Get featured products
    public function getFeaturedProducts($limit = 8) {
        $this->db->query('SELECT * FROM products WHERE featured = 1 AND active = 1 ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    
    // Get single product
    public function getProductById($id) {
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    // Search products
    public function searchProducts($term) {
        $this->db->query('SELECT * FROM products WHERE (name LIKE :term OR description LIKE :term) AND active = 1 ORDER BY created_at DESC');
        $this->db->bind(':term', '%' . $term . '%');
        return $this->db->resultSet();
    }
    
    // Get products by category
    public function getProductsByCategory($category, $limit = null) {
        $sql = 'SELECT * FROM products WHERE category = :category AND active = 1 ORDER BY created_at DESC';
        
        if ($limit) {
            $sql .= ' LIMIT :limit';
        }
        
        $this->db->query($sql);
        $this->db->bind(':category', $category);
        
        if ($limit) {
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    // Get related products
    public function getRelatedProducts($productId, $category, $limit = 4) {
        $this->db->query('SELECT * FROM products WHERE id != :id AND category = :category AND active = 1 ORDER BY RAND() LIMIT :limit');
        $this->db->bind(':id', $productId);
        $this->db->bind(':category', $category);
        $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
    
    // Add product (admin function)
    public function addProduct($data) {
        $this->db->query('INSERT INTO products (name, description, price, sale_price, category, subcategory, image, featured, active, stock, sku) VALUES (:name, :description, :price, :sale_price, :category, :subcategory, :image, :featured, :active, :stock, :sku)');
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':subcategory', $data['subcategory']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':active', $data['active']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':sku', $data['sku']);
        
        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Update product (admin function)
    public function updateProduct($data) {
        $this->db->query('UPDATE products SET name = :name, description = :description, price = :price, sale_price = :sale_price, category = :category, subcategory = :subcategory, image = :image, featured = :featured, active = :active, stock = :stock, sku = :sku WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':subcategory', $data['subcategory']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':active', $data['active']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':sku', $data['sku']);
        
        // Execute
        return $this->db->execute();
    }
    
    // Delete product (admin function)
    public function deleteProduct($id) {
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}