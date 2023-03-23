<?php
$title = get_the_title();
$check = stripos($title, ' in ');


if ($check !== false && strpos($title, 'Hundeschule') !== false && !isset($_GET['dont_redirect']) && $title != 'Hundeschulenübersicht' && $title != 'Hundeschule registrieren') {
    $title = str_replace('in', '', $title);
    $title = str_replace('Hundeschule', '', $title);
    $title = trim($title);

    get_template_part('category-hundeschule');
} else {

    $redirection = get_field('redirection');
    if (trim($redirection)) {
        header('Location: ' . do_shortcode($redirection));
        die();
    }

    get_header();
    ?>

    <div id="main-content" class="main-content">
    <?php
    while (have_posts()) : the_post();
        get_template_part('content', 'page');
    endwhile;
    ?>

    </div><!-- #main-content -->

    <?php
    get_footer();
}
