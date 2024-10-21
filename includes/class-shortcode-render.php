<?php
namespace TSPortfolio;

class Shortcode_Render {
    public function __construct() {
        add_shortcode('portfolio_projects', [$this, 'render']);
    }

    public function render() {
        // Query arguments for retrieving projects
        $args = array(
            'post_type'      => 'ts_portfolio_project', // Custom Post Type slug
            'posts_per_page' => 10,                     // Number of posts to display
        );
        
        $query = new \WP_Query($args);
        
        if ($query->have_posts()) {
            // Output the wrapper for the flex container
            echo '<div class="portfolio-projects-container">';

            while ($query->have_posts()) {
                $query->the_post();
                
                // Get the title, permalink, and featured image
                $post_title = get_the_title();
                $post_link = get_permalink();
                $post_excerpt = wp_trim_words(get_the_excerpt(), 8); // Trim the excerpt to 15 words
                $post_image = get_the_post_thumbnail_url(get_the_ID(), 'portfolio-thumbnail'); // Medium size image

                // Output the card for each project
                echo '<div class="portfolio-project-card">';
                
                if ($post_image) {
                    echo '<div class="portfolio-project-image">';
                    echo '<a href="' . esc_url($post_link) . '">';
                    echo '<img src="' . esc_url($post_image) . '" alt="' . esc_attr($post_title) . '">';
                    echo '</a>';
                    echo '</div>';
                }
                

                // Project Heading as a link
                echo '<div class="portfolio-project-heading">';
                echo '<h2><a href="' . esc_url($post_link) . '">' . esc_html($post_title) . '</a></h2>';
                echo '</div>'; // End content div

                echo '</div>'; // End card div
            }

            echo '</div>'; // End flex container
            
            wp_reset_postdata(); // Reset the global $post object
        } else {
            // No posts found
            echo '<p>No projects found.</p>';
        }
    }
}


