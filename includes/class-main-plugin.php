<?php
namespace TSPortfolio;

use TSPortfolio\Custom_Post_Type;
use TSPortfolio\Shortcode_Render;
use TSPortfolio\Metabox;
use TSPortfolio\Enqueue;

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
        new Shortcode_Render();
        new Metabox();
        new Enqueue();

    }

    private function register_hooks() {
        // Hook for initializing the plugin's functionality
        add_action('init', [$this, 'init_plugin']);

        // Add the template_include filter
        add_filter('template_include', [$this, 'custom_template']);

        
        function ts_portfolio_enqueue_admin_scripts() {
            wp_enqueue_media(); // Enqueue media uploader scripts
            wp_enqueue_script('ts-portfolio-metabox', plugin_dir_url(__FILE__) . 'assest/js/admin/metabox.js', ['jquery'], '1.0', true);
        add_action('admin_enqueue_scripts', 'ts_portfolio_enqueue_admin_scripts');
}

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
