<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<?php

/*
    <?php if ( is_search() ) : // Only display Excerpts for Search ?>
    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div><!-- .entry-summary -->
    <?php else : ?>
    <div class="entry-content">
        <?php the_content(); ?>
        <?php //the_content('Weiter lesen <span class="meta-nav">&rarr;</span>'); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-links">' . 'Seiten:', 'after' => '</div>' ) ); ?>
    </div><!-- .entry-content -->
    <?php endif; ?>
*/ 
?>

    <div class="breadcrumb"><?php get_breadcrumb() ?></div>
    <?php if (is_front_page()): ?>
        <?php while ( have_posts() ) : the_post(); ?>
            <?php the_content(); ?>
            <?php //get_template_part( 'content', 'page' ); ?>
            <?php comments_template( '', true ); ?>
        <?php endwhile; ?>
    <?php else: ?>
        <section class="primary" role="main">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php //get_template_part( 'content', 'page' );  ?>
                <?php comments_template( '', true ); ?>
            <?php endwhile; ?>
        </section>
        <section class="secondary" role="complementary">
            <?php if (is_schoolEntry()): ?>
                <?php dynamic_sidebar( 'sidebar-school-entry' ); ?>
            <?php endif ?>
            <?php if (is_active_sidebar('sidebar-global-right')): ?>
                <?php dynamic_sidebar( 'sidebar-global-right' ); ?>
            <?php endif ?>
        </section>
        <?php //get_sidebar(); ?>
    <?php endif; ?>