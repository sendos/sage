<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// Add meta fields to the json responses.
// --------------------------------------

// Helper for setting up the callback
function setup_get_field() {
  global $post;
  $post = get_post($object->ID);
  setup_postdata($post);
}

// Add post->author_url
add_action( 'rest_api_init', function() {
  register_api_field('post', 'author_url',
    array(
      'get_callback' => 'get_post_author_url'
    )
  );
});
function get_post_author_url($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $url = get_author_posts_url(get_the_author_meta('ID'));
  return $url;
}

// Make post->author the author's name.
add_action( 'rest_api_init', function() {
  register_api_field('post', 'author',
    array(
      'get_callback' => 'get_post_author'
    )
  );
});
function get_post_author($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $author = get_the_author();
  return $author;
}

// Use a consistent date format for post->date.
add_action( 'rest_api_init', function() {
  register_api_field('post', 'date',
    array(
      'get_callback' => 'get_post_date'
    )
  );
});
function get_post_date($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $date = get_the_date();
  return $date;
}

// Add post->datetime
add_action( 'rest_api_init', function() {
  register_api_field('post', 'datetime',
    array(
      'get_callback' => 'get_post_datetime'
    )
  );
});
function get_post_datetime($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $datetime = get_post_time('c', true);
  return $datetime;
}

// Add post->classes
add_action( 'rest_api_init', function() {
  register_api_field('post', 'classes',
    array(
      'get_callback' => 'get_post_classes'
    )
  );
});
function get_post_classes($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $post_class = get_post_class();
  $post_class = join(' ', $post_class);
  return $post_class;
}

// Add post->json_url
add_action( 'rest_api_init', function() {
  register_api_field('post', 'json_url',
    array(
      'get_callback' => 'get_post_json_url'
    )
  );
});
function get_post_json_url($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $json_url = '/wp-json/wp/v2/posts/' . get_the_ID();
  return $json_url;
}

// Use leading slash syntax for post->link
add_action( 'rest_api_init', function() {
  register_api_field('post', 'link',
    array(
      'get_callback' => 'get_post_link'
    )
  );
});
function get_post_link($object, $field_name, $request) {
  setup_get_field($object, $field_name, $request);
  $link = str_replace(home_url(), '', get_the_permalink());
  return $link;
}
