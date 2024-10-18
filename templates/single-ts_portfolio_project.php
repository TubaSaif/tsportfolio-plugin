<?php
/**
 * Template for displaying individual portfolio projects
 */

get_header(); // Include the header

// Start the Loop
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
     <!-- Embed Elementor Section (replace 123 with your Elementor Page ID) -->
     <div class="elementor-section">
            <?php echo \Elementor\Plugin::instance()->frontend->get_builder_content( 165); ?>
        </div>
        <div class="project-container">
            <h1><?php the_title(); ?></h1>
            <div class="project-content">
                <?php the_content(); // Display the main content of the project ?>
            </div>
            
            <div class="project-meta">
                <h2><?php _e('Project Detafsdils', 'ts-portfolio'); ?></h2>

                <?php
                // Retrieve custom meta data
                $technologies = get_post_meta(get_the_ID(), '_ts_portfolio_technologies', true);
                $associated_with = get_post_meta(get_the_ID(), '_ts_portfolio_associated_with', true);
                $main_image = get_post_meta(get_the_ID(), '_ts_portfolio_main_image', true);
                $sub_images = get_post_meta(get_the_ID(), '_ts_portfolio_sub_images', true);

                // Display technologies
                if ($technologies) {
                    echo '<p><strong>' . __('Technologies Used:', 'ts-portfolio') . '</strong> ' . esc_html($technologies) . '</p>';
                }

                // Display associated with
                if ($associated_with) {
                    echo '<p><strong>' . __('Associated With:', 'ts-portfolio') . '</strong> ' . esc_html($associated_with) . '</p>';
                }

                // Display main image
                if ($main_image) {
                    echo '<div class="project-main-image">';
                    echo '<img src="' . esc_url($main_image) . '" alt="' . esc_attr(get_the_title()) . '" />';
                    echo '</div>';
                }

                // Display sub-images
                if ($sub_images) {
                    $sub_images_array = explode(',', $sub_images); // Convert comma-separated URLs to an array
                    if (!empty($sub_images_array)) {
                        echo '<h3>' . __('Sub Images:', 'ts-portfolio') . '</h3>';
                        echo '<div class="project-sub-images">';
                        foreach ($sub_images_array as $sub_image) {
                            echo '<img src="' . esc_url(trim($sub_image)) . '" alt="' . esc_attr(get_the_title()) . '" />';
                        }
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    <?php endwhile;
else :
    echo '<p>' . __('No project found', 'ts-portfolio') . '</p>';
endif;

get_footer(); // Include the footer
?>
