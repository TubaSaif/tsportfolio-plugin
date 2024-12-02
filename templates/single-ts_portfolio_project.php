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
// Next and Previous post links with title and featured image
echo '<div class="single-post-pagination project-container">';

// Get previous and next posts
$prev_post = get_previous_post();
$next_post = get_next_post();

if (!empty($prev_post)) {
    $prev_post_image = get_the_post_thumbnail($prev_post->ID, 'thumbnail'); // Get previous post thumbnail
    $prev_post_title = wp_trim_words(get_the_title($prev_post->ID), 2,'...'); // Trim title to 3 words

    echo '<div class="post-nav prev-post">';
    echo '<a href="' . get_permalink($prev_post->ID) . '" class="post-link">';
    echo '<div class="item-content">';
    echo '<div class="half-item-content prev">';
    echo '<div class="item-label">← Previuos Project</div>';
    echo '<div class="item-title">' . esc_html($prev_post_title) . '</div>';
    echo '</div>';
    echo '<div class="mobile-arrow">←</div>';
    echo '<span class="post-image">' . $prev_post_image . '</span>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
}

if (!empty($next_post)) {
    $next_post_image = get_the_post_thumbnail($next_post->ID, 'thumbnail'); // Get next post thumbnail
    $next_post_title = wp_trim_words(get_the_title($next_post->ID),2,'...'); // Trim title to 3 words

    echo '<div class="post-nav next-post">';
    echo '<a href="' . get_permalink($next_post->ID) . '" class="post-link">';
    echo '<div class="item-content">';
    echo '<div class="half-item-content next">';
    echo '<div class="item-label">Next Project →</div>';
    echo '<div class="item-title">' . esc_html($next_post_title) . '</div>';
    echo '</div>';
    echo '<div class="mobile-arrow">→</div>';
    echo '<span class="post-image">' . $next_post_image . '</span>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
}


echo '</div>'; // End pagination div

get_footer(); // Include the footer
?>
