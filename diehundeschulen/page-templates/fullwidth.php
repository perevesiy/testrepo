<?php
/**
 * Template Name: Volle Breite, ohne Sidebar
 */

add_filter('body_class','dh_add_css_class_fullwidth');
function dh_add_css_class_fullwidth($classes) {
    $classes[] = 'fullwidth';
    return $classes;
}
?>
<? get_header(); ?>
    <div class="breadcrumb"><?php get_breadcrumb() ?></div>
    <section class="primary" role="main">
        <? while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
            <? comments_template( '', true ); ?>
        <? endwhile; ?>
    </section>
<? get_footer(); ?>