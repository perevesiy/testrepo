<?php
/*
  Template Name: Home Page
 */

get_header();
the_post();

$hero_title = get_field('hero_title');
$hero_text = get_field('hero_text');
$hero_background = get_field('hero_background');



$sa_banner_image = get_field('sa_banner_image');
$sa_banner_url = get_field('sa_banner_url');
$sa_title = get_field('sa_title');
$sa_slider = get_field('sa_slider');


$banners_below = get_field('banners_below');


?>

<?php
get_footer();
