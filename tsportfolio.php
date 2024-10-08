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
    // Plugin namespace prefix
    $prefix = 'TSPortfolio\\';
    $base_dir = __DIR__ . '/includes/';

    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If the class does not use the namespace prefix, return.
        return;
    }

    // Get the relative class name
    $relative_class = substr($class, $len);

    // Replace namespace separators with directory separators
    $relative_class = str_replace('\\', '/', strtolower($relative_class));
    
    // Generate the file path to check: directly in includes or in subdirectories
    $file = $base_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
    
    // Check if the file exists
    if (file_exists($file)) {
        require_once $file;
    } else {
        // Check in subdirectories
        $subdir_file = $base_dir . strtolower(dirname($relative_class)) . '/class-' . basename($relative_class) . '.php';
        if (file_exists($subdir_file)) {
            require_once $subdir_file;
        }
    }
});

// Initialize Main Plugin Class
use TSPortfolio\Main_Plugin;
Main_Plugin::get_instance();
