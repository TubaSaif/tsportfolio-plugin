<?php
$project_id = get_the_ID();
$project_data = get_post($project_id);

// Output project data
?>
<div class="project-details">
    <h1><?php echo esc_html($project_data->post_title); ?></h1>
    <div class="project-content">
        <?php echo apply_filters('the_content', $project_data->post_content); ?>
    </div>
</div>
