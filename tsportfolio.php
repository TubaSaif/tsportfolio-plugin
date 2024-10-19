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
    
    // Base directory for class files (assuming 'includes' is your main directory for classes)
    $base_dir = __DIR__ . '/includes/';

    // Check if the class belongs to the plugin's namespace
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // If it doesn't use the plugin namespace, skip
        return;
    }

    // Get the relative class name (strip the namespace prefix)
    $relative_class = substr($class, $len);

    // Convert namespace separators to directory separators
    // Keeping the file names case-sensitive but class names lowercased
    $relative_class = str_replace('\\', '/', strtolower($relative_class));

    // Construct the file path for class files
    // For 'includes' directory
    $file = $base_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';

    // Check if the class exists in the 'includes' directory
    if (file_exists($file)) {
        require_once $file;
        return;
    }

    // Check if the class exists in the 'admin' subdirectory inside 'includes'
    $admin_dir = $base_dir . 'admin/';
    $admin_file = $admin_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
    if (file_exists($admin_file)) {
        require_once $admin_file;
        return;
    }

    // Check if the class exists in the 'frontend' subdirectory inside 'includes'
    $frontend_dir = $base_dir . 'frontend/';
    $frontend_file = $frontend_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
    if (file_exists($frontend_file)) {
        require_once $frontend_file;
        return;
    }

    // Check if the class exists in the 'metabox' subdirectory inside 'admin'
    $metabox_dir = $admin_dir . 'metabox/';
    $metabox_file = $metabox_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
    if (file_exists($metabox_file)) {
        require_once $metabox_file;
        return;
    }

    // Check if the class exists in the 'settings' subdirectory inside 'admin'
    $settings_dir = $admin_dir . 'settings/';
    $settings_file = $settings_dir . 'class-' . str_replace('_', '-', $relative_class) . '.php';
    if (file_exists($settings_file)) {
        require_once $settings_file;
        return;
    }

    // If the file wasn't found in any directory, do nothing (class will not be autoloaded)
});




// Initialize Main Plugin Class
use TSPortfolio\Main_Plugin;
Main_Plugin::get_instance();
