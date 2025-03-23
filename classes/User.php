<?php
class User {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    // Register user
    public function register($data) {
        $this->db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
        
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        // Bind values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        
        // Execute
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }
    
    // Login user
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        if ($row) {
            $hashed_password = $row['password'];
            if (password_verify($password, $hashed_password)) {
                return $row;
            }
        }
        
        return false;
    }
    
    // Find user by email
    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();
        
        // Check if email exists
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    // Get user by ID
    public function getUserById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        
        return $this->db->single();
    }
    
    // Update user profile
    public function updateProfile($data) {
        $this->db->query('UPDATE users SET name = :name, email = :email, phone = :phone, address = :address, city = :city, state = :state, zip = :zip, country = :country WHERE id = :id');
        
        // Bind values
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':city', $data['city']);
        $this->db->bind(':state', $data['state']);
        $this->db->bind(':zip', $data['zip']);
        $this->db->bind(':country', $data['country']);
        
        // Execute
        return $this->db->execute();
    }
    
    // Change password
    public function changePassword($userId, $newPassword) {
        $this->db->query('UPDATE users SET password = :password WHERE id = :id');
        
        // Hash password
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Bind values
        $this->db->bind(':id', $userId);
        $this->db->bind(':password', $newPassword);
        
        // Execute
        return $this->db->execute();
    }
    
    // Reset password request
    public function createPasswordReset($email, $token) {
        // First, check if user exists
        $this->db->query('SELECT id FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $user = $this->db->single();
        
        if (!$user) {
            return false;
        }
        
        // Delete any existing reset tokens for this user
        $this->db->query('DELETE FROM password_resets WHERE email = :email');
        $this->db->bind(':email', $email);
        $this->db->execute();
        
        // Create new reset token
        $this->db->query('INSERT INTO password_resets (email, token, created_at) VALUES (:email, :token, NOW())');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        
        return $this->db->execute();
    }
    
    // Verify reset token
    public function verifyResetToken($email, $token) {
        $this->db->query('SELECT * FROM password_resets WHERE email = :email AND token = :token AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)');
        $this->db->bind(':email', $email);
        $this->db->bind(':token', $token);
        
        $row = $this->db->single();
        
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}