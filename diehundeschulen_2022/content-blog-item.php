<?php
$thegem_blog_style = isset($thegem_blog_style) ? $thegem_blog_style : 'default';

$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());
$thegem_post_elements = thegem_get_output_post_elements_data(get_the_ID());

$params = isset($params) ? $params : array(
    'hide_author' => 0,
    'hide_comments' => 0,
    'hide_date' => 0,
    'hide_likes' => 0,
    'hide_social_sharing' => 0,
);

if (is_archive() && $thegem_post_elements['blog_hide_date_in_blog_cat']) {
    $params['hide_date'] = 1;
}

$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

$thegem_categories = get_the_category();
$thegem_categories_list = array();
foreach ($thegem_categories as $thegem_category) {
    $thegem_categories_list[] = '<a href="' . esc_url(get_category_link($thegem_category->term_id)) . '" title="' . esc_attr(sprintf(__("View all posts in %s", "thegem"), $thegem_category->name)) . '">' . $thegem_category->cat_name . '</a>';
}

$thegem_classes = array();

if (is_sticky() && !is_paged()) {
    $thegem_classes = array_merge($thegem_classes, array('sticky', 'default-background'));
}

$thegem_featured_content = thegem_get_post_featured_content(get_the_ID());
if (empty($thegem_featured_content)) {
    $thegem_classes[] = 'no-image';
}

$thegem_classes[] = 'item-animations-not-inited';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?><?php echo (!empty($item_colors['background_color']) ? ' style="background-color: ' . esc_attr($item_colors['background_color']) . '"' : ''); ?>>
    <?php if (get_post_format() == 'quote' && $thegem_featured_content) : ?>
        <?php echo $thegem_featured_content; ?>
    <?php else : ?>
        <?php
        global $post;
        oneBlogPost($post);
        ?>
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
