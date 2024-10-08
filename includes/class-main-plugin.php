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
    }

    public function init_plugin() {
        // Initialize plugin logic
    }
}
