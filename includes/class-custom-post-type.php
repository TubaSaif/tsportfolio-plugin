<?php
namespace TSPortfolio;

class Custom_Post_Type {
    public function __construct() {
        add_action('init', [$this, 'register_custom_post_type']);
    }

    public function register_custom_post_type() {
        register_post_type('ts_portfolio_project', [
            'labels' => [
                'name' => __('Projects', 'ts-portfolio'),
                'singular_name' => __('Project', 'ts-portfolio')
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true, // For Gutenberg
        ]);
    }
}
