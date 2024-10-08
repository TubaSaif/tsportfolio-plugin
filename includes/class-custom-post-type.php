<?php
namespace TSPortfolio;

class Custom_Post_Type {
    public function __construct() {
        // Register custom post type
        add_action('init', [$this, 'register_custom_post_type']);
        
        // Add custom meta boxes for additional fields
        add_action('add_meta_boxes', [$this, 'add_project_meta_boxes']);
        
        // Save custom meta box data
        add_action('save_post', [$this, 'save_project_meta']);
    }

    // Register the custom post type
    public function register_custom_post_type() {
        register_post_type('ts_portfolio_project', [
            'labels' => [
                'name' => __('Projects', 'ts-portfolio'),
                'singular_name' => __('Project', 'ts-portfolio')
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => ['title', 'editor', 'thumbnail'],
            'show_in_rest' => true, // For Gutenberg support
        ]);
    }

    // Add custom meta boxes for project details
    public function add_project_meta_boxes() {
        add_meta_box(
            'ts_portfolio_project_details', 
            __('Project Details', 'ts-portfolio'),
            [$this, 'render_project_meta_box'], 
            'ts_portfolio_project', 
            'normal', 
            'high'
        );
    }

    // Render the meta box content
    public function render_project_meta_box($post) {
        // Add nonce for security
        wp_nonce_field('ts_portfolio_save_meta', 'ts_portfolio_meta_nonce');
        
        // Get existing data (if any)
        $technologies = get_post_meta($post->ID, '_ts_portfolio_technologies', true);
        $associated_with = get_post_meta($post->ID, '_ts_portfolio_associated_with', true);
        $main_image = get_post_meta($post->ID, '_ts_portfolio_main_image', true);
        $sub_images = get_post_meta($post->ID, '_ts_portfolio_sub_images', true);

        // Project Technologies
        echo '<label for="ts_portfolio_technologies">' . __('Technologies Used', 'ts-portfolio') . '</label>';
        echo '<input type="text" id="ts_portfolio_technologies" name="ts_portfolio_technologies" value="' . esc_attr($technologies) . '" class="widefat" />';
        
        // Associated With (company, team, etc.)
        echo '<label for="ts_portfolio_associated_with">' . __('Associated With', 'ts-portfolio') . '</label>';
        echo '<input type="text" id="ts_portfolio_associated_with" name="ts_portfolio_associated_with" value="' . esc_attr($associated_with) . '" class="widefat" />';

        // Main Image (URL)
        echo '<label for="ts_portfolio_main_image">' . __('Main Project Image URL', 'ts-portfolio') . '</label>';
        echo '<input type="text" id="ts_portfolio_main_image" name="ts_portfolio_main_image" value="' . esc_attr($main_image) . '" class="widefat" />';
        
        // Sub Images (Comma-separated URLs)
        echo '<label for="ts_portfolio_sub_images">' . __('Sub Images (comma-separated URLs)', 'ts-portfolio') . '</label>';
        echo '<textarea id="ts_portfolio_sub_images" name="ts_portfolio_sub_images" class="widefat">' . esc_textarea($sub_images) . '</textarea>';
    }

    // Save the custom meta box data
    public function save_project_meta($post_id) {
        // Verify nonce for security
        if (!isset($_POST['ts_portfolio_meta_nonce']) || !wp_verify_nonce($_POST['ts_portfolio_meta_nonce'], 'ts_portfolio_save_meta')) {
            return $post_id;
        }

        // Check if not autosaving
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Check if user has permission to edit post
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        // Sanitize and save the technologies used
        if (isset($_POST['ts_portfolio_technologies'])) {
            update_post_meta($post_id, '_ts_portfolio_technologies', sanitize_text_field($_POST['ts_portfolio_technologies']));
        }

        // Sanitize and save the associated with field
        if (isset($_POST['ts_portfolio_associated_with'])) {
            update_post_meta($post_id, '_ts_portfolio_associated_with', sanitize_text_field($_POST['ts_portfolio_associated_with']));
        }

        // Save the main image URL
        if (isset($_POST['ts_portfolio_main_image'])) {
            update_post_meta($post_id, '_ts_portfolio_main_image', esc_url($_POST['ts_portfolio_main_image']));
        }

        // Save the sub-images (array or comma-separated URLs)
        if (isset($_POST['ts_portfolio_sub_images'])) {
            update_post_meta($post_id, '_ts_portfolio_sub_images', sanitize_textarea_field($_POST['ts_portfolio_sub_images']));
        }
    }
}
