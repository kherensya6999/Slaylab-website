<?php
/**
 * Helper functions for the SlayLab Beauty E-Commerce website
 */

/**
 * Format price with currency symbol
 *
 * @param float $price The price to format
 * @param string $currency The currency symbol (default: $)
 * @return string Formatted price with currency symbol
 */
function formatPrice($price, $currency = '$') {
    return $currency . number_format($price, 2);
}

/**
 * Calculate discount percentage
 *
 * @param float $originalPrice The original price
 * @param float $salePrice The sale price
 * @return int The discount percentage
 */
function calculateDiscount($originalPrice, $salePrice) {
    if ($originalPrice <= 0 || $salePrice <= 0 || $salePrice >= $originalPrice) {
        return 0;
    }
    
    return round(($originalPrice - $salePrice) / $originalPrice * 100);
}

/**
 * Truncate text to a specified length
 *
 * @param string $text The text to truncate
 * @param int $length The maximum length
 * @param string $append Text to append if truncated (default: ...)
 * @return string Truncated text
 */
function truncateText($text, $length = 100, $append = '...') {
    if (strlen($text) <= $length) {
        return $text;
    }
    
    $text = substr($text, 0, $length);
    $text = substr($text, 0, strrpos($text, ' '));
    
    return $text . $append;
}

/**
 * Generate star rating HTML
 *
 * @param float $rating The rating value (0-5)
 * @return string HTML for star rating
 */
function generateStarRating($rating) {
    $fullStars = floor($rating);
    $halfStar = $rating - $fullStars >= 0.5;
    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
    
    $html = '';
    
    // Full stars
    for ($i = 0; $i < $fullStars; $i++) {
        $html .= '<i class="fas fa-star"></i>';
    }
    
    // Half star
    if ($halfStar) {
        $html .= '<i class="fas fa-star-half-alt"></i>';
    }
    
    // Empty stars
    for ($i = 0; $i < $emptyStars; $i++) {
        $html .= '<i class="far fa-star"></i>';
    }
    
    return $html;
}

/**
 * Check if user is logged in
 *
 * @return bool True if user is logged in, false otherwise
 */
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirect to a specified page
 *
 * @param string $page The page to redirect to
 * @return void
 */
function redirect($page) {
    header('Location: ' . $page);
    exit;
}

/**
 * Generate a random token
 *
 * @param int $length The length of the token
 * @return string Random token
 */
function generateToken($length = 32) {
    return bin2hex(random_bytes($length / 2));
}

/**
 * Sanitize input data
 *
 * @param string $data The data to sanitize
 * @return string Sanitized data
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * Flash message helper
 *
 * @param string $name The name of the message
 * @param string $message The message text
 * @param string $class The CSS class for the message
 * @return void
 */
function flash($name = '', $message = '', $class = 'alert alert-success') {
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name . '_class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : $class;
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . '_class']);
        }
    }
}

/**
 * Get current page URL
 *
 * @return string Current page URL
 */
function getCurrentUrl() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Format date
 *
 * @param string $date The date to format
 * @param string $format The format (default: F j, Y)
 * @return string Formatted date
 */
function formatDate($date, $format = 'F j, Y') {
    return date($format, strtotime($date));
}

/**
 * Get file extension
 *
 * @param string $filename The filename
 * @return string File extension
 */
function getFileExtension($filename) {
    return pathinfo($filename, PATHINFO_EXTENSION);
}

/**
 * Generate slug from string
 *
 * @param string $string The string to convert to slug
 * @return string Slug
 */
function generateSlug($string) {
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string);
    $string = strtolower($string);
    $string = str_replace(' ', '-', $string);
    return $string;
}