<?php
namespace TSPortfolio;

class Gutenberg_Render extends Frontend_RenderBase {
    public function __construct() {
        add_action('enqueue_block_assets', [$this, 'register_blocks']);
    }

    public function register_blocks() {
        // Gutenberg block registration logic
    }

    public function render() {
        // Logic to render Gutenberg blocks
    }
}
