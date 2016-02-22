<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

// Prepare Post Data for templates.
function get_post_data($post_object) {
  global $post;
  $post = $post_object;
  setup_postdata($post);

  $post_class = get_post_class();
  $post_data = array(
    'author' => get_the_author(),
    'author_url' => get_author_posts_url(get_the_author_meta('ID')),
    'classes' => join(' ', $post_class),
    'content' => get_the_content(),
    'date' => get_the_date(),
    'datetime' => get_post_time('c', true),
    'excerpt' => get_the_excerpt(),
    'json_url' => '/wp-json/wp/v2/posts/' . get_the_ID(),
    'title' => get_the_title(),
    'link' => str_replace(home_url(), '', get_the_permalink())
  );
  return $post_data;
}
