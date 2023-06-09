<?php
	$params = empty($params) ? array() : $params;
	$params = array_merge(array(
		'box_border_color' => '',
		'alignment' => 'left',
	), $params);
	$thegem_item_data = thegem_get_sanitize_qf_item_data(get_the_ID());

	$thegem_quickfinder_effect = 'quickfinder-item-effect-';
	if($thegem_item_data['icon_border_color'] && $thegem_item_data['icon_background_color']) {
		$thegem_quickfinder_effect .= 'border-reverse border-reverse-with-background';
	} elseif($thegem_item_data['icon_border_color']) {
		$thegem_quickfinder_effect .= 'border-reverse';
	} elseif($thegem_item_data['icon_background_color']) {
		$thegem_quickfinder_effect .= 'background-reverse';
	} else {
		$thegem_quickfinder_effect .= 'scale';
	}

	if(!$thegem_item_data['icon'] && has_post_thumbnail()) {
		$thegem_quickfinder_effect = 'quickfinder-item-effect-image-scale';
	}

	$thegem_icon_shortcode = thegem_build_icon_shortcode($thegem_item_data);

	$thegem_link_start = '<span class="quickfinder-item-link ' . ($thegem_item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'">';
	$thegem_link_end = '</span>';
	if($thegem_link = thegem_get_data($thegem_item_data, 'link')) {
		$thegem_link_start = '<a href="'.esc_url($thegem_link).'" class="quickfinder-item-link ' . ($thegem_item_data['icon_shape'] == 'circle' ? 'img-circle' : 'rounded-corners') .'" target="'.esc_attr(thegem_get_data($thegem_item_data, 'link_target')).'">';
		$thegem_link_end = '</a>';
	}
	$thegem_title_text_color = '';
	if( !empty($thegem_item_data['title_text_color'])){
		$thegem_title_text_color = 'style="color: '. $thegem_item_data['title_text_color'] .';"';
	}
	$thegem_description_text_color = '';
	if( !empty($thegem_item_data['description_text_color'])){
		$thegem_description_text_color = 'style="color: '. $thegem_item_data['description_text_color'] .'
		;"';
	}
	if($thegem_item_data['icon_shape'] == 'hexagon'){
		switch ( $thegem_item_data['icon_size'] ) {
			case 'small':
				$thegem_border_indent = '30.5px';
				$thegem_min_height = '100px';
				break;
			case 'medium':
				$thegem_border_indent = '47.5px';
				$thegem_min_height = '150px';
				break;
			case 'large':
				$thegem_border_indent = '92.5px';
				$thegem_min_height = '270px';
				break;
			case 'xlarge':
				$thegem_border_indent = '135px';
				$thegem_min_height = '320px';
				break;
			}
	} else {
		switch ( $thegem_item_data['icon_size'] ) {
			case 'small':
				$thegem_border_indent = '27px';
				$thegem_min_height = '100px';
				break;
			case 'medium':
				$thegem_border_indent = '42px';
				$thegem_min_height = '150px';
				break;
			case 'large':
				$thegem_border_indent = '82px';
				$thegem_min_height = '270px';
				break;
			case 'xlarge':
				$thegem_border_indent = '122px';
				$thegem_min_height = '320px';
				break;
			}
	}

	$delay = 'data-ll-item-delay="0"';
	if(isset($params['effects_enabled_delay']) && !empty($params['effects_enabled_delay']) && $i === 1) {
		$delay = 'data-ll-item-delay="'.$params['effects_enabled_delay'].'"';
	}
?>
<div id="post-<?php the_ID(); ?>" <?php if($params['effects_enabled']) echo ' data-ll-finish-delay="200" '; ?> <?php post_class(array( 'quickfinder-item', $quickfinder_item_rotation, $thegem_quickfinder_effect, $thegem_item_data['icon_size'], $params['effects_enabled'] ? 'lazy-loading' : '')); ?> <?php echo $delay; ?>>
	<?php if($params['alignment'] != 'left') : ?>
		<div class="quickfinder-item-image">
			<div class="quickfinder-item-image-content<?php if($params['effects_enabled']): ?> lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
				<?php if($thegem_item_data['icon']) : ?>
					<div class="quickfinder-item-image-wrapper">
						<?php echo do_shortcode($thegem_icon_shortcode); ?>
						</div>
				<?php else : ?>
					<div class="quickfinder-item-image-wrapper quickfinder-item-picture quickfinder-item-image-shape-<?php echo $thegem_item_data['icon_shape'] ?>">
						<?php thegem_post_thumbnail('thegem-person', true, ' quickfinder-img-size-'.$thegem_item_data['icon_size'], thegem_quickfinder_srcset($thegem_item_data)); ?>
					</div>
				<?php endif; ?>
				<?php if($thegem_item_data['link']) : ?>
					<a href="<?php echo esc_url($thegem_item_data['link']); ?>" target="<?php echo esc_attr($thegem_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<?php if($quickfinder_style != 'vertical' || $quickfinder_item_rotation == 'even') : ?>
		<div class="quickfinder-item-info-wrapper" style="min-height: <?php echo $thegem_min_height ?>;">
			<?php if($quickfinder_style == 'vertical-3') : ?>
				<div class="connector" style="border-color: <?php echo esc_attr($connector_color); ?>; <?php echo ($params['alignment'] == 'left' ? 'right' : 'left'); ?>: -<?php echo $thegem_border_indent;?>;">
				</div>
			<?php endif; ?>
			<div class="quickfinder-item-info <?php if($params['effects_enabled']): ?>lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="200" data-ll-effect="fading"<?php endif; ?>>
				<div style="display: block; min-height: 50px;">
				<?php the_title('<div class="quickfinder-item-title"  '.$thegem_title_text_color.'>', '</div>'); ?>
				<?php echo thegem_get_data($thegem_item_data, 'description', '', '<div class="quickfinder-item-text" '.$thegem_description_text_color.'>', '</div>'); ?>
				</div>
			</div>
			<?php if($thegem_item_data['link']) : ?>
				<a href="<?php echo esc_url($thegem_item_data['link']); ?>" target="<?php echo esc_attr($thegem_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
			<?php endif; ?>
		</div>
	<?php endif; ?>

	<?php if($params['alignment'] == 'left') : ?>
		<div class="quickfinder-item-image">
			<div class="quickfinder-item-image-content<?php if($params['effects_enabled']): ?> lazy-loading-item<?php endif; ?>" <?php if($params['effects_enabled']): ?>data-ll-item-delay="0" data-ll-effect="clip"<?php endif; ?>>
				<?php if($thegem_item_data['icon']) : ?>
					<div class="quickfinder-item-image-wrapper">
						<?php echo do_shortcode($thegem_icon_shortcode); ?>
						</div>
				<?php else : ?>
					<div class="quickfinder-item-image-wrapper quickfinder-item-picture quickfinder-item-image-shape-<?php echo $thegem_item_data['icon_shape'] ?>">
						<?php thegem_post_thumbnail('thegem-person', true, ' quickfinder-img-size-'.$thegem_item_data['icon_size'], thegem_quickfinder_srcset($thegem_item_data)); ?>
					</div>
				<?php endif; ?>
				<?php if($thegem_item_data['link']) : ?>
					<a href="<?php echo esc_url($thegem_item_data['link']); ?>" target="<?php echo esc_attr($thegem_item_data['link_target']); ?>" class="quickfinder-item-link"></a>
				<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

</div>
