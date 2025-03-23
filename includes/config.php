<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'slaylab_db');

// Site configuration
define('SITE_TITLE', 'SlayLab Beauty');
define('SITE_DESCRIPTION', 'Premium Cosmetics & Skincare Products');

// Start session
session_start();

// Error reporting (disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
require_once 'classes/Database.php';

// Include utility functions
require_once 'utils/helpers.php';
?>