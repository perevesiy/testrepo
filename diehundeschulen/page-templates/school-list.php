<?php
/**
 * Template Name: Schulen Listenansicht
 */
?>
<? get_header(); ?>
    <section class="primary" role="main">
        <? while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
            <? //get_template_part( 'content', 'page' );  ?>
            <? comments_template( '', true ); ?>
        <? endwhile; ?>
    </section>
    <section class="secondary" role="complementary">
        <?php dynamic_sidebar( 'sidebar-school-overview' ); ?>
        <? if (is_active_sidebar('sidebar-global-right')): ?>
            <?php dynamic_sidebar( 'sidebar-global-right' ); ?>
        <? endif ?>
    </section>
<? get_footer(); ?>