<?php



     function format_date($date) {
        // Helper to format dates
        return date('F j, Y', strtotime($date));
    }

