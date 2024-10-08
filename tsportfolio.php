<?php
/**
 * Plugin Name: TS Portfolio
 * Description: A portfolio plugin for displaying projects using Elementor, Gutenberg, and Shortcodes.
 * Version: 1.0.0
 * Author: Tuba
 * Text Domain: ts-portfolio
 */

defined('ABSPATH') || exit;

// Autoloading classes
spl_autoload_register(function ($class) {
    // Define the plugin's namespace
    $prefix = 'TSPortfolio\\';
    // Base directory for class files
    $base_dir = __DIR__ . '/includes/';

    // Check if the class belongs to the plugin's namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If it doesn't use the plugin namespace, skip
        return;
    }

    // Get the relative class name (strip the namespace prefix)
    $relative_class = substr($class, $len);

    // Convert namespace separators to directory separators and lowercase the class
    $relative_class = str_replace('\\', '/', strtolower($relative_class));

    // Construct the file path for class files in the includes directory
    $file = $base_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';

    // Check if the file exists in the root includes directory
    if (file_exists($file)) {
        require_once $file;
    } else {
        // Check if the file exists in the frontend subdirectory
        $frontend_dir = $base_dir . 'frontend/';
        $frontend_file = $frontend_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
        if (file_exists($frontend_file)) {
            require_once $frontend_file;
        }
    }
});



// Initialize Main Plugin Class
use TSPortfolio\Main_Plugin;
Main_Plugin::get_instance();
