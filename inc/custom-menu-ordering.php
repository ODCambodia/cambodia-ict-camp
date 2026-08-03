<?php
// Enanable custom menu ordering
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'custom_wp_dashboard_menu_order' );

// Define the custom order including Custom Post Type (CPT)
function custom_wp_dashboard_menu_order($menu_order) {
    $new_order = [
        'index.php',                        // Dashboard
        'edit.php',                         // Posts
        'upload.php',                       // Media
        'edit.php?post_type=page',          // Pages

        'separator1',                       // Separator
        'edit.php?post_type=news',          // News
        'edit.php?post_type=announcements', // Announcements
        'edit.php?post_type=agenda-session',// Agenda session
        'edit.php?post_type=presentations', // Slide presentations
        'edit.php?post_type=camp-themes',   // Camp Themes

        'edit.php?post_type=donors',        // Donors
        'edit.php?post_type=facilitators',  // Facilitators
        'edit.php?post_type=organizers',    // Organizers
        'edit.php?post_type=partners',      // Partners
        'edit.php?post_type=speakers',      // Speakers

        'separator2',                       // Separator
        'edit-comments.php',                // Comments
        'themes.php',                       // Appearance
        'plugins.php',                      // Plugins
        'users.php',                        // Users
        'tools.php',                        // Tools
        'options-general.php',              // Settings
    ];

    return $new_order;
}