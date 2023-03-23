<?php
/**
 * Template Name: Schulen Kartenansicht
 */
?>
<? get_header(); ?>
    <div class="breadcrumb"><?php get_breadcrumb() ?></div>
    <section class="primary" role="main">
        <? while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
            <? comments_template( '', true ); ?>
        <? endwhile; ?>
    </section>
    <section class="secondary" role="complementary">
        <?php dynamic_sidebar( 'sidebar-school-overview-map' ); ?>
        <? if (is_active_sidebar('sidebar-global-right')): ?>
            <?php dynamic_sidebar( 'sidebar-global-right' ); ?>
        <? endif ?>
    </section>
<? get_footer(); ?>