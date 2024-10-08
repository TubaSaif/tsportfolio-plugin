<?php
namespace TSPortfolio;

class Shortcode_Render extends Frontend_RenderBase {
    public function __construct() {
        add_shortcode('ts_portfolio_projects', [$this, 'render']);
    }

    public function render() {
        // Logic to render the project list using a shortcode
        return '<div class="ts-portfolio">[Projects will appear here]</div>';
    }
}
