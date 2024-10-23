<?php
/**
 * Template for displaying individual portfolio projects
 */

get_header(); // Include the header

// Start the Loop
if (have_posts()) :
    while (have_posts()) : the_post(); ?>
    <div class=main-container>  
            <div class="project-title">
                <h1 class="custom-title"><?php the_title(); ?></h1>
            </div>
            <div class="project-container">
                <div class="project-content">
                    <?php the_content(); // Display the main content of the project ?>
                </div>
            </div>
    </div>
    <?php endwhile;
else :
    echo '<p>' . __('No project found', 'ts-portfolio') . '</p>';
endif;

get_footer(); // Include the footer
?>
