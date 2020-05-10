<?php
/**
 * Template Name: item-list-stripe
 * Template Post Type: page

 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();

global $wpdb;
//$results = $wpdb->get_results( 'SELECT * FROM wp_posts' );
//1 var_dump($results[0]);
//Comment
?>

<main id="site-content" role="main">

	<?php
        get_template_part( 'template-parts/content', get_post_type() );
    ?>
    
    <header class="archive-header has-text-align-center header-footer-group">
		<div class="archive-header-inner section-inner medium">
            <h1 class="archive-title">
            <?php
                $item_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='asp-products' AND post_status='publish'" );
                echo "<p>商品数： {$item_count}</p>";
            ?>
            </h1>
            <?php
                echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
                $items = $wpdb->get_col( "SELECT post_title FROM $wpdb->posts WHERE post_type='asp-products' AND post_status='publish'");
                foreach ( $items as $item ) {
                  echo '<ul><li>';
                  echo '<a href="https://codecamp.o-namae.com/asp-products/'.$item.'">'.$item.'</a>';
                  echo '</li></ul>';
                }
                
	        ?>
            <?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
