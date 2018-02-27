<?php

/**
* Trigger this file on Plugin uninstall
*/
// Security check that won't trigger this, if accessed from outside Wordpress
if (!defined('WP_UNINSTALL_PLUGIN')) {
  die;
}

// Clear database stored data
// get all posts from DB with post_type 'update'
// $updatePosts = get_posts( array('post_type' => 'update', 'numberposts' => -1));
//
// foreach ($updatePosts as $post)
// {
//   wp_delete_post($post->ID, true);
// }

// Access the database via SQLite3
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'update'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)" );
