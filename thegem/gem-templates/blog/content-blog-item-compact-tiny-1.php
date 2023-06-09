<?php

$thegem_post_data = thegem_get_sanitize_page_title_data(get_the_ID());

$item_colors = isset($params['item_colors']) ? $params['item_colors'] : array();

$thegem_classes = array();

if (is_sticky() && !is_paged()) {
	$thegem_classes = array_merge($thegem_classes, array('sticky'));
}

if (!has_post_thumbnail() || $params['hide_featured']) {
	$thegem_classes[] = 'no-image';
}

if ($params['show_separator']) {
	$thegem_classes[] = 'with-separator';
}

if (empty($params['icon_on_hover'])) {
	$thegem_classes[] = 'without-hover-icon';
}

$thegem_classes[] = 'clearfix';

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($thegem_classes); ?>
		 style="<?php if (!empty($item_colors['border_color'])) {
			 echo 'border-color:' . $item_colors['border_color'] . ';';
		 } ?><?php if (isset($params['bottom_gap'])) {
			 echo 'margin-bottom:' . $params['bottom_gap'] . 'px;';
		 } ?><?php if (isset($params['bottom_gap']) && $params['show_separator']) {
			 echo 'padding-bottom:' . $params['bottom_gap'] . 'px;';
		 } ?>">
	<?php if (!$params['hide_featured']) { ?>
		<div class="gem-compact-tiny-left" <?php if (!empty($params['image_size'])) {
			echo 'style="width:' . $params['image_size'] . 'px"';
		} ?>>
			<div class="gem-compact-tiny-item-image" <?php if (isset($params['image_border_radius'])) {
				echo 'style="border-radius:' . $params['image_border_radius'] . 'px"';
			} ?>>
				<a class="default"
				   href="<?php echo esc_url(get_permalink()); ?>"><?php thegem_post_thumbnail('thegem-blog-compact', true, 'img-responsive'); ?></a>
				<?php if ($params['show_category']) {
					$categories = get_the_category();
					$separator = ', ';
					$output = '';
					if (!empty($categories)) {
						foreach ($categories as $category) {
							$output .= '<a href="' . esc_url(get_category_link($category->term_id)) . '" alt="' . esc_attr(sprintf(__('View all posts in %s', 'textdomain'), $category->name)) . '">' . esc_html($category->name) . '</a>' . $separator;
						}
						echo '<div class="categories">' . trim($output, $separator) . '</div>';
					}
				} ?>
			</div>
		</div>
	<?php } ?>
	<div class="gem-compact-tiny-right">
		<div class="gem-compact-item-content">
			<?php if ($params['show_title']) {
				$title_style = '';
				if (!empty($item_colors['post_title_color'])) {
					$title_style .= 'color: ' . esc_attr($item_colors['post_title_color']) . ';';
				}
				if (!empty($params['title_transform'])) {
					$title_style .= 'text-transform: ' . esc_attr($params['title_transform']) . ';';
				}
				$color_class = '';
				if ($params['title_preset1'] !== 'main-menu-item') {
					$color_class = 'reverse-link-color ';
				}
				$title = get_the_title();
				if ($params['truncate_title']) {
					$title = thegem_truncate_by_words($title, $params['title_size']);
				}
				echo('<div class="gem-news-item-title ' . esc_attr($params['title_preset1']) . '"><a class="' . $color_class . '" href="' . esc_url(get_permalink()) . '" rel="bookmark" style="' . $title_style . '"' . (!empty($item_colors['post_title_hover_color']) ? ' onmouseenter="jQuery(this).data(\'color\', this.style.color);this.style.color=\'' . esc_attr($item_colors['post_title_hover_color']) . '\';" onmouseleave="this.style.color=jQuery(this).data(\'color\');"' : '') . '>' . $title . '</a></div>');
			} ?>
			<?php if ($params['show_description']) { ?>
				<div class="post-text">
					<div class="summary <?php echo esc_attr($params['post_excerpt_preset']); ?>"<?php echo(!empty($item_colors['post_excerpt_color']) ? ' style="color: ' . esc_attr($item_colors['post_excerpt_color']) . '"' : ''); ?>>
						<?php if (!has_excerpt() && !empty($thegem_post_data['title_excerpt'])): ?>
							<?php $excerpt = $thegem_post_data['title_excerpt']; ?>
						<?php else: ?>
							<?php $excerpt = preg_replace('%&#x[a-fA-F0-9]+;%', '', apply_filters('the_excerpt', get_the_excerpt())); ?>
						<?php endif; ?>
						<?php if ($params['truncate_description']) {
							echo thegem_truncate_by_words($excerpt, $params['description_size']);
						} else {
							echo $excerpt;
						} ?>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="post-meta date-color"<?php echo(!empty($item_colors['date_color']) ? ' style="color: ' . esc_attr($item_colors['date_color']) . '"' : ''); ?>>
			<div class="entry-meta clearfix text-body-tiny">
				<div class="post-meta-left gem-news-item-date">
					<?php if (!$params['hide_date']) : ?><span
							class="post-meta-date"><?php echo get_the_date() ?></span><?php endif; ?>
					<?php if (!$params['hide_author']) : ?><span
							class="post-meta-author"><?php printf(esc_html__("by %s", "thegem"), get_the_author_link()) ?></span><?php endif; ?>
				</div>
				<div class="post-meta-right">
					<?php if (comments_open() && !$params['hide_comments']): ?>
						<span class="comments-link"><?php comments_popup_link(0, 1, '%'); ?></span>
					<?php endif; ?>
				</div>
			</div><!-- .entry-meta -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
