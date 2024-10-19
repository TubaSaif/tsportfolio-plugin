<?php
namespace TSPortfolio;

class Enqueue {
    public function __construct() {
        // Enqueue styles and scripts for frontend and admin
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_frontend_assets'] );
        add_action( 'admin_enqueue_scripts', [$this, 'enqueue_admin_assets'] );
    }

    // Enqueue frontend styles and scripts
    public function enqueue_frontend_assets() {
       // wp_enqueue_style( 'tsportfolio-frontend-css', plugin_dir_url( __FILE__ ) . '../assest/css/frontend/style.css', array(), '1.0.0', 'all' );
       // wp_enqueue_script( 'tsportfolio-frontend-js', plugin_dir_url( __FILE__ ) . '../assest/js/frontend/frontend.js', array('jquery'), '1.0.0', true );
    }

    // Enqueue admin styles and scripts
    public function enqueue_admin_assets() {
       // wp_enqueue_style( 'tsportfolio-admin-css', plugin_dir_url( __FILE__ ) . '../assest/css/admin/admin.css', array(), '1.0.0', 'all' );
        
        // Enqueue the WordPress media library for uploading images
        wp_enqueue_media();

        // Enqueue the custom JS for handling meta box functionality
        wp_enqueue_script( 'tsportfolio-metabox-js', plugin_dir_url( __FILE__ ) . '../assest/js/admin/tsportfolio-metabox.js', array('jquery'), '1.0.0', true );
    }
}

// Instantiate the class
new Enqueue();
