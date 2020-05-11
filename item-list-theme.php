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

//$results = $wpdb->get_results( 'SELECT * FROM wp_posts' );
//1 var_dump($results[0]);
//Comment
?>

<main id="site-content" role="main">

	<?php
        get_template_part( 'template-parts/content', get_post_type() );
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    $(document).ready(function(){
        $("select").change(function(){
            $(this).find("option:selected").each(function(){
                var optionValue = $(this).attr("value");
                if(optionValue){
                    $(".box").not("." + optionValue).hide();
                    $("." + optionValue).show();
                } else{
                    $(".box").hide();
                }
            });
        }).change();
    });
    </script>
    
    <header class="archive-header has-text-align-center header-footer-group">
		<div class="archive-header-inner section-inner medium">
            <h1 class="archive-title">
            <?php
                global $wpdb;
                $item_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='asp-products' AND post_status='publish'" );
                echo "<p>商品数： {$item_count}</p>";
            ?>
            </h1>
            <div>
                <select>
                    <option>カテゴリー選択</option>
                    <option value="category-service" selected>サービス</option>
                    <option value="category-omiyage">お土産</option>
                </select>
            </div>
            <?php
                echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
                $item_ID = $wpdb->get_col( "SELECT ID FROM $wpdb->posts WHERE post_type='asp-products' AND post_status='publish'");
                //echo gettype($item_ID);
                //echo var_dump($item_ID); //配列の中身
                $items = $wpdb->get_col( "SELECT post_title FROM $wpdb->posts WHERE post_type='asp-products' AND post_status='publish'");
                $thumbnail = $wpdb->get_col( "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='asp_product_thumbnail'");
                $item_price = $wpdb->get_col( "SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='asp_product_price'");
                
                //$mypost = $wpdb->get_row( "SELECT * FROM $wpdb->posts WHERE ID = 1" );
                //echo $mypost->post_title;
                
                //$item_category = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE ID=$item_ID");
                //echo $item_category->meta_value;
                
                //×　$category = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE meta_value = 【マイサービス】イクメン実体験のメソッド公開、後悔のしない家族づくりへ");
                //×　echo $category;

                $x = 0;
                foreach ( $items as $item ) {
                    //echo 'ID: '.$item_ID[$x];
                    //$item_category = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE post_id=$item_ID[$x]");
                    $item_category = $wpdb->get_col("SELECT meta_value FROM $wpdb->postmeta WHERE post_id=$item_ID[$x] AND meta_key='asp_product_description'");
                    //echo '--'.$item_category[0];
                    if(strpos($item_category[0],'サービス') == true){
                        echo '<div class="category-service box">';
                        echo '<img src="'.$thumbnail[$x].'">';
                        echo '<a href="https://codecamp.o-namae.com/asp-products/'.$item.'">'.$item.'</a><br>';
                        echo '<p>価格： '.$item_price[$x].'円</p>';
                        echo '<small>カテゴリ: サービス</small>';
                        echo '</div>';
                    } elseif(strpos($item_category[0],'ワールド') == true){
                        echo '<div class="category-omiyage box">';
                        echo '<img src="'.$thumbnail[$x].'">';
                        echo '<a href="https://codecamp.o-namae.com/asp-products/'.$item.'">'.$item.'</a><br>';
                        echo '<p>価格： '.$item_price[$x].'円</p>';
                        echo '<small>カテゴリ: 世界</small>';
                        echo '</div>';
                    }
                    $x++;
                }
                
	        ?>
            <?php get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>
