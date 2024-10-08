<?php
namespace TSPortfolio;

use TSPortfolio\Custom_Post_Type;
use TSPortfolio\Elementor_Render;
use TSPortfolio\Gutenberg_Render;
use TSPortfolio\Shortcode_Render;

class Main_Plugin {
    private static $instance;

    private function __construct() {
        // Initialize the plugin
        $this->load_dependencies();
        $this->register_hooks();
    }

    public static function get_instance() {
        if (null == self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function load_dependencies() {
        // Initialize all custom post types and frontend renders
        new Custom_Post_Type();
        new Elementor_Render();
        new Gutenberg_Render();
        new Shortcode_Render();
    }

    private function register_hooks() {
        // Hook for initializing the plugin's functionality
        add_action('init', [$this, 'init_plugin']);

        // Add the template_include filter
        add_filter('template_include', [$this, 'custom_template']);
    }

    public function init_plugin() {
        // Initialize plugin logic
    }

    public function custom_template($template) {
        // Check if we're viewing a single post of the custom post type 'ts_portfolio_project'
        if (is_singular('ts_portfolio_project')) {
            // Path to your custom template file
            $custom_template = plugin_dir_path(__FILE__) . '../templates/single-ts_portfolio_project.php'; // Adjust path if necessary
            
            // Check if the custom template file exists
            if (file_exists($custom_template)) {
                return $custom_template; // Use the custom template
            }
        }
        return $template; // Return the default template if not
    }
}
