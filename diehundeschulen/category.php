
<?php get_header(); ?>
	<section class="primary post-list" role="main">
	<?php
	/*
	// For what??
	$args = array ( 'category' => ID, 'posts_per_page' => 5);
	$args = array ( 'category' => ID );
	$myposts = get_posts( $args );
	foreach( $myposts as $post ):
		setup_postdata($post);
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        <? the_content(); ?>
		</article>
	<?php endforeach; ?>
	*/ ?>
	<? while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        <? the_content(); ?>
		</article>
	<? endwhile; ?>
	<?php get_contentNav(); ?>
	</section>
        <section class="secondary" role="complementary">
            <?php dynamic_sidebar( 'sidebar-category' ); ?>            
        </section>
<?php get_footer(); ?>
