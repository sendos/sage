<?php 
  use Roots\Sage\Extras;
  
  require_once('vendor/autoload.php'); 
  $compiler = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(get_template_directory() . '/templates')
  ));
?>

<?php while (have_posts()) : the_post(); ?>
  <?php 
    $post_data = Extras\get_post_data(get_post(get_the_ID()));
    echo $compiler->render('content-single', $post_data); 
  ?>
<?php endwhile; ?>
