<?php
namespace TSPortfolio;

class Metabox {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_image_metabox']);
        add_action('save_post', [$this, 'save_image']);
    }

    // Add the custom meta box
    public function add_image_metabox() {
        add_meta_box(
            'ts_portfolio_project_image',    // Unique ID
            'Project Image',                 // Box title
            [$this, 'image_metabox_callback'], // Content callback
            'ts_portfolio_project',          // Post type
            'normal',                          // Context (side, normal, etc.)
            'high'                        // Priority
        );
    }

    // Meta box content (HTML for the media uploader)
    public function image_metabox_callback( $post ) {
        wp_nonce_field('ts_portfolio_project_image_nonce', 'ts_portfolio_project_image_nonce_field');

        $image_id = get_post_meta( $post->ID, '_ts_portfolio_project_image_id', true );

        ?>
        <div class="ts-portfolio-image-wrapper">
            <?php if ( $image_id ) : ?>
                <img src="<?php echo esc_url( wp_get_attachment_url( $image_id ) ); ?>" style="max-width:100%;" />
            <?php endif; ?>
        </div>
        <input type="hidden" name="ts_portfolio_project_image_id" id="ts_portfolio_project_image_id" value="<?php echo esc_attr( $image_id ); ?>" />
        <button type="button" class="button ts-portfolio-upload-image"><?php _e('Upload Image', 'text-domain'); ?></button>
        <button type="button" class="button ts-portfolio-remove-image"><?php _e('Remove Image', 'text-domain'); ?></button>
        <?php
    }

    // Save the image meta data
    public function save_image( $post_id ) {
        if ( ! isset( $_POST['ts_portfolio_project_image_nonce_field'] ) || ! wp_verify_nonce( $_POST['ts_portfolio_project_image_nonce_field'], 'ts_portfolio_project_image_nonce' ) ) {
            return;
        }

        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return;
        }

        if ( isset( $_POST['ts_portfolio_project_image_id'] ) ) {
            update_post_meta( $post_id, '_ts_portfolio_project_image_id', sanitize_text_field( $_POST['ts_portfolio_project_image_id'] ) );
        }
    }
}


