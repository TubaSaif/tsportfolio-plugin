<?php
namespace TSPortfolio;

class Projects {
    public function get_project_data($post_id) {
        // Fetch the project data for a single post
        return get_post($post_id);
    }
}
