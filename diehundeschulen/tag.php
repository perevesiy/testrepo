
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
		
			<a href="<?php the_permalink() ?>" style="float:left;">
				<?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				  the_post_thumbnail();
				} 
				?>
			</a>
			<?php the_excerpt(); ?>
		</article>
	<? endwhile; ?>
	<?php get_contentNav(); ?>
	</section>
        <section class="secondary" role="complementary">
            <?php dynamic_sidebar( 'sidebar-category' ); ?>
            <? if (is_active_sidebar('sidebar-global-right')): ?>
                <?php dynamic_sidebar( 'sidebar-global-right' ); ?>
            <? endif ?>
        </section>
<?php get_footer(); ?>
