<?php
namespace TSPortfolio;

class Shortcode_Render {
    public function __construct() {
        add_shortcode('portfolio_projects', [$this, 'render']);
    }

    public function render() {
        // Logic to render the project list using a shortcode
        $args = array(
            'post_type'      => 'ts_portfolio_project', // Replace with your CPT slug
            'posts_per_page' => 10,                     // Number of posts to display
        );
        
        $query = new \WP_Query( $args );
        
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                
                // Make the title clickable and link to the single post
                $post_title = get_the_title();
                $post_link = get_permalink();

                echo '<h2><a href="' . esc_url( $post_link ) . '">' . esc_html( $post_title ) . '</a></h2>';
                
                // Output the content
                the_content();
            }
            wp_reset_postdata(); // Reset the global $post object
        } else {
            // No posts found
            echo 'No projects found.';
        }
    }
}

