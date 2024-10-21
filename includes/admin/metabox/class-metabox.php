<?php
namespace TSPortfolio;

class Metabox {
    public function __construct() {
        add_action('add_meta_boxes', [$this, 'add_meta_boxes']);
        add_action('save_post', [$this, 'save_metaboxes']);
    }

    // Add multiple meta boxes
    public function add_meta_boxes() {
        add_meta_box(
            'ts_portfolio_project_image',      // Unique ID
            'Project Image',                   // Box title
            [$this, 'image_metabox_callback'], // Content callback
            'ts_portfolio_project',            // Post type
            'normal',                          // Context
            'high'                             // Priority
        );

        add_meta_box(
            'ts_portfolio_technologies_used',  // Unique ID
            'Technologies Used',               // Box title
            [$this, 'technologies_metabox_callback'], // Content callback
            'ts_portfolio_project',            // Post type
            'normal',                          // Context
            'high'                             // Priority
        );

        add_meta_box(
            'ts_portfolio_associated_with',    // Unique ID
            'Associated With',                 // Box title
            [$this, 'associated_metabox_callback'], // Content callback
            'ts_portfolio_project',            // Post type
            'normal',                          // Context
            'high'                             // Priority
        );
    }

    // Image Meta Box HTML
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

    // Technologies Used Meta Box HTML
    public function technologies_metabox_callback( $post ) {
        wp_nonce_field('ts_portfolio_technologies_nonce', 'ts_portfolio_technologies_nonce_field');

        $technologies = get_post_meta( $post->ID, '_ts_portfolio_technologies_used', true );

        ?>
        <textarea name="ts_portfolio_technologies_used" rows="5" style="width:100%;"><?php echo esc_textarea( $technologies ); ?></textarea>
        <?php
    }

    // Associated With Meta Box HTML
    public function associated_metabox_callback( $post ) {
        wp_nonce_field('ts_portfolio_associated_nonce', 'ts_portfolio_associated_nonce_field');

        $associated_with = get_post_meta( $post->ID, '_ts_portfolio_associated_with', true );

        ?>
        <input type="text" name="ts_portfolio_associated_with" value="<?php echo esc_attr( $associated_with ); ?>" style="width:100%;" />
        <?php
    }

    // Save meta data for all metaboxes
    public function save_metaboxes( $post_id ) {
        // Verify the nonce fields and permissions for each metabox
        if ( ! isset( $_POST['ts_portfolio_project_image_nonce_field'] ) || ! wp_verify_nonce( $_POST['ts_portfolio_project_image_nonce_field'], 'ts_portfolio_project_image_nonce' ) ) {
            return;
        }
        if ( ! isset( $_POST['ts_portfolio_technologies_nonce_field'] ) || ! wp_verify_nonce( $_POST['ts_portfolio_technologies_nonce_field'], 'ts_portfolio_technologies_nonce' ) ) {
            return;
        }
        if ( ! isset( $_POST['ts_portfolio_associated_nonce_field'] ) || ! wp_verify_nonce( $_POST['ts_portfolio_associated_nonce_field'], 'ts_portfolio_associated_nonce' ) ) {
            return;
        }

        // Check autosave
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return;
        }

        // Save the image ID
        if ( isset( $_POST['ts_portfolio_project_image_id'] ) ) {
            update_post_meta( $post_id, '_ts_portfolio_project_image_id', sanitize_text_field( $_POST['ts_portfolio_project_image_id'] ) );
        }

        // Save technologies used
        if ( isset( $_POST['ts_portfolio_technologies_used'] ) ) {
            update_post_meta( $post_id, '_ts_portfolio_technologies_used', sanitize_textarea_field( $_POST['ts_portfolio_technologies_used'] ) );
        }

        // Save associated with
        if ( isset( $_POST['ts_portfolio_associated_with'] ) ) {
            update_post_meta( $post_id, '_ts_portfolio_associated_with', sanitize_text_field( $_POST['ts_portfolio_associated_with'] ) );
        }
    }
}
