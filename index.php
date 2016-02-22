<?php 
  use Roots\Sage\Extras;

  require_once('vendor/autoload.php'); 
  $compiler = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(get_template_directory() . '/templates')
  ));
?>

<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php 
    $post_data = Extras\get_post_data(get_post(get_the_ID()));
    echo $compiler->render('content', $post_data); 
  ?>
<?php endwhile; ?>

<?php the_posts_navigation(); ?>
