<?php
/**
 * The default template for displaying content of category ubersicht-der-hundeschulen. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php get_header(); ?>
<div class="breadcrumb"><?php get_breadcrumb() ?></div>
<section class="primary" role="main">
<?php
global $wpdb;
$slug = 'ubersicht-der-hundeschulen';
$post = get_post($wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '$slug'"));
echo apply_filters( 'the_content', $post->post_content );
?>
</section>
<section class="secondary" role="complementary">
	<?php dynamic_sidebar( 'sidebar-school-overview' ); ?>
</section>
<?php get_footer(); ?>