<?php

$thegem_use_new_theme_options = true;
$thegem_use_new_page_options = true;
$thegem_use_old_theme_options = true;
$thegem_use_old_page_options = false;

if ( ! defined( 'THEGEM_THEME_URI' ) ) {
	define( 'THEGEM_THEME_URI', get_template_directory_uri() );
}
define( 'THEGEM_THEME_PATH', get_template_directory() );
if ( ! defined( 'THEGEM_THEME_VERSION' ) ) {
	define( 'THEGEM_THEME_VERSION', wp_get_theme(wp_get_theme()->get('Template'))->get('Version') );
}
if ( ! defined( 'THEGEM_PAGE_EDITOR' ) ) {
	define( 'THEGEM_PAGE_EDITOR', 'wpbackery' );
}

require THEGEM_THEME_PATH . '/inc/template-tags.php';
require THEGEM_THEME_PATH . '/inc/options.php';
if ($thegem_use_new_theme_options || $thegem_use_new_page_options) {
	require THEGEM_THEME_PATH . '/inc/theme-options/theme-options.php';
}
require THEGEM_THEME_PATH . '/inc/content.php';
require THEGEM_THEME_PATH . '/inc/post-types/init.php';
require THEGEM_THEME_PATH . '/inc/woocommerce.php';
require THEGEM_THEME_PATH . '/inc/megamenu/megamenu.class.php';
require THEGEM_THEME_PATH . '/inc/megamenu/megamenu-walker.class.php';
require THEGEM_THEME_PATH . '/inc/image-generator/image-editor.class.php';
require THEGEM_THEME_PATH . '/inc/image-generator/image-generator.php';
require THEGEM_THEME_PATH . '/inc/blog-extended-grid.php';

require THEGEM_THEME_PATH . '/inc/pagespeed/pagespeed.class.php';

require THEGEM_THEME_PATH . '/plugins/plugins.php';

require_once ABSPATH . "wp-admin" . '/includes/file.php';

if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

if(!function_exists('thegem_setup')) :
function thegem_setup() {
	load_theme_textdomain('thegem', THEGEM_THEME_PATH . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('post-thumbnails');
	add_theme_support('woocommerce');
	add_theme_support('title-tag');
	remove_theme_support( 'widgets-block-editor' );
	set_post_thumbnail_size(672, 372, true);
	add_image_size('thegem-post-thumb', 256, 256, true);
	add_image_size('thegem-custom-product-categories', 766, 731, true);
	register_nav_menus(array(
		'primary' => esc_html__('Top primary menu', 'thegem'),
		'footer'  => esc_html__('Footer menu', 'thegem'),
		'top_area' => esc_html__('Top area menu', 'thegem'),
	));
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	));
	add_theme_support('post-formats', array(
		'image', 'video', 'audio', 'quote', 'gallery',
	));
	add_theme_support('featured-content', array(
		'featured_content_filter' => 'thegem_get_featured_posts',
		'max_posts' => 6,
	));
	add_filter('use_default_gallery_style', '__return_false');

	function thegem_jpeg_quality() { return 80; }
	add_filter( 'jpeg_quality', 'thegem_jpeg_quality', 10, 2 );

	if(!get_option('thegem_theme_options')) {
		update_option('thegem_theme_options', thegem_first_install_settings());
		delete_option('thegem_activation');
	}
	$thegem_theme = wp_get_theme(wp_get_theme()->get('Template'));
	$option_version = thegem_get_option('theme_version');
	if(!empty($option_version) && version_compare($thegem_theme->get('Version'), $option_version) > 0) {
		thegem_version_update_options();
	}
	if(!empty($option_version) && version_compare('4.6.0', $option_version) > 0) {
		thegem_migrate_new_options();
		update_option('thegem_custom_css_filename', 'regenerate');
	}
	if(!get_option('pw_options')) {
		$pw_options = array(
			'donation' => 'yes',
			'customize_by_default' => 'yes',
			'post_types' => array('post', 'page', 'thegem_pf_item', 'thegem_news', 'product'),
			'sidebars' => array('page-sidebar', 'footer-widget-area', 'shop-sidebar', 'page-sidebar-0', 'page-sidebar-1', 'page-sidebar-2', 'shop-widget-area'),
		);
		update_option('pw_options', $pw_options);
	}
	if(!get_option('shop_catalog_image_size')) {
		update_option('shop_catalog_image_size', array('width' => 522, 'height' => 652, 'crop' => 1));
	}
	if(!get_option('shop_single_image_size')) {
		update_option('shop_single_image_size', array('width' => 564, 'height' => 744, 'crop' => 1));
	}
	if(!get_option('shop_thumbnail_image_size')) {
		update_option('shop_thumbnail_image_size', array('width' => 160, 'height' => 160, 'crop' => 1));
	}
	if(!get_option('wpb_js_content_types')) {
		update_option('wpb_js_content_types', array('post', 'page', 'product', 'thegem_news', 'thegem_pf_item', 'thegem_footer', 'thegem_title', 'thegem_templates'));
	}
	if(!empty($option_version) && version_compare('5.3.0', $option_version) > 0) {
		$wpb_js_content_types = get_option('wpb_js_content_types');
		$wpb_js_content_types[] = 'thegem_templates';
		update_option('wpb_js_content_types', $wpb_js_content_types);
	}
	if(!empty($option_version) && version_compare('5.3.1', $option_version) > 0) {
		$role = get_role( 'administrator' );
		$role->add_cap( 'vc_access_rules_post_types/thegem_templates', true );
	}
	$thegem_theme = wp_get_theme('thegem');
	update_option('zilla_likes_settings', array_merge(get_option('zilla_likes_settings', array()), array('disable_css' => 1)));
	$lscode = get_option( 'layerslider-purchase-code', '' );
	$lsactivated = get_option( 'layerslider-authorized-site', false );
	if( $lsactivated && empty( $lscode ) ) {
		delete_option( 'layerslider-authorized-site' );
	}
	if(!get_option('wpb_js_js_composer_purchase_code')) {
		update_option('wpb_js_js_composer_purchase_code', 1);
	}
	update_option('revslider-valid-notice', 'false');
	if( defined('LS_PLUGIN_VERSION') && !get_option('thegem_layerslider_options_updated', false) ) {
		thegem_update_layerslider_options();
	}
	if( defined('RS_REVISION') && !get_option('thegem_revslider_options_updated', false) && class_exists('RevSliderGlobals') && method_exists('RevSliderGlobals', 'instance')) {
		thegem_update_revslider_options();
	}
	$megamenu = new TheGem_Mega_Menu();
	add_filter('attachment_fields_to_edit', 'thegem_attachment_extra_fields', 10, 2);
	add_filter('attachment_fields_to_save', 'thegem_attachment_extra_fields_save', 10, 2);

	add_theme_support('editor-styles');
	add_editor_style('css/style-editor.css');

	$custom_css_name = get_option('thegem_custom_css_filename');
	if(!file_exists(get_stylesheet_directory() . '/css/'.$custom_css_name.'.css')) {
		thegem_generate_empty_custom_css();
	}

	if(isset($_GET['thegem-elementor-conflict-proceed'])) {
		deactivate_plugins(array('thegem-elements-elementor/thegem-elements-elementor.php', 'thegem-importer-elementor/thegem-importer.php'));
		wp_safe_redirect(remove_query_arg('thegem-elementor-conflict-proceed'));
	}
	if(isset($_GET['thegem-elementor-conflict-cancel'])) {
		switch_theme('thegem-elementor');
		wp_safe_redirect(remove_query_arg('thegem-elementor-conflict-cancel'));
	}
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) {
		update_option('yith_wcwl_price_show', 'yes');
		update_option('yith_wcwl_stock_show', 'yes');
		update_option('yith_wcwl_add_to_cart_show', 'yes');
		update_option('yith_wcwl_show_remove', 'yes');
		update_option('yith_wcwl_after_add_to_wishlist_behaviour', 'remove');
	}
	update_option( 'woocommerce_attribute_lookup_enabled', 'no' );
}
endif;
add_action('after_setup_theme', 'thegem_setup');

if (!function_exists('thegem_init_callback')) {
	function thegem_init_callback() {
		TGM_PageSpeed::activate();
	}
	add_action('init', 'thegem_init_callback');
}

//THEGEM MENU

//add_action( 'admin_menu', 'thegem_admin_menu');
function thegem_admin_menu() {
	$page = add_menu_page(esc_html__('TheGem','thegem'), esc_html__('TheGem','thegem'), 'edit_theme_options', 'thegem-theme-options', 'thegem_theme_options_page', '', '3.1');
}

function thegem_admin_menu_additional_links() {
	if(current_user_can('edit_theme_options')) {
		global $submenu;
		$submenu['thegem-dashboard-welcome'][] = array(esc_html__('Support Center', 'thegem'), 'edit_theme_options', esc_url('https://codexthemes.ticksy.com/'));
		$submenu['thegem-dashboard-welcome'][] = array(esc_html__('Documentation', 'thegem'), 'edit_theme_options', esc_url('http://codex-themes.com/thegem/documentation/'));
	}
}
add_action('admin_menu', 'thegem_admin_menu_additional_links', 50);

function thegem_theme_option_admin_notice() {
	if(isset($_GET['page']) && $_GET['page'] == 'thegem-theme-options') {
		$wp_upload_dir = wp_upload_dir();
		$upload_logos_dir = $wp_upload_dir['basedir'] . '/thegem-logos';
		if(!wp_mkdir_p($upload_logos_dir)) {
?>
<div class="error">
	<p><?php esc_html_e('Upload directory cannot be created. Check your permissions.', 'thegem'); ?></p>
</div>
<?php
		}
	}
}
add_action('admin_notices', 'thegem_theme_option_admin_notice');

function thegem_attachment_extra_fields($fields, $post) {
	$attachment_link = get_post_meta($post->ID, 'attachment_link', true);
	$fields['attachment_link'] = array(
		'input' => 'html',
		'html' => '<input type="text" id="attachments-' . $post->ID . '-attachment_link" style="width: 500px;" name="attachments[' . $post->ID . '][attachment_link]" value="' . esc_attr( $attachment_link ) . '" />',
		'label' => esc_html__('Link', 'thegem'),
		'value' => $attachment_link
	);

	$highligh = (bool) get_post_meta($post->ID, 'highlight', true);
	$fields['highlight'] = array(
		'input' => 'html',
		'html' => '<input type="checkbox" id="attachments-' . $post->ID . '-highlight" name="attachments[' . $post->ID . '][highlight]" value="1"' . ($highligh ? ' checked="checked"' : '') . ' />',
		'label' => esc_html__('Show as Highlight?', 'thegem'),
		'value' => $highligh
	);

	$highligh_type = get_post_meta($post->ID, 'highligh_type', true);
	if (!$highligh_type) {
		$highligh_type = 'squared';
	}
	$fields['highligh_type'] = array(
		'input' => 'html',
		'html' => '<select id="attachments-' . $post->ID . '-highligh_type" name="attachments[' . $post->ID . '][highligh_type]"><option value="squared" ' . ($highligh_type == 'squared' ? ' selected="selected"' : '') . '>Squared</option><option value="horizontal" ' . ($highligh_type == 'horizontal' ? ' selected="selected"' : '') . '>Horizontal</option><option value="vertical" ' . ($highligh_type == 'vertical' ? ' selected="selected"' : '') . '>Vertical</option></select>',
		'label' => esc_html__('Highlight Type', 'thegem'),
		'value' => $highligh_type
	);

	return $fields;
}

function thegem_attachment_extra_fields_save($post, $attachment) {
	update_post_meta($post['ID'], 'highlight', isset($attachment['highlight']));
	update_post_meta($post['ID'], 'attachment_link', $attachment['attachment_link']);
	update_post_meta($post['ID'], 'highligh_type', $attachment['highligh_type']);
	return $post;
}

/* SIDEBAR & WIDGETS */

function thegem_count_widgets($sidebar_id) {

	global $_wp_sidebars_widgets, $sidebars_widgets;
	if(!is_admin()) {
		if(empty($_wp_sidebars_widgets))
			$_wp_sidebars_widgets = get_option('sidebars_widgets', array());
		$sidebars_widgets = $_wp_sidebars_widgets;
	} else {
		$sidebars_widgets = get_option('sidebars_widgets', array());
	}
	if(is_array($sidebars_widgets) && isset($sidebars_widgets['array_version']))
		unset($sidebars_widgets['array_version']);

	$sidebars_widgets = apply_filters('sidebars_widgets', $sidebars_widgets);

	if(isset($sidebars_widgets[$sidebar_id])) {
		return count($sidebars_widgets[$sidebar_id]);
	}
	return 0;
}

function thegem_dynamic_sidebar_params($params) {
	$footer_widgets_class = 'col-md-4 col-sm-6 col-xs-12';
	if(thegem_count_widgets('footer-widget-area') >= 4) {
		$footer_widgets_class = 'col-md-3 col-sm-6 col-xs-12';
	}
	if(thegem_count_widgets('footer-widget-area') == 2) {
		$footer_widgets_class = 'col-sm-6 col-xs-12';
	}
	if(thegem_count_widgets('footer-widget-area') == 1) {
		$footer_widgets_class = 'col-xs-12';
	}
	$footer_widgets_class .= ' count-'.thegem_count_widgets('footer-widget-area');
	$params[0]['before_widget'] = str_replace('thegem__footer-widget-class__thegem', esc_attr($footer_widgets_class), $params[0]['before_widget']);
	return $params;
}
add_filter('dynamic_sidebar_params', 'thegem_dynamic_sidebar_params');

function thegem_sidebar_init() {
	register_sidebar(array(
		'name'		  => esc_html__('Main Page Sidebar', 'thegem'),
		'id'			=> 'page-sidebar',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thegem'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('Page Builder Sidebar 01', 'thegem'),
		'id'			=> 'page-sidebar-0',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thegem'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('Page Builder Sidebar 02', 'thegem'),
		'id'			=> 'page-sidebar-1',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thegem'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('Page Builder Sidebar 03', 'thegem'),
		'id'			=> 'page-sidebar-2',
		'description'   => esc_html__('Main sidebar that appears on the left.', 'thegem'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	));
	register_sidebar(array(
		'name'		  => esc_html__('Footer Widget Area', 'thegem'),
		'id'			=> 'footer-widget-area',
		'description'   => esc_html__('Footer Widget Area.', 'thegem'),
		'before_widget' => '<div id="%1$s" class="widget inline-column thegem__footer-widget-class__thegem %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	register_sidebar(array(
		'name' => esc_html__('WooCommerce Sidebar', 'thegem'),
		'id' => 'shop-sidebar',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'thegem'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => esc_html__('WooCommerce Bottom Area', 'thegem'),
		'id' => 'shop-widget-area',
		'description' => esc_html__('Appears on posts and pages except the optional Front Page template, which has its own widgets', 'thegem'),
		'before_widget' => '<section id="%1$s" class="widget inline-column col-md-4 col-sm-6 col-xs-12 %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h4 class="widget-title shop-widget-title">',
		'after_title' => '</h4>',
	));
}
add_action('widgets_init', 'thegem_sidebar_init');

function thegem_scripts() {
	$thegem_page_id = is_singular() ? get_the_ID() : 0;
	$thegem_shop_page = 0;
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$thegem_page_id = thegem_get_option('404_page');
	}
	if(is_post_type_archive('product') && function_exists('wc_get_page_id')) {
		$thegem_page_id = wc_get_page_id('shop');
		$thegem_shop_page = 1;
	}
	$header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_page_id);
	if((is_archive() || is_home()) && !$thegem_shop_page) {
		if(is_tax('product_cat') || is_tax('product_tag')) {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('product_categories'), 'product_category');
		} else {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
		}
	}
	if(is_tax() || is_category() || is_tag()) {
		$thegem_term_id = get_queried_object()->term_id;
		if(get_term_meta($thegem_term_id , 'thegem_taxonomy_custom_page_options', true)) {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
		}
	}
	if (is_search()) {
		$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
	}
//	wp_enqueue_script('thegem-fullwidth-optimizer', THEGEM_THEME_URI . '/js/thegem-fullwidth-loader.js', false, false, false);
	wp_enqueue_script( 'html5', THEGEM_THEME_URI . '/js/html5.js', array(), THEGEM_THEME_VERSION );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_register_script('jquery-dlmenu', THEGEM_THEME_URI . '/js/jquery.dlmenu.js', array('jquery'), THEGEM_THEME_VERSION, true);

	/*if (thegem_get_option('mobile_menu_layout') == 'default') {
		wp_enqueue_script('jquery-dlmenu');
	}*/

	wp_register_script('thegem-menu-init-script', THEGEM_THEME_URI . '/js/thegem-menu_init.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_localize_script('thegem-menu-init-script', 'thegem_dlmenu_settings', array(
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'backLabel' => esc_html__('Back', 'thegem'),
		'showCurrentLabel' => esc_html__('Show this page', 'thegem')
	));

	wp_enqueue_style('thegem-preloader', THEGEM_THEME_URI . '/css/thegem-preloader.css', array(), THEGEM_THEME_VERSION);

	$icons_loading_css = "
		body:not(.compose-mode) .gem-icon-style-gradient span,
		body:not(.compose-mode) .gem-icon .gem-icon-half-1,
		body:not(.compose-mode) .gem-icon .gem-icon-half-2 {
			opacity: 0 !important;
			}";
	wp_add_inline_style('thegem-preloader', $icons_loading_css);

	wp_enqueue_style('thegem-reset', THEGEM_THEME_URI . '/css/thegem-reset.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('thegem-grid', THEGEM_THEME_URI . '/css/thegem-grid.css', array(), THEGEM_THEME_VERSION);

	wp_register_style('thegem-header', THEGEM_THEME_URI . '/css/thegem-header.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-custom-header', THEGEM_THEME_URI . '/css/thegem-custom-header.css', array(), THEGEM_THEME_VERSION);
	if((!$header_params['effects_hide_header'] && $header_params['header_source'] == 'builder' && get_post(get_post($header_params['header_builder']))) || (is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'header')) {
		wp_enqueue_style('thegem-custom-header');
	} elseif(!$header_params['effects_hide_header'] && $header_params['header_source'] == 'default' && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'header')) {
		wp_enqueue_style('thegem-header');
	}
	if(!empty($_REQUEST['thegem_header_test'])) {
		wp_enqueue_style('thegem-header');
	}

	if(get_stylesheet() === get_template()) {
		wp_enqueue_style('thegem-style', get_stylesheet_uri(), array('thegem-reset', 'thegem-grid'));
	} else {
		wp_enqueue_style('thegem-style', THEGEM_THEME_URI.'/style.css', array('thegem-reset', 'thegem-grid'), THEGEM_THEME_VERSION);
		wp_enqueue_style('thegem-child-style', get_stylesheet_uri(), array('thegem-style'), THEGEM_THEME_VERSION);
	}

	if (thegem_get_option('header_layout') == 'perspective') {
		wp_enqueue_style('thegem-layout-perspective', THEGEM_THEME_URI . '/css/thegem-layout-perspective.css', array(), THEGEM_THEME_VERSION);
	}

	wp_enqueue_style('thegem-widgets', THEGEM_THEME_URI . '/css/thegem-widgets.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-animations', THEGEM_THEME_URI . '/css/thegem-itemsAnimations.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('thegem-new-css', THEGEM_THEME_URI . '/css/thegem-new-css.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('perevazka-css-css', THEGEM_THEME_URI . '/css/thegem-perevazka-css.css', array(), THEGEM_THEME_VERSION);
	if($fonts_url = thegem_google_fonts_url()) {
		wp_enqueue_style( 'thegem-google-fonts', $fonts_url);
	}
	$custom_css_name = thegem_get_custom_css_filename();
	if(file_exists(get_stylesheet_directory() . '/css/'.$custom_css_name.'.css')) {
		wp_enqueue_style('thegem-custom', get_stylesheet_directory_uri() . '/css/'.$custom_css_name.'.css', array('thegem-style'), THEGEM_THEME_VERSION);
	} elseif(file_exists(THEGEM_THEME_URI . '/css/'.$custom_css_name.'.css')) {
		wp_enqueue_style('thegem-custom', THEGEM_THEME_URI . '/css/'.$custom_css_name.'.css', array('thegem-style'), THEGEM_THEME_VERSION);
	} else {
		wp_enqueue_style('thegem-custom', THEGEM_THEME_URI . '/css/custom.css', array('thegem-style'), THEGEM_THEME_VERSION);
	}
	wp_deregister_style('wp-mediaelement');
	wp_register_style('wp-mediaelement', THEGEM_THEME_URI . '/css/wp-mediaelement.css', array('mediaelement'), THEGEM_THEME_VERSION);

	if(is_rtl()) {
		wp_enqueue_style( 'thegem-rtl', THEGEM_THEME_URI . '/css/rtl.css', array(), THEGEM_THEME_VERSION);
	}

	if(is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply', array(), false, true);
	}

	wp_enqueue_style('js_composer_front');
	wp_enqueue_style('thegem_js_composer_front');
	//wp_enqueue_script('svg4everybody', THEGEM_THEME_URI . '/js/svg4everybody.js', false, false, true);
	wp_enqueue_script('thegem-form-elements', THEGEM_THEME_URI . '/js/thegem-form-elements.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_enqueue_script('jquery-easing', THEGEM_THEME_URI . '/js/jquery.easing.js', array('jquery'), THEGEM_THEME_VERSION, true);

	wp_register_script('thegem-mediaelement', THEGEM_THEME_URI . '/js/thegem-mediaelement.js', array('jquery', 'mediaelement'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-header', THEGEM_THEME_URI . '/js/thegem-header.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-custom-header', THEGEM_THEME_URI . '/js/thegem-custom-header.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('jquery-touchSwipe', THEGEM_THEME_URI . '/js/jquery.touchSwipe.min.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('jquery-carouFredSel', THEGEM_THEME_URI . '/js/jquery.carouFredSel.js', array('jquery', 'jquery-touchSwipe'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-gallery', THEGEM_THEME_URI . '/js/thegem-gallery.js', array('jquery', 'jquery-carouFredSel', 'thegem-scroll-monitor'), THEGEM_THEME_VERSION, true);
	wp_register_style('odometr', THEGEM_THEME_URI . '/css/odometer-theme-default.css', array(), THEGEM_THEME_VERSION);
	wp_register_script('odometr', THEGEM_THEME_URI . '/js/odometer.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-related-products-carousel', THEGEM_THEME_URI . '/js/thegem-related-products-carousel.js', array('jquery', 'jquery-carouFredSel'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-related-posts-carousel', THEGEM_THEME_URI . '/js/thegem-related-posts-carousel.js', array('jquery', 'jquery-carouFredSel'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-sticky', THEGEM_THEME_URI . '/js/thegem-sticky.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-items-animations', THEGEM_THEME_URI . '/js/thegem-itemsAnimations.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_style('thegem-blog', THEGEM_THEME_URI . '/css/thegem-blog.css', array('mediaelement', 'wp-mediaelement'), THEGEM_THEME_VERSION);
	wp_register_style('thegem-additional-blog', THEGEM_THEME_URI . '/css/thegem-additional-blog.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('thegem-additional-blog-1', THEGEM_THEME_URI . '/css/thegem-additional-blog-1.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers', THEGEM_THEME_URI . '/css/thegem-hovers.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-default', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-default.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-zooming-blur', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-zooming-blur.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-horizontal-sliding', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-horizontal-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-vertical-sliding', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-vertical-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-gradient', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-gradient.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-circular', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-circular.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-slide', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-slide.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-fade', THEGEM_THEME_URI . '/css/hovers/thegem-hovers-fade.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-blog-timeline-new', THEGEM_THEME_URI . '/css/thegem-blog-timeline-new.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-elegant', THEGEM_THEME_URI . '/css/icons-elegant.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-material', THEGEM_THEME_URI . '/css/icons-material.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-fontawesome', THEGEM_THEME_URI . '/css/icons-fontawesome.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-thegemdemo', THEGEM_THEME_URI . '/css/icons-thegemdemo.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-thegem-header', THEGEM_THEME_URI . '/css/icons-thegem-header.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-quickfinders', THEGEM_THEME_URI . '/css/thegem-quickfinders.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-quickfinders-vertical', THEGEM_THEME_URI . '/css/thegem-quickfinders-vertical.css', array(), THEGEM_THEME_VERSION);

	if (!thegem_get_option('disable_smooth_scroll')) {
		wp_enqueue_script('SmoothScroll', THEGEM_THEME_URI . '/js/SmoothScroll.js', array(), THEGEM_THEME_VERSION, true);
	}
	if((!$header_params['effects_hide_header'] && $header_params['header_source'] == 'builder' && get_post($header_params['header_builder'])) || (is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'header')) {
		wp_enqueue_script('thegem-custom-header');
		do_action('thegem_custom_header_scripts', $header_params);
	} elseif(!$header_params['effects_hide_header'] && $header_params['header_source'] == 'default' && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'header')) {
		if (thegem_get_option('mobile_menu_layout') == 'default') {
			wp_enqueue_script('jquery-dlmenu');
		}
		wp_enqueue_script('thegem-menu-init-script');
		wp_enqueue_script('thegem-header');
	}
	if(!empty($_REQUEST['thegem_header_test'])) {
		if (thegem_get_option('mobile_menu_layout') == 'default') {
			wp_enqueue_script('jquery-dlmenu');
		}
		wp_enqueue_script('thegem-menu-init-script');
		wp_enqueue_script('thegem-header');
	}

	/* Lazy Loading */
	wp_register_script('thegem-lazy-loading', THEGEM_THEME_URI . '/js/thegem-lazyLoading.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_style('thegem-lazy-loading-animations', THEGEM_THEME_URI . '/css/thegem-lazy-loading-animations.css', array(), THEGEM_THEME_VERSION);
	// wp_enqueue_script('jquery-transform', THEGEM_THEME_URI . '/js/jquery.transform.js', array(), THEGEM_THEME_VERSION, true);
	// wp_enqueue_script('jquery-effects-drop', array(), THEGEM_THEME_VERSION, true);


	wp_enqueue_script('thegem-scripts', THEGEM_THEME_URI . '/js/functions.js', array('jquery', 'thegem-form-elements'), THEGEM_THEME_VERSION, true);
	wp_localize_script('thegem-scripts', 'thegem_scripts_data', array(
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'ajax_nonce' => wp_create_nonce('ajax_security'),
	));

	wp_enqueue_script('jquery-mousewheel', THEGEM_THEME_URI . '/js/fancyBox/jquery.mousewheel.pack.js', array(), THEGEM_THEME_VERSION, true);
	wp_enqueue_script('jquery-fancybox', THEGEM_THEME_URI . '/js/fancyBox/jquery.fancybox.min.js', array(), THEGEM_THEME_VERSION, true);
	wp_enqueue_script('fancybox-init-script', THEGEM_THEME_URI . '/js/fancyBox/jquery.fancybox-init.js', array('jquery-mousewheel', 'jquery-fancybox'), THEGEM_THEME_VERSION, true);
	wp_enqueue_style('jquery-fancybox', THEGEM_THEME_URI . '/js/fancyBox/jquery.fancybox.min.css', array(), THEGEM_THEME_VERSION);

	wp_enqueue_style('thegem-vc_elements', THEGEM_THEME_URI . '/css/thegem-vc_elements.css', array(), THEGEM_THEME_VERSION);

	wp_register_script('thegem-blog-core', THEGEM_THEME_URI . '/js/thegem-blog-core.js', array('jquery', 'thegem-mediaelement', 'thegem-scroll-monitor', 'thegem-gallery', 'thegem-items-animations'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-blog', THEGEM_THEME_URI . '/js/thegem-blog.js', array('thegem-blog-core'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-blog-isotope', THEGEM_THEME_URI . '/js/thegem-blog-isotope.js', array('isotope-js', 'thegem-blog-core'), THEGEM_THEME_VERSION, true);

	wp_register_script('imagesloaded', THEGEM_THEME_URI . '/js/imagesloaded.min.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('isotope-js', THEGEM_THEME_URI . '/js/isotope.min.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-scroll-monitor', THEGEM_THEME_URI . '/js/thegem-scrollMonitor.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_script('wheel-indicator', THEGEM_THEME_URI . '/js/wheel-indicator.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-page-scroller', THEGEM_THEME_URI . '/js/thegem-page-scroller.js', array('jquery', 'wheel-indicator', 'jquery-touchSwipe'), THEGEM_THEME_VERSION, true);

	wp_register_script('fullpage', THEGEM_THEME_URI . '/js/fullpage/fullpage.min.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_style('fullpage', THEGEM_THEME_URI . '/js/fullpage/fullpage.min.css', array(), THEGEM_THEME_VERSION);
	wp_register_script('thegem-fullpage', THEGEM_THEME_URI . '/js/thegem-fullpage.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_style('thegem-fullpage', THEGEM_THEME_URI . '/css/thegem-fullpage.css', array(), THEGEM_THEME_VERSION);

	wp_register_script('thegem-ken-burns', THEGEM_THEME_URI . '/js/thegem-ken-burns.js', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-ken-burns', THEGEM_THEME_URI . '/css/thegem-ken-burns.css', array(), THEGEM_THEME_VERSION);

	wp_register_script('thegem-parallax-footer', THEGEM_THEME_URI . '/js/thegem-parallax-footer.js', array('jquery'), THEGEM_THEME_VERSION, true);

	wp_register_script('owl', THEGEM_THEME_URI . '/js/owl/owl.carousel.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_script('owl-zoom', THEGEM_THEME_URI . '/js/owl/zoom.min.js', array(), THEGEM_THEME_VERSION, true);
	wp_register_style('owl', THEGEM_THEME_URI . '/js/owl/owl.carousel.css', array(), THEGEM_THEME_VERSION);

	if(is_404() && get_post(thegem_get_option('404_page')) && $page_404_inline_style = get_post_meta(thegem_get_option('404_page'), '_wpb_shortcodes_custom_css', true).get_post_meta(thegem_get_option('404_page'), '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thegem-custom', strip_tags($page_404_inline_style));
	}
	$custom_footer_post_id = 0;
	if(thegem_get_option('custom_footer') && get_post(thegem_get_option('custom_footer'))) {
		$custom_footer_post_id = thegem_get_option('custom_footer');
	}
	if($header_params['footer_custom'] && get_post($header_params['footer_custom'])) {
		$custom_footer_post_id = $header_params['footer_custom'];
	}
	if(get_post($custom_footer_post_id) && $custom_footer_inline_style = get_post_meta($custom_footer_post_id, '_wpb_shortcodes_custom_css', true).get_post_meta($custom_footer_post_id, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thegem-custom', strip_tags($custom_footer_inline_style));
	}

	$custom_title_post_id = 0;
	$id = is_singular() ? get_the_ID() : 0;
	$title_params = $header_params;
	if($title_params['title_style'] == 2 && $title_params['title_template'] && get_post($title_params['title_template'])) {
		$custom_title_post_id = $title_params['title_template'];
	}
	if($title_params['title_style'] == 2 && get_post($custom_title_post_id) && $custom_title_inline_style = get_post_meta($custom_title_post_id, '_wpb_shortcodes_custom_css', true).get_post_meta($custom_title_post_id, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thegem-custom', strip_tags($custom_title_inline_style));
	}

	$page_settings_css = thegem_get_page_settings_css();
	if($page_settings_css) {
		wp_add_inline_style('thegem-custom', $page_settings_css);
	}

	if(thegem_is_plugin_active('woocommerce/woocommerce.php')) {
		if(is_shop() && get_post(wc_get_page_id('shop')) && $page_shop_inline_style = get_post_meta(wc_get_page_id('shop'), '_wpb_shortcodes_custom_css', true)) {
			wp_add_inline_style('thegem-custom', strip_tags($page_shop_inline_style));
		}
	}
	wp_register_style('thegem-wpb-animations', THEGEM_THEME_URI . '/css/thegem-wpb-animations.css', array(), THEGEM_THEME_VERSION);

	wp_register_style('thegem-portfolio', THEGEM_THEME_URI . '/css/thegem-portfolio.css', array('thegem-hovers'), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid', THEGEM_THEME_URI . '/css/thegem-news-grid.css', array( 'thegem-portfolio'), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-hovers', THEGEM_THEME_URI . '/css/thegem-news-grid-hovers.css', array(), THEGEM_THEME_VERSION);

	wp_register_style('thegem-news-grid-version-new-hovers-default', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/default.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-zooming-blur', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/zooming-blur.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-simple-zoom', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/simple-zoom.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-horizontal-sliding', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/horizontal-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-vertical-sliding', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/vertical-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-gradient', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/gradient.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-new-hovers-circular', THEGEM_THEME_URI . '/css/thegem-news-grid-version-new/circular.css', array(), THEGEM_THEME_VERSION);

	wp_register_style('thegem-news-grid-version-default-hovers-default', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/default.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-default-hovers-zooming-blur', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/zooming-blur.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-hovers-simple-zoom', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/simple-zoom.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-default-hovers-horizontal-sliding', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/horizontal-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-default-hovers-vertical-sliding', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/vertical-sliding.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-default-hovers-gradient', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/gradient.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('thegem-news-grid-version-default-hovers-circular', THEGEM_THEME_URI . '/css/thegem-news-grid-version-default/circular.css', array(), THEGEM_THEME_VERSION);

	wp_register_script('thegem-isotope-metro', THEGEM_THEME_URI . '/js/isotope_layout_metro.js', array('isotope-js'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-isotope-masonry-custom', THEGEM_THEME_URI . '/js/isotope-masonry-custom.js', array('isotope-js'), THEGEM_THEME_VERSION, true);
	wp_register_script('thegem-portfolio-grid-extended', THEGEM_THEME_URI . '/js/thegem-portfolio-grid-extended.js', array('jquery'), THEGEM_THEME_VERSION, true);

	if (is_category() && thegem_get_option('blog_layout_type') == 'grid' || (is_search() && thegem_get_option('search_layout_type') == 'grid')) {
		wp_enqueue_style('thegem-news-grid');
	}

}
add_action('wp_enqueue_scripts', 'thegem_scripts', 5);

function thegem_print_inline_scripts() {
	echo '<script type="text/javascript">';
	echo stripslashes("function fullHeightRow() {
			var fullHeight,
				offsetTop,
				element = document.getElementsByClassName('vc_row-o-full-height')[0];
			if (element) {
				fullHeight = window.innerHeight;
				offsetTop = window.pageYOffset + element.getBoundingClientRect().top;
				if (offsetTop < fullHeight) {
					fullHeight = 100 - offsetTop / (fullHeight / 100);
					element.style.minHeight = fullHeight + 'vh'
				}
			}
		}");
	echo '</script>';
}
add_action('wp_print_scripts', 'thegem_print_inline_scripts');

function thegem_custom_header_script() {
	$script = preg_replace(array('#<script(.*?)>#is', '#</script>#is'), '', stripslashes(thegem_get_option('custom_js_header')));
	if(!empty($script)) {
		echo PHP_EOL.'<script type="text/javascript">'.PHP_EOL.$script.PHP_EOL.'</script>'.PHP_EOL;
	}
}
add_action('wp_print_scripts', 'thegem_custom_header_script');

function thegem_custom_footer_script() {
	$script = preg_replace(array('#<script(.*?)>#is', '#</script>#is'), '', stripslashes(thegem_get_option('custom_js')));
	if(!empty($script)) {
		echo PHP_EOL.'<script type="text/javascript">'.PHP_EOL.$script.PHP_EOL.'</script>'.PHP_EOL;
	}
}
add_action('wp_footer', 'thegem_custom_footer_script');

function thegem_get_tracking_js() {
	if (thegem_get_option('tracking_js')) {
		$is_show_tracking_js = true;

		if (class_exists('TheGemGdpr') && !TheGemGdpr::getInstance()->is_allow_consent(TheGemGdpr::CONSENT_NAME_TRACKING)) {
			$is_show_tracking_js = false;
		}

		if ($is_show_tracking_js) {
			echo stripslashes(thegem_get_option('tracking_js'));
		}
	}
}
add_action('wp_head', 'thegem_get_tracking_js', 10);

function thegem_admin_scripts_init() {
	$jQuery_ui_theme = 'ui-no-theme';
	wp_enqueue_style('jquery-ui-no-theme', THEGEM_THEME_URI . '/css/jquery-ui/' . $jQuery_ui_theme . '/jquery-ui.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_script('media-upload');
	wp_enqueue_style('thegem-admin-styles', THEGEM_THEME_URI . '/css/thegem-admin.css', array(), THEGEM_THEME_VERSION);
	wp_register_script('color-picker', THEGEM_THEME_URI . '/js/colorpicker/js/colorpicker.js', array(), THEGEM_THEME_VERSION);
	wp_register_style('color-picker', THEGEM_THEME_URI . '/js/colorpicker/css/colorpicker.css', array(), THEGEM_THEME_VERSION);
	global $pagenow;
	wp_register_script('jquery-fancybox', THEGEM_THEME_URI . '/js/fancyBox/jquery.fancybox.min.js', array('jquery'), THEGEM_THEME_VERSION);
	wp_register_style('jquery-fancybox', THEGEM_THEME_URI . '/js/fancyBox/jquery.fancybox.min.css', array(), THEGEM_THEME_VERSION);
	if($pagenow == 'themes.php' || $pagenow == 'update-core.php') {
		wp_enqueue_script('jquery-fancybox');
		wp_enqueue_style('jquery-fancybox');
	}
	wp_enqueue_script('thegem-admin-functions', THEGEM_THEME_URI . '/js/thegem-admin_functions.js', array('jquery'), THEGEM_THEME_VERSION);
	wp_localize_script('thegem-admin-functions', 'thegem_admin_functions_data', array(
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'ajax_nonce' => wp_create_nonce('ajax_security'),
        'to_styled_elements_color_1' => thegem_get_option('styled_elements_color_1'),
		'to_styled_elements_background_color' => thegem_get_option('styled_elements_background_color'),
		'to_button_background_basic_color' => thegem_get_option('button_background_basic_color'),
        'to_main_menu_level1_color' => thegem_get_option('main_menu_level1_color'),
	));
	wp_enqueue_script('thegem_page_settings-script', THEGEM_THEME_URI . '/js/thegem-page_meta_box_settings.js', array('jquery'), THEGEM_THEME_VERSION);
	wp_register_script('thegem_js_composer_js_custom_views', THEGEM_THEME_URI . '/js/thegem-composer-custom-views.js', array( 'wpb_js_composer_js_view' ), THEGEM_THEME_VERSION, true );
	wp_register_style('icons-elegant', THEGEM_THEME_URI . '/css/icons-elegant.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-material', THEGEM_THEME_URI . '/css/icons-material.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-fontawesome', THEGEM_THEME_URI . '/css/icons-fontawesome.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-thegemdemo', THEGEM_THEME_URI . '/css/icons-thegemdemo.css', array(), THEGEM_THEME_VERSION);
	wp_register_style('icons-thegem-header', THEGEM_THEME_URI . '/css/icons-thegem-header.css', array(), THEGEM_THEME_VERSION);

	wp_register_style('icons-arrows', THEGEM_THEME_URI . '/css/icons-arrows.css', array(), THEGEM_THEME_VERSION);

	wp_enqueue_script('thegem-icons-picker', THEGEM_THEME_URI . '/js/thegem-icons-picker.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_localize_script('thegem-icons-picker', 'thegem_iconsPickerData', array(
		'buttonTitle' => esc_html__('Select icon', 'thegem'),
		'ajax_url' => esc_url(admin_url('admin-ajax.php')),
		'ajax_nonce' => wp_create_nonce('ajax_security'),
	));
}
add_action('admin_enqueue_scripts', 'thegem_admin_scripts_init');


function thegem_vc_frontend_editor_enqueue_js_css() {
	wp_enqueue_style('icons-elegant', THEGEM_THEME_URI . '/css/icons-elegant.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('icons-material', THEGEM_THEME_URI . '/css/icons-material.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('icons-fontawesome', THEGEM_THEME_URI . '/css/icons-fontawesome.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('icons-thegemdemo', THEGEM_THEME_URI . '/css/icons-thegemdemo.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('icons-thegem-header', THEGEM_THEME_URI . '/css/icons-thegem-header.css', array(), THEGEM_THEME_VERSION);
	wp_enqueue_style('icons-arrows', THEGEM_THEME_URI . '/css/icons-arrows.css', array(), THEGEM_THEME_VERSION);

	if(thegem_icon_userpack_enabled()) {
		wp_enqueue_style('icons-userpack', get_stylesheet_directory_uri() . '/css/icons-userpack.css', array(), THEGEM_THEME_VERSION);
	}
	wp_register_script('odometr', THEGEM_THEME_URI . '/js/odometer.js', array('jquery'), THEGEM_THEME_VERSION, true);
	wp_enqueue_script('thegem-vc-editor-init', THEGEM_THEME_URI . '/js/thegem-vc-editor-init.js', array('odometr'), THEGEM_THEME_VERSION, true );
}
add_action( 'vc_frontend_editor_enqueue_js_css', 'thegem_vc_frontend_editor_enqueue_js_css' );

/* OPEN GRAPH TAGS START */

function thegem_open_graph() {
	global $post;

	if (thegem_get_option('disable_og_tags') == 1) {
		return;
	}

	$og_description_length = 300;

	$output = "\n";

	if (is_singular(array('post', 'thegem_news', 'thegem_pf_item', 'product'))) {
		// title
		$og_title = esc_attr(strip_tags(stripslashes($post->post_title)));

		// description
		$og_description = trim($post->post_excerpt) != '' ? trim($post->post_excerpt) : trim($post->post_content);
		$og_description = esc_attr( strip_tags( strip_shortcodes( stripslashes( $og_description ) ) ) );
		$og_description = preg_replace('%\s+%', ' ', $og_description);
		if ($og_description_length)
			$og_description = substr( $og_description, 0, $og_description_length );
		if ($og_description == '')
			$og_description = $og_title;


		// site name
		$og_site_name = get_bloginfo('name');

		// type
		$og_type = 'article';

		// url
		$og_url = get_permalink();

		// image
		$og_image = '';
		$attachment_id = get_post_thumbnail_id($post->ID);
		if ($attachment_id) {
			$post_image = thegem_generate_thumbnail_src($attachment_id, 'thegem-blog-timeline-large');
			if ($post_image && $post_image[0]) {
				$og_image = $post_image[0];
			}
		}


		// Open Graph output
		$output .= '<meta property="og:title" content="'.trim(esc_attr($og_title)).'"/>'."\n";

		$output .= '<meta property="og:description" content="'.trim(esc_attr($og_description)).'"/>'."\n";

		$output .= '<meta property="og:site_name" content="'.trim(esc_attr($og_site_name)).'"/>'."\n";

		$output .= '<meta property="og:type" content="'.trim(esc_attr($og_type)).'"/>'."\n";

		$output .= '<meta property="og:url" content="'.trim(esc_attr($og_url)).'"/>'."\n";

		if (trim($og_image) != '')
			$output .= '<meta property="og:image" content="'.trim(esc_attr($og_image)).'"/>'."\n";

		// Google Plus output
		$output .= "\n";
		$output .= '<meta itemprop="name" content="'.trim(esc_attr($og_title)).'"/>'."\n";

		$output .= '<meta itemprop="description" content="'.trim(esc_attr($og_description)).'"/>'."\n";

		if (trim($og_image) != '')
			$output .= '<meta itemprop="image" content="'.trim(esc_attr($og_image)).'"/>'."\n";
	}

	echo $output;
}

add_action('wp_head', 'thegem_open_graph', 9999);

function thegem_open_graph_namespace($output) {
	if (!stristr($output,'xmlns:og')) {
		$output = $output . ' xmlns:og="http://ogp.me/ns#"';
	}
	if (!stristr($output,'xmlns:fb')) {
		$output=$output . ' xmlns:fb="http://ogp.me/ns/fb#"';
	}
	return $output;
}

add_filter('language_attributes', 'thegem_open_graph_namespace',9999);

/* OPEN GRAPH TAGS FINISH */

/* FONTS */

function thegem_additionals_fonts() {
	$thegem_fonts = apply_filters('thegem_additional_fonts', array());
	$thegem_fonts[] = array(
	'font_name' => 'Montserrat UltraLight',
	'font_url_eot' => THEGEM_THEME_URI . '/fonts/montserrat-ultralight.eot',
	'font_url_svg' => THEGEM_THEME_URI . '/fonts/montserrat-ultralight.svg',
	'font_svg_id' => 'montserratultra_light',
	'font_url_ttf' => THEGEM_THEME_URI . '/fonts/montserrat-ultralight.ttf',
	'font_url_woff' => THEGEM_THEME_URI . '/fonts/montserrat-ultralight.woff',
	);
	$user_fonts = get_option('thegem_additionals_fonts');
	if(is_array($user_fonts)) {
		return array_merge($user_fonts, $thegem_fonts);
	}

	return $thegem_fonts;
}

add_action('template_redirect', 'thegem_redirect_subpage');
function thegem_redirect_subpage() {
	global $post;

	$effects_params = thegem_get_sanitize_page_effects_data(get_the_ID());
	if ($effects_params['redirect_to_subpage']) {
		define('DONOTCACHEPAGE', 1);
		$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
		if (count($pagekids) > 0) {
			$firstchild = $pagekids[0];
			wp_redirect(get_permalink($firstchild->ID));
		}
	}
}


add_filter('vc_google_fonts_get_fonts_filter', 'Vc_Re_Google_Fonts');

if(!function_exists('Vc_Re_Google_Fonts')) {
	function Vc_Re_Google_Fonts() {
		$fontsData = thegem_fonts_list(true);
		$fonts = array();
		foreach($fontsData as $fontData) {
			$font = array(
				'font_family' => $fontData['family'],
			);

			$fontStyles = array();
			$fontTypes = array();

			foreach($fontData['variants'] as $variant) {
				preg_match('%^(\d*)(.*)$%', $variant, $m);
				if ($m[1] == '') {
					$fontStyles[] = $variant;
				}

				if ($m[1] == '') {
					$m[1] = 400;
				}

				$fontTypes [] = $m[1] . ' ' . ($m[2] != '' ? $m[2] : 'regular') . ':' . $m[1] . ':normal';
			}

			$font = new stdClass();
			$font->font_family = $fontData['family'];
			$font->font_styles = implode(',', $fontStyles);
			$font->font_types = implode(',', $fontTypes);

			$fonts[] = $font;
		}

		return $fonts;
	}
}


add_action('init', 'thegem_google_fonts_load_file');
function thegem_google_fonts_load_file() {
	global $thegem_fontsFamilyArray, $thegem_fontsFamilyArrayFull;
	$thegem_fontsFamilyArray = array();
	$thegem_fontsFamilyArrayFull = array();
	$additionals_fonts = thegem_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$thegem_fontsFamilyArray[$additionals_font['font_name']] = $additionals_font['font_name'];
		$thegem_fontsFamilyArrayFull[$additionals_font['font_name']] = array('family' => $additionals_font['font_name'], 'variants' => array('regular'), 'subsets' => array());
	}
	$thegem_fontsFamilyArray = array_merge($thegem_fontsFamilyArray, array(
		'Arial' => 'Arial',
		'Courier' => 'Courier',
		'Courier New' => 'Courier New',
		'Georgia' => 'Georgia',
		'Helvetica' => 'Helvetica',
		'Palatino' => 'Palatino',
		'Times New Roman' => 'Times New Roman',
		'Trebuchet MS' => 'Trebuchet MS',
		'Verdana' => 'Verdana'
	));
	$thegem_fontsFamilyArrayFull = array_merge($thegem_fontsFamilyArrayFull, array(
		'Arial' => array('family' => 'Arial', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier' => array('family' => 'Courier', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Courier New' => array('family' => 'Courier New', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Georgia' => array('family' => 'Georgia', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Helvetica' => array('family' => 'Helvetica', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Palatino' => array('family' => 'Palatino', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Times New Roman' => array('family' => 'Times New Roman', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Trebuchet MS' => array('family' => 'Trebuchet MS', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
		'Verdana' => array('family' => 'Verdana', 'variants' => array('regular', 'italic', '700', '700italic'), 'subsets' => array()),
	));
	$fontsList = false;
	$font_json_file = file_get_contents(get_template_directory() . '/fonts/webfonts.json');
	if($font_json_file !== false) {
		$fontsList = json_decode($font_json_file);
	}
	if(is_object($fontsList) && isset($fontsList->kind) && $fontsList->kind == 'webfonts#webfontList' && isset($fontsList->items) && is_array($fontsList->items)) {
		foreach($fontsList->items as $item) {
			if(is_object($item) && isset($item->kind) && $item->kind == 'webfonts#webfont' && isset($item->family) && is_string($item->family)) {
				$thegem_fontsFamilyArray[$item->family] = $item->family;
				$thegem_fontsFamilyArrayFull[$item->family] = array(
					'family' => $item->family,
					'variants' => $item->variants,
					'subsets' => $item->subsets,
				);
			}
		}
	}
}

function thegem_fonts_list($full = false) {
	global $thegem_fontsFamilyArray, $thegem_fontsFamilyArrayFull;
	if($full) {
		return $thegem_fontsFamilyArrayFull;
	} else {
		return $thegem_fontsFamilyArray;
	}
}

function thegem_get_font_options_list() {
	$options = get_option('thegem_theme_options');
	$options_list = array();
	if(is_array($options)) {
		foreach(array_keys($options) as $option) {
			if(substr($option, -12) === '_font_family') {
				$options_list[] = substr($option, 0, -7);
			}
		}
	}
	return $options_list;
}

function thegem_google_fonts_url() {
	if (class_exists('TheGemGdpr')) {
		if (!TheGemGdpr::getInstance()->is_allow_consent(TheGemGdpr::CONSENT_NAME_GOOGLE_FONTS)) {
			return false;
		}
	}

	$fontsList = thegem_fonts_list(true);
	$fontElements = thegem_get_font_options_list();
	$exclude_array = array('Arial', 'Courier', 'Courier New', 'Georgia', 'Helvetica', 'Palatino', 'Times New Roman', 'Trebuchet MS', 'Verdana');
	$additionals_fonts = thegem_additionals_fonts();
	foreach($additionals_fonts as $additionals_font) {
		$exclude_array[] = $additionals_font['font_name'];
	}
	$fonts = array();
	$variants = array();
	$subsets = array();
	foreach($fontElements as $element) {
		if(($font = thegem_get_option($element.'_family')) && !in_array($font, $exclude_array) && isset($fontsList[$font])) {
			$font = $fontsList[$font];
			if(thegem_get_option($element.'_sets')) {
				$font['subsets'] = thegem_get_option($element.'_sets');
			} else {
				$font['subsets'] = implode(',',$font['subsets']);
			}

			if(!in_array($font['family'], $fonts))
				$fonts[] = $font['family'];

			if(!isset($variants[$font['family']]))
				$variants[$font['family']] = array();

			$tmp = $font['variants'];
			$replace = ['regular' => '400', 'italic' => '400italic'];
			foreach ($tmp as $k => $v) {
				$tmp[$k] = isset($replace[$v]) ? $replace[$v] : $v;
			}

			foreach ($tmp as $v) {
				if(!in_array($v, $variants[$font['family']]))
					$variants[$font['family']][] = $v;
			}

			$tmp = explode(',', $font['subsets']);
			foreach ($tmp as $v) {
				if(!in_array($v, $subsets))
					$subsets[] = $v;
			}
		}
	}
	if(count($fonts) > 0) {
		$inc_fonts = '';
		foreach ($fonts as $k=>$v) {
			if('off' !== _x( 'on', $v.' font: on or off', 'thegem' )) {
				if($k > 0)
					$inc_fonts .= '|';
				$inc_fonts .= $v;
				if(!empty($variants[$v]))
					$inc_fonts .= ':'.implode(',', $variants[$v]);
			}
		}
		$query_args = array(
		'family' => urlencode($inc_fonts),
		'subset' => urlencode(implode(',', $subsets)),
		);
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		return esc_url_raw( $fonts_url );
	}
	return false;
}

function thegem_custom_fonts() {
	$fontElements = thegem_get_font_options_list();
	$additionals_fonts = thegem_additionals_fonts();
	$fonts_array = array();
	foreach($additionals_fonts as $additionals_font) {
		$fonts_array[] = $additionals_font['font_name'];
		$fonts_arrayFull[$additionals_font['font_name']] = $additionals_font;
	}
	$exclude_array = array();
	foreach($fontElements as $element) {
		if(($font = thegem_get_option($element.'_family')) && in_array($font, $fonts_array) && !in_array($font, $exclude_array)) {
			$exclude_array[] = $font;
?>

@font-face {
	font-family: '<?php echo sanitize_text_field($fonts_arrayFull[$font]['font_name']); ?>';
	src: url('<?php echo preg_replace('(^https?:)', '', esc_url($fonts_arrayFull[$font]['font_url_eot'])); ?>');
	src: url('<?php echo preg_replace('(^https?:)', '', esc_url($fonts_arrayFull[$font]['font_url_eot'])); ?>?#iefix') format('embedded-opentype'),
		url('<?php echo preg_replace('(^https?:)', '', esc_url($fonts_arrayFull[$font]['font_url_woff'])); ?>') format('woff'),
		url('<?php echo preg_replace('(^https?:)', '', esc_url($fonts_arrayFull[$font]['font_url_ttf'])); ?>') format('truetype'),
		url('<?php echo preg_replace('(^https?:)', '', esc_url($fonts_arrayFull[$font]['font_url_svg'].'#'.$fonts_arrayFull[$font]['font_svg_id'])); ?>') format('svg');
		font-weight: normal;
		font-style: normal;
}

<?php
		}
	}
}

add_action('wp_ajax_thegem_get_font_data', 'thegem_get_font_data');
function thegem_get_font_data() {
	if(is_array($_REQUEST['fonts'])) {
		$result = array();
		$fontsList = thegem_fonts_list(true);
		foreach ($_REQUEST['fonts'] as $font)
			if(isset($fontsList[$font]))
				$result[$font] = $fontsList[$font];
		echo json_encode($result);
		exit;
	}
	die(-1);
}

/* META BOXES */

if(!function_exists('thegem_print_select_input')) {
function thegem_print_select_input($values = array(), $value = '', $name = '', $id = '') {
	if(!is_array($values)) {
		$values = array();
	}
?>
	<select name="<?php echo esc_attr($name) ?>" id="<?php echo esc_attr($id); ?>" class="thegem-combobox">
		<?php foreach($values as $key => $title) : ?>
			<option value="<?php echo esc_attr($key); ?>" <?php selected($key, $value); ?>><?php echo esc_html($title); ?></option>
		<?php endforeach; ?>
	</select>
<?php
}
}

if(!function_exists('thegem_print_checkboxes')) {
function thegem_print_checkboxes($values = array(), $value = array(), $name = '', $id_prefix = '', $after = '') {
	if(!is_array($values)) {
		$values = array();
	}
	if(!is_array($value)) {
		$value = array();
	}
?>
	<?php foreach($values as $key => $title) : ?>
		<input name="<?php echo esc_attr($name); ?>" type="checkbox" id="<?php echo esc_attr($id_prefix.'-'.$key); ?>" value="<?php echo esc_attr($key); ?>" <?php checked(in_array($key, $value), 1); ?> />
		<label for="<?php echo esc_attr($id_prefix.'-'.$key); ?>"><?php echo esc_html($title); ?></label>
		<?php echo $after; ?>
	<?php endforeach; ?>
<?php
}
}

/* PLUGINS */

if(!function_exists('thegem_is_plugin_active')) {
	function thegem_is_plugin_active($plugin) {
		include_once(ABSPATH . 'wp-admin/includes/plugin.php');
		return is_plugin_active($plugin);
	}
}

/* DROPDOWN MENU */

class thegem_walker_primary_nav_menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu dl-submenu styled\">\n";
	}
}

class thegem_walker_footer_nav_menu extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu styled\">\n";
	}
}

class thegem_walker_menu_mobile_default extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu dl-submenu styled\">\n";
	}
}

function thegem_add_menu_item_classes($classes, $item) {
	$one_pager = false;
	if(is_singular()) {
		$effects_params = thegem_get_sanitize_page_effects_data(get_the_ID());
		$one_pager = $effects_params['effects_one_pager'];
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$page_id = wc_get_page_id('shop');
		$effects_params = thegem_get_sanitize_page_effects_data($page_id);
		$one_pager = $effects_params['effects_one_pager'];
	}
	if(!empty($item->current_item_ancestor) || !empty($item->current_item_parent)) {
		$classes[] = 'menu-item-current';
	}
	if(!empty($item->current) && !$one_pager) {
		$classes[] = 'menu-item-active';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'thegem_add_menu_item_classes', 10, 2);

function thegem_add_menu_parent_class($items) {
	$parents = array();
	foreach($items as $item) {
		if($item->menu_item_parent && $item->menu_item_parent > 0) {
			$parents[] = $item->menu_item_parent;
		}
	}
	foreach($items as $item) {
		if(in_array($item->ID, $parents)) {
			$item->classes[] = 'menu-item-parent';
		}
	}
	return $items;
}
add_filter('wp_nav_menu_objects', 'thegem_add_menu_parent_class');

function thegem_get_data($data = array(), $param = '', $default = '', $prefix = '', $suffix = '') {
	if(is_array($data) && !empty($data[$param])) {
		return $prefix.(nl2br($data[$param])).$suffix;
	}
	if(!empty($default)) {
		return $prefix.$default.$suffix;
	}
	return $default;
}

if(!function_exists('thegem_check_array_value')) {
function thegem_check_array_value($array = array(), $value = '', $default = '') {
	if(in_array($value, $array)) {
		return $value;
	}
	return $default;
}
}

/* PAGE TITLE */
if(!function_exists('thegem_title')) {
function thegem_title($sep = '&raquo;', $display = true, $seplocation = '') {
	global $wpdb, $wp_locale;

	$m = get_query_var('m');
	$year = get_query_var('year');
	$monthnum = get_query_var('monthnum');
	$day = get_query_var('day');
	$search = get_query_var('s');
	$title = '';

	$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

	// If there is a post
	if(is_single() || is_page()) {
		$title = single_post_title('', false);
	}

	// If there's a post type archive
	if(is_post_type_archive()) {
		$post_type = get_query_var('post_type');
		if(is_array($post_type))
			$post_type = reset($post_type);
		$post_type_object = get_post_type_object($post_type);
		if(! $post_type_object->has_archive)
			$title = post_type_archive_title('', false);
	}

	// If there's a category or tag
	if(is_category() || is_tag()) {
		$title = single_term_title('', false);
	}

	// If there's a taxonomy
	if(is_tax()) {
		$term = get_queried_object();
		if($term) {
			$tax = get_taxonomy($term->taxonomy);
			$title = single_term_title('', false);
		}
	}

	// If there's an author
	if(is_author()) {
		$author = get_queried_object();
		if($author)
			$title = $author->display_name;
	}

	// Post type archives with has_archive should override terms.
	if(is_post_type_archive() && $post_type_object->has_archive)
		$title = post_type_archive_title('', false);

	// If there's a month
	if(is_archive() && !empty($m)) {
		$my_year = substr($m, 0, 4);
		$my_month = $wp_locale->get_month(substr($m, 4, 2));
		$my_day = intval(substr($m, 6, 2));
		$title = $my_year . ($my_month ? $t_sep . $my_month : '') . ($my_day ? $t_sep . $my_day : '');
	}

	// If there's a year
	if(is_archive() && !empty($year)) {
		$title = $year;
		if(!empty($monthnum))
			$title .= $t_sep . $wp_locale->get_month($monthnum);
		if(!empty($day))
			$title .= $t_sep . zeroise($day, 2);
	}

	// If it's a search
	if(is_search()) {
		/* translators: 1: separator, 2: search phrase */
		$title = sprintf(wp_kses(__('<span class="light">Search Results</span> <span class="highlight">"%1$s"</span>', 'thegem'), array('span' => array('class' => array()))), strip_tags($search));
	}

	// If it's a 404 page
	if(is_404()) {
		$title = esc_html__('Page not found', 'thegem');
		if(get_post(thegem_get_option('404_page'))) {
			$title = get_the_title(thegem_get_option('404_page'));
		}
	}

	$prefix = '';
	if(!empty($title))
		$prefix = " $sep ";

 	// Determines position of the separator and direction of the breadcrumb
	if('right' == $seplocation) { // sep on right, so reverse the order
		$title_array = explode($t_sep, $title);
		$title_array = array_reverse($title_array);
		$title = implode(" $sep ", $title_array) . $prefix;
	} else {
		$title_array = explode($t_sep, $title);
		$title = $prefix . implode(" $sep ", $title_array);
	}

	/**
	 * Filter the text of the page title.
	 *
	 * @since 2.0.0
	 *
	 * @param string $title	   Page title.
	 * @param string $sep		 Title separator.
	 * @param string $seplocation Location of the separator (left or right).
	 */
	$title = apply_filters('thegem_title', $title, $sep, $seplocation);

	// Send it out
	if($display)
		echo $title;
	else
		return $title;
}
}
if(!function_exists('thegem_page_title')) {
	function thegem_page_title() {
		$output = '';
		$title_classes = [];
		$css_style = '';
		$css_style_title = '';
		$css_title_margin = '';
		$css_style_excerpt = '';
		$video_bg = '';
		$overlay_bg = false;
		$title_show = 1;
		$title_style = 1;
		$page_data = array();
		$parallax_bg = '';
		$parallax_bg_style = '';
		$ken_burns_bg = false;
		$ken_burns_classes = [];
		$ken_burns_style = '';
		$xlarge = '';
		$excerpt = '';
		$rich_title = '';
		ob_start();
		gem_breadcrumbs();
		$breadcrumbs = '<div class="breadcrumbs-container"><div class="container">' . ob_get_clean() . '</div></div>';
		$alignment = 'center';
		if (is_singular() || is_tax() || is_category() || is_tag() || is_search() || is_archive() || is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag') || is_404()) {
			$post_id = 0;
			if (is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) {
				$post_id = wc_get_page_id('shop');
			} elseif (is_404() && get_post(thegem_get_option('404_page'))) {
				$post_id = thegem_get_option('404_page');
			} elseif (is_singular()) {
				global $post;
				$post_id = $post->ID;
			}
			$page_data = thegem_get_output_page_settings($post_id);
			if(function_exists('wc_get_page_id') && thegem_get_option('cart_layout', 'modern') == 'modern') {
				$admin_page_data = thegem_get_sanitize_admin_page_data($post_id);
				if(wc_get_page_id('cart') == $post_id || wc_get_page_id('checkout') == $post_id && thegem_get_option('modern_cart_steps', 1) && thegem_get_option('modern_cart_steps_position', 'content_area') == 'title_area') {
					if($admin_page_data['title_show'] == 'default') {
						$page_data['title_show'] = thegem_get_option('product_title_show');
					}
				}
			}
			if (is_archive() && !$post_id) {
				$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
			}
			if (is_tax() || is_category() || is_tag()) {
				$thegem_term_id = get_queried_object()->term_id;
				if (get_term_meta($thegem_term_id, 'thegem_taxonomy_custom_page_options', true)) {
					$page_data = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
				} else if (!is_tax('product_cat') && !is_tax('product_tag')) {
					$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
				} elseif(is_tax('product_cat') || is_tax('product_tag')) {
					$page_data = thegem_get_output_page_settings(0, array(), 'product_category');
				}
			}

			if (is_search()) {
				$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
			}

			$title_style = $page_data['title_style'];
			$xlarge = $page_data['title_xlarge'];
			if ($page_data['title_rich_content'] && $page_data['title_content']) {
				$rich_title = wpautop(do_shortcode($page_data['title_content']));
			}
			if($page_data['title_background_type']) {
				if($page_data['title_background_type'] == 'image') {
					if ($page_data['title_background_image']) {
						$title_classes[] = 'has-background-image';
					}
					$parallax_bg = $page_data['title_background_effect'] == 'parallax';
					$ken_burns_bg = $page_data['title_background_effect'] == 'ken_burns';
					if ($page_data['title_background_image']) {
						if ($ken_burns_bg) {
							$title_classes[] = 'page-title-ken-burns-block';
						}
						$title_classes[] = 'has-background-image';
					}
					if($page_data['title_background_image_overlay']) {
						$overlay_bg = true;
					}
				} elseif($page_data['title_background_type'] == 'video') {
					$page_data['title_video_overlay_opacity'] = 1;
					$video_bg = thegem_video_background($page_data['title_background_video_type'], $page_data['title_background_video'], $page_data['title_background_video_aspect_ratio'], $page_data['title_menu_on_video'], $page_data['title_background_video_overlay'], 1, $page_data['title_background_video_poster'], $page_data['title_background_video_play_on_mobile']);
				} elseif($page_data['title_background_type'] == 'gradient') {
					$title_classes[] = 'has-background-image';
				}
			} else {
				$parallax_bg = $page_data['title_background_parallax'];
				if ($page_data['title_background_image']) {
					$title_classes[] = 'has-background-image';
				}
				$video_bg = thegem_video_background($page_data['title_video_type'], $page_data['title_video_background'], $page_data['title_video_aspect_ratio'], $page_data['title_menu_on_video'], $page_data['title_video_overlay_color'], $page_data['title_video_overlay_opacity'], $page_data['title_video_poster'], $page_data['title_background_video_play_on_mobile']);
			}
			if ($page_data['title_alignment']) {
				$alignment = $page_data['title_alignment'];
			}
			if ($page_data['title_icon']) {
				$icon_data = array();
				foreach ($page_data as $key => $val) {
					if (strpos($key, 'title_icon') === 0) {
						$icon_data[str_replace('title_icon', 'icon', $key)] = $val;
					}
				}
				if (function_exists('thegem_build_icon_shortcode')) {
					$output .= '<div class="page-title-icon">' . do_shortcode(thegem_build_icon_shortcode($icon_data)) . '</div>';
				}
			}
			$excerpt = nl2br($page_data['title_excerpt']);
			if ($page_data['title_breadcrumbs']) {
				$breadcrumbs = '';
			}
			if(isset($page_data['title_show']) && !$page_data['title_show'] || $page_data['title_style'] == '3') {
				$title_show = 0;
			}
		}
		if (is_search() && !get_option('thegem_options_page_settings_search')) {
			$alignment = 'left';
			$icon_data = array(
				'icon_pack' => 'material',
				'icon' => 'f3de',
				'icon_color' => '#ffffff',
				'icon_size' => 'xlarge',
			);
			if (function_exists('thegem_build_icon_shortcode')) {
				$output .= '<div class="page-title-icon">' . do_shortcode(thegem_build_icon_shortcode($icon_data)) . '</div>';
			}
		}

		if ((is_tax() || is_category() || is_tag()) && !is_tax('product_cat') && !is_tax('product_tag')) {
			if (empty($excerpt)) {
				$term = get_queried_object();
				$excerpt = $term->description;
			}
		}

		$output .= '<div class="page-title-title">' .
			($rich_title ? '<div class="title-rich-content">'.$rich_title.'</div>' : '<h1' . ($xlarge ? ' class="title-xlarge"' : '') . '>' .
			thegem_title('', false) .
			'</' . ($title_style == '2' ? 'h2' : 'h1') . '>') .
			'</div>';
		if ($excerpt) {
			$output .= '<div class="page-title-excerpt styled-subtitle">' . $excerpt . '</div>';
		}
		if($title_show && $title_style == 2 && !empty($page_data['title_template']) && get_post($page_data['title_template']) && !(defined('WPB_VC_VERSION') && (vc_is_frontend_editor() || vc_is_page_editable()))) {
			global $thegem_page_title_template_data;
			$thegem_page_title_template_data = $page_data;
			$thegem_page_title_template_data['main_title'] = thegem_title('', false);
			$thegem_page_title_template_data['breadcrumbs_output'] = $breadcrumbs;
			ob_start();
			get_template_part('title-template');
			$output = ob_get_clean();
			return apply_filters('thegem_page_title', $output, $page_data);
		} elseif ($title_style && $title_show) {

			if ($parallax_bg) {
				wp_enqueue_script('thegem-parallax-vertical');
			}

			if ($ken_burns_bg) {
				wp_enqueue_script('thegem-ken-burns');
				wp_enqueue_style('thegem-ken-burns');

				$ken_burns_classes[] = 'page-title-ken-burns-background';
				$ken_burns_classes[] = 'thegem-ken-burns-bg';
				$ken_burns_classes[] = $page_data['title_background_ken_burns_direction'] == 'zoom_in' ? 'thegem-ken-burns-zoom-in' : 'thegem-ken-burns-zoom-out';
				$ken_burns_style .= ' animation-duration: '.(!empty($page_data['title_background_ken_burns_transition_speed']) ? esc_attr(trim($page_data['title_background_ken_burns_transition_speed'])) : 15000).'ms;';
			}
			$buttons_html = '';
			if($page_data['title_style'] == 2 && !empty($page_data['title_template']) && function_exists('vc_is_page_editable') && vc_is_page_editable()) {
				$buttons_html .= '<div class="edit-template-overlay">';
					$buttons_html .= '<div class="buttons">';
						$buttons_html .= '<a href="';
							$buttons_html .= apply_filters( 'vc_get_inline_url', admin_url('post.php?vc_action=vc_inline&post_id='.$page_data['title_template'].'&post_type=thegem_title'));
						$buttons_html .= '" target="_blank">'.__('Edit Title Area Template', 'thegem').'</a>';
						//$buttons_html .= '<a href="#" target="_blank" class="doc">?</a>';
					$buttons_html .= '</div>';
				$buttons_html .= '</div>';
			}
			return apply_filters('thegem_page_title', '<div id="page-title" class="page-title-block page-title-alignment-' . esc_attr($alignment) . ' page-title-style-' . esc_attr($title_style) . ' ' . esc_attr(implode(' ', $title_classes)) . ($parallax_bg ? ' page-title-parallax-background-wrap' : '') . '">
						'.$buttons_html.'
						'.($parallax_bg ? '<div class="page-title-parallax-background" style="'.$parallax_bg_style.'"></div>': '').'
						'.($ken_burns_bg ? '<div class="'.implode(' ', $ken_burns_classes).'" style="'.$ken_burns_style.'"></div>': '').'
						'.($overlay_bg ? '<div class="page-title-background-overlay"></div>': '').'
						' . $video_bg . '
						<div class="container"><div class="page-title-inner">' . $output . '</div></div>
						' . $breadcrumbs . '
					</div>'.(empty($video_bg) ? '' : thegem_page_title_init_video_bg_script()), $page_data);
		}
		return apply_filters('thegem_page_title', false, $page_data);
	}
}

function thegem_post_type_archive_title($label, $post_type) {
	if($post_type == 'product') {
		$shop_page_id = wc_get_page_id('shop');
		$page_title = get_the_title($shop_page_id);
		return $page_title;
	}
	return $label;
}
add_filter('post_type_archive_title', 'thegem_post_type_archive_title', 10, 2);

add_filter('woocommerce_show_page_title', '__return_false');

/* EXCERPT */

function thegem_excerpt_length($length) {
	return thegem_get_option('excerpt_length') ? intval(thegem_get_option('excerpt_length')) : 20;
}
add_filter('excerpt_length', 'thegem_excerpt_length');

function thegem_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'thegem_excerpt_more');

/* EDITOR */

add_action('admin_init', 'thegem_admin_init');
function thegem_admin_init() {
	add_filter('tiny_mce_before_init', 'thegem_init_editor');
	add_filter('mce_buttons_2', 'thegem_mce_buttons_2');
}

function thegem_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}

if(!function_exists('thegem_init_editor')) {
	function thegem_init_editor($settings) {
		$style_formats = array(
			array(
				'title' => esc_html__('Styled Subtitle', 'thegem'),
				'block' => 'div',
				'classes' => 'styled-subtitle'
			),
			array(
				'title' => esc_html__('Title H1', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h1'
			),
			array(
				'title' => esc_html__('Title H2', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h2'
			),
			array(
				'title' => esc_html__('Title H3', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h3'
			),
			array(
				'title' => esc_html__('Title H4', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h4'
			),
			array(
				'title' => esc_html__('Title H5', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h5'
			),
			array(
				'title' => esc_html__('Title H6', 'thegem'),
				'block' => 'div',
				'classes' => 'title-h6'
			),
			array(
				'title' => esc_html__('XLarge Title', 'thegem'),
				'block' => 'div',
				'classes' => 'title-xlarge'
			),
			array(
				'title' => esc_html__('Letter-spacing Title', 'thegem'),
				'inline' => 'span',
				'classes' => 'letter-spacing'
			),
			array(
				'title' => esc_html__('Light Title', 'thegem'),
				'inline' => 'span',
				'classes' => 'light'
			),
			array(
				'title' => esc_html__('Body small', 'thegem'),
				'block' => 'div',
				'classes' => 'small-body'
			),
		);
		$settings['wordpress_adv_hidden'] = false;
		$settings['style_formats'] = json_encode($style_formats);
		return $settings;
	}
}
/* SOCIALS */

function thegem_socials_icons_list() {
	return apply_filters('thegem_socials_icons_list', array(
		'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'twitter' => 'Twitter', 'instagram' => 'Instagram',
		'pinterest' => 'Pinterest', 'stumbleupon' => 'StumbleUpon', 'rss' => 'RSS',
		'vimeo' => 'Vimeo', 'youtube' => 'YouTube', 'flickr' => 'Flickr', 'tumblr' => 'Tumblr',
		'wordpress' => 'WordPress', 'dribbble' => 'Dribbble', 'deviantart' => 'DeviantArt', 'share' => 'Share',
		'myspace' => 'Myspace', 'skype' => 'Skype', 'picassa' => 'Picassa', 'googledrive' => 'Google Drive',
		'blogger' => 'Blogger', 'spotify' => 'Spotify', 'delicious' => 'Delicious', 'telegram' => 'Telegram',
		'vk' => 'VK', 'whatsapp' => 'WhatsApp', 'viber' => 'Viber', 'ok' => 'OK', 'reddit' => 'Reddit',
		'slack' => 'Slack', 'askfm' => 'ASKfm', 'meetup' => 'Meetup', 'weibo' => 'Weibo', 'qzone' => 'Qzone',
		'tiktok' => 'TikTok', 'soundcloud' => 'SoundCloud', 'discord' => 'Discord'
	));
}
if(!function_exists('thegem_print_socials')) {
	function thegem_print_socials($type = '')
	{
		$socials_icons = array();
		$thegem_socials_icons = thegem_socials_icons_list();
		foreach (array_keys($thegem_socials_icons) as $icon) {
			thegem_additionals_socials_enqueue_style($icon);
			$socials_icons[$icon] = thegem_get_option($icon . '_active');
		}

		if (in_array(1, $socials_icons)) {
			?>
			<div class="socials inline-inside">
				<?php foreach ($socials_icons as $name => $active) : ?>
					<?php if ($active) : ?>
						<a class="socials-item" href="<?php echo esc_url(thegem_get_option($name . '_link')); ?>"
						   target="_blank" title="<?php echo esc_attr($thegem_socials_icons[$name]); ?>"><i
									class="socials-item-icon <?php echo esc_attr($name); ?> <?php echo($type ? 'social-item-' . $type : ''); ?>"></i></a>
					<?php endif; ?>
				<?php endforeach; ?>
				<?php do_action('thegem_print_socials'); ?>

			</div>
			<?php
		}
	}
}

/* PAGINATION */

function thegem_pagination($query = false) {
	if(!$query) {
		$query = $GLOBALS['wp_query'];
	}
	if($query->max_num_pages < 2) {
		return;
	}

	$paged		= (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
	$pagenum_link = html_entity_decode(get_pagenum_link());
	$query_args   = array();
	$url_parts	= explode('?', $pagenum_link);

	if(isset($url_parts[1])) {
		wp_parse_str($url_parts[1], $query_args);
	}

	$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
	$pagenum_link = trailingslashit($pagenum_link) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links(array(
		'base'	 => $pagenum_link,
		'format'   => $format,
		'total'	=> $query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map('urlencode', $query_args),
		'prev_text' => '',
		'next_text' => '',
	));

	if($links) :

	?>
	<div class="gem-pagination"><div class="gem-pagination-links">
		<?php echo $links; ?>
	</div></div><!-- .pagination -->
	<?php
	endif;
}

if(!function_exists('hex_to_rgb')) {
	function hex_to_rgb($color) {
		if(strpos($color, '#') === 0) {
			$color = substr($color, 1);
			if(strlen($color) == 3) {
				return array(hexdec($color[0]), hexdec($color[1]), hexdec($color[2]));
			} elseif(strlen($color) >= 6) {
				return array(hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
			}
		}
		return $color;
	}
}

function thegem_admin_bar_site_menu($wp_admin_bar) {
	if(current_user_can('edit_theme_options')) {
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-root',
			'title' => esc_html__('TheGem Theme Options', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options',
			'parent' => 'thegem-theme-root',
			'title' => esc_html__('Theme Options', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-general',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('General', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/general/theme-layout/panel.layout_style')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-header',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Menu &amp; Header', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/menu-and-header/layout')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-title',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Title Area', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/title-area')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-footer',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Footer', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/footer/layout')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-typography',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Typography', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/typography/headings-and-body')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-colors',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Colors', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/colors/elements')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-posttypes',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('TheGem Posttypes', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/posttypes/portfolio-grids')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-single-pages',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Single Pages', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/single-pages/post')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-archive-pages',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Archive Pages', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/archive-pages/blog')),
		));
		if(defined( 'WC_PLUGIN_FILE')) {
			$wp_admin_bar->add_menu(array(
				'id' => 'thegem-theme-options-woocommerce',
				'parent' => 'thegem-theme-options',
				'title' => esc_html__('WooCommerce', 'thegem'),
				'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/woocommerce/product-layout')),
			));
		}
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-performance',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Performance', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/performance/page-speed')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-contacts',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Contacts &amp; Socials', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/contacts-and-socials/socials')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-custom',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Custom CSS &amp; JS', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/custom-css-js/custom-css')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-extras',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Extras', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/extras')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-options-backup',
			'parent' => 'thegem-theme-options',
			'title' => esc_html__('Backup &amp; Import', 'thegem'),
			'href' => esc_url(admin_url('admin.php?page=thegem-theme-options#/backup')),
		));
		$wp_admin_bar->add_menu(array(
			'id' => 'thegem-theme-templates',
			'parent' => 'thegem-theme-root',
			'title' => esc_html__('Header Builder', 'thegem'),
			'href' => esc_url(admin_url('edit.php?post_type=thegem_templates&templates_type=header')),
		));
		$wp_admin_bar->add_menu(array(
			'id'	=> 'thegem-support-center',
			'parent' => 'thegem-theme-root',
			'title' => esc_html__('Support Center', 'thegem'),
			'href'  => esc_url('https://codexthemes.ticksy.com/'),
			'meta' => array(
				'target' => '_blank',
			)
		));
		$wp_admin_bar->add_menu(array(
			'id'	=> 'thegem-documentation',
			'parent' => 'thegem-theme-root',
			'title' => esc_html__('Documentation', 'thegem'),
			'href'  => esc_url('http://codex-themes.com/thegem/documentation/'),
			'meta' => array(
				'target' => '_blank',
			)
		));
	}
}
add_action('admin_bar_menu', 'thegem_admin_bar_site_menu', 100);

function thegem_wp_toolbar_css_admin() {
	if(is_admin_bar_showing()){
		wp_enqueue_style( 'thegem_wp_toolbar_css', THEGEM_THEME_URI . '/css/thegem-wp-toolbar-link.css', '', THEGEM_THEME_VERSION, 'screen' );
	}
}
add_action( 'admin_enqueue_scripts', 'thegem_wp_toolbar_css_admin' );
add_action( 'wp_enqueue_scripts', 'thegem_wp_toolbar_css_admin' );

if(!function_exists('thegem_user_icons_info_link')) {
function thegem_user_icons_info_link($pack = '') {
	return esc_url(apply_filters('thegem_user_icons_info_link', THEGEM_THEME_URI.'/fonts/icons-list-'.$pack.'.html', $pack));
}
}

/* THUMBNAILS */

function thegem_post_thumbnail($size = 'thegem-post-thumb', $dummy = true, $class='img-responsive img-circle', $attr = '') {
	if (empty($attr)) {
		$attr = array();
	}
	$attr = array_merge($attr, array('class' => $class));

	if (!empty($attr['srcset']) && is_array($attr['srcset'])) {
		$srcset_condtions = array();
		foreach ($attr['srcset'] as $condition => $condition_size) {
			$condition_size_image = thegem_generate_thumbnail_src(get_post_thumbnail_id(), $condition_size, false);
			if ($condition_size_image) {
				$srcset_condtions[] = esc_url($condition_size_image[0]) . ' ' . $condition;
			}
		}
		$attr['srcset'] = implode(', ', $srcset_condtions);
		$attr['sizes'] = '100vw';
	}

	if(has_post_thumbnail()) {
		the_post_thumbnail($size, $attr);
	} elseif($dummy) {
		echo '<span class="gem-dummy '.esc_attr($class).'"></span>';
	}
}

function thegem_attachment_url($attachcment, $size = 'full') {
	if((int)$attachcment > 0 && ($image_url = wp_get_attachment_image_src($attachcment, $size)) !== false) {
		return $image_url[0];
	}
	return false;
}

function thegem_generate_thumbnail_src_old($attachment_id, $size) {
	static $thegem_src_cache = array();

	if (!empty($thegem_src_cache[$attachment_id][$size])) {
		return $thegem_src_cache[$attachment_id][$size];
	}

	if(in_array($size, array_keys(thegem_image_sizes()))) {
		$filepath = get_attached_file($attachment_id);
		$thumbFilepath = $filepath;
		$image = wp_get_image_editor($filepath);
		if(!is_wp_error($image) && $image) {
			$thumbFilepath = $image->generate_filename($size);
			if(!file_exists($thumbFilepath)) {
				$thegem_image_sizes = thegem_image_sizes();
				if(!is_wp_error($image) && isset($thegem_image_sizes[$size])) {
					$image->resize($thegem_image_sizes[$size][0], $thegem_image_sizes[$size][1], $thegem_image_sizes[$size][2]);
					$image = $image->save($image->generate_filename($size));
					do_action('thegem_thumbnail_generated', array('/'._wp_relative_upload_path($thumbFilepath)));
				} else {
					$thumbFilepath = $filepath;
				}
			}
		}
		$image = wp_get_image_editor($thumbFilepath);
		if(!is_wp_error($image) && $image) {
			$upload_dir = wp_upload_dir();
			$sizes = $image->get_size();
			$result = array($upload_dir['baseurl'].'/'._wp_relative_upload_path($thumbFilepath), $sizes['width'], $sizes['height']);
			$thegem_src_cache[$attachment_id][$size] = $result;
			return $result;
		}
	}
	$result = wp_get_attachment_image_src($attachment_id, $size);
	$thegem_src_cache[$attachment_id][$size] = $result;
	return $result;
}

function thegem_get_thumbnail_image($attachment_id, $size, $icon = false, $attr = '') {
	$html = '';
	$image = thegem_generate_thumbnail_src($attachment_id, $size, $icon);
	if($image) {
		list($src, $width, $height) = $image;
		$hwstring = image_hwstring($width, $height);
		if(is_array($size))
			$size = join('x', $size);
		$attachment = get_post($attachment_id);
		$default_attr = array(
			'src' => $src,
			'class' => "attachment-$size",
			'alt' => trim(strip_tags(get_post_meta($attachment_id, '_wp_attachment_image_alt', true))),
		);
		if(empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_excerpt));
		if(empty($default_attr['alt']))
			$default_attr['alt'] = trim(strip_tags($attachment->post_title));

		$attr = wp_parse_args($attr, $default_attr);
		$attr = apply_filters('wp_get_attachment_image_attributes', $attr, $attachment);
		$attr = array_map('esc_attr', $attr);
		$html = rtrim("<img $hwstring");
		foreach ($attr as $name => $value) {
			$html .= " $name=" . '"' . $value . '"';
		}
		$html .= ' />';
	}

	return $html;
}

function thegem_get_the_post_thumbnail($html, $post_id, $post_thumbnail_id, $size, $attr) {
	if(in_array($size, array_keys(thegem_image_sizes()))) {
		if($post_thumbnail_id) {
			do_action('begin_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size);
			if(in_the_loop())
				update_post_thumbnail_cache();
			$html = thegem_get_thumbnail_image($post_thumbnail_id, $size, false, $attr);
			do_action('end_fetch_post_thumbnail_html', $post_id, $post_thumbnail_id, $size);
		} else {
			$html = '';
		}
	}
	return $html;
}
add_filter('post_thumbnail_html', 'thegem_get_the_post_thumbnail', 10, 5);

function thegem_image_sizes() {
	return apply_filters('thegem_image_sizes', array(
		'thegem-post-thumb-large' => array(256, 256, true),
		'thegem-post-thumb-medium' => array(128, 128, true),
		'thegem-post-thumb-small' => array(80, 80, true),

		'thegem-portfolio-justified' => array(844, 767, true),

		'thegem-product-justified-square' => array(767, 767, true),
		'thegem-product-justified-square-double' => array(1534, 1534, true),
		'thegem-product-justified-square-xxs' => array(100, 100, true),
		'thegem-product-justified-square-xs' => array(200, 200, true),
		'thegem-product-justified-square-double-xs' => array(400, 400, true),
		'thegem-product-justified-square-double-vertical-xs'=> array(200, 400, true),
		'thegem-product-justified-square-double-horizontal-xs'=> array(400, 200, true),
		'thegem-product-justified-square-double-page-xs' => array(400, 600, true),
		'thegem-product-justified-square-double-page-vertical-xs'=> array(200, 600, true),
		'thegem-product-justified-square-s' => array(300, 300, true),
		'thegem-product-justified-square-double-s' => array(600, 600, true),
		'thegem-product-justified-square-double-vertical-s'=> array(300, 600, true),
		'thegem-product-justified-square-double-horizontal-s'=> array(600, 300, true),
		'thegem-product-justified-square-double-page-s' => array(600, 800, true),
		'thegem-product-justified-square-double-page-vertical-s'=> array(300, 800, true),
		'thegem-product-justified-square-m' => array(400, 400, true),
		'thegem-product-justified-square-double-m' => array(800, 800, true),
		'thegem-product-justified-square-double-vertical-m'=> array(400, 800, true),
		'thegem-product-justified-square-double-horizontal-m'=> array(800, 400, true),
		'thegem-product-justified-square-double-page-m' => array(800, 1000, true),
		'thegem-product-justified-square-double-page-vertical-m'=> array(400, 1000, true),
		'thegem-product-justified-square-l' => array(500, 500, true),
		'thegem-product-justified-square-double-l' => array(1000, 1000, true),
		'thegem-product-justified-square-double-vertical-l'=> array(500, 1000, true),
		'thegem-product-justified-square-double-horizontal-l'=> array(1000, 500, true),
		'thegem-product-justified-square-double-page-l' => array(1000, 1200, true),
		'thegem-product-justified-square-double-page-vertical-l'=> array(500, 1200, true),
		'thegem-product-justified-square-xl' => array(700, 700, true),
		'thegem-product-justified-square-double-xl' => array(1400, 1400, true),
		'thegem-product-justified-square-double-vertical-xl'=> array(700, 1400, true),
		'thegem-product-justified-square-double-horizontal-xl'=> array(1400, 700, true),
		'thegem-product-justified-square-double-page-xl' => array(1400, 1600, true),
		'thegem-product-justified-square-double-page-vertical-xl'=> array(700, 1600, true),
		'thegem-product-justified-square-xxl' => array(960, 960, true),
		'thegem-product-justified-square-double-xxl' => array(1920, 1920, true),
		'thegem-product-justified-square-double-vertical-xxl'=> array(960, 1920, true),
		'thegem-product-justified-square-double-horizontal-xxl'=> array(1920, 960, true),
		'thegem-product-justified-square-double-page-xxl' => array(1920, 2120, true),
		'thegem-product-justified-square-double-page-vertical-xxl'=> array(960, 2120, true),

		'thegem-product-justified-portrait' => array(767, 959, true),
		'thegem-product-justified-portrait-double' => array(1534, 1918, true),
		'thegem-product-justified-portrait-xxs' => array(100, 125, true),
		'thegem-product-justified-portrait-xs' => array(200, 250, true),
		'thegem-product-justified-portrait-double-xs' => array(400, 500, true),
		'thegem-product-justified-portrait-double-vertical-xs'=> array(200, 500, true),
		'thegem-product-justified-portrait-double-horizontal-xs'=> array(400, 250, true),
		'thegem-product-justified-portrait-double-page-xs' => array(400, 700, true),
		'thegem-product-justified-portrait-double-page-vertical-xs'=> array(200, 700, true),
		'thegem-product-justified-portrait-s' => array(300, 375, true),
		'thegem-product-justified-portrait-double-s' => array(600, 750, true),
		'thegem-product-justified-portrait-double-vertical-s'=> array(300, 750, true),
		'thegem-product-justified-portrait-double-horizontal-s'=> array(600, 375, true),
		'thegem-product-justified-portrait-double-page-s' => array(600, 950, true),
		'thegem-product-justified-portrait-double-page-vertical-s'=> array(300, 950, true),
		'thegem-product-justified-portrait-m' => array(400, 500, true),
		'thegem-product-justified-portrait-double-m' => array(800, 1000, true),
		'thegem-product-justified-portrait-double-vertical-m'=> array(400, 1000, true),
		'thegem-product-justified-portrait-double-horizontal-m'=> array(800, 500, true),
		'thegem-product-justified-portrait-double-page-m' => array(800, 1200, true),
		'thegem-product-justified-portrait-double-page-vertical-m'=> array(400, 1200, true),
		'thegem-product-justified-portrait-l' => array(500, 625, true),
		'thegem-product-justified-portrait-double-l' => array(1000, 1250, true),
		'thegem-product-justified-portrait-double-vertical-l'=> array(500, 1250, true),
		'thegem-product-justified-portrait-double-horizontal-l'=> array(1000, 625, true),
		'thegem-product-justified-portrait-double-page-l' => array(1000, 1450, true),
		'thegem-product-justified-portrait-double-page-vertical-l'=> array(500, 1450, true),
		'thegem-product-justified-portrait-xl' => array(700, 875, true),
		'thegem-product-justified-portrait-double-xl' => array(1400, 1750, true),
		'thegem-product-justified-portrait-double-vertical-xl'=> array(700, 1750, true),
		'thegem-product-justified-portrait-double-horizontal-xl'=> array(1400, 875, true),
		'thegem-product-justified-portrait-double-page-xl' => array(1400, 1950, true),
		'thegem-product-justified-portrait-double-page-vertical-xl'=> array(700, 1950, true),
		'thegem-product-justified-portrait-xxl' => array(960, 1200, true),
		'thegem-product-justified-portrait-double-xxl' => array(1920, 2400, true),
		'thegem-product-justified-portrait-double-vertical-xxl'=> array(960, 2400, true),
		'thegem-product-justified-portrait-double-horizontal-xxl'=> array(1920, 1200, true),
		'thegem-product-justified-portrait-double-page-xxl' => array(1920, 2600, true),
		'thegem-product-justified-portrait-double-page-vertical-xxl'=> array(960, 2600, true),

		'thegem-portfolio-justified-2x' => array(644, 585, true),
		'thegem-portfolio-justified-2x-500' => array(605, 550, true),
		'thegem-portfolio-justified-3x' => array(429, 390, true),
		'thegem-portfolio-justified-4x' => array(321, 292, true),
		'thegem-portfolio-justified-fullwidth-4x' => array(509, 463, true),
		'thegem-portfolio-justified-fullwidth-5x' => array(407, 370, true),

		'thegem-portfolio-masonry-1x' => array(768, 0, true),
		'thegem-portfolio-masonry-2x' => array(644, 0, true),
		'thegem-portfolio-masonry-2x-500' => array(605, 0, true),
		'thegem-portfolio-masonry-3x' => array(429, 0, true),
		'thegem-portfolio-masonry-4x' => array(321, 0, true),
		'thegem-portfolio-masonry-fullwidth-4x' => array(509, 0, true),
		'thegem-portfolio-masonry-fullwidth-5x' => array(407, 0, true),

		'thegem-gallery-justified-2x' => array(644, 585, true),
		'thegem-gallery-justified-2x-500' => array(605, 550, true),
		'thegem-gallery-justified-3x' => array(429, 390, true),
		'thegem-gallery-justified-4x' => array(321, 292, true),
		'thegem-gallery-justified-5x' => array(347, 316, true),
		'thegem-gallery-justified-4x-small' => array(279, 254, true),
		'thegem-gallery-justified-fullwidth-4x' => array(509, 463, true),
		'thegem-gallery-justified-fullwidth-5x' => array(407, 370, true),
		'thegem-gallery-justified-double-4x-set' => array(671, 610, true),
		'thegem-gallery-justified-double-4x-set-horizontal' => array(671, 305, true),
		'thegem-gallery-justified-double-4x-set-vertical' => array(336, 671, true),

		'thegem-gallery-masonry-2x' => array(644, 0, true),
		'thegem-gallery-masonry-2x-500' => array(605, 0, true),
		'thegem-gallery-masonry-3x' => array(429, 0, true),
		'thegem-gallery-masonry-4x' => array(321, 0, true),
		'thegem-gallery-masonry-5x' => array(347, 0, true),
		'thegem-gallery-masonry-4x-small' => array(279, 0, true),
		'thegem-gallery-masonry-fullwidth-4x' => array(509, 0, true),
		'thegem-gallery-masonry-fullwidth-5x' => array(407, 0, true),

		'thegem-blog-masonry-3x' => array(360, 0, true),
		'thegem-blog-masonry-3x-450' => array(450, 0, true),
		'thegem-blog-masonry-3x-600' => array(600, 0, true),

		'thegem-blog-default-large' => array(1170, 540, true),
		'thegem-blog-default-medium' => array(780, 360, true),
		'thegem-blog-default-small' => array(520, 240, true),
		'thegem-blog-timeline' => array(440, 0, true),
		'thegem-blog-timeline-small' => array(370, 0, true),
		'thegem-blog-timeline-large' => array(720, 0, true),
		'thegem-blog-default' => array(1170, 540, true),
		'thegem-blog-justified' => array(640, 480, true),
		'thegem-blog-justified-3x' => array(360, 270, true),
		'thegem-blog-justified-3x-small' => array(320, 240, true),
		'thegem-blog-justified-4x' => array(220, 165, true),
		'thegem-blog-justified-sticky' => array(1280, 960, true),
		'thegem-blog-masonry-100' => array(380, 0, true),
		'thegem-blog-masonry-100-medium' => array(450, 0, true),
		'thegem-blog-masonry-100-small' => array(230, 0, true),
		'thegem-blog-masonry' => array(640, 0, true),
		'thegem-blog-masonry-4x' => array(258, 0, true),
		'thegem-blog-masonry-sticky' => array(1280, 0, true),
		'thegem-blog-compact' => array(366, 296, true),
		'thegem-blog-slider-fullwidth' => array(1170, 525, true),
		'thegem-blog-slider-halfwidth' => array(564, 525, true),

		'thegem-portfolio-double-2x' => array(1287, 1170, true),

		'thegem-portfolio-double-3x' => array(843, 934, true),
		'thegem-portfolio-double-3x-gap-0' => array(858, 948, true),
		'thegem-portfolio-double-3x-gap-18' => array(851, 942, true),
		'thegem-portfolio-double-3x-hover' => array(843, 766, true),
		'thegem-portfolio-double-3x-hover-gap-0' => array(858, 780, true),
		'thegem-portfolio-double-3x-hover-gap-18' => array(851, 774, true),

		'thegem-portfolio-double-4x' => array(620, 732, true),
		'thegem-portfolio-double-4x-gap-0' => array(644, 753, true),
		'thegem-portfolio-double-4x-gap-18' => array(634, 744, true),
		'thegem-portfolio-double-4x-hover' => array(620, 563 , true),
		'thegem-portfolio-double-4x-hover-gap-0' => array(643, 584, true),
		'thegem-portfolio-double-4x-hover-gap-18' => array(634, 575, true),

		'thegem-portfolio-double-100' => array(1056, 960, true),
		'thegem-portfolio-double-100-page' => array(1017, 1094, true),

		'thegem-portfolio-double-100-page-horizontal' => array(1017, 463, true),
		'thegem-portfolio-double-100-page-vertical' => array(602, 1094, true),

		'thegem-portfolio-double-100-horizontal' => array(1284, 585, true),

		'thegem-portfolio-double-2x-horizontal' => array(1287, 585, true),

		'thegem-portfolio-double-3x-horizontal' => array(843, 362, true),
		'thegem-portfolio-double-3x-gap-0-horizontal' => array(843, 390, true),
		'thegem-portfolio-double-3x-gap-18-horizontal' => array(843, 378, true),
		'thegem-portfolio-double-3x-hover-horizontal' => array(843, 362, true),
		'thegem-portfolio-double-3x-hover-gap-0-horizontal' => array(843, 390, true),
		'thegem-portfolio-double-3x-hover-gap-18-horizontal' => array(843, 378, true),

		'thegem-portfolio-double-4x-horizontal' => array(868, 366, true),
		'thegem-portfolio-double-4x-gap-0-horizontal' => array(868, 409, true),
		'thegem-portfolio-double-4x-gap-18-horizontal' => array(868, 391, true),
		'thegem-portfolio-double-4x-hover-horizontal' => array(868, 366, true),
		'thegem-portfolio-double-4x-hover-gap-0-horizontal' => array(868, 409, true),
		'thegem-portfolio-double-4x-hover-gap-18-horizontal' => array(868, 391, true),

		'thegem-portfolio-double-100-vertical' => array(602, 1500, true),

		'thegem-portfolio-double-2x-vertical' => array(644, 1172, true),

		'thegem-portfolio-double-3x-vertical' => array(518, 1212, true),
		'thegem-portfolio-double-3x-gap-0-vertical' => array(558, 1229, true),
		'thegem-portfolio-double-3x-gap-18-vertical' => array(540, 1222, true),
		'thegem-portfolio-double-3x-hover-vertical' => array(518, 995, true),
		'thegem-portfolio-double-3x-hover-gap-0-vertical' => array(558, 1013, true),
		'thegem-portfolio-double-3x-hover-gap-18-vertical' => array(540, 1005, true),

		'thegem-portfolio-double-4x-vertical' => array(373, 952, true),
		'thegem-portfolio-double-4x-gap-0-vertical' => array(380, 983, true),
		'thegem-portfolio-double-4x-gap-18-vertical' => array(399, 965, true),
		'thegem-portfolio-double-4x-hover-vertical' => array(373, 952, true),
		'thegem-portfolio-double-4x-hover-gap-0-vertical' => array(418, 760, true),
		'thegem-portfolio-double-4x-hover-gap-18-vertical' => array(399, 748, true),

		'thegem-portfolio-1x' => array(858, 420, true),
		'thegem-portfolio-1x-sidebar' => array(751, 500, true),
		'thegem-portfolio-1x-hover' => array(1287, 567, true),

		'thegem-portfolio-metro' => array(0, 500, false),
		'thegem-portfolio-metro-large' => array(0, 600, false),
		'thegem-portfolio-metro-medium' => array(0, 300, false),
		'thegem-portfolio-metro-retina' => array(0, 1000, false),

		'thegem-portfolio-masonry' => array(754, 0, false),
		'thegem-portfolio-masonry-double' => array(1508, 0, false),

		'thegem-portfolio-masonry-double-horizontal' => array(1508, 0, false),
		'thegem-portfolio-masonry-double-vertical' => array(754, 0, false),

		'thegem-gallery-justified' => array(660, 600, true),
		'thegem-gallery-justified-double' => array(880, 800, true),
		'thegem-gallery-justified-double-horizontal' => array(880, 400, true),
		'thegem-gallery-justified-double-vertical' => array(440, 870, true),

		'thegem-gallery-justified-100' => array(660, 600, true),
		'thegem-gallery-justified-double-100' => array(1320, 1200, true),
		'thegem-gallery-justified-double-100-horizontal' => array(1320, 600, true),
		'thegem-gallery-justified-double-100-vertical' => array(660, 1200, true),

		'thegem-gallery-justified-double-100-horizontal-4' => array(1019, 464, true),
		'thegem-gallery-justified-double-100-horizontal-5' => array(814, 371, true),
		'thegem-gallery-justified-double-100-horizontal-6' => array(594, 271, true),
		'thegem-gallery-justified-double-100-squared-4' => array(1019, 927, true),
		'thegem-gallery-justified-double-100-squared-5' => array(814, 741, true),
		'thegem-gallery-justified-double-100-squared-6' => array(594, 541, true),
		'thegem-gallery-justified-double-100-vertical-4' => array(510, 928, true),
		'thegem-gallery-justified-double-100-vertical-5' => array(407, 742, true),
		'thegem-gallery-justified-double-100-vertical-6' => array(297, 542, true),

		'thegem-gallery-masonry-double-100-horizontal-4' => array(1019, 0, true),
		'thegem-gallery-masonry-double-100-horizontal-5' => array(814, 0, true),
		'thegem-gallery-masonry-double-100-horizontal-6' => array(594, 0, true),
		'thegem-gallery-masonry-double-100-squared-4' => array(1019, 0, true),
		'thegem-gallery-masonry-double-100-squared-5' => array(814, 0, true),
		'thegem-gallery-masonry-double-100-squared-6' => array(594, 0, true),
		'thegem-gallery-masonry-double-100-vertical-4' => array(510, 0, true),
		'thegem-gallery-masonry-double-100-vertical-5' => array(407, 0, true),
		'thegem-gallery-masonry-double-100-vertical-6' => array(297, 0, true),

		'thegem-gallery-justified-double-4x' => array(766, 697, true),
		'thegem-gallery-justified-double-4x-squared' => array(766, 697, true),
		'thegem-gallery-justified-double-4x-horizontal' => array(766, 349, true),
		'thegem-gallery-justified-double-4x-vertical' => array(383, 697, true),

		'thegem-gallery-masonry-double-4x-squared' => array(766, 0, true),
		'thegem-gallery-masonry-double-4x-horizontal' => array(766, 0, true),
		'thegem-gallery-masonry-double-4x-vertical' => array(383, 0, true),

		'thegem-gallery-masonry' => array(660, 0, false),
		'thegem-gallery-masonry-double' => array(880, 0, false),
		'thegem-gallery-masonry-double-4x' => array(766, 0, true),
		'thegem-gallery-masonry-double-horizontal' => array(880, 0, false),
		'thegem-gallery-masonry-double-vertical' => array(440, 0, false),

		'thegem-gallery-masonry-100' => array(660, 0, false),
		'thegem-gallery-masonry-double-100' => array(1320, 0, false),
		'thegem-gallery-masonry-double-100-horizontal' => array(1320, 0, false),
		'thegem-gallery-masonry-double-100-vertical' => array(660, 0, false),

		'thegem-gallery-metro' => array(0, 500, false),
		'thegem-gallery-metro-medium' => array(0, 300, false),
		'thegem-gallery-metro-retina' => array(0, 1000, false),
		'thegem-gallery-fullwidth' => array(1170, 540, true),
		'thegem-gallery-sidebar' => array(867, 540, true),
		'thegem-gallery-simple' => array(522, 700, true),
		'thegem-gallery-simple-1x' => array(261, 350, true),
		'thegem-person' => array(400, 400, true),
		'thegem-person-80' => array(80, 80, true),
		'thegem-person-160' => array(160, 160, true),
		'thegem-person-240' => array(240, 240, true),
		'thegem-testimonial' => array(400, 400, true),
		'thegem-news-carousel' => array(144, 144, true),
		'thegem-portfolio-carusel-2x' => array(644, 395, true),
		'thegem-portfolio-carusel-3x' => array(473, 290, true),
		'thegem-portfolio-carusel-4x' => array(580, 370, true),
		'thegem-portfolio-carusel-5x' => array(465, 298, true),
		'thegem-portfolio-carusel-full-3x' => array(704, 450, true),
		'thegem-portfolio-carusel-2x-masonry' => array(644, 0, true),
		'thegem-portfolio-carusel-3x-masonry' => array(473, 0, true),
		'thegem-portfolio-carusel-4x-masonry' => array(580, 0, true),
		'thegem-portfolio-carusel-5x-masonry' => array(465, 0, true),
		'thegem-portfolio-carusel-full-3x-masonry' => array(704, 0, true),
		'thegem-widget-column-1x' => array(80, 80, true),
		'thegem-widget-column-2x' => array(160, 160, true),
		'thegem-product-catalog' => array(thegem_get_option('woocommerce_catalog_image_width'), thegem_get_option('woocommerce_catalog_image_height'), true),
		'thegem-product-single' => array(thegem_get_option('woocommerce_product_image_width'), thegem_get_option('woocommerce_product_image_height'), true),
		'thegem-product-single-2x' => array(intval(thegem_get_option('woocommerce_product_image_width'))*2, intval(thegem_get_option('woocommerce_product_image_height'))*2, true),
		'thegem-product-thumbnail' => array(thegem_get_option('woocommerce_thumbnail_image_width'), thegem_get_option('woocommerce_thumbnail_image_height'), true),
		'thegem-product-thumbnail-2x' => array(intval(thegem_get_option('woocommerce_thumbnail_image_width'))*2, intval(thegem_get_option('woocommerce_thumbnail_image_height'))*2, true),
		'thegem-product-thumbnail-vertical' => array(180, 180, true),
		'thegem-product-thumbnail-vertical-2x' => array(180*2, 180*2, true),

		'thegem-news-grid-metro-video' => array(1245, 700, true),

		'thegem-featured-post-slide' => array(1170, 0, false),
		'thegem-featured-post-slide-fullwidth' => array(1920, 0, false),
	));
}

function thegem_remove_generate_thumbnails($metadata, $attachment_id) {
	$filepath = get_attached_file($attachment_id);
	if (!$filepath) {
		return $metadata;
	}

	$regenerated = get_option(thegem_get_image_regenerated_option_key());
	$regenerated = !empty($regenerated) ? (array) $regenerated : array();

	$image_editor = new TheGem_Dummy_WP_Image_Editor($filepath);
	foreach (thegem_image_sizes() as $key => $val) {
		$thumb_filepath = $image_editor->generate_filename($key);
		if (file_exists($thumb_filepath)) {
			unlink($thumb_filepath);
		}
	}

	$regenerated[$attachment_id] = time();
	update_option(thegem_get_image_regenerated_option_key(), $regenerated);

	return $metadata;
}
add_filter('wp_generate_attachment_metadata', 'thegem_remove_generate_thumbnails', 10, 2);

/* FOOTER */

function thegem_is_effects_disabled() {
	$effects_disabled = false;
	if(is_home()) {
		$effects_disabled = thegem_get_option('home_effects_disabled', false);
	} else {
		global $post;
		if(is_object($post)) {
			$thegem_page_data = get_post_meta($post->ID, 'thegem_page_data', true);
		} elseif((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
			$thegem_page_data = get_post_meta(wc_get_page_id('shop'), 'thegem_page_data', true);
		} else {
			$thegem_page_data = null;
		}

		if($thegem_page_data) {
			$effects_disabled = isset($thegem_page_data['effects_disabled']) ? (bool) $thegem_page_data['effects_disabled'] : false;
		}
	}
	return $effects_disabled;
}

function thegem_print_head_script() {
	$effects_disabled = thegem_is_effects_disabled();

	wp_enqueue_script('thegem-settings-init', THEGEM_THEME_URI . '/js/thegem-settings-init.js', false, false, false);
	wp_localize_script('thegem-settings-init', 'gemSettings', array(
		'isTouch' => false,
		'forcedLasyDisabled' => $effects_disabled,
		'tabletPortrait' => thegem_get_option('menu_appearance_tablet_portrait') == 'responsive',
		'tabletLandscape' => thegem_get_option('menu_appearance_tablet_landscape') == 'responsive',
		'topAreaMobileDisable' => thegem_get_option('top_area_disable_mobile') == 'responsive',
		'parallaxDisabled' => false,
		'fillTopArea' => false,
		'themePath' => THEGEM_THEME_URI,
		'rootUrl' => get_site_url(),
		'mobileEffectsEnabled' => thegem_get_option('enable_mobile_lazy_loading') == 1,
		'isRTL' => is_rtl()
	));
}
//add_action('wp_enqueue_scripts', 'thegem_print_head_script', 1);

function thegem_vc_fix_custom_css_position() {
	echo '<script>if(document.querySelector(\'[data-type="vc_custom-css"]\')) {document.head.appendChild(document.querySelector(\'[data-type="vc_custom-css"]\'));}</script>';
}
add_action('wp_head', 'thegem_vc_fix_custom_css_position', 99);

/* FONTS MANAGER */

/* Create fonts manager page */
add_action( 'admin_menu', 'thegem_fonts_manager_add_page', 30);
function thegem_fonts_manager_add_page() {
	$page = add_submenu_page('thegem-dashboard-welcome', esc_html__('Self-Hosted Fonts','thegem'), esc_html__('Self-Hosted Fonts','thegem'), 'edit_theme_options', 'fonts-manager', 'thegem_fonts_manager_page');
	add_action('load-' . $page, 'thegem_fonts_manager_page_prepend');
}

/* Admin theme page scripts & css */
function thegem_fonts_manager_page_prepend() {
	wp_enqueue_media();
	wp_enqueue_script('thegem-file-selector', THEGEM_THEME_URI . '/js/thegem-file-selector.js');
	wp_enqueue_script('thegem-font-manager', THEGEM_THEME_URI . '/js/thegem-font-manager.js');
}

/* Build admin theme page form */
function thegem_fonts_manager_page(){
	$additionals_fonts = get_option('thegem_additionals_fonts');

	$fallback_fonts_elements_list = array();
	$thegem_get_theme_options_fonts = thegem_get_font_options_list();
	foreach ($thegem_get_theme_options_fonts as $item) {
		$fallback_fonts_elements_list[$item]['title'] = thegem_fm_title_converter($item);
		$font_only = true;
		if(!empty(thegem_get_option($item.'_size')) && !empty(thegem_get_option(str_replace('_font', '_line_height', $item)))) {
			$fallback_fonts_elements_list[$item]['font_size'] = thegem_get_option($item.'_size');
			$fallback_fonts_elements_list[$item]['line_height'] = thegem_get_option(str_replace('_font', '_line_height', $item));
			$font_only = false;
		}
		$fallback_fonts_elements_list[$item]['only_font'] = $font_only;
	}
?>

<div class="wrap ui-no-theme">
	<h2><?php esc_html_e('Self-Hosted Fonts', 'thegem'); ?></h2>
	<p><?php esc_html_e('Here you can upload your own font files or google font files on your own server to use it in your website directly. After adding the font files the corresponding fonts will be available for selection in "Fonts" section of Theme Options.', 'thegem'); ?></p>

	<div id="fonts-manager-wrap">
		<div class="font-pane-template">
			<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thegem'); ?></a></div>
			<?php $field_pfx = 'fonts[{{i}}]'; ?>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font name', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_name]" value="" class="field-font-name" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file EOT url', 'thegem'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_eot]" value="" data-type="application/vnd.ms-fontobject" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file SVG url', 'thegem'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_svg]" value="" data-type="image/svg+xml" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('ID inside SVG', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_svg_id]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file TTF url', 'thegem'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_ttf]" value="" data-type="application/x-font-ttf" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Font file WOFF url', 'thegem'); ?></label></div>
				<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_woff]" value="" data-type="application/x-font-woff" /></div>
			</div>

			<?php if (class_exists('TheGemGdpr')): ?>
				<div class="field field-fallback-fonts">
					<div class="field-fallback-checkbox">
						<input type="hidden" name="<?php echo $field_pfx; ?>[font_is_fallback]" value="">
						<input type="checkbox" class="input-checkbox-is-fallback">
						<label for=""><?php esc_html_e('Use as a fallback font for privacy settings.', 'thegem'); ?></label>
					</div>
					<p><?php esc_html_e('if google fonts are disabled by website visitor in privacy preferences', 'thegem'); ?></p>

					<div class="fallback-fonts-elements-box hide">
						<div class="fallback-fonts-elements-add">
							<select>
								<option value=""></option>
								<?php foreach ($fallback_fonts_elements_list as $k=>$v): ?>
									<option value="<?php echo $k; ?>"
											<?php echo ($v['only_font'] ? 'data-font-only="'.$v['only_font'].'"':''); ?>
											<?php echo (!empty($v['font_size']) ? 'data-font-size="'.$v['font_size'].'"':''); ?>
											<?php echo (!empty($v['line_height']) ? 'data-line-height="'.$v['line_height'].'"':''); ?>
											><?php echo $v['title']; ?></option>
								<?php endforeach; ?>
							</select>
							<button class="button" type="button">+</button>
						</div>
						<div class="fallback-fonts-elements-items-box">
							<?php $field_el_pfx = 'fonts[{{i}}][font_fallback_elements][{{el}}]'; ?>
							<div class="fallback-fonts-elements-item">
								<div class="fallback-fonts-elements-item-header">
									<div class="fallback-fonts-elements-item-title">
										<label></label>
										<input type="hidden" name="<?php echo $field_el_pfx; ?>[name]">
									</div>
									<button type="button" class="button"><?php esc_html_e('Remove', 'thegem'); ?></button>
								</div>
								<div class="fallback-fonts-elements-item-body">
									<div class="fallback-fonts-elements-item-field">
										<label for=""><?php esc_html_e('Font Size', 'thegem'); ?></label>
										<div class="fixed-number">
											<input class="fonts-elements-item-font-size" name="<?php echo $field_el_pfx; ?>[font_size]" value="14" data-min-value="10" data-max-value="100" type="number">
										</div>
									</div>
									<div class="fallback-fonts-elements-item-field">
										<label for=""><?php esc_html_e('Line Height', 'thegem'); ?></label>
										<div class="fixed-number">
											<input class="fonts-elements-item-line-height" name="<?php echo $field_el_pfx; ?>[line_height]" value="25" data-min-value="10" data-max-value="150" type="number">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<form id="fonts-manager-form" method="POST" enctype="multipart/form-data">
			<div class="fonts-manager-form-fields">
		<?php if(is_array($additionals_fonts)) : ?>
					<?php foreach($additionals_fonts as $key_font=>$font) : ?>
						<div class="font-pane" data-item="<?php echo $key_font; ?>">
					<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thegem'); ?></a></div>
							<?php $field_pfx = 'fonts['.$key_font.']'; ?>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font name', 'thegem'); ?></label></div>
								<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_name]" value="<?php echo esc_attr($font['font_name']); ?>" class="field-font-name" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file EOT url', 'thegem'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_eot]" value="<?php echo esc_attr($font['font_url_eot']); ?>" data-type="application/vnd.ms-fontobject" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file SVG url', 'thegem'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_svg]" value="<?php echo esc_attr($font['font_url_svg']); ?>" data-type="image/svg+xml" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('ID inside SVG', 'thegem'); ?></label></div>
								<div class="input"><input type="text" name="<?php echo $field_pfx; ?>[font_svg_id]" value="<?php echo esc_attr($font['font_svg_id']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file TTF url', 'thegem'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_ttf]" value="<?php echo esc_attr($font['font_url_ttf']); ?>" data-type="application/x-font-ttf" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Font file WOFF url', 'thegem'); ?></label></div>
								<div class="file_url"><input type="text" name="<?php echo $field_pfx; ?>[font_url_woff]" value="<?php echo esc_attr($font['font_url_woff']); ?>" data-type="application/x-font-woff" /></div>
					</div>

							<?php if (class_exists('TheGemGdpr')): ?>
								<div class="field field-fallback-fonts">
									<div class="field-fallback-checkbox">
										<?php $font_is_fallback = !empty($font['font_is_fallback']) ? $font['font_is_fallback'] : null;  ?>
										<input type="hidden" name="<?php echo $field_pfx; ?>[font_is_fallback]" value="<?php echo esc_attr($font_is_fallback); ?>">
										<input type="checkbox" class="input-checkbox-is-fallback" <?php checked(esc_attr($font_is_fallback)); ?>>
										<label for=""><?php esc_html_e('Use as a fallback font for privacy settings.', 'thegem'); ?></label>
									</div>
									<p><?php esc_html_e('if google fonts are disabled by website visitor in privacy preferences', 'thegem'); ?></p>

									<div class="fallback-fonts-elements-box <?php echo (empty($font['font_is_fallback']) ? 'hide' : ''); ?>">
										<div class="fallback-fonts-elements-add">
											<select>
												<option value=""></option>
												<?php foreach ($fallback_fonts_elements_list as $k=>$v): ?>
													<option value="<?php echo $k; ?>"
														<?php echo ($v['only_font'] ? 'data-font-only="'.$v['only_font'].'"':''); ?>
														<?php echo (!empty($v['font_size']) ? 'data-font-size="'.$v['font_size'].'"':''); ?>
														<?php echo (!empty($v['line_height']) ? 'data-line-height="'.$v['line_height'].'"':''); ?>
													><?php echo $v['title']; ?></option>
												<?php endforeach; ?>
											</select>
											<button class="button" type="button">+</button>
										</div>
										<div class="fallback-fonts-elements-items-box">
											<?php if (!empty($font['font_fallback_elements'])): ?>
												<?php foreach ($font['font_fallback_elements'] as $el_key=>$fallback_element): ?>
													<?php $field_el_pfx = $field_pfx.'[font_fallback_elements]['.$el_key.']'; ?>
													<div class="fallback-fonts-elements-item" data-id="<?php echo esc_attr($fallback_element['name']); ?>">
														<div class="fallback-fonts-elements-item-header">
															<div class="fallback-fonts-elements-item-title">
																<label><?php echo esc_attr($fallback_fonts_elements_list[$fallback_element['name']]['title']) ?></label>
																<input type="hidden" name="<?php echo $field_el_pfx; ?>[name]" value="<?php echo esc_attr($fallback_element['name']); ?>">
															</div>
															<button type="button" class="button"><?php esc_html_e('Remove', 'thegem'); ?></button>
														</div>
														<?php if (!empty($fallback_element['font_size']) && !empty($fallback_element['line_height'])): ?>
															<div class="fallback-fonts-elements-item-body">
																<div class="fallback-fonts-elements-item-field">
																	<label for=""><?php esc_html_e('Font Size', 'thegem'); ?></label>
																	<div class="fixed-number">
																		<input type="number" name="<?php echo $field_el_pfx; ?>[font_size]" value="<?php echo esc_attr($fallback_element['font_size']); ?>" data-min-value="10" data-max-value="100">
																	</div>
																</div>
																<div class="fallback-fonts-elements-item-field">
																	<label for=""><?php esc_html_e('Line Height', 'thegem'); ?></label>
																	<div class="fixed-number">
																		<input type="number" name="<?php echo $field_el_pfx; ?>[line_height]" value="<?php echo esc_attr($fallback_element['line_height']); ?>" data-min-value="10" data-max-value="150">
																	</div>
																</div>
															</div>
														<?php endif; ?>
													</div>
												<?php endforeach; ?>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="add-new"><a href="javascript:void(0);"><?php esc_html_e('Upload new font file', 'thegem'); ?></a></div>
			<div class="submit"><button name="action" value="save" type="submit" class="button button-primary"><?php esc_html_e('Save', 'thegem'); ?></button></div>
	</form>
	</div>
</div>

<?php
}

function thegem_fm_title_converter($str) {
	$result = ucwords(implode(' ', explode("_", $str)));

	return $result;
}

/* Update fonts manager */
add_action('admin_menu', 'thegem_fonts_manager_update');
function thegem_fonts_manager_update() {
	if(isset($_GET['page']) && $_GET['page'] == 'fonts-manager') {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
			if(isset($_REQUEST['fonts']) && is_array($_REQUEST['fonts'])) {
				$fonts = $_REQUEST['fonts'];

				foreach($fonts as $key=>&$font) {
					if(!$font['font_name']) {
						unset($fonts[$key]);
					}

					if (!$font['font_is_fallback']) {
						unset($font['font_fallback_elements']);
					}
				}
				update_option('thegem_additionals_fonts', $fonts);
			} else {
				update_option('thegem_additionals_fonts', array());
			}

			wp_redirect(esc_url(admin_url('admin.php?page=fonts-manager')));
		}
	}
}

/* SOCIALS MANAGER */

/* Create fonts manager page */
add_action( 'admin_menu', 'thegem_socials_manager_add_page');
function thegem_socials_manager_add_page() {
	$page = add_submenu_page(NULL, esc_html__('Add new social network','thegem'), '', 'edit_theme_options', 'socials-manager', 'thegem_socials_manager_page');
	add_action('load-' . $page, 'thegem_socials_manager_page_prepend');
}

/* Admin theme page scripts & css */
function thegem_socials_manager_page_prepend() {
	wp_enqueue_script('thegem-font-manager', THEGEM_THEME_URI . '/js/thegem-socials-manager.js');
}

/* Build admin theme page form */
function thegem_socials_manager_page(){
	add_thickbox();
	wp_enqueue_style('icons-elegant');
	wp_enqueue_style('icons-material');
	wp_enqueue_style('icons-fontawesome');
	wp_enqueue_style('icons-thegemdemo');
	wp_enqueue_style('icons-thegem-header');
	wp_enqueue_style('icons-userpack');
	wp_enqueue_script('thegem-icons-picker');
	$additionals_socials = get_option('thegem_additionals_socials');
?>
<div class="wrap">

	<h2><?php esc_html_e('Add new social network', 'thegem'); ?></h2>
	<p><?php esc_html_e('Here you can add new social networks, which are not included per default in TheGem\'s theme options. Define ID, name, icon pack, icon and color. By clicking on "Save" this network will appear in "Theme Options - Contacts & Socials".', 'thegem'); ?></p>
	<p><?php esc_html_e('By clicking on "Save" these networks will be added to the list of social networks available for teams, top area, footer, social network widget etc.', 'thegem'); ?></p>

	<form id="socials-manager-form" method="POST">
		<div class="social-pane empty" style="display: none;">
			<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thegem'); ?></a></div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Social network ID', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[id][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Social network name', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[name][]" value="" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Icon pack', 'thegem'); ?></label></div>
				<div class="icon-pack-select"><?php thegem_print_select_input(thegem_icon_packs_select_array(), '', 'socials[icon_pack][]', ''); ?></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Default icon', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Rounded icon', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[rounded_icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Squared icon', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[squared_icon][]" value="" class="icons-picker" data-iconpack="elegant" /></div>
			</div>
			<div class="field">
				<div class="label"><label for=""><?php esc_html_e('Color', 'thegem'); ?></label></div>
				<div class="input"><input type="text" name="socials[color][]" value="" class="color-picker" /></div>
			</div>
		</div>
		<?php if(is_array($additionals_socials)) : ?>
			<?php foreach($additionals_socials as $additionals_social) : ?>
				<div class="social-pane">
					<div class="remove"><a href="javascript:void(0);"><?php esc_html_e('Remove', 'thegem'); ?></a></div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Social network ID', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[id][]" value="<?php echo esc_attr($additionals_social['id']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Social network name', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[name][]" value="<?php echo esc_attr($additionals_social['name']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Icon pack', 'thegem'); ?></label></div>
						<div class="icon-pack-select"><?php thegem_print_select_input(thegem_icon_packs_select_array(), $additionals_social['icon_pack'], 'socials[icon_pack][]', ''); ?></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Default icon', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[icon][]" value="<?php echo esc_attr($additionals_social['icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Rounded icon', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[rounded_icon][]" value="<?php echo esc_attr($additionals_social['rounded_icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Squared icon', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[squared_icon][]" value="<?php echo esc_attr($additionals_social['squared_icon']); ?>" class="icons-picker" data-iconpack="<?php echo esc_attr($additionals_social['icon_pack']); ?>" /></div>
					</div>
					<div class="field">
						<div class="label"><label for=""><?php esc_html_e('Color', 'thegem'); ?></label></div>
						<div class="input"><input type="text" name="socials[color][]" value="<?php echo esc_attr($additionals_social['color']); ?>" class="color-picker" /></div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php endif; ?>
		<div class="add-new"><a href="javascript:void(0);"><?php esc_html_e('+ Add new', 'thegem'); ?></a></div>
		<div class="submit"><button name="action" value="save"><?php esc_html_e('Save', 'thegem'); ?></button></div>
	</form>

</div>

<?php
}

/* Update socials manager */
add_action('admin_menu', 'thegem_socials_manager_update');
function thegem_socials_manager_update() {
	if(isset($_GET['page']) && $_GET['page'] == 'socials-manager') {
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'save') {
			if(isset($_REQUEST['socials']['id']) && is_array($_REQUEST['socials']['id'])) {
				$socials = array();
				foreach($_REQUEST['socials']['id'] as $key => $value) {
					$socials[$key] = array(
						'id' => sanitize_title($value),
						'name' => !empty($_REQUEST['socials']['name'][$key]) ? esc_html($_REQUEST['socials']['name'][$key]) : '',
						'icon_pack' => !empty($_REQUEST['socials']['icon_pack'][$key]) ? thegem_check_array_value(array('elegant', 'material', 'fontawesome', 'thegemdemo', 'userpack'), $_REQUEST['socials']['icon_pack'][$key], 'elegant') : 'elegant',
						'icon' => !empty($_REQUEST['socials']['icon'][$key]) ? esc_html($_REQUEST['socials']['icon'][$key]) : '',
						'rounded_icon' => !empty($_REQUEST['socials']['rounded_icon'][$key]) ? esc_html($_REQUEST['socials']['rounded_icon'][$key]) : '',
						'squared_icon' => !empty($_REQUEST['socials']['squared_icon'][$key]) ? esc_html($_REQUEST['socials']['squared_icon'][$key]) : '',
						'color' => !empty($_REQUEST['socials']['color'][$key]) ? esc_html($_REQUEST['socials']['color'][$key]) : '',
					);
				}
				foreach($socials as $key => $social) {
					if(!$social['id']) {
						unset($socials[$key]);
					}
				}
				update_option('thegem_additionals_socials', $socials);
			}
			wp_redirect(esc_url(admin_url('?page=socials-manager')));
		}
	}
}

/* Add icons to list */
function thegem_socials_icons_list_additionals($socials) {
	return array_merge($socials, thegem_additionals_socials_list('names'));
}
add_filter('thegem_socials_icons_list', 'thegem_socials_icons_list_additionals');

function thegem_additionals_socials_list($array_type = 'full') {
	$socials = array();
	$additionals_socials = get_option('thegem_additionals_socials');
	if(!empty($additionals_socials) && is_array($additionals_socials)) {
		foreach($additionals_socials as $social) {
			if(!empty($social['id'])) {
				if($array_type == 'names') {
					$socials[$social['id']] = $social['name'];
				} elseif($array_type == 'ids') {
					$socials[] = $social['id'];
				} else {
					$socials[$social['id']] = array(
						'name' => !empty($social['name']) ? esc_html($social['name']) : '',
						'icon_pack' => !empty($social['icon_pack']) ? thegem_check_array_value(array('elegant', 'material', 'fontawesome', 'thegemdemo', 'userpack'), $social['icon_pack'], 'elegant') : 'elegant',
						'icon' => !empty($social['icon']) ? esc_html($social['icon']) : '',
						'rounded_icon' => !empty($social['rounded_icon']) ? esc_html($social['rounded_icon']) : '',
						'squared_icon' => !empty($social['squared_icon']) ? esc_html($social['squared_icon']) : '',
						'color' => !empty($social['color']) ? esc_html($social['color']) : '',
					);
				}
			}
		}
	}
	return $socials;
}

function thegem_additionals_socials_enqueue_style($social) {
	if(in_array($social, thegem_additionals_socials_list('ids'))) {
		$additionals_socials = thegem_additionals_socials_list('full');
		$social_data = $additionals_socials[$social];
		wp_enqueue_style('icons-'.$social_data['icon_pack']);
	}
}

function thegem_get_social_font_family($selected) {
	$fonts_array = array(
		'elegant' => 'ElegantIcons',
		'material' => 'MaterialDesignIcons',
		'fontawesome' => 'FontAwesome',
		'thegemdemo' => 'Additional',
		'userpack' => 'UserPack',
	);
	$font_family = isset($fonts_array[$selected]) ? $fonts_array[$selected] : 'ElegantIcons';
	return $font_family;
}

/* LAYERSLIDER SKIN */

if(thegem_is_plugin_active('LayerSlider/layerslider.php') && class_exists('LS_Sources')) {
	LS_Sources::addSkins(get_template_directory().'/ls_skin/');
}

/* JS Composer colums new grid */

function thegem_vc_base_register_front_css() {
	wp_register_style('thegem_js_composer_front', THEGEM_THEME_URI . '/css/thegem-js_composer_columns.css', array('js_composer_front'), THEGEM_THEME_VERSION);
	add_action('wp_enqueue_scripts', 'thegem_vc_enqueueStyle_columns');
}
add_action('vc_base_register_front_css', 'thegem_vc_base_register_front_css');

function thegem_vc_enqueueStyle_columns() {
	$post = get_post();
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$post = get_post(thegem_get_option('404_page'));
	}
	if($post && preg_match( '/vc_row/', $post->post_content)) {
		wp_enqueue_style('thegem_js_composer_front');
	}
}

/* JS Composer scripts */

function thegem_additional_js_composer_backend_scripts() {
	wp_register_script('thegem-vc-backend-js', THEGEM_THEME_URI . '/js/thegem-js-composer-backend.js', array('vc-backend-actions-js'), THEGEM_THEME_VERSION, true);
}
add_action( 'add_meta_boxes', 'thegem_additional_js_composer_backend_scripts', 6);

function thegem_vc_backend_editor_enqueue_js_css() {
	wp_enqueue_script('thegem-vc-backend-js');
}
add_action( 'vc_backend_editor_enqueue_js_css', 'thegem_vc_backend_editor_enqueue_js_css');

function check_add_breadcrumbs_woocommerce_shop() {
	if(  function_exists ( "is_woocommerce" ) && is_woocommerce()){
			return true;
	}
	$woocommerce_keys   =   array ( "woocommerce_shop_page_id" ,
									"woocommerce_terms_page_id" ,
									"woocommerce_cart_page_id" ,
									"woocommerce_checkout_page_id" ,
									"woocommerce_pay_page_id" ,
									"woocommerce_thanks_page_id" ,
									"woocommerce_myaccount_page_id" ,
									"woocommerce_edit_address_page_id" ,
									"woocommerce_view_order_page_id" ,
									"woocommerce_change_password_page_id" ,
									"woocommerce_logout_page_id" ,
									"woocommerce_lost_password_page_id" ) ;
	foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
				return true ;
		}
	}
	return false;
}

/*breadcrumbs*/
if(!function_exists('gem_breadcrumbs')) {
	function gem_breadcrumbs($new = false)
	{
		$text['home'] = esc_html__('Home', 'thegem');
		$text['category'] = esc_html__('Blog Category', 'thegem');
		$text['search'] = esc_html__('Search Results', 'thegem');
		$text['tag'] = esc_html__('Tag', 'thegem');
		$text['author'] = esc_html__('Posts by', 'thegem');
		$text['404'] = esc_html__('404', 'thegem');
		$text['page'] = '%s';
		$text['cpage'] = esc_html__('Comment %s', 'thegem');

		$show_home_link = 1;
		$show_on_home = 0;
		$show_title = 1;
		$show_current = 1;

		if ($new) {
			$delimiter = '';
			$delim_before = '';
			$delim_after = '';
			$before = '<li>';
			$after = '</li>';
			$link_before = '<li>';
			$link_after = '</li>';
			$link_attr = '';
			$link_in_before = '';
			$link_in_after = '';
		} else {
			$delimiter = '<span class="bc-devider"></span>';
			$delim_before = '<span class="divider">';
			$delim_after = '</span>';
			$before = '<span class="current">';
			$after = '</span>';
			$link_before = '<span>';
			$link_after = '</span>';
			$link_attr = ' itemprop="url"';
			$link_in_before = '<span itemprop="title">';
			$link_in_after = '</span>';
		}

		global $post;
		$home_link = home_url('/');
		$link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
		$frontpage_id = get_option('page_on_front');
		$thisPostID = get_the_ID();
		$parent_id = wp_get_post_parent_id($thisPostID);
		$delimiter = ' ' . $delim_before . $delimiter . $delim_after . ' ';

		if (is_home() || is_front_page()) {

			if ($show_on_home == 1) {
				if ($new) {
					echo '<ul class="breadcrumbs"><li><a href="' . esc_url($home_link) . '">' . $text['home'] . '</a></li></ul>';
				} else {
					echo '<div class="breadcrumbs"><a href="' . esc_url($home_link) . '">' . $text['home'] . '</a></div>';
				}
			}

		} else {

			if ($new) {
				echo '<ul>';
			} else {
				echo '<div class="breadcrumbs">';
			}
			if ($show_home_link == 1) echo sprintf($link, esc_url($home_link), $text['home']);

			if (is_category()) {
				$cat = get_category(get_query_var('cat'), false);

				if ($cat->parent != 0) {
					$cats = get_category_parents($cat->parent, TRUE, $delimiter);
					$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					if ($show_home_link == 1) echo $delimiter;
					echo $cats;
				}

				if (get_query_var('paged')) {
					$cat = $cat->cat_ID;
					echo $delimiter . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {
					if ($show_current == 1) echo $delimiter . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
				}

			} elseif (is_tax()) {
				if ($show_home_link == 1) echo $delimiter;
				$tax = get_queried_object();
				if((is_tax('product_cat') || is_tax('product_tag'))) {
					$tax_data = thegem_get_output_page_settings(0, array(), 'product_category');
					if(get_term_meta($tax->term_id , 'thegem_taxonomy_custom_page_options', true)) {
						$tax_data = $thegem_effects_params = thegem_get_output_page_settings($tax->term_id, array(), 'term');
					}
					$show_shop = $new ? !empty($tax_data['page_layout_breadcrumbs_shop_category']) : !empty($tax_data['title_breadcrumbs_shop_category']);
					if($show_shop) {
						echo sprintf($link, get_permalink(get_option('woocommerce_shop_page_id', 0)), esc_html__('Shop', 'thegem')); echo $delimiter;
					}
				}
				if ($tax->parent != 0) {
					$terms = get_term_parents_list($tax->parent, $tax->taxonomy, array('link' => TRUE, 'separator' => $delimiter));
					$terms = preg_replace("#^(.+)$delimiter$#", "$1", $terms);
					$terms = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $terms);
					if ($show_title == 0) $terms = preg_replace('/ title="(.*?)"/', '', $terms);
					echo $terms; echo $delimiter;
				}
				if ($show_current == 1) echo $before . $tax->name . $after;

			} elseif (is_search()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . sprintf($text['search'], get_search_query()) . $after;
			} elseif (is_day()) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F')) . $delimiter;
				echo $before . get_the_time('d') . $after;

			} elseif (is_month()) {
				if ($show_home_link == 1) echo $delimiter;
				echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
				echo $before . get_the_time('F') . $after;

			} elseif (is_year()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . get_the_time('Y') . $after;

			} elseif (is_single() && !is_attachment()) {
				if ($show_home_link == 1) echo $delimiter;
				if (get_post_type() != 'post') {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					$post_type = get_post_type_object(get_post_type());
					if (get_post_type() == 'product') {
						$post_data = thegem_get_output_page_settings(get_the_ID());
						$show_shop = $new ? !empty($post_data['page_layout_breadcrumbs_shop_category']) : !empty($post_data['title_breadcrumbs_shop_category']);
						if($show_shop) {
							echo sprintf($link, get_permalink(get_option('woocommerce_shop_page_id', 0)), esc_html__('Shop', 'thegem')); echo $delimiter;
						}
						$cat = get_the_terms( get_the_ID(), 'product_cat' );
						if(!empty($cat)){
							$cat = $cat[0];
							$cat_args = array(
								'separator' => $delimiter,
								'link'      => TRUE,
							);
							$cats = get_term_parents_list($cat, 'product_cat', $cat_args );
							$cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
							$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
							if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
							echo $cats;
						}
					} elseif (get_post_type() == 'thegem_pf_item' && thegem_get_option('portfolio_archive_page') && $page = get_page(thegem_get_option('portfolio_archive_page'))) {
						printf($link, get_permalink($page->ID), $page->post_title);
					} elseif ($post_type->has_archive) {
						$slug = $post_type->rewrite;
						printf($link, trailingslashit($home_link) . $slug['slug'] . '/', $post_type->labels->singular_name);
					} else {
						echo $link_before . $link_in_before . $post_type->labels->singular_name . $link_in_after . $link_after;
					}
					if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;
				} else {
					$cat = get_the_category();
					if(!empty($cat)) {
						$cat = $cat[0];
						$cats = get_category_parents($cat, TRUE, $delimiter);
						if ($show_current == 0 || get_query_var('cpage')) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
						$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
						if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
						echo $cats;
					}
					if (get_query_var('cpage')) {
						echo $delimiter . sprintf($link, get_permalink(), get_the_title()) . $delimiter . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
					} else {
						if ($show_current == 1) echo $before . get_the_title() . $after;
					}

				}


// custom post type

			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404() && have_posts()) {
				$post_type = get_post_type_object(get_post_type());
				if (get_query_var('paged')) {
					echo $delimiter . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $delimiter . $before . sprintf($text['page'], get_query_var('paged')) . $after;
				} else {

					if ($show_current == 1) echo $delimiter . $before . $post_type->label . $after;
				}
			} elseif (is_attachment()) {
				if ($show_home_link == 1) echo $delimiter;
				$parent = get_post($parent_id);
				$cat = get_the_category($parent->ID);
				$cat = $cat[0];
				if ($cat) {
					$cats = get_category_parents($cat, TRUE, $delimiter);
					$cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
					if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);
					echo $cats;
				}
				printf($link, get_permalink($parent), $parent->post_title);
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_page() && !$parent_id) {
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_page() && $parent_id) {
				if ($show_home_link == 1) echo $delimiter;
				if ($parent_id != $frontpage_id) {
					$breadcrumbs = array();
					while ($parent_id) {
						$page = get_page($parent_id);
						if ($parent_id != $frontpage_id) {
							$breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
						}
						$parent_id = $page->post_parent;
					}
					$breadcrumbs = array_reverse($breadcrumbs);
					for ($i = 0; $i < count($breadcrumbs); $i++) {
						echo $breadcrumbs[$i];
						if ($i != count($breadcrumbs) - 1) echo $delimiter;
					}
				}
				if ($show_current == 1) echo $delimiter . $before . get_the_title() . $after;

			} elseif (is_tag()) {
				if ($show_current == 1) echo $delimiter . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;

			} elseif (is_author()) {
				if ($show_home_link == 1) echo $delimiter;
				global $author;
				$author = get_userdata($author);
				echo $before . sprintf($text['author'], $author->display_name) . $after;

			} elseif (is_404()) {
				if ($show_home_link == 1) echo $delimiter;
				echo $before . $text['404'] . $after;
			} elseif (has_post_format() && !is_singular()) {
				if ($show_home_link == 1) echo $delimiter;
				echo get_post_format_string(get_post_format());
			}

			if ($new) {
				echo '</ul><!-- .breadcrumbs -->';
			} else {
				echo '</div><!-- .breadcrumbs -->';
			}

		}
	}
}


function thegem_default_avatar ($avatar_defaults) {
	$myavatar = THEGEM_THEME_URI . '/images/default-avatar.png';
	$avatar_defaults[$myavatar] = esc_html__('The Gem Avatar', 'thegem');
	$myavatar2 = THEGEM_THEME_URI . '/images/avatar-1.jpg';
	$avatar_defaults[$myavatar2] = esc_html__('The Gem Avatar 2', 'thegem');
	return $avatar_defaults;
}
add_filter( 'avatar_defaults', 'thegem_default_avatar' );


/* ADDITIONL MENU ITEMS */
function thegem_menu_item_search($items, $args){
	if($args->menu_id == 'primary-menu' && !thegem_get_option('hide_search_icon')) {
		$menu_item_class = '';
		$minisearch_class= '';
		if (thegem_get_option('header_layout') == 'default' || thegem_get_option('header_layout') == 'overlay') {
			if (thegem_get_option('website_search_layout') == 'fullscreen') {
				$menu_item_class = 'menu-item-fullscreen-search';
				if (thegem_get_option('mobile_menu_layout') == 'overlay') {
					$menu_item_class .= ' menu-item-fullscreen-search-mobile';
				}
			}
		}
		$product_search = '';
		if (thegem_is_plugin_active('woocommerce/woocommerce.php') && thegem_get_option('website_search_post_type_products') == '1') {
			$product_search = '<input type="hidden" name="post_type" value="product" />';
		}
		$items .= '<li class="menu-item menu-item-search '.$menu_item_class.'"><a href="#"></a><div class="minisearch '.$minisearch_class.'"><form role="search" id="searchform" class="sf" action="'. esc_url( home_url( '/' ) ) .'" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="'.esc_html__('Search...', 'thegem').'" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value="">'.$product_search.'</form></div></li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thegem_menu_item_search', 10, 2);

function thegem_fullscreen_search_body_class( $classes ) {
	if (!thegem_get_option('hide_search_icon') &&
		((thegem_get_option('header_layout') == 'default' && thegem_get_option('website_search_layout') == 'fullscreen') ||
			(thegem_get_option('header_layout') == 'overlay' && thegem_get_option('website_search_layout') == 'fullscreen' ) ||
			(thegem_get_option('mobile_menu_layout') == 'overlay'))
	) {
		$classes[] = 'fullscreen-search';
	}
	return $classes;
}
add_filter( 'body_class','thegem_fullscreen_search_body_class' );

function thegem_fullscreen_search_layout($params = false) {
	if (!$params) {
		$params = array(
			'search_id' => 'header-search',
			'search_ajax' => thegem_get_option('website_search_ajax'),
			'post_type_products' => thegem_get_option('website_search_post_type_products'),
			'products_auto_suggestions' => thegem_get_option('website_search_products_auto_suggestions'),
			'post_type_posts' => thegem_get_option('website_search_post_type_posts'),
			'posts_auto_suggestions' => thegem_get_option('website_search_posts_auto_suggestions'),
			'post_type_portfolio' => thegem_get_option('website_search_post_type_portfolio'),
			'portfolio_auto_suggestions' => thegem_get_option('website_search_portfolio_auto_suggestions'),
			'post_type_pages' => thegem_get_option('website_search_post_type_pages'),
			'pages_auto_suggestions' => thegem_get_option('website_search_pages_auto_suggestions'),
			'layout_fullscreen_placeholder_text' => thegem_get_option('website_search_layout_fullscreen_placeholder_text'),
			'popular' => thegem_get_option('website_search_popular'),
			'popular_title' => thegem_get_option('website_search_popular_title'),
			'select_terms_data' => json_decode(thegem_get_option('website_search_select_terms_data')),
		);

		$thegem_page_id = is_singular() ? get_the_ID() : 0;
		$thegem_shop_page = 0;
		if (is_404() && get_post(thegem_get_option('404_page'))) {
			$thegem_page_id = thegem_get_option('404_page');
		}
		if (is_post_type_archive('product') && function_exists('wc_get_page_id')) {
			$thegem_page_id = wc_get_page_id('shop');
			$thegem_shop_page = 1;
		}
		$thegem_effects_params = thegem_get_output_page_settings($thegem_page_id);
		if ((is_archive() || is_home()) && !$thegem_shop_page) {
			if (is_tax('product_cat') || is_tax('product_tag')) {
				$thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('product_categories'), 'product_category');
			} else {
				$thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
			}
		}
		if (is_tax() || is_category() || is_tag()) {
			$thegem_term_id = get_queried_object()->term_id;
			if (get_term_meta($thegem_term_id, 'thegem_taxonomy_custom_page_options', true)) {
				$thegem_effects_params = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
			}
		}
		if (is_search()) {
			$thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
		}

		if ($thegem_effects_params['effects_hide_header']) {
			return;
		}
	}

	$ajax_data = '';
	if ($params['search_ajax'] == '1') {
		$post_types_arr = [];
		$post_types_ppp_arr = [];
		if (thegem_is_plugin_active('woocommerce/woocommerce.php') && $params['post_type_products'] == '1') {
			array_push($post_types_arr, 'product');
			array_push($post_types_ppp_arr, $params['products_auto_suggestions']);
		}
		if ($params['post_type_posts'] == '1') {
			array_push($post_types_arr, 'post');
			array_push($post_types_ppp_arr, $params['posts_auto_suggestions']);
		}
		if ($params['post_type_portfolio'] == '1') {
			array_push($post_types_arr, 'thegem_pf_item');
			array_push($post_types_ppp_arr, $params['portfolio_auto_suggestions']);
		}
		if ($params['post_type_pages'] == '1') {
			array_push($post_types_arr, 'page');
			array_push($post_types_ppp_arr, $params['pages_auto_suggestions']);
		}
		$post_types = json_encode($post_types_arr);
		$post_types_ppp = json_encode($post_types_ppp_arr);
		$ajax_data = 'data-post-types="' . esc_attr($post_types) . '" data-post-types-ppp="' . esc_attr($post_types_ppp) . '"';
	}

	if ($params['search_id'] == 'header-search') { ?>
		<div id="ajax-search-params" <?php echo $ajax_data; ?>></div>
		<?php
		$ajax_data = '';
		if (thegem_get_option('hide_search_icon') ||
			!((thegem_get_option('header_layout') == 'default' && thegem_get_option('website_search_layout') == 'fullscreen') ||
				(thegem_get_option('header_layout') == 'overlay' && thegem_get_option('website_search_layout') == 'fullscreen') ||
				(thegem_get_option('mobile_menu_layout') == 'overlay'))
		) {
			return;
		}
	}

	if ($params['search_ajax'] == '1') {
		if (thegem_get_option('product_archive_preset_type') == 'on_image') {
			$hover_effect = thegem_get_option('product_archive_image_hover_effect_image');
			$caption_position = 'image';
			$preset = 'image-' . thegem_get_option('product_archive_preset_on_image');
		} else if (thegem_get_option('product_archive_preset_type') == 'below') {
			$hover_effect = thegem_get_option('product_archive_image_hover_effect_page');
			$caption_position = 'page';
			$preset = 'below-' . thegem_get_option('product_archive_preset_below');
		} else {
			$hover_effect = thegem_get_option('product_archive_image_hover_effect_hover');
			$caption_position = 'hover';
			$preset = 'hover-' . thegem_get_option('product_archive_preset_on_hover');
		}
		$theme_url = THEGEM_THEME_URI;
		$styles_arr[] = $theme_url . '/css/thegem-portfolio.css';
		$styles_arr[] = $theme_url . '/css/thegem-woocommerce.css';
		$styles_arr[] = $theme_url . '/css/thegem-woocommerce-temp.css';
		$styles_arr[] = $theme_url . '/css/thegem-portfolio-products-extended.css';
		$styles_arr[] = $theme_url . '/css/thegem-hovers.css';
		$styles_arr[] = $theme_url . '/css/hovers/thegem-hovers-' . $hover_effect . '.css';
		$styles_arr[] = $theme_url . '/css/thegem-news-grid.css';
		$styles = htmlspecialchars(json_encode($styles_arr), ENT_QUOTES, 'UTF-8');
	} ?>
	<div class="thegem-fullscreen-search <?php echo $params['search_ajax'] == '1' ? 'ajax-search' : ''; ?>"
		 data-id="<?php echo esc_attr($params['search_id']); ?>" <?php echo $ajax_data; ?>>
		<form role="search" class="searchform sf" action="<?php echo esc_url(home_url('/')); ?>"
			  method="GET">
			<input class="thegem-fullscreen-searchform-input sf-input" type="text"
				   placeholder="<?php echo esc_attr($params['layout_fullscreen_placeholder_text']); ?>"
				   name="s" data-styles="<?php echo esc_attr($styles); ?>">
			<?php if (thegem_is_plugin_active('woocommerce/woocommerce.php') && $params['post_type_products'] == '1') { ?>
				<input type="hidden" name="post_type" value="product" />
			<?php } ?>
			<div class="sf-close"></div>
		</form>
		<div class="search-scroll">
			<?php if ($params['popular'] == '1') { ?>
				<div class="top-searches">
					<div class="container">
						<div class="top-search-text"><?php echo esc_html($params['popular_title']); ?></div>
						<?php
						$search_terms = $params['select_terms_data'];
						foreach ($search_terms as $search_term) {
							$search_term = (array)$search_term; ?>
							<a class="top-search-item"
							   href="<?php echo esc_url(home_url('/')); ?>?s=<?php echo esc_attr($search_term['title']) ?>"
							   data-search="<?php echo esc_attr($search_term['title']) ?>"><?php echo esc_attr($search_term['title']) ?></a>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
			<div class="sf-result">
				<div class="result-sections"></div>
			</div>
		</div>

	</div>
	<?php
}

function thegem_get_fullscreen_search_layout() {
	$thegem_page_id = is_singular() ? get_the_ID() : 0;
	$thegem_shop_page = 0;
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$thegem_page_id = thegem_get_option('404_page');
	}
	if(is_post_type_archive('product') && function_exists('wc_get_page_id')) {
		$thegem_page_id = wc_get_page_id('shop');
		$thegem_shop_page = 1;
	}
	$header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_page_id);
	if((is_archive() || is_home()) && !$thegem_shop_page) {
		if(is_tax('product_cat') || is_tax('product_tag')) {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('product_categories'), 'product_category');
		} else {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
		}
	}
	if(is_tax() || is_category() || is_tag()) {
		$thegem_term_id = get_queried_object()->term_id;
		if(get_term_meta($thegem_term_id , 'thegem_taxonomy_custom_page_options', true)) {
			$header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
		}
	}
	if (is_search()) {
		$header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
	}
	if ($header_params['header_source'] !== 'builder' && !thegem_get_option('hide_search_icon') && !is_singular('thegem_templates') &&
	    ((thegem_get_option('header_layout') == 'default' && thegem_get_option('website_search_layout') == 'fullscreen') ||
	     (thegem_get_option('header_layout') == 'overlay' && thegem_get_option('website_search_layout') == 'fullscreen' ) ||
	     (thegem_get_option('mobile_menu_layout') == 'overlay') ||
	     thegem_get_option('website_search_ajax') == '1')) {
		thegem_fullscreen_search_layout();
	}
}
add_action( 'wp_footer', 'thegem_get_fullscreen_search_layout', 100 );

function thegem_pages_search_filter($query) {
	if ( !is_admin() && $query->is_main_query() ) {
		if ($query->is_search && isset($_GET['post_type']) && $_GET['post_type'] == 'page') {
			$query->set('post_type', 'page');
		}
		if (is_category() && thegem_get_option('blog_layout_type') == 'grid' && !empty(thegem_get_option('blog_layout_pagination_items_per_page'))) {
			$query->set( 'posts_per_page', thegem_get_option('blog_layout_pagination_items_per_page') );
		}
		if ($query->is_search  && thegem_get_option('search_layout_type') == 'grid') {
			$query->set( 'posts_per_page', thegem_get_option('search_layout_pagination_items_per_page') );
		}
		if ($query->is_search && (empty(get_query_var('post_type')) || get_query_var('post_type') == 'any')) {
			$query->set('post_type', thegem_get_search_post_types_array());
		}
		if (absint($query->query_vars['s'])) {
			$query->set('p', $query->query_vars['s']);
			$query->set('s', '');
		}
	}
}

add_action('pre_get_posts','thegem_pages_search_filter');

function thegem_ajax_search_mini() {
	$search = $_POST['search'];
	$post_types = $_POST['post_types'];
	$post_types_ppp = $_POST['post_types_ppp'];
	$has_result = false;

	ob_start();?>

	<div class="scroll-block">
		<?php foreach ($post_types as $key => $post_type) {
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $post_types_ppp[$key],
			);

			if (absint($search)) {
				$args['p'] = $search;
			} else {
				$args['s'] = $search;
			}

			$posts = new WP_Query( $args );

			if ( $posts->have_posts() )  {
				$has_result = true; ?>
				<div class="search-results-section search-results-<?php echo esc_attr($post_type); ?>">
					<?php
					while ( $posts->have_posts() ) {
						$posts->the_post(); ?>
						<div class="ajax-search-item">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<a href="<?php the_permalink() ?>">
									<div class="thumbnail">
										<?php thegem_post_thumbnail('thegem-post-thumb', true, '', array('srcset' => array('1x' => 'thegem-post-thumb-small', '2x' => 'thegem-post-thumb-medium', '3x' => 'thegem-post-thumb-large'))); ?>
									</div>
									<div>
										<?php the_title();
										if ($post_type === 'product') {
											woocommerce_template_loop_price();
										}
										?>
									</div>
								</a>
							</article>
						</div>
					<?php }
					?>
				</div>
			<?php }
		}

		if (!$has_result) { ?>
			<div class="search-results-section search-results-nothing">
				<div class="ajax-search-item">
					<svg enable-background="new 0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m15.5 14 5 5-1.5 1.5-5-5v-.8l-.3-.3c-1.1 1-2.6 1.6-4.2 1.6-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5c0 1.6-.6 3.1-1.6 4.2l.3.3zm-6 0c2.5 0 4.5-2 4.5-4.5s-2-4.5-4.5-4.5-4.5 2-4.5 4.5 2 4.5 4.5 4.5m1.4-2.4-1.4-1.4-1.4 1.4-.7-.7 1.4-1.4-1.4-1.4.7-.7 1.4 1.4 1.4-1.4.7.7-1.4 1.4 1.4 1.4z"/></svg>
					<?php esc_html_e( 'Nothing found...', 'thegem' ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php $content = ob_get_clean();



	echo $content;
	die();

}
add_action('wp_ajax_nopriv_thegem_ajax_search_mini', 'thegem_ajax_search_mini');
add_action('wp_ajax_thegem_ajax_search_mini', 'thegem_ajax_search_mini');

function thegem_ajax_search_form() {
	$search = $_POST['search'];
	$post_types = $_POST['post_types'];
	$post_types_ppp = $_POST['post_types_ppp'];
	$product_category = $_POST['product_category'];
	$result_title = $_POST['result_title'];
	$show_all_text = $_POST['show_all_text'];
	$has_result = false;

	ob_start();?>

	<div class="scroll-block">
		<?php foreach ($post_types as $key => $post_type) {
			$args = array(
				'post_type' => $post_type,
				'post_status' => 'publish',
				'posts_per_page' => $post_types_ppp[$key],
			);

			if (absint($search)) {
				$args['p'] = $search;
			} else {
				$args['s'] = $search;
			}

			if ($post_type === 'product' && $product_category != '') {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'slug',
						'terms' => $product_category
					)
				);
			}
			$posts = new WP_Query( $args );

			if ($posts->have_posts()) {
				$has_result = true; ?>
				<div class="search-results-section search-results-<?php echo esc_attr($post_type); ?>">
					<div class="title title-h6 light"><?php echo $result_title[$key]; ?></div>
					<div class="result-items">
						<?php while ($posts->have_posts()) {
							$posts->the_post(); ?>
							<div class="ajax-search-item">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<a href="<?php the_permalink() ?>">
										<?php if ($post_type !== 'page') { ?>
											<div class="thumbnail">
												<?php thegem_post_thumbnail('thegem-post-thumb', true, '', array('srcset' => array('1x' => 'thegem-post-thumb-small', '2x' => 'thegem-post-thumb-medium', '3x' => 'thegem-post-thumb-large'))); ?>
											</div>
										<?php } ?>
										<div>
											<div class="post-title">
												<?php
												if ($post_type === 'page') {
													echo '<span class="arrow"></span> ';
												}
												the_title(); ?>
											</div>
											<?php
											if ($post_type === 'product') {
												woocommerce_template_loop_price();
												?>
												<div class="post-meta">
													<?php
													$product_categories = get_the_terms(get_the_ID(), 'product_cat');
													if ($product_categories) {
														foreach ($product_categories as $i => $term) {
															echo $term->name;
															if ($i + 1 !== count($product_categories)) {
																echo ',';
															}
														}
													} ?>
												</div>
												<?php
											}
											if ($post_type === 'post') { ?>
												<div class="post-meta">
													<?php
													echo get_the_date('M j, Y');

													$post_categories = wp_get_post_categories(get_the_ID(), array('fields' => 'names'));
													if ($post_categories) {
														echo ' ' . __('in', 'thegem') . ' ';
														foreach ($post_categories as $i => $name) {
															echo $name;
															if ($i + 1 !== count($post_categories)) {
																echo ',';
															}
														}
													} ?>
												</div>
											<?php } ?>
										</div>
									</a>
								</article>
							</div>
						<?php } ?>
					</div>
					<div class="show-all">
						<a href="<?php echo esc_html(get_site_url().'?s='.$search.'&post_type='.$post_type) ?>"><?php echo '<span class="arrow"></span> ' . $show_all_text . ' (' . $posts->found_posts . ')'; ?></a>
					</div>
				</div>
			<?php }
		}

		if (!$has_result) { ?>
			<div class="search-results-section search-results-nothing">
				<div class="ajax-search-item">
					<svg enable-background="new 0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m15.5 14 5 5-1.5 1.5-5-5v-.8l-.3-.3c-1.1 1-2.6 1.6-4.2 1.6-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5c0 1.6-.6 3.1-1.6 4.2l.3.3zm-6 0c2.5 0 4.5-2 4.5-4.5s-2-4.5-4.5-4.5-4.5 2-4.5 4.5 2 4.5 4.5 4.5m1.4-2.4-1.4-1.4-1.4 1.4-.7-.7 1.4-1.4-1.4-1.4.7-.7 1.4 1.4 1.4-1.4.7.7-1.4 1.4 1.4 1.4z"/></svg>
					<?php esc_html_e( 'Nothing found...', 'thegem' ); ?>
				</div>
			</div>
		<?php } ?>
	</div>
	<?php $content = ob_get_clean();

	echo $content;
	die();
}
add_action('wp_ajax_nopriv_thegem_ajax_search_form', 'thegem_ajax_search_form');
add_action('wp_ajax_thegem_ajax_search_form', 'thegem_ajax_search_form');

function thegem_ajax_search() {
	$search = $_POST['search'];
	$post_types = $_POST['post_types'];
	$post_types_ppp = $_POST['post_types_ppp'];
	$has_result = false;

	ob_start();

	foreach ($post_types as $key => $post_type) {
		$args = array(
			'post_type' => $post_type,
			'post_status' => 'publish',
			'posts_per_page' => $post_types_ppp[$key],
		);

		if (absint($search)) {
			$args['p'] = $search;
		} else {
			$args['s'] = $search;
		}

		$posts = new WP_Query( $args );

		if ( $posts->have_posts() )  {
			$has_result = true; ?>
			<div class="search-results-section search-results-<?php echo esc_attr($post_type); ?>">
				<?php if ($post_type === 'product') {
					thegem_woocommerce_search_grid_content($posts);
				} else if ($post_type === 'post') { ?>
					<div class="container">
						<h2><span class="light"><?php esc_html_e(thegem_get_option('website_search_posts_result_title')); ?></span></h2>
					</div>
					<?php thegem_ajax_search_posts_content($posts); ?>
				<?php } else if ($post_type === 'thegem_pf_item') { ?>
					<div class="container">
						<h2><span class="light"><?php esc_html_e(thegem_get_option('website_search_portfolio_result_title')); ?></span></h2>
					</div>
					<?php thegem_ajax_search_portfolios_content($posts); ?>
				<?php } else { ?>
					<div class="container">
						<h2><span class="light"><?php esc_html_e(thegem_get_option('website_search_pages_result_title') ); ?></span></h2>
					</div>
					<div class="pages-list">
						<?php
						while ( $posts->have_posts() ) {
							$posts->the_post(); ?>
							<div class="page-item col-xs-12 col-sm-4 col-md-3">
								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<a href="<?php the_permalink() ?>">
										<div class="title title-h6">
											<?php the_title(); ?>
										</div>
									</a>
								</article>
							</div>
						<?php }
						?>
					</div>
				<?php } ?>
				<div class="search-results-bottom">
					<div class="container">
						<a class="view-all gem-button gem-button-size-small gem-button-style-flat" href="<?php echo esc_html(get_site_url().'?s='.$search.'&post_type='.$post_type) ?>"><?php echo esc_html(thegem_get_option('website_search_view_results_button_text')) ?></a>
					</div>
				</div>
			</div>
		<?php }
	}

	if (!$has_result) { ?>
		<div class="search-results-section search-results-nothing">
			<div class="container">
				<svg enable-background="new 0 0 24 24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m15.5 14 5 5-1.5 1.5-5-5v-.8l-.3-.3c-1.1 1-2.6 1.6-4.2 1.6-3.6 0-6.5-2.9-6.5-6.5s2.9-6.5 6.5-6.5 6.5 2.9 6.5 6.5c0 1.6-.6 3.1-1.6 4.2l.3.3zm-6 0c2.5 0 4.5-2 4.5-4.5s-2-4.5-4.5-4.5-4.5 2-4.5 4.5 2 4.5 4.5 4.5m1.4-2.4-1.4-1.4-1.4 1.4-.7-.7 1.4-1.4-1.4-1.4.7-.7 1.4 1.4 1.4-1.4.7.7-1.4 1.4 1.4 1.4z"/></svg>
				<h2><?php echo wp_kses(__( '<span class="light">Nothing</span> Found', 'thegem' ), array('span' => array('class' => array()))); ?></h2>
				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'thegem' ); ?></p>
			</div>
		</div>
	<?php }

	$content = ob_get_clean();

	echo $content;
	die();

}
add_action('wp_ajax_nopriv_thegem_ajax_search', 'thegem_ajax_search');
add_action('wp_ajax_thegem_ajax_search', 'thegem_ajax_search');

function search_grid_load_more_callback() {
	$settings = isset($_POST['data']) ? json_decode(stripslashes($_POST['data']), true) : array();
	ob_start();
	$response = array('status' => 'success');
	$page = isset($settings['more_page']) ? intval($settings['more_page']) : 1;
	if ($page == 0)
		$page = 1;
	$args = array(
		'post_type' => $settings['post_type'],
		'post_status' => 'publish',
		'orderby' => $settings['orderby'] == 'date' ? '' : $settings['orderby'],
		'order' => $settings['order'],
		'paged' => $page,
		'posts_per_page' => $settings['items_per_page'],
		's' => $settings['search'],
	);
	$search_grid_loop = new WP_Query( $args );
	if ($search_grid_loop->max_num_pages > $page)
		$next_page = $page + 1;
	else
		$next_page = 0;
	?>

	<div data-page="<?php echo $page; ?>" data-next-page="<?php echo $next_page; ?>" data-pages-count="<?php echo esc_attr($search_grid_loop->max_num_pages); ?>">
		<?php
		$item_classes = get_thegem_extended_blog_render_item_classes($settings);
		$thegem_sizes = get_thegem_extended_blog_render_item_image_sizes($settings);
		while ($search_grid_loop->have_posts()) : $search_grid_loop->the_post();
			echo thegem_extended_blog_render_item($settings, $item_classes, $thegem_sizes, get_the_ID());
		endwhile; ?>
	</div>
	<?php $response['html'] = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	$response['args'] = json_encode($args);
	$response = json_encode($response);
	header("Content-Type: application/json");
	echo $response;
	exit;
}

add_action('wp_ajax_search_grid_load_more', 'search_grid_load_more_callback');
add_action('wp_ajax_nopriv_search_grid_load_more', 'search_grid_load_more_callback');

function thegem_get_search_post_types_array($without_products = false) {
	$post_types_arr = [];
	$post_types = get_post_types(array('exclude_from_search' => false));

	foreach ( $post_types  as $post_type ) {
		if ($post_type == 'product' && !$without_products && thegem_is_plugin_active('woocommerce/woocommerce.php') && thegem_get_option('website_search_post_type_products') == '1') {
			$post_types_arr[] = 'product';
		} else if ($post_type == 'post' && thegem_get_option('website_search_post_type_posts') == '1') {
			$post_types_arr[] = 'post';
		} else if ($post_type == 'thegem_pf_item' && thegem_get_option('website_search_post_type_portfolio') == '1') {
			$post_types_arr[] = 'thegem_pf_item';
		} else if ($post_type == 'page' && thegem_get_option('website_search_post_type_pages') == '1') {
			$post_types_arr[] = 'page';
		} else {
			$post_types_arr[] = $post_type;
		}
	}
	return $post_types_arr;
}

function thegem_ajax_search_posts_content($news_grid_loop = array()) {

	$params = array(
		'layout' => 'justified',
		'categories' => array('0'),
		'columns' => '100%',
		'fullwidth_columns' => '5',
		'caption_container_preset' => 'white',
		'display_titles' => 'page',
		'version' => 'new',
		'gaps_size' => '21',
		'hide_date' => '',
		'disable_socials' => '1',
		'hide_comments' => '1',
		'hide_categories' => '',
		'hide_author' => '',
		'hide_author_avatar' => '',
		'blog_show_description' => '1',
		'ignore_highlights' => '1',
		'search_post' => '1',
		'loading_animation' => 'disabled',
	);

	if ($news_grid_loop->have_posts()) :

		$item_classes = get_thegem_extended_blog_render_item_classes($params);
		$thegem_sizes = get_thegem_extended_blog_render_item_image_sizes($params);
		?>
		<div class="portfolio-preloader-wrapper">

			<?php $portfolio_classes = array(
				'portfolio portfolio-grid news-grid no-padding disable-isotope columns-4',
				'portfolio-style-' . $params['layout'],
				'background-style-' . $params['caption_container_preset'],
				'hover-none',
				'title-on-' . $params['display_titles'],
				'version-' . $params['version'],
				'hover-' . $params['version'] . '-' . $params['image_hover_effect'],
				($params['columns'] == '100%' ? 'fullwidth-columns fullwidth-columns-' . $params['columns_100'] : ''),
			);
			?>

			<div class="<?php echo esc_attr(implode(' ', $portfolio_classes)) ?>">
				<div class="portfolio-row-outer <?php if ($params['columns'] == '100%'): ?>fullwidth-block no-paddings<?php endif; ?>">
					<div class="row portfolio-row">
						<div class="portfolio-set clearfix">
							<?php
							while ($news_grid_loop->have_posts()) : $news_grid_loop->the_post();
								if(class_exists('WPBMap') && method_exists('WPBMap', 'addAllMappedShortcodes')) {
									WPBMap::addAllMappedShortcodes();
								}
								echo thegem_extended_blog_render_item($params, $item_classes, $thegem_sizes, get_the_ID());
							endwhile; ?>
						</div><!-- .portflio-set -->
					</div><!-- .row-->
				</div><!-- .full-width -->
			</div><!-- .portfolio-->
		</div><!-- .portfolio-preloader-wrapper-->

	<?php endif;
	wp_reset_postdata();
}

function thegem_ajax_search_portfolios_content($portfolios_grid_loop = array()) {

	$params = array(
		'layout' => 'justified',
		'content_portfolios_cat' => array('0'),
		'columns' => '100%',
		'columns_100' => '5',
		'caption_container_preset' => 'white',
		'display_titles' => 'page',
		'gaps_size' => '21',
		'ignore_highlights' => '1',
		'disable_socials' => '1',
		'loading_animation' => 'disabled',
		'search_portfolio' => '1',
	);

	if ($portfolios_grid_loop->have_posts()) :

		$item_classes = get_thegem_portfolio_render_item_classes($params);
		$thegem_sizes = get_thegem_portfolio_render_item_image_sizes($params);
		?>
		<div class="portfolio-preloader-wrapper">

			<?php $portfolio_classes = array(
				'portfolio portfolio-grid no-padding disable-isotope columns-4',
				'portfolio-style-' . $params['layout'],
				'background-style-white',
				'hover-none',
				'title-on-' . $params['display_titles'],
				($params['columns'] == '100%' ? 'fullwidth-columns fullwidth-columns-' . $params['columns_100'] : ''),
			);
			?>

			<div class="<?php echo esc_attr(implode(' ', $portfolio_classes)) ?>">
				<div class="portfolio-row-outer <?php if ($params['columns'] == '100%'): ?>fullwidth-block no-paddings<?php endif; ?>">
					<div class="row portfolio-row">
						<div class="portfolio-set clearfix">
							<?php while ($portfolios_grid_loop->have_posts()) : $portfolios_grid_loop->the_post();
								$slugs = wp_get_object_terms(get_the_ID(), 'thegem_portfolios', array('fields' => 'slugs'));
								echo thegem_portfolio_render_item($params, $item_classes, $thegem_sizes, get_the_ID());
							endwhile; ?>
						</div><!-- .portflio-set -->
					</div><!-- .row-->
				</div><!-- .full-width -->
			</div><!-- .portfolio-->
		</div><!-- .portfolio-preloader-wrapper-->

	<?php endif;
	wp_reset_postdata();
}

function get_thegem_portfolio_render_item_classes($settings, $thegem_highlight_type = 'disabled') {
	$thegem_classes = [];

	if ($settings['columns'] == '1x') {
		$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
	}

	if ($settings['columns'] == '2x') {
		if ($thegem_highlight_type != 'disabled' && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-xs-12'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-sm-6', 'col-xs-12'));
	}

	if ($settings['columns'] == '3x') {
		if ($thegem_highlight_type != 'disabled' && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-4', 'col-xs-4'));
	}

	if ($settings['columns'] == '4x') {
		if ($thegem_highlight_type != 'disabled' && $thegem_highlight_type != 'vertical')
			$thegem_classes = array_merge($thegem_classes, array('col-md-6', 'col-sm-8', 'col-xs-8'));
		else
			$thegem_classes = array_merge($thegem_classes, array('col-md-3', 'col-sm-4', 'col-xs-4'));
	}
	return $thegem_classes;
}

function get_thegem_portfolio_render_item_image_sizes($settings, $thegem_highlight_type = 'disabled') {
	$thegem_size = 'thegem-portfolio-justified';
	$thegem_sizes = thegem_image_sizes();
	if ($settings['columns'] != '1x') {
		if ($settings['layout'] == 'masonry') {
			$thegem_size = 'thegem-portfolio-masonry';
			if ($thegem_highlight_type != 'disabled')
				$thegem_size = 'thegem-portfolio-masonry-double';
		} elseif ($settings['layout'] == 'metro') {
			$thegem_size = 'thegem-portfolio-metro';
		} else {
			if ($thegem_highlight_type != 'disabled') {
				$thegem_size = 'thegem-portfolio-double-' . str_replace('%', '', $settings['columns']);

				if ( ($settings['display_titles'] == 'hover' || $settings['hover'] == 'gradient' || $settings['hover'] == 'circular') && isset($thegem_sizes[$thegem_size.'-hover'])) {
					$thegem_size .= '-hover';
				}

				if(isset($thegem_sizes[$thegem_size.'-gap-'.$settings['gaps_size']])) {
					$thegem_size .= '-gap-'.$settings['gaps_size'];
				}

				if ($settings['columns'] == '100%' && $settings['display_titles'] == 'page') {
					$thegem_size .= '-page';
				}
			}
		}

		if ($thegem_highlight_type != 'disabled' && $settings['layout'] != 'metro' && $thegem_highlight_type != 'squared') {
			$thegem_size .= '-' . $thegem_highlight_type;
		}
	} else {
		$thegem_size = 'thegem-portfolio-1x';
	}

	$thegem_size = apply_filters('portfolio_size_filter', $thegem_size);

	$thegem_sources = array();

	if ($settings['layout'] == 'metro') {
		$thegem_sources = array(
			array('media' => '(min-width: 550px) and (max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-metro-medium', '2x' => 'thegem-portfolio-metro-retina'))
		);
	}

	if ($thegem_highlight_type == 'disabled' ||
		($settings['layout'] == 'masonry' && $thegem_highlight_type == 'vertical'))  {

		$retina_size = $settings['layout'] == 'justified' ? $thegem_size : 'thegem-portfolio-masonry-double';

		if ($settings['columns'] == '100%') {
			if ($settings['layout'] == 'justified' || $settings['layout'] == 'masonry') {
				switch ($settings['columns_100']) {
					case '4':
						$thegem_sources = array(
							array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x-500', '2x' => $retina_size)),
							array('media' => '(min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-fullwidth-5x', '2x' => $retina_size)),
							array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-fullwidth-4x', '2x' => $retina_size))
						);
						break;

					case '5':
						$thegem_sources = array(
							array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x-500', '2x' => $retina_size)),
							array('media' => '(min-width: 1495px) and (max-width: 1680px), (min-width: 550px) and (max-width: 1280px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-fullwidth-4x', '2x' => $retina_size)),
							array('media' => '(min-width: 1680px) and (max-width: 1920px), (min-width: 1280px) and (max-width: 1495px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-fullwidth-5x', '2x' => $retina_size))
						);
						break;
				}
			}
		} else {
			if ($settings['layout'] == 'justified' || $settings['layout'] == 'masonry') {
				switch ($settings['columns']) {
					case '2x':
						$thegem_sources = array(
							array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x-500', '2x' => $retina_size)),
							array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x', '2x' => $retina_size))
						);
						break;

					case '3x':
						$thegem_sources = array(
							array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x-500', '2x' => $retina_size)),
							array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-3x', '2x' => $retina_size))
						);
						break;

					case '4x':
						$thegem_sources = array(
							array('media' => '(max-width: 550px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-2x-500', '2x' => $retina_size)),
							array('media' => '(max-width: 1100px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-3x', '2x' => $retina_size)),
							array('media' => '(max-width: 1920px)', 'srcset' => array('1x' => 'thegem-portfolio-' . $settings['layout'] . '-4x', '2x' => $retina_size))
						);
						break;
				}
			}
		}
	}

	return array($thegem_size, $thegem_sources);
}

function thegem_portfolio_render_item($params, $item_classes, $thegem_sizes = null, $post_id = false) {
	if ($post_id) {
		$slugs = wp_get_object_terms($post_id, 'thegem_portfolios', array('fields' => 'slugs'));

		$thegem_portfolio_item_data = get_post_meta(get_the_ID(), 'thegem_portfolio_item_data', 1);

		if (($params['ignore_highlights'] != '1') && !empty($thegem_portfolio_item_data['highlight'])) {
			if (!empty($thegem_portfolio_item_data['highlight_type'])) {
				$thegem_highlight_type = $thegem_portfolio_item_data['highlight_type'];
			} else {
				$thegem_highlight_type = 'squared';
			}
		} else {
			$thegem_highlight_type = 'disabled';
		}
	} else {
		$slugs = array();
		$portfolio_item_size = true;
		$thegem_highlight_type = 'disabled';
	}

	$terms = $params['content_portfolios_cat'];
	if (in_array('0', $terms)) {
		$terms = get_terms('thegem_portfolios', array('hide_empty' => false));
	} else {
		foreach ($terms as $key => $term) {
			$terms[$key] = get_term_by('slug', $term, 'thegem_portfolios');
			if (!$terms[$key]) {
				unset($terms[$key]);
			}
		}
	}

	$terms = apply_filters('portfolio_terms_filter', $terms);
	usort($terms, 'portolios_cmp');

	$thegem_terms_set = array();
	foreach ($terms as $term) {
		$thegem_terms_set[$term->slug] = $term;
	}

	$thegem_classes = array('portfolio-item');
	$thegem_classes = array_merge($thegem_classes, $slugs);

	$thegem_image_classes = array('image');
	$thegem_caption_classes = array('caption');

	if ($params['layout'] != 'metro' || isset($portfolio_item_size)) {
		if ($thegem_highlight_type != 'disabled' && $thegem_highlight_type != 'vertical') {
			$thegem_classes = array_merge($thegem_classes, get_thegem_portfolio_render_item_classes($params, $thegem_highlight_type));
		} else {
			$thegem_classes = array_merge($thegem_classes, $item_classes);
		}
	}

	if ($thegem_highlight_type != 'disabled') {
		$thegem_classes[] = 'double-item';
		$thegem_classes[] = 'double-item-' . $thegem_highlight_type;

		$thegem_sizes = get_thegem_portfolio_render_item_image_sizes($params, $thegem_highlight_type);
	}

	if ($params['loading_animation'] !== 'disabled') {
		$thegem_classes[] = 'item-animations-not-inited';
	}

	if (!isset($portfolio_item_size)) {
		$thegem_large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
		$thegem_self_video = '';
	}

	$hover_effect = $params['hover'];

	$gap_size = round(intval($params['gaps_size']) / 2);

	include(locate_template(array('gem-templates/portfolios/content-portfolio-item.php')));
}

function thegem_menu_item_hamburger_widget($items, $args){
	if($args->menu_id == 'primary-menu' && thegem_get_option('header_layout') == 'fullwidth_hamburger'){

		ob_start();
		thegem_print_socials('rounded');
		$socials = ob_get_clean();
		$minisearch_class = '';
		$minisearch_ajax = '';
		if (thegem_get_option('website_search_ajax') == '1') {
			$minisearch_class = 'menu-item-ajax-search';
			$minisearch_ajax = '<div class="ajax-minisearch-results"></div>';
		}
		$product_search = '';
		if (thegem_is_plugin_active('woocommerce/woocommerce.php') && thegem_get_option('website_search_post_type_products') == '1') {
			$product_search = '<input type="hidden" name="post_type" value="product" />';
		}
		$items .= '<li class="menu-item menu-item-widgets">'. (!thegem_get_option('hide_search_icon') ? '<div class="vertical-minisearch '.$minisearch_class.'"><div class="vertical-minisearch-padding"><div class="vertical-minisearch-shadow">'.$minisearch_ajax.'<form role="search" id="searchform" class="sf" action="'. esc_url( home_url( '/' ) ) .'" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="'.esc_html__('Search...', 'thegem').'" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value="">'.$product_search.'</form></div></div></div>': "").''. (thegem_get_option('show_menu_socials') ? '<div class="menu-item-socials socials-colored">'. $socials .'</div>': "").'</li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thegem_menu_item_hamburger_widget', 100, 2);

function thegem_mobile_menu_item_widget($items, $args){
	if($args->menu_id == 'primary-menu' && in_array(thegem_get_option('mobile_menu_layout'), array('slide-horizontal', 'slide-vertical'))){

		ob_start();
		thegem_print_socials();
		$socials = ob_get_clean();

		$items .= '<li class="menu-item menu-item-widgets mobile-only">'. (thegem_get_option('show_menu_socials_mobile') ? '<div class="menu-item-socials">'. $socials .'</div>': "").'</li>';
	}
	return $items;
}
add_filter('wp_nav_menu_items', 'thegem_mobile_menu_item_widget', 100, 2);

/* PAGE SCROLLER */

function thegem_page_scroller_disable_scroll_top_button($value) {
	if(is_singular()) {
		$page_effects = thegem_get_output_page_settings(get_the_ID());
		if($page_effects['effects_page_scroller']) {
			return true;
		}
	}
	return $value;
}
add_filter('thegem_option_disable_scroll_top_button', 'thegem_page_scroller_disable_scroll_top_button');

/* PRINT LOGO */
if(!function_exists('thegem_print_logo')) {
	function thegem_print_logo($header_light = '', $echo = true)
	{
		ob_start();
		?>
		<div class="site-logo" style="width:<?php echo esc_attr(thegem_get_option('logo_width')); ?>px;">
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
				<?php if (thegem_get_option('logo')) : ?>
					<span class="logo"><?php thegem_get_logo_img(esc_url(thegem_get_option('logo' . $header_light)), intval(thegem_get_option('logo_width')), 'tgp-exclude default') ?><?php if (thegem_get_option('small_logo_light') && $header_light) : ?><?php thegem_get_logo_img(esc_url(thegem_get_option('small_logo_light')), intval(thegem_get_option('small_logo_width')), 'tgp-exclude small light') ?><?php endif; ?><?php if (thegem_get_option('small_logo')) : ?><?php thegem_get_logo_img(esc_url(thegem_get_option('small_logo')), intval(thegem_get_option('small_logo_width')), 'tgp-exclude small') ?><?php endif; ?></span>
				<?php else : ?>
					<?php bloginfo('name'); ?>
				<?php endif; ?>
			</a>
		</div>
		<?php
		$output = ob_get_clean();
		if ($echo) {
			echo $output;
		}
		return $output;
	}
}

function thegem_get_logo_img($url, $width, $class = '', $echo = 1) {
	$logo = '<img src="'.esc_url(thegem_get_logo_url($url, $width, 1)).'" srcset="'.esc_url(thegem_get_logo_url($url, $width, 1)).' 1x,'.esc_url(thegem_get_logo_url($url, $width, 2)).' 2x,'.esc_url(thegem_get_logo_url($url, $width, 3)).' 3x" alt="'.esc_attr(get_bloginfo( 'name', 'display' )).'" style="width:'.esc_attr($width).'px;"'.($class ? ' class="'.esc_attr($class).'"' : '').'/>';
	$logo = apply_filters('thegem_get_logo_img', $logo, $url, $width, $class);
	if($echo) {
		echo $logo;
	}
	return $logo;
}

function thegem_get_logo_url($url, $width, $ratio = 1) {
	$url = set_url_scheme($url);
	$logo_url = apply_filters('thegem_get_logo_url', $url, $width, $ratio);
	if($logo_url != $url) {
		return $logo_url;
	}
	$url_pathinfo = pathinfo($url);
	if(!empty($url_pathinfo['extension']) && substr($url_pathinfo['extension'], 0, 3) === 'svg') {
		return $logo_url;
	}
	$wp_upload_dir = wp_upload_dir();
	$upload_logos_dir = $wp_upload_dir['basedir'] . '/thegem-logos';
	$upload_logos_url = set_url_scheme($wp_upload_dir['baseurl'] . '/thegem-logos');
	$file = explode('.', $url);
	$extention = $file[count($file)-1];
	$logo_filename = 'logo_'.md5($url.$width).'_'.$ratio.'x.'.$extention;
	$logo_filepath = $upload_logos_dir.'/'.$logo_filename;
	if(file_exists($logo_filepath)) {
		return $upload_logos_url.'/'.$logo_filename;
	}

	if(!wp_mkdir_p($upload_logos_dir)) {
		return $logo_url;
	}

	$local_file = false;
	$temp_file = '';
	if(strpos($url, home_url('/')) === 0) {
		$temp_file = ABSPATH . str_replace(home_url('/'), '', $url);
		if(file_exists($temp_file)) {
			$local_file = true;
		} else {
			return $logo_url;
		}
	}
	if(!$local_file) {
		require_once(ABSPATH . 'wp-admin/includes/file.php');
		$temp_file = download_url($url);
		if(is_wp_error($temp_file)) {
			return $logo_url;
		}
	}
	$temp_logo_filepath = $upload_logos_dir.'/temp_logo_file.'.$extention;
	$move_new_file = @copy($temp_file, $temp_logo_filepath);
	if(!$local_file) {
		unlink($temp_file);
	}
	if($move_new_file === false) {
		return $logo_url;
	};
	$image = wp_get_image_editor($temp_logo_filepath);
	if(!is_wp_error($image) && $image) {
		$image->resize($width*$ratio, 0, false);
		$image->set_quality(100);
		$image->save($logo_filepath);
		unlink($temp_logo_filepath);
		return $upload_logos_url.'/'.$logo_filename;
	}
	return $logo_url;
}

/* Hamburger fix */

function thegem_vertical_fix_logo_position($value) {
	if(($value == 'menu_center' || $value == 'center') && in_array(thegem_get_option('header_layout'), array('fullwidth_hamburger', 'overlay', 'perspective'))) {
		return 'left';
	}
	if(thegem_get_option('header_layout') == 'vertical') {
		return 'left';
	}
	return $value;
}
add_filter('thegem_option_logo_position', 'thegem_vertical_fix_logo_position');

/* Boxed fix */

function thegem_vertical_fix_page_layout_style($value) {
	if($value == 'boxed' && (thegem_get_option('header_layout') == 'fullwidth_hamburger' || thegem_get_option('header_layout') == 'vertical')) {
		return 'fullwidth';
	}
	return $value;
}
add_filter('thegem_option_page_layout_style', 'thegem_vertical_fix_page_layout_style');


/* 404 Sidebar fix */

function thegem_fix_404_pw_filter_widgets($sidebars_widgets) {
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$post = get_post(thegem_get_option('404_page'));
		if (isset($post->ID)) {
			$enable_customize = get_post_meta($post->ID, '_customize_sidebars', true);
			$_sidebars_widgets = get_post_meta($post->ID, '_sidebars_widgets', true);
		}
		if (isset($enable_customize) && $enable_customize == 'yes' && !empty($_sidebars_widgets)) {
			if (is_array($_sidebars_widgets) && isset($_sidebars_widgets['array_version']))
				unset($_sidebars_widgets['array_version']);
			$sidebars_widgets = wp_parse_args($_sidebars_widgets, $sidebars_widgets);
		}
	}
	return $sidebars_widgets;
}
add_filter('sidebars_widgets', 'thegem_fix_404_pw_filter_widgets');

/* USER ICON PACK */

if(!function_exists('thegem_icon_userpack_enabled')) {
function thegem_icon_userpack_enabled() {
	return apply_filters('thegem_icon_userpack_enabled', false);
}
}

if(!function_exists('thegem_icon_packs_select_array')) {
function thegem_icon_packs_select_array() {
	$packs = array('elegant' => esc_html__('Elegant', 'thegem'), 'material' => esc_html__('Material Design', 'thegem'), 'fontawesome' => esc_html__('FontAwesome', 'thegem'), 'thegemdemo' => esc_html__('Additional', 'thegem'));
	if(thegem_icon_userpack_enabled()) {
		$packs['userpack'] = esc_html__('UserPack', 'thegem');
	}
	return $packs;
}
}

if(!function_exists('thegem_icon_packs_infos')) {
function thegem_icon_packs_infos() {
	ob_start();
?>
<?php esc_html_e('Enter icon code', 'thegem'); ?>.
<a class="gem-icon-info gem-icon-info-elegant" href="<?php echo esc_url(thegem_user_icons_info_link('elegant')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show Elegant Icon Codes', 'thegem'); ?></a>
<a class="gem-icon-info gem-icon-info-material" href="<?php echo esc_url(thegem_user_icons_info_link('material')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show Material Design Icon Codes', 'thegem'); ?></a>
<a class="gem-icon-info gem-icon-info-fontawesome" href="<?php echo esc_url(thegem_user_icons_info_link('fontawesome')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show FontAwesome Icon Codes', 'thegem'); ?></a>
<a class="gem-icon-info gem-icon-info-thegemdemo" href="<?php echo esc_url(thegem_user_icons_info_link('thegemdemo')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show TheGem Demo Icon Codes', 'thegem'); ?></a>

 <?php if(thegem_icon_userpack_enabled()) : ?>
<a class="gem-icon-info gem-icon-info-userpack" href="<?php echo esc_url(thegem_user_icons_info_link('userpack')); ?>" onclick="tb_show('<?php esc_attr_e('Icons info', 'thegem'); ?>', this.href+'?TB_iframe=true'); return false;"><?php esc_html_e('Show UserPack Icon Codes', 'thegem'); ?></a>
<?php endif; ?>
<?php
	return ob_get_clean();
}
}


/* BODY CLASS */

function thegem_body_class($classes) {
	$page_id = is_singular() ? get_the_ID() : 0;
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$page_id = thegem_get_option('404_page');
	}
	if((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
		$page_id = wc_get_page_id('shop');
	}
	$effects_params = thegem_get_output_page_settings($page_id);
	$body_classes = array();
	if(is_home() && thegem_get_option('home_content_enabled')) {
		$body_classes[] = 'home-constructor';
	}

	if ($effects_params['effects_page_scroller']) {
		if ($effects_params['effects_page_scroller_type'] == 'basic') {
			$body_classes[] = 'page-scroller';

			if ($effects_params['effects_page_scroller_mobile']) {
				$body_classes[] = 'page-scroller-mobile';
			}

		} else {
			$body_classes[] = 'thegem-fp';

			if (!$effects_params['fullpage_disabled_dots']) {
				$body_classes[] = 'thegem-fp-dost-'.$effects_params['fullpage_style_dots'];
			}

			if ($effects_params['fullpage_disabled_mobile']) {
				$body_classes[] = 'thegem-fp-disabled-mobile';
			}

			if ($effects_params['fullpage_disabled_dots']) {
				$body_classes[] = 'thegem-fp-disabled-dots';
			}

			if ($effects_params['fullpage_disabled_tooltips_dots']) {
				$body_classes[] = 'thegem-fp-disabled-tooltips';
			}

			if ($effects_params['fullpage_enable_continuous']) {
				$body_classes[] = 'thegem-fp-enable-continuous';
			}

			if ($effects_params['fullpage_scroll_effect']) {
				switch ($effects_params['fullpage_scroll_effect']) {
					case 'parallax':
						$body_classes[] = 'thegem-fp-parallax';
						break;
					case 'fixed_background':
				$body_classes[] = 'thegem-fp-fixed-background';
						break;
				}
			}

			if ((thegem_get_option('page_padding_top') + thegem_get_option('page_padding_bottom')) > 0) {
				$body_classes[] = 'thegem-fp-page-padding';
			}

		}
	}
	
	if($effects_params['effects_one_pager']) {
		$body_classes[] = 'one-pager';
	}
	if (thegem_is_effects_disabled()) {
		$body_classes[] = 'thegem-effects-disabled';
	}

	if (get_post_type() == 'thegem_templates') {
		$body_classes[] = 'template-type-'.get_post_meta(get_the_ID(), 'thegem_template_type', true);
	}

	return array_merge($classes, $body_classes);
}
add_filter('body_class', 'thegem_body_class');


/* SEACRH FORMS */
if(!function_exists('thegem_serch_form_vertical_header')) {
	function thegem_serch_form_vertical_header($form)
	{
		$minisearch_class = '';
		$minisearch_ajax = '';
		if (thegem_get_option('website_search_ajax') == '1') {
			$minisearch_class = 'menu-item-ajax-search';
			$minisearch_ajax = '<div class="ajax-minisearch-results"></div>';
		}
		$product_search = '';
		if (thegem_is_plugin_active('woocommerce/woocommerce.php') && thegem_get_option('website_search_post_type_products') == '1') {
			$product_search = '<input type="hidden" name="post_type" value="product" />';
		}
		return '<div class="vertical-minisearch '.$minisearch_class.'"><div class="vertical-minisearch-padding"><div class="vertical-minisearch-shadow">'.$minisearch_ajax.'<form role="search" id="searchform" class="sf" action="' . esc_url(home_url('/')) . '" method="GET"><input id="searchform-input" class="sf-input" type="text" placeholder="' . esc_html__('Search...', 'thegem') . '" name="s"><span class="sf-submit-icon"></span><input id="searchform-submit" class="sf-submit" type="submit" value="">'.$product_search.'</form></div></div></div>';
	}
}

function thegem_serch_form_nothing_found($form){
	ob_start();
?>
<form role="search" method="get" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<table><tr>
		<td><input type="text" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_html_e('Search...', 'thegem'); ?>" /></td>
		<td><?php thegem_button(array(
			'tag' => 'button',
			'text' => __('Search', 'thegem'),
			'size' => 'medium',
			'corner' => 3,
			'extra_class' => 'searchform-submit',
			'attributes' => array('type' => 'submit', 'value' => __('Search', 'thegem')),
		), 1); ?></td>
	</tr></table>
</form>
<?php
	$form = ob_get_clean();
	return $form;
}


/* MEJS SETTINGS */

function thegem_mejs_settings($mejs_settings) {
	$mejs_settings['hideVideoControlsOnLoad'] = true;
	$mejs_settings['audioVolume'] = 'vertical';
	return $mejs_settings;
}
add_filter('mejs_settings', 'thegem_mejs_settings');


/* OVERLAY MENU */

add_action('wp', 'thegem_remove_language_switcher');
function thegem_remove_language_switcher() {
	global $icl_language_switcher;
	if(thegem_get_option('header_layout') === 'overlay' && !empty($icl_language_switcher)) {
		remove_action( 'wp_nav_menu_items', array( $icl_language_switcher, 'wp_nav_menu_items_filter' ) );
	}
}

add_filter('thegem_option_menu_appearance_tablet_portrait', 'thegem_menu_overlay_appearance');
add_filter('thegem_option_menu_appearance_tablet_landscape', 'thegem_menu_overlay_appearance');
function thegem_menu_overlay_appearance($value) {
	if(thegem_get_option('header_layout') === 'overlay') {
		return 'default';
	}
	return $value;
}

function thegem_before_nav_menu_callback() {
	echo '<button class="menu-toggle dl-trigger">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';

	if (thegem_get_option('header_layout') == 'fullwidth_hamburger' || thegem_get_option('header_layout') == 'overlay') {
		$minicart_items = '';
		echo '<div class="hamburger-group'.(thegem_get_option('hamburger_menu_icon_size') ? ' hamburger-size-small hamburger-size-small-original' : '').(thegem_get_option('hamburger_menu_cart_position') ? ' hamburger-with-cart' : '').'">';
		if(thegem_get_option('hamburger_menu_cart_position') && !thegem_get_option('hide_card_icon') && !thegem_get_option('catalog_view') && thegem_is_plugin_active('woocommerce/woocommerce.php')) {
			if (thegem_get_option('cart_icon_pack') && thegem_get_option('cart_icon')) {
				wp_enqueue_style('icons-'.thegem_get_option('cart_icon_pack'));
			}
			$count = thegem_get_cart_count();
			ob_start();
			woocommerce_mini_cart();
			$minicart = ob_get_clean();
			$minicart_items = '<div class="hamburger-minicart"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . (thegem_get_option('cart_label_type') == 1 ? ' circle-count' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart'.(thegem_get_option('logo_position', 'left') === 'left' ? ' invert' : '').'"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></div>';
			if(thegem_get_option('logo_position') != 'right') {
				echo $minicart_items;
			}
		}

		if (thegem_get_option('header_layout') == 'fullwidth_hamburger') {
			echo '<button class="hamburger-toggle">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
		}

		if (thegem_get_option('header_layout') == 'overlay') {
			echo '<button class="overlay-toggle '.(thegem_get_option('hamburger_menu_icon_size') ? ' toggle-size-small toggle-size-small-original' : '').'">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
		}

		if($minicart_items && thegem_get_option('logo_position') == 'right') {
			echo $minicart_items;
		}

		echo '</div>';
	}

	if (thegem_get_option('header_layout') == 'overlay' || thegem_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="overlay-menu-wrapper"><div class="overlay-menu-table"><div class="overlay-menu-row"><div class="overlay-menu-cell">';
	}

	if (thegem_get_option('header_layout') == 'perspective') {
		echo '<button class="perspective-toggle'.(thegem_get_option('hamburger_menu_icon_size') ? ' toggle-size-small toggle-size-small-original' : '').'">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '<div class="mobile-menu-slide-wrapper left"><button class="mobile-menu-slide-close"></button>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '<div class="mobile-menu-slide-wrapper top"><button class="mobile-menu-slide-close"></button>';
	}
}
add_action('thegem_before_nav_menu', 'thegem_before_nav_menu_callback');

function thegem_after_nav_menu_callback() {
	if (thegem_get_option('header_layout') == 'overlay' || thegem_get_option('mobile_menu_layout') == 'overlay') {
		echo '</div></div></div></div>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '</div>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '</div>';
	}
}
add_action('thegem_after_nav_menu', 'thegem_after_nav_menu_callback');

function thegem_before_header_callback() {
	if (thegem_get_option('header_layout') == 'overlay' || thegem_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="menu-overlay"></div>';
	}
}
add_action('thegem_before_header', 'thegem_before_header_callback');

function thegem_option_mobile_menu_layout_default($value) {
	if (!$value) {
		$value = 'default';
	}
	return $value;
}
add_filter('thegem_option_mobile_menu_layout', 'thegem_option_mobile_menu_layout_default');

function thegem_nav_menu_class_callback($classes) {
	if (thegem_get_option('mobile_menu_layout') == 'default') {
		$classes .= ' dl-menu';
	}
	if (thegem_get_option('logo_position') == 'menu_center') {
		$classes .= ' menu_center-preload';
	}
	return $classes;
}
add_filter('thegem_nav_menu_class', 'thegem_nav_menu_class_callback');

function thegem_before_perspective_nav_menu_callback() {
	if (thegem_get_option('mobile_menu_layout') == 'overlay') {
		echo '<div class="overlay-menu-wrapper"><div class="overlay-menu-table"><div class="overlay-menu-row"><div class="overlay-menu-cell">';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '<div class="mobile-menu-slide-wrapper left"><button class="mobile-menu-slide-close"></button>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '<div class="mobile-menu-slide-wrapper top"><button class="mobile-menu-slide-close"></button>';
	}

	echo '<button class="perspective-menu-close'.(thegem_get_option('hamburger_menu_icon_size') ? ' toggle-size-small' : '').'"></button>';
}
add_action('thegem_before_perspective_nav_menu', 'thegem_before_perspective_nav_menu_callback');

function thegem_after_perspective_nav_menu_callback() {
	if (thegem_get_option('mobile_menu_layout') == 'overlay') {
		echo '</div></div></div></div>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-horizontal') {
		echo '</div>';
	}

	if (thegem_get_option('mobile_menu_layout') == 'slide-vertical') {
		echo '</div>';
	}

	?>
	<div class="vertical-menu-item-widgets">
		<?php
			if (!thegem_get_option('hide_search_icon')){
				add_filter( 'get_search_form', 'thegem_serch_form_vertical_header' );
				get_search_form();
				remove_filter( 'get_search_form', 'thegem_serch_form_vertical_header' );
			}
		?>
		<?php if (thegem_get_option('show_menu_socials')): ?>
			<div class="menu-item-socials socials-colored"><?php thegem_print_socials('rounded'); ?></div>
		<?php endif; ?>
	</div>
	<?php
}
add_action('thegem_after_perspective_nav_menu', 'thegem_after_perspective_nav_menu_callback');

function thegem_perspective_menu_buttons_callback() {
	echo '<div id="perspective-menu-buttons" class="primary-navigation">';
	$minicart_items = '';
	echo '<div class="hamburger-group'.(thegem_get_option('hamburger_menu_icon_size') ? ' hamburger-size-small hamburger-size-small-original' : '').(thegem_get_option('hamburger_menu_cart_position') ? ' hamburger-with-cart' : '').'">';
	if(thegem_get_option('hamburger_menu_cart_position') && !thegem_get_option('hide_card_icon') && !thegem_get_option('catalog_view') && thegem_is_plugin_active('woocommerce/woocommerce.php')) {
		if (thegem_get_option('cart_icon_pack') && thegem_get_option('cart_icon')) {
			wp_enqueue_style('icons-'.thegem_get_option('cart_icon_pack'));
		}
		$count = thegem_get_cart_count();
		ob_start();
		woocommerce_mini_cart();
		$minicart = ob_get_clean();
		$minicart_items = '<div class="hamburger-minicart"><a href="'.esc_url(get_permalink(wc_get_page_id('cart'))).'" class="minicart-menu-link ' . ($count == 0 ? 'empty' : '') . (thegem_get_option('cart_label_type') == 1 ? ' circle-count' : '') . '">' . '<span class="minicart-item-count">' . $count . '</span>' . '</a><div class="minicart'.(thegem_get_option('logo_position', 'left') === 'left' ? ' invert' : '').'"><div class="widget_shopping_cart_content">'.$minicart.'</div></div></div>';
		if(thegem_get_option('logo_position') != 'right') {
			echo $minicart_items;
		}
	}
	echo '<button class="perspective-toggle'.(thegem_get_option('hamburger_menu_icon_size') ? ' toggle-size-small toggle-size-small-original' : '').'">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	if(thegem_get_option('logo_position') == 'right' && $minicart_items) {
		echo $minicart_items;
	}
	echo '<button class="menu-toggle dl-trigger">' . esc_html('Primary Menu', 'thegem') . '<span class="menu-line-1"></span><span class="menu-line-2"></span><span class="menu-line-3"></span></button>';
	echo '</div>';

	echo '</div>';
}
add_action('thegem_perspective_menu_buttons', 'thegem_perspective_menu_buttons_callback');

function thegem_get_site_icon_url($url, $size, $blog_id) {
	$custom_icon = thegem_get_option('favicon');
	if(!empty($custom_icon)) {
		return set_url_scheme($custom_icon);
	};
	return $url;
}
add_filter( 'get_site_icon_url', 'thegem_get_site_icon_url', 10, 3 );

function thegem_get_footers_list() {
	$footers = array();
	$footers_list = get_posts(array(
		'post_type' => 'thegem_footer',
		'numberposts' => -1,
		'post_status' => 'any'
	));
	if(function_exists('thegem_get_templates')) {
		$footers_list = array_merge($footers_list, thegem_get_templates('footer'));
	}
	foreach ($footers_list as $footer) {
		$footers[$footer->ID] = $footer->post_title . ' (ID = ' . $footer->ID . ')';
	}
	return $footers;
}

function thegem_get_titles_list() {
	$titles_list = get_posts(array(
		'post_type' => 'thegem_title',
		'numberposts' => -1,
		'post_status' => 'any'
	));
	if(function_exists('thegem_get_templates')) {
		$titles_list = array_merge($titles_list, thegem_get_templates('title'));
	}
	$titles = array();
	foreach ($titles_list as $title) {
		$titles[$title->ID] = $title->post_title . ' (ID = ' . $title->ID . ')';
	}
	return $titles;
}

function thegem_get_headers_list() {
	$headers_list = get_posts(array(
		'post_type' => 'thegem_header',
		'numberposts' => -1,
		'post_status' => 'any'
	));
	if(function_exists('thegem_get_templates')) {
		$headers_list = array_merge($headers_list, thegem_get_templates('header'));
	}
	$headers = array();
	foreach ($headers_list as $header) {
		$headers[$header->ID] = $header->post_title . ' (ID = ' . $header->ID . ')';
	}
	return $headers;
}

function thegem_get_single_products_list() {
	$single_products_list = array();
	if(function_exists('thegem_get_templates')) {
		$single_products_list = thegem_get_templates('single-product');
	}
	$single_products = array();
	if(is_array($single_products_list)) {
		foreach ($single_products_list as $product) {
			$single_products[$product->ID] = $product->post_title . ' (ID = ' . $product->ID . ')';
		}
	}
	return $single_products;
}

function thegem_get_megamenus_list() {
	$templates = array();
	if (function_exists('thegem_get_templates')) {
		$templates_list = thegem_get_templates('megamenu');

		foreach ($templates_list as $template) {
			$templates[$template->ID] = array('label' => $template->post_title . ' (ID = ' . $template->ID . ')', 'edit' => add_query_arg(array('post' => $template->ID, 'action' => 'elementor'), admin_url( 'post.php' )));
		}
	}
	return $templates;
}

function thegem_get_custom_css_filename() {
	$name = get_option('thegem_custom_css_filename');
	if($name && file_exists(get_stylesheet_directory() . '/css/'.$name.'.css')) {
		return $name;
	}
	return 'custom';
}

function thegem_generate_custom_css_filename() {
	return 'custom-'.wp_generate_password(8, false, false);
}

function thegem_save_custom_css_filename($name) {
	update_option('thegem_custom_css_filename', $name);
}

function thegem_gutenberg_can_edit_post($can_edit, $post ) {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return $can_edit;
	}
	global $pagenow;
	if($can_edit && $pagenow == 'post.php' || $pagenow == 'post-new.php') {
		$can_edit = isset( $_GET['gutenberg-editor']);
	}
	return $can_edit;
}
add_filter('gutenberg_can_edit_post', 'thegem_gutenberg_can_edit_post', 10, 2);

function thegem_gutenberg_add_edit_link_filters() {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return ;
	}
	remove_filter( 'page_row_actions', 'gutenberg_add_edit_link', 10 );
	remove_filter( 'post_row_actions', 'gutenberg_add_edit_link', 10 );
	add_filter( 'page_row_actions', 'thegem_gutenberg_add_edit_link', 10, 2 );
	add_filter( 'post_row_actions', 'thegem_gutenberg_add_edit_link', 10, 2 );
}
add_action( 'admin_init', 'thegem_gutenberg_add_edit_link_filters', 11 );

function thegem_gutenberg_add_edit_link( $actions, $post ) {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return $actions;
	}
	if ( 'wp_block' === $post->post_type ) {
		unset( $actions['edit'] );
		unset( $actions['inline hide-if-no-js'] );
		return $actions;
	}
	if (!function_exists('gutenberg_can_edit_post') || ! gutenberg_can_edit_post( $post ) ) {
		return $actions;
	}
	$edit_url = get_edit_post_link( $post->ID, 'raw' );
	$edit_url = add_query_arg( 'gutenberg-editor', '', $edit_url );

	// Build the classic edit action. See also: WP_Posts_List_Table::handle_row_actions().
	$title	   = _draft_or_post_title( $post->ID );
	$edit_action = array(
		'classic' => sprintf(
			'<a href="%s" aria-label="%s">%s</a>',
			esc_url( $edit_url ),
			esc_attr(
				sprintf(
					/* translators: %s: post title */
					__( 'Edit &#8220;%s&#8221; in the gutenberg editor', 'thegem' ),
					$title
				)
			),
			__( 'Gutenberg Editor', 'thegem' )
		),
	);

	// Insert the Classic Edit action after the Edit action.
	$edit_offset = array_search( 'edit', array_keys( $actions ), true );
	$actions	 = array_merge(
		array_slice( $actions, 0, $edit_offset + 1 ),
		$edit_action,
		array_slice( $actions, $edit_offset + 1 )
	);
	return $actions;
}

function thegem_gutenberg_replace_default_add_new_button() {
	if ( ! defined( 'GUTENBERG_VERSION' ) || ! defined( 'WPB_VC_VERSION' )) {
		return ;
	}
	global $typenow;

	if ( ! use_block_editor_for_post_type( $typenow ) ) {
		return;
	}

	?>
	<script type="text/javascript">
		document.addEventListener( 'DOMContentLoaded', function() {
			var buttons = document.getElementsByClassName( 'split-page-title-action' ),
				button = buttons.item( 0 );

			if ( ! button ) {
				return;
			}
			var gutenberg_button = button.getElementsByClassName('dropdown').item( 0 ).childNodes[0];
			var url = gutenberg_button.href;
			var urlHasParams = ( -1 !== url.indexOf( '?' ) );
			var gutenbergUrl = url + ( urlHasParams ? '&' : '?' ) + 'gutenberg-editor';
			gutenberg_button.href = gutenbergUrl;
		} );
	</script>
	<?php
}
add_action( 'admin_print_scripts-edit.php', 'thegem_gutenberg_replace_default_add_new_button', 11 );

function thegem_admin_url_gutenberg_replace($url, $path, $blog_id) {
	if(defined('WPB_VC_VERSION') && substr_count($path, 'post-new.php')) {
		$parsed_path = wp_parse_url($path);
		$query_data = array();
		if(!empty($parsed_path['query'])) {
			parse_str($parsed_path['query'], $query_data);
		}
		$post_type = !empty($query_data['post_type']) ? $query_data['post_type'] : 'post';
		if(vc_check_post_type($post_type)) {
			$url = add_query_arg('classic-editor', '', $url);
		}
	}
	return $url;
}
add_filter( 'admin_url', 'thegem_admin_url_gutenberg_replace', 10, 3);

function thegem_vc_base_register_admin_js() {
	$localize = visual_composer()->getEditorsLocale();
	$localize['main_button_title'] = esc_html__( 'Switch to Page Builder', 'thegem' );
	wp_localize_script( 'vc-backend-actions-js', 'i18nLocale', $localize );
}
add_action( 'vc_base_register_admin_js', 'thegem_vc_base_register_admin_js');

function thegem_get_contact_font_family($selected) {
	$fonts_array = array(
		'elegant' => 'ElegantIcons',
		'material' => 'MaterialDesignIcons',
		'fontawesome' => 'FontAwesome',
		'userpack' => 'UserPack',
	);
	$font_family = isset($fonts_array[$selected]) ? $fonts_array[$selected] : 'ElegantIcons';
	return $font_family;
}

if (!function_exists('thegem_lazy_loading_enqueue')) {
	function thegem_lazy_loading_enqueue() {
		wp_enqueue_script('thegem-lazy-loading');
		wp_enqueue_style('thegem-lazy-loading-animations');
	}
}

function thegem_save_instagram_image($remote_url) {
	$hash = sha1($remote_url);
	$cache_key = 'thegem_instagram_image_' . $hash;

	$cached_url = get_option($cache_key);
	if ($cached_url) {
		return $cached_url;
	}

	$url = str_replace('//', 'https://', $remote_url);
	$cleared_url = preg_replace('%\?.*$%', '', $url);

	if (!preg_match('%\.(.*)$%', basename($cleared_url), $match)) {
		return $remote_url;
	}

	$file = array(
		'name' => $hash . '.' . $match[1],
		'tmp_name' => download_url($url)
	);

	if (is_wp_error($file['tmp_name'])) {
		@unlink($file['tmp_name']);
		return $remote_url;
	}

	$upload_dir = wp_get_upload_dir();

	if (!@copy($file['tmp_name'], $upload_dir['path'] . '/' . $file['name'])) {
		@unlink($file['tmp_name']);
		return $remote_url;
	}

	@unlink($file['tmp_name']);

	$local_url = $upload_dir['url'] . '/' . $file['name'];

	update_option($cache_key, $local_url, 'no');

	return $local_url;
}

function thegem_enqueue_fullpage() {
	wp_enqueue_script('fullpage');
	wp_enqueue_style('fullpage');
	wp_enqueue_script('thegem-fullpage');
	wp_enqueue_style('thegem-fullpage');
}

function thegem_addPrefixToCssSelectors($selectorPrefix,$css) {
	// remove comments
	$css=preg_replace('%/\*.*?\*/%s','',$css);

	// extract attribute selectors in square brackets for correct parsing
	$attrSelectors=array();
	$css=preg_replace_callback('%\[\s*[-_a-zA-Z0-9]+\s*((|[~|^$*])=\s*("[^"]*"|\'[^\']*\'|[^"\'\]])+\s*)?\]%',function($m) use(&$attrSelectors) {
		$index=count($attrSelectors);
		$attrSelectors[$index]=$m[0];
		return "%attribute%selector%$index%%%";
	},$css);

	// find selector blocks ( fragments between "}" and "{" )
	$css=preg_replace_callback('%(^|\{|\})([^@"\'{}]*)({)%',function($selectorBlockMatches) use($selectorPrefix) {
		// process individual selectors
		$selectorsBlock=preg_replace_callback('%(\s*)([^,]+)%i',function($selectorMatches) use($selectorPrefix) {
			return $selectorMatches[1].$selectorPrefix.' '.$selectorMatches[2];
		},$selectorBlockMatches[2]);

		return $selectorBlockMatches[1].$selectorsBlock.$selectorBlockMatches[3];
	},$css);

	// inject attribute selectors
	$css=preg_replace_callback('#%attribute%selector%(\d+)%%%#',function($m) use(&$attrSelectors) {
		return $attrSelectors[$m[1]];
	},$css);

	$css = str_replace('@id', $selectorPrefix, $css);

	return $css;
}

function thegem_elementor_conflict_popup() {
	if(thegem_is_plugin_active('thegem-elements-elementor/thegem-elements-elementor.php') || thegem_is_plugin_active('thegem-importer-elementor/thegem-importer.php')) {
		wp_enqueue_style('thegem-activation-google-fonts');
		$themes = wp_get_themes(array('allowed' => true));
?>
<div id="thegem-elementor-conflict-popup" style="display: none;">
	<div class="thegem-elementor-conflict-title"><?php _e('Attention', 'thegem'); ?></div>
	<div class="thegem-elementor-conflict-info">
		<div class="thegem-elementor-conflict-text">
			<p><?php _e('Your currently active plugins TheGem Elements (Elementor) and TheGem Demo Import (Elementor) are not compatible with WPBakery\'s version of TheGem theme. In case you wish to proceed, this plugins will be automatically deactivated and your content, created with Elementor will not be available on the front end.', 'thegem'); ?></p>
			<?php if(isset($themes['thegem-elementor'])) : ?>
				<p><?php _e('If you wish to return to Elementor\'s version of TheGem theme, click on "Cancel". In this case TheGem for Elementor will be automatically re-activated, plugins TheGem Elements (Elementor) and TheGem Demo Import (Elementor) will stay active and your content, created with Elementor will remain available on the front end.', 'thegem'); ?></p>
			<?php else : ?>
				<p><?php _e('In case you wish to return to Elementor\'s version of TheGem theme, please re-install it and your content, created with Elementor will be available on the front end again.', 'thegem'); ?></p>
			<?php endif; ?>
		</div>
		<div class="thegem-elementor-conflict-buttons">
			<?php if(isset($themes['thegem'])) : ?>
				<a href="<?php echo add_query_arg('thegem-elementor-conflict-cancel', '1'); ?>" class="thegem-elementor-conflict-cancel"><?php _e('Cancel', 'thegem'); ?></a>
			<?php endif; ?>
			<a href="<?php echo add_query_arg('thegem-elementor-conflict-proceed', '1'); ?>" class="thegem-elementor-conflict-proceed"><?php _e('Proceed', 'thegem'); ?></a>
		</div>
	</div>
</div>
<script>(function($) {
	$(function() {
		thegem_show_elementor_conflict_popup();
	});
})(jQuery)</script>
<?php
	}
}
add_action('admin_footer', 'thegem_elementor_conflict_popup');

function thegem_get_page_settings_css() {
	global $thegem_product_data;

	$output_css = '';
	if(is_singular() || is_tax() || is_category() || is_tag() || is_search() || is_archive() || is_home() || is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag') || is_404()) {
		$post_id = 0;
		if (is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) {
			$post_id = wc_get_page_id('shop');
		} elseif (is_404() && get_post(thegem_get_option('404_page'))) {
			$post_id = thegem_get_option('404_page');
		} elseif (is_singular()) {
			global $post;
			$post_id = $post->ID;
		}
		$page_data = thegem_get_output_page_settings($post_id);
		if(function_exists('wc_get_page_id')) {
			$admin_page_data = thegem_get_sanitize_admin_page_data($post_id);
			if(thegem_get_option('cart_layout', 'modern') == 'modern') {
				$wishlist_page_id = function_exists('YITH_WCWL') ? YITH_WCWL()->get_wishlist_page_id() : -1;
				if(in_array($post_id, array(wc_get_page_id('checkout'), wc_get_page_id('cart'), wc_get_page_id('myaccount'), wc_get_page_id('terms'), $wishlist_page_id))) {
					if($admin_page_data['content_area_options'] == 'default') {
						$page_data['content_padding_top'] = '70';
						$page_data['product_content_padding_top_tablet'] = '';
						$page_data['product_content_padding_top_mobile'] = '';
					}
				}
			}
			if(is_post_type_archive('product') && thegem_get_option('product_archive_type') == 'grid' && $admin_page_data['content_area_options'] == 'default') {
				$page_data['content_padding_top'] = '70';
				$page_data['product_content_padding_top_tablet'] = '';
				$page_data['product_content_padding_top_mobile'] = '';
			}
		}
		if ((is_archive() || is_home()) && !$post_id) {
			$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
		}
		if (is_tax() || is_category() || is_tag()) {
			$thegem_term_id = get_queried_object()->term_id;
			if (get_term_meta($thegem_term_id, 'thegem_taxonomy_custom_page_options', true)) {
				$page_data = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
			} else if (!is_tax('product_cat') && !is_tax('product_tag')) {
				$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
			} elseif(is_tax('product_cat') || is_tax('product_tag')) {
				$page_data = thegem_get_output_page_settings(0, array(), 'product_category');
			}
		}
		if (is_search()) {
			$page_data = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
		}
		$parallax_bg = $page_data['title_background_effect'] == 'parallax';
		$ken_burns_bg = $page_data['title_background_effect'] == 'ken_burns';
		$hide_top_area = $page_data['header_hide_top_area'] && $page_data['header_hide_top_area_tablet'] && $page_data['header_hide_top_area_mobile'];
		if($page_data['effects_page_scroller']) {
			$page_data['header_hide_top_area'] = true;
			$page_data['header_hide_top_area_tablet'] = true;
			$page_data['header_hide_top_area_mobile'] = true;
			$page_data['header_transparent'] = true;
		}
		ob_start();
?>
<?php if($page_data['title_show'] && $page_data['title_style'] == 1 && !is_singular('thegem_title') && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'title')) : ?>
#page-title {
<?php if($page_data['title_background_type']) : ?>
<?php if($page_data['title_background_type'] == 'image') : ?>
<?php if($page_data['title_background_image'] && !$parallax_bg && !$ken_burns_bg && get_post_type() !== 'thegem_title') : ?>
background-image: url('<?php echo $page_data['title_background_image']; ?>');
<?php endif; ?>
<?php if($page_data['title_background_image_color']) : ?>
background-color: <?php echo $page_data['title_background_image_color']; ?>;
<?php endif; ?>
background-repeat: <?php echo ($page_data['title_background_image_repeat'] ? '' : 'no-'); ?>repeat;
background-position-x: <?php echo $page_data['title_background_position_x']; ?>;
background-position-y: <?php echo $page_data['title_background_position_y']; ?>;
background-size: <?php echo $page_data['title_background_size']; ?>;
<?php elseif($page_data['title_background_type'] == 'gradient') : ?>
<?php if($page_data['title_background_gradient_type'] == 'radial') : ?>
background-image: radial-gradient(at <?php echo $page_data['title_background_gradient_position']; ?>,
	<?php echo $page_data['title_background_gradient_point1_color']; ?> <?php echo $page_data['title_background_gradient_point1_position']; ?>%,
	<?php echo $page_data['title_background_gradient_point2_color']; ?> <?php echo $page_data['title_background_gradient_point2_position']; ?>%);
<?php else : ?>
background-image: linear-gradient(<?php echo $page_data['title_background_gradient_angle']; ?>deg,
	<?php echo $page_data['title_background_gradient_point1_color']; ?> <?php echo $page_data['title_background_gradient_point1_position']; ?>%,
	<?php echo $page_data['title_background_gradient_point2_color']; ?> <?php echo $page_data['title_background_gradient_point2_position']; ?>%);
<?php endif; ?>
<?php elseif($page_data['title_background_type'] != 'video') : ?>
<?php if($page_data['title_background_color']) : ?>
background-color: <?php echo $page_data['title_background_color']; ?>;
<?php endif; ?>
<?php endif; ?>
<?php else : ?>
<?php if($page_data['title_background_image'] && !$parallax_bg && !$ken_burns_bg) : ?>
background-image: url('<?php echo $page_data['title_background_image']; ?>');
<?php endif; ?>
<?php if($page_data['title_background_color']) : ?>
background-color: <?php echo $page_data['title_background_color']; ?>;
<?php endif; ?>
<?php endif; ?>
<?php if($page_data['title_padding_top'] >= 0) : ?>
padding-top: <?php echo $page_data['title_padding_top']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_bottom'] >= 0) : ?>
padding-bottom: <?php echo $page_data['title_padding_bottom']; ?>px;
<?php endif; ?>
}
<?php if($page_data['title_background_type']) : ?>
<?php if($page_data['title_background_type'] == 'image' && $page_data['title_background_image'] && $parallax_bg) : ?>
.page-title-parallax-background {
background-image: url('<?php echo $page_data['title_background_image']; ?>');
}
<?php endif; ?>
<?php if($page_data['title_background_type'] == 'image' && $page_data['title_background_image'] && $ken_burns_bg) : ?>
.page-title-ken-burns-background {
background-image: url('<?php echo $page_data['title_background_image']; ?>');
}
<?php endif; ?>
<?php else : ?>
<?php if($page_data['title_background_image'] && $parallax_bg) : ?>
.page-title-parallax-background {
background-image: url('<?php echo $page_data['title_background_image']; ?>');
}
<?php endif; ?>
<?php if($page_data['title_background_image'] && $ken_burns_bg) : ?>
.page-title-ken-burns-background {
background-image: url('<?php echo $page_data['title_background_image']; ?>');
}
<?php endif; ?>
<?php endif; ?>
<?php if($page_data['title_background_type'] && $page_data['title_background_type'] == 'image' && $page_data['title_background_image'] && $page_data['title_background_image_overlay']) : ?>
.page-title-background-overlay {
background-color: <?php echo $page_data['title_background_image_overlay']; ?>;
}
<?php endif; ?>
#page-title h1,
#page-title .title-rich-content {
<?php if($page_data['title_text_color']) : ?>
color: <?php echo $page_data['title_text_color']; ?>;
<?php endif; ?>
<?php if($page_data['title_title_width'] > 0) : ?>
max-width: <?php echo $page_data['title_title_width']; ?>px;
<?php endif; ?>
}
.page-title-excerpt {
<?php if($page_data['title_excerpt_text_color']) : ?>
color: <?php echo $page_data['title_excerpt_text_color']; ?>;
<?php endif; ?>
<?php if($page_data['title_excerpt_width'] > 0) : ?>
max-width: <?php echo $page_data['title_excerpt_width']; ?>px;
<?php endif; ?>
<?php if($page_data['title_excerpt_top_margin'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_excerpt_top_margin']); ?>px;
<?php endif; ?>
}
#page-title .page-title-title {
<?php if($page_data['title_top_margin'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_top_margin']); ?>px;
<?php endif; ?>
}
.page-title-inner,
body .breadcrumbs{
<?php if($page_data['title_padding_left'] !== '' && $page_data['title_padding_left'] >= 0) : ?>
padding-left: <?php echo $page_data['title_padding_left']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_right'] !== '' && $page_data['title_padding_right'] >= 0) : ?>
padding-right: <?php echo $page_data['title_padding_right']; ?>px;
<?php endif; ?>
}
<?php endif; ?>
<?php if($page_data['breadcrumbs_default_color']) : ?>
body .breadcrumbs,
body .breadcrumbs a,
body .bc-devider:before {
color: <?php echo $page_data['breadcrumbs_default_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['breadcrumbs_active_color']) : ?>
body .breadcrumbs .current {
	color: <?php echo $page_data['breadcrumbs_active_color']; ?>;
	border-bottom: 3px solid <?php echo $page_data['breadcrumbs_active_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['breadcrumbs_hover_color']) : ?>
body .breadcrumbs a:hover {
	color: <?php echo $page_data['breadcrumbs_hover_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['title_breadcrumbs_alignment']) : ?>
body .page-title-block .breadcrumbs-container{
	text-align: <?php echo $page_data['title_breadcrumbs_alignment']; ?>;
}
<?php endif; ?>

<?php if($page_data['page_layout_breadcrumbs']) : ?>
.page-breadcrumbs{
	position: relative;
	display: flex;
	width: 100%;
	align-items: center;
	min-height: 70px;
	z-index: 1;
}
.page-breadcrumbs.page-breadcrumbs--left{
	justify-content: flex-start;
	text-align: left;
}
.page-breadcrumbs.page-breadcrumbs--center{
	justify-content: center;
	text-align: center;
}
.page-breadcrumbs.page-breadcrumbs--right{
	justify-content: flex-end;
	text-align: right;
}
.page-breadcrumbs ul{
	display: flex;
	flex-wrap: wrap;
	padding: 0;
	margin: 0;
	list-style-type: none;
}
.page-breadcrumbs ul li{
	position: relative;
}
.page-breadcrumbs ul li:not(:last-child){
	padding-right: 20px;
	margin-right: 5px;
}
.page-breadcrumbs ul li:not(:last-child):after{
	font-family: 'thegem-icons';
	content: '\e601';
	position: absolute;
	right: 0;
	top: 50%;
	transform: translateY(-50%);
	line-height: 1;
}
<?php endif; ?>
<?php if($page_data['page_layout_breadcrumbs_default_color']) : ?>
.page-breadcrumbs ul li a,
.page-breadcrumbs ul li:not(:last-child):after{
	color: <?php echo $page_data['page_layout_breadcrumbs_default_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['page_layout_breadcrumbs_active_color']) : ?>
.page-breadcrumbs ul li{
	color: <?php echo $page_data['page_layout_breadcrumbs_active_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['page_layout_breadcrumbs_hover_color']) : ?>
.page-breadcrumbs ul li a:hover{
	color: <?php echo $page_data['page_layout_breadcrumbs_hover_color']; ?>;
}
<?php endif; ?>

.block-content {
<?php if($page_data['content_padding_top'] !== '' && $page_data['content_padding_top'] >= 0) : ?>
padding-top: <?php echo $page_data['content_padding_top']; ?>px;
<?php endif; ?>
<?php if(!empty($page_data['main_background_type'])) : ?>
<?php if($page_data['main_background_type'] == 'image') : ?>
<?php if($page_data['main_background_image']) : ?>
background-image: url('<?php echo $page_data['main_background_image']; ?>');
<?php endif; ?>
<?php if($page_data['main_background_image_color']) : ?>
background-color: <?php echo $page_data['main_background_image_color']; ?>;
<?php endif; ?>
background-repeat: <?php echo ($page_data['main_background_image_repeat'] ? '' : 'no-'); ?>repeat;
background-position-x: <?php echo $page_data['main_background_position_x']; ?>;
background-position-y: <?php echo $page_data['main_background_position_y']; ?>;
background-size: <?php echo $page_data['main_background_size']; ?>;
<?php elseif($page_data['main_background_type'] == 'gradient') : ?>
<?php if($page_data['main_background_gradient_type'] == 'radial') : ?>
background-image: radial-gradient(at <?php echo $page_data['main_background_gradient_position']; ?>,
	<?php echo $page_data['main_background_gradient_point1_color']; ?> <?php echo $page_data['main_background_gradient_point1_position']; ?>%,
	<?php echo $page_data['main_background_gradient_point2_color']; ?> <?php echo $page_data['main_background_gradient_point2_position']; ?>%);
<?php else : ?>
background-image: linear-gradient(<?php echo $page_data['main_background_gradient_angle']; ?>deg,
	<?php echo $page_data['main_background_gradient_point1_color']; ?> <?php echo $page_data['main_background_gradient_point1_position']; ?>%,
	<?php echo $page_data['main_background_gradient_point2_color']; ?> <?php echo $page_data['main_background_gradient_point2_position']; ?>%);
<?php endif; ?>
<?php elseif($page_data['main_background_type'] == 'pattern'): ?>
<?php if($page_data['main_background_pattern']) : ?>
	background-image: url('<?php echo $page_data['main_background_pattern']; ?>');
	background-repeat: repeat;
	background-size: auto;
<?php endif; ?>
<?php else : ?>
<?php if($page_data['main_background_color']) : ?>
background-color: <?php echo $page_data['main_background_color']; ?>;
background-image: none;
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
}
.block-content:last-of-type {
<?php if($page_data['content_padding_bottom'] !== '' && $page_data['content_padding_bottom'] >= 0) : ?>
padding-bottom: <?php echo $page_data['content_padding_bottom']; ?>px;
<?php endif; ?>
}
<?php if(empty($hide_top_area) && !empty($page_data['header_hide_top_area'])) : ?>
#top-area {
	display: none;
}
<?php else : ?>
#top-area {
	display: block;
}
<?php endif; ?>
<?php if(thegem_get_option('header_layout') != 'vertical') : ?>
<?php if(!empty($page_data['header_transparent'])) : ?>
.header-background:before {
	opacity: <?php echo floatval($page_data['header_opacity'])/100; ?>;
}
<?php endif; ?>
<?php if(!empty($page_data['header_top_area_transparent'])) : ?>
.top-area-background:before {
	opacity: <?php echo floatval($page_data['header_top_area_opacity'])/100; ?>;
}
<?php endif; ?>
<?php endif; ?>

<?php if(!$page_data['title_show'] && $page_data['product_header_separator']): ?>
body.woocommerce #main.page__top-shadow:before{
	display: none;
	content: '';
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 5px;
	box-shadow: 0px 5px 5px -5px rgba(0, 0, 0, 0.15) inset;
	z-index: 1;
}
body.woocommerce #main.page__top-shadow.visible:before{
	display: block;
}
<?php endif; ?>

<?php if($page_data['header_source'] == 'builder') : ?>
<?php if($page_data['header_builder_sticky_desktop'] || $page_data['header_builder_sticky_mobile']): ?>
.header-sticky-template.header-sticked .header-background:before {
	opacity: <?php echo floatval($page_data['header_builder_sticky_opacity'])/100; ?>;
}
<?php endif; ?>
<?php if($page_data['header_builder_light_color']): ?>
:root {
	--header-builder-light-color: <?php echo $page_data['header_builder_light_color']; ?>;
}
<?php endif; ?>
<?php if($page_data['header_builder_light_color_hover']): ?>
:root {
	--header-builder-light-color-hover: <?php echo $page_data['header_builder_light_color_hover']; ?>;
}
<?php endif; ?>
<?php endif; ?>

@media (max-width: 991px) {
#page-title {
<?php if($page_data['title_padding_top_tablet'] >= 0 && $page_data['title_style'] == 1 && !is_singular('thegem_title') && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'title')) : ?>
padding-top: <?php echo $page_data['title_padding_top_tablet']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_bottom_tablet'] >= 0 && $page_data['title_style'] == 1 && !is_singular('thegem_title') && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'title')) : ?>
padding-bottom: <?php echo $page_data['title_padding_bottom_tablet']; ?>px;
<?php endif; ?>
}
.page-title-inner,
 body .breadcrumbs{
<?php if($page_data['title_padding_left_tablet'] !== '' && $page_data['title_padding_left_tablet'] >= 0) : ?>
padding-left: <?php echo $page_data['title_padding_left_tablet']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_right_tablet'] !== '' && $page_data['title_padding_right_tablet'] >= 0) : ?>
padding-right: <?php echo $page_data['title_padding_right_tablet']; ?>px;
<?php endif; ?>
}
.page-title-excerpt {
<?php if($page_data['title_excerpt_top_margin_tablet'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_excerpt_top_margin_tablet']); ?>px;
<?php endif; ?>
}
#page-title .page-title-title {
<?php if($page_data['title_top_margin_tablet'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_top_margin_tablet']); ?>px;
<?php endif; ?>
}
.block-content {
<?php if($page_data['content_padding_top_tablet'] !== '' && $page_data['content_padding_top_tablet'] >= 0) : ?>
padding-top: <?php echo $page_data['content_padding_top_tablet']; ?>px;
<?php endif; ?>
}
.block-content:last-of-type {
<?php if($page_data['content_padding_bottom_tablet'] !== '' && $page_data['content_padding_bottom_tablet'] >= 0) : ?>
padding-bottom: <?php echo $page_data['content_padding_bottom_tablet']; ?>px;
<?php endif; ?>
}
<?php if(empty($hide_top_area) && !empty($page_data['header_hide_top_area_tablet'])) : ?>
#top-area {
	display: none;
}
<?php else : ?>
#top-area {
	display: block;
}
<?php endif; ?>
}
@media (max-width: 767px) {
#page-title {
<?php if($page_data['title_padding_top_mobile'] >= 0 && $page_data['title_style'] == 1 && !is_singular('thegem_title') && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'title')) : ?>
padding-top: <?php echo $page_data['title_padding_top_mobile']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_bottom_mobile'] >= 0 && $page_data['title_style'] == 1 && !is_singular('thegem_title') && !(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) === 'title')) : ?>
padding-bottom: <?php echo $page_data['title_padding_bottom_mobile']; ?>px;
<?php endif; ?>
}
.page-title-inner,
body .breadcrumbs{
<?php if($page_data['title_padding_left_mobile'] !== '' && $page_data['title_padding_left_mobile'] >= 0) : ?>
padding-left: <?php echo $page_data['title_padding_left_mobile']; ?>px;
<?php endif; ?>
<?php if($page_data['title_padding_right_mobile'] !== '' && $page_data['title_padding_right_mobile'] >= 0) : ?>
padding-right: <?php echo $page_data['title_padding_right_mobile']; ?>px;
<?php endif; ?>
}
.page-title-excerpt {
<?php if($page_data['title_excerpt_top_margin_mobile'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_excerpt_top_margin_mobile']); ?>px;
<?php endif; ?>
}
#page-title .page-title-title {
<?php if($page_data['title_top_margin_mobile'] !== '') : ?>
margin-top: <?php echo intval($page_data['title_top_margin_mobile']); ?>px;
<?php endif; ?>
}
.block-content {
<?php if($page_data['content_padding_top_mobile'] !== '' && $page_data['content_padding_top_mobile'] >= 0) : ?>
padding-top: <?php echo $page_data['content_padding_top_mobile']; ?>px;
<?php endif; ?>
}
.block-content:last-of-type {
<?php if($page_data['content_padding_bottom_mobile'] !== '' && $page_data['content_padding_bottom_mobile'] >= 0) : ?>
padding-bottom: <?php echo $page_data['content_padding_bottom_mobile']; ?>px;
<?php endif; ?>
}
<?php if(empty($hide_top_area) && !empty($page_data['header_hide_top_area_mobile'])) : ?>
#top-area {
	display: none;
}
<?php else : ?>
#top-area {
	display: block;
}
<?php endif; ?>
}
<?php
		$output_css = trim(preg_replace('/\s\s+/', ' ', preg_replace('/[\r\n]+/', '', ob_get_clean())));
	}
	return $output_css;
}

function thegem_get_list_po_custom_post_types($list_only = true) {
	$post_types = array();
	foreach ( get_post_types( array( 'public' => true ), 'object' ) as $slug => $post_type ) {
		if ( ! in_array( $slug, array('post', 'page', 'product', 'thegem_news', 'thegem_pf_item', 'thegem_footer', 'thegem_title', 'attachment'), true ) ) {
			$post_types[$slug] = $post_type->label;
		}
	}
	return $list_only ? array_keys($post_types) : $post_types;
}

function thegem_get_available_po_custom_post_types() {
	$types = thegem_get_list_po_custom_post_types();
	$active_types = thegem_get_option('po_custom_types');
	if(!empty($active_types)) {
		$active_types = explode(',', $active_types);
	} else {
		$active_types = array();
	}
	return array_intersect($types, $active_types);
}

function thegem_migrate_update_color($color) {
	$str = str_replace('#', '', $color);

	if (strlen($str) == 3){
		$new_color = '#'.$str.$str;
		return $new_color;
	}

	return $color;
}

function thegem_parcing_youtube_url($url) {
	preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
	if (!empty($match)){
		$url = $match[1];
	}

	return $url;
}

function thegem_parcing_vimeo_url($url) {
	preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $match);
	if (!empty($match)){
		$url = $match[3];
	}

	return $url;
}

function thegem_gallery_get_alt_text($id) {
	global $product;
	$alt_text = get_post_meta( $id, '_wp_attachment_image_alt', true);
	$product_title = get_the_title($product->get_id());
	
	return $alt_text != '' ? esc_html($alt_text) : esc_html($product_title);
}

/* OPTIMIZATION */

function thegem_wp_rocket_acivate_delay_script() {
	if(thegem_is_wp_rocket_delay_js_active()) {
		$selectors = apply_filters('thegem_wp_rocket_delay_js_start_selectors', array(
			'.preloader:not(.slideshow-preloader)',
			'.lazy-loading',
			'.item-animations-not-inited',
			'.portfolio',
			'.gem-counter',
			'.single-product-content',
			'.vc_images_carousel',
			'.wpb_animate_when_almost_visible',
			'.page-title-parallax-background',
			'.thegem-ken-burns-bg',
			'.fullwidth-block-ken-burns',
			'.fullwidth-block-parallax-vertical',
			'.fullwidth-block-parallax-horizontal',
			'.vc_column-inner.sticky',
			'.vc_parallax',
			'.gem-video-background',
			'.diagram-item',
			'.vc_chart',
			'.widget-testimonials',
			'.gem-interactions-enabled',
			'.elementor-background-video-container',
			'.elementor-section[data-settings*=thegem_parallax_activate]',
			'.elementor-element[data-settings*=thegem_interaction]'
		));
		$selectors = implode(',', $selectors);
		$selectors_desktop = apply_filters('thegem_wp_rocket_delay_js_start_selectors_desktop', array(
			'.page-title-parallax-background',
			'.thegem-ken-burns-bg',
			'.fullwidth-block-ken-burns',
			'.fullwidth-block-parallax-vertical',
			'.fullwidth-block-parallax-horizontal',
			'.gem-interactions-enabled',
			'.elementor-section[data-settings*=thegem_parallax_activate]',
			'.elementor-element[data-settings*=thegem_interaction]'
		));
		$selectors_desktop = implode(',', $selectors_desktop);
?>
<script type="text/javascript">
var index,
	gemScriptsElements = document.querySelectorAll('<?php echo esc_js($selectors); ?>'),
	gemScriptsElementsDesktop = document.querySelectorAll('<?php echo esc_js($selectors_desktop); ?>');
	gemScriptsElementsDesktop = Array.prototype.slice.call(gemScriptsElementsDesktop);
for (index = 0; index < gemScriptsElements.length; index++) {
	if(window.innerWidth > 768 || !gemScriptsElementsDesktop.length || !gemScriptsElementsDesktop.includes(gemScriptsElements[index])) {
		var elRect = gemScriptsElements[index].getBoundingClientRect();
		if((elRect.top < window.innerHeight || elRect.top < document.documentElement.clientHeight) && elRect.bottom > 0) {
//			console.log([gemScriptsElements[index]]);
			window.dispatchEvent(new Event('mousemove'));
		}
	}
}
var gemResponsiveMenu = document.querySelector('.primary-navigation');
function gemResponsiveMenuClick(event) {
	window.gemResponsiveMenuClicked = 1;
	gemResponsiveMenu.removeEventListener('click', gemResponsiveMenuClick);
	gemResponsiveMenu.removeEventListener('touchstart', gemResponsiveMenuClick);
}
if(gemResponsiveMenu) {
	gemResponsiveMenu.addEventListener('click', gemResponsiveMenuClick);
	gemResponsiveMenu.addEventListener('touchstart', gemResponsiveMenuClick);
}
var gemResponsiveCart = document.querySelector('.mobile-cart-position-top .mobile-cart');
function gemResponsiveCartClick(event) {
	event.preventDefault();
	window.gemResponsiveCartClicked = 1;
	gemResponsiveCart.removeEventListener('click', gemResponsiveCartClick);
	gemResponsiveCart.removeEventListener('touchstart', gemResponsiveCartClick);
}
if(gemResponsiveCart) {
	gemResponsiveCart.addEventListener('click', gemResponsiveCartClick);
	gemResponsiveCart.addEventListener('touchstart', gemResponsiveCartClick);
}

function gemDetectElementClick(event) {
	event.preventDefault();
	var element = this;
	element.removeEventListener('click', gemDetectElementClick);
	element.removeEventListener('touchstart', gemDetectElementClick);
	element.classList.add('detect-delay-clicked');
}
var gemDetectClickElements = document.querySelectorAll('.detect-delay-click');
for (index = 0; index < gemDetectClickElements.length; index++) {
	gemDetectClickElements[index].addEventListener('click', gemDetectElementClick);
	gemDetectClickElements[index].addEventListener('touchstart', gemDetectElementClick);
}

window.addEventListener('rocket-load', function() {
	window.dispatchEvent(new Event('load'));
	jQuery(window).trigger('load');
	for (index = 0; index < gemDetectClickElements.length; index++) {
		if(gemDetectClickElements[index].classList.contains('detect-delay-clicked')) {
			gemDetectClickElements[index].dispatchEvent(new Event('click', {bubbles: true}));
			if(gemDetectClickElements[index].classList.contains('menu-item-cart')) {
				gemDetectClickElements[index].querySelector('.minicart-menu-link').dispatchEvent(new Event('click', {bubbles: true}));
			}
		}
		gemDetectClickElements[index].removeEventListener('click', gemDetectElementClick);
		gemDetectClickElements[index].removeEventListener('touchstart', gemDetectElementClick);
		gemDetectClickElements[index].classList.remove('detect-delay-click');
		gemDetectClickElements[index].classList.remove('detect-delay-clicked');
	}
});
</script>
<?php
	}
}
add_action('wp_footer', 'thegem_wp_rocket_acivate_delay_script', 1);

function thegem_wp_rocket_autoptimize_delay_script($tag) {
	if(thegem_is_wp_rocket_delay_js_active()) {
		$tag = str_replace('<script ', '<script type="rocketlazyloadscript" data-rocket-type="text/javascript" ', $tag);
	}
	return $tag;
}
add_filter('autoptimize_filter_js_bodyreplacementpayload', 'thegem_wp_rocket_autoptimize_delay_script');

function thegem_is_wp_rocket_delay_js_active() {
	$delay_js_active = false;
	if(defined('WP_ROCKET_VERSION')) {
		$rocket_container = apply_filters( 'rocket_container', null );
		if($rocket_container->get( 'delay_js_html' )->is_allowed()) {
			$delay_js_active = true;
			if(is_search()) {
				$delay_js_active = false;
			}
			if(is_404()) {
				$delay_js_active = false;
			}
			if(class_exists( 'WooCommerce', false ) && (is_product() || is_shop() || is_product_taxonomy())) {
				$delay_js_active = false;
			}
			if(is_singular() && (has_shortcode( get_the_content(null, false, get_the_id()), 'gem_product_grid_extended' ) || has_shortcode(get_the_content(null, false, get_the_id()), 'gem_product_grid_categories' ))) {
				$delay_js_active = false;
			}
			if(thegem_get_option('logo_position') == 'menu_center') {
				$delay_js_active = false;
			}
			$thegem_page_id = is_singular() ? get_the_ID() : 0;
			$thegem_page_data = thegem_get_output_page_settings($thegem_page_id);
			if($thegem_page_data['effects_page_scroller']) {
				$delay_js_active = false;
			}
		}
	}
	return apply_filters('thegem_is_wp_rocket_delay_js_active', $delay_js_active);
}

function thegem_inline_enqueue_scripts_print() {
	$effects_disabled = false;
	if(is_home()) {
		$effects_disabled = thegem_get_option('home_effects_disabled', false);
	} else {
		global $post;
		if(is_object($post)) {
			$thegem_page_data = get_post_meta($post->ID, 'thegem_page_data', true);
		} elseif((is_post_type_archive('product') || is_tax('product_cat') || is_tax('product_tag')) && function_exists('wc_get_page_id')) {
			$thegem_page_data = get_post_meta(wc_get_page_id('shop'), 'thegem_page_data', true);
		} else {
			$thegem_page_data = null;
		}

		if($thegem_page_data) {
			$effects_disabled = isset($thegem_page_data['effects_disabled']) ? (bool) $thegem_page_data['effects_disabled'] : false;
		}
	}

	$thegem_settings = array(
		'isTouch' => false,
		'forcedLasyDisabled' => $effects_disabled,
		'tabletPortrait' => thegem_get_option('menu_appearance_tablet_portrait') == 'responsive',
		'tabletLandscape' => thegem_get_option('menu_appearance_tablet_landscape') == 'responsive',
		'topAreaMobileDisable' => thegem_get_option('top_area_disable_mobile') == 'responsive',
		'parallaxDisabled' => false,
		'fillTopArea' => false,
		'themePath' => THEGEM_THEME_URI,
		'rootUrl' => get_site_url(),
		'mobileEffectsEnabled' => thegem_get_option('enable_mobile_lazy_loading') == 1,
		'isRTL' => is_rtl()
	);
	foreach ( (array) $thegem_settings as $key => $value ) {
		if ( !is_scalar($value) )
			continue;

		$thegem_settings[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8');
	}

	?>
	<script type="text/javascript">
		var gemSettings = <?php echo wp_json_encode($thegem_settings); ?>;
		<?php echo file_get_contents(get_template_directory() . '/js/thegem-settings-init.js'); ?>
		<?php echo file_get_contents(get_template_directory() . '/js/safari-parallax-fix.js'); ?>
		<?php echo file_get_contents(get_template_directory() . '/js/thegem-fullwidth-loader.js'); ?>
	</script>
	<?php
}
add_action('gem_before_page_content', 'thegem_inline_enqueue_scripts_print', 6);

function thegem_revslider_include_libraries($load) {
	$thegem_page_id = is_singular() ? get_the_ID() : 0;
	$thegem_shop_page = 0;
	if(is_404() && get_post(thegem_get_option('404_page'))) {
		$thegem_page_id = thegem_get_option('404_page');
	}
	if(is_post_type_archive('product') && function_exists('wc_get_page_id')) {
		$thegem_page_id = wc_get_page_id('shop');
		$thegem_shop_page = 1;
	}
	$thegem_slider_params = thegem_get_output_page_settings($thegem_page_id);
	if((is_archive() || is_home()) && !$thegem_shop_page) {
		if(is_tax('product_cat') || is_tax('product_tag')) {
			$thegem_slider_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('product_categories'), 'product_category');
		} else {
			$thegem_slider_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
		}
	}
	if(is_tax() || is_category() || is_tag()) {
		$thegem_term_id = get_queried_object()->term_id;
		if(get_term_meta($thegem_term_id , 'thegem_taxonomy_custom_page_options', true)) {
			$thegem_slider_params = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
		}
	}
	if (is_search()) {
		$thegem_slider_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
	}
	if($thegem_slider_params['title_show'] && $thegem_slider_params['title_style'] == 3 && $thegem_slider_params['slideshow_type'] == 'revslider' && $thegem_slider_params['slideshow_revslider']) {
		$load = true;
	}
	return $load;
}
add_filter('revslider_include_libraries', 'thegem_revslider_include_libraries');

function thegem_update_revslider_options() {
	$func = RevSliderGlobals::instance()->get('RevSliderFunctions');
	$global = $func->get_global_settings();
	$func->set_val($global, 'allinclude', false);
	$func->set_val($global, 'forceViewport', false);
	$func->set_val($global, 'forceLazyLoading', 'none');
	$func->set_global_settings($global);
	update_option('thegem_revslider_options_updated', 1);
}

function thegem_update_layerslider_options() {
	update_option( 'ls_conditional_script_loading', true );
	update_option('thegem_layerslider_options_updated', 1);
}

function thegem_page_title_init_video_bg_script() {
	ob_start();
?>
<script type="text/javascript">
(function() {
	var pageTitle = document.getElementById("page-title");
	var videoBG = pageTitle.querySelector('.gem-video-background');
	var videoContainer = pageTitle.querySelector('.gem-video-background-inner');
	var ratio = videoBG.dataset.aspectRatio ? videoBG.dataset.aspectRatio : '16:9';
	var regexp = /(\d+):(\d+)/;
	ratio = regexp.exec(ratio);
	if(!ratio || parseInt(ratio[1]) == 0 || parseInt(ratio[2]) == 0) {
		ratio = 16/9;
	} else {
		ratio = parseInt(ratio[1])/parseInt(ratio[2]);
	}
	if(videoContainer.offsetWidth / videoContainer.offsetHeight > ratio) {
		videoContainer.style.height = (videoContainer.offsetWidth / ratio) + 'px';
		videoContainer.style.marginTop = -(videoContainer.offsetWidth / ratio - videoBG.offsetHeight) / 2 + 'px';
	} else {
		videoContainer.style.width = (videoContainer.offsetHeight * ratio) + 'px';
		videoContainer.style.marginLeft = -(videoContainer.offsetHeight * ratio - videoBG.offsetWidth) / 2 + 'px';
	}
})();
</script>
<?php
	$output = ob_get_clean();
	return $output;
}

function thegem_header_builder($page_settings = array()) {
	if($page_settings['header_source'] != 'builder') return ;
	if(intval($page_settings['header_builder']) < 1) return ;
	$header_template = get_post(intval($page_settings['header_builder']));
	if(empty($header_template)) return ;
	$header_template_sticky = false;
	if(($page_settings['header_builder_sticky_desktop'] || $page_settings['header_builder_sticky_mobile']) && intval($page_settings['header_builder_sticky']) > 0) {
		$header_template_sticky = get_post(intval($page_settings['header_builder_sticky']));
	}
	$header_attributes = array(
		'id' => 'site-header',
		'class' => array(
			'site-header',
			'header-sticky',
		),
	);
	if(!empty($page_settings['header_transparent']) && !(defined('WPB_VC_VERSION') && (vc_is_frontend_editor() || vc_is_page_editable())) && !is_singular('thegem_templates')) {
		$header_attributes['class'][] = 'header-transparent';
		if(!empty($page_settings['header_menu_logo_light'])) {
			$header_attributes['class'][] = 'header-light';
			$header_template->post_content = str_replace('[thegem_te_logo', '[thegem_te_logo use_light="1"', $header_template->post_content);
			$header_template->post_content = str_replace('[thegem_te_menu ', '[thegem_te_menu use_light="1" ', $header_template->post_content);
		}
	}
	if(!empty($header_template_sticky)) {
		$header_attributes['class'][] = 'header-with-sticky-template';
	}
	$header_attributes = apply_filters('thegem_header_builder_attributes', $header_attributes);
	$header_attributes_str = '';
	foreach($header_attributes as $key => $val) {
		if(is_string($val)) {
			$header_attributes_str .= ' '.sanitize_title($key).'="'.esc_attr($val).'"';
		} elseif(is_array($val)) {
			$header_attributes_str .= ' '.sanitize_title($key).'="'.esc_attr(implode(' ', $val)).'"';
		}
	}
	$header_template->post_content = str_replace(array('[vc_row ', '[vc_row]', '[vc_column ', '[vc_column template_flex="1"]', '[vc_column_inner template_flex="1"'), array('[vc_row template_fw="1" ', '[vc_row template_fw="1"]', '[vc_column template_flex="1" ', '[vc_column template_flex="1"]'), $header_template->post_content);
	setup_postdata($GLOBALS['post'] =& $header_template);
?>
<header<?php echo $header_attributes_str; ?>>
	<div class="header-wrapper"><div class="header-background">
		<div class="fullwidth-content">
			<div class="thegem-template-wrapper thegem-template-header thegem-template-<?php the_ID(); ?>">
				<?php if(defined('WPB_VC_VERSION') && (vc_is_frontend_editor() || vc_is_page_editable())) : ?>
					<div class="edit-template-overlay">
						<div class="buttons">
							<a href="<?php echo vc_frontend_editor()->getInlineUrl('', get_the_ID()); ?>" target="_blank"><?php esc_html_e('Edit Header Template', 'thegem'); ?></a>
						</div>
					</div>
				<?php else : ?>
					<?php $GLOBALS['thegem_template_type'] = 'header'; the_content(); unset($GLOBALS['thegem_template_type']); ?>
				<?php endif; ?>
			</div>
		</div>
	</div></div>
</header>
<?php
	if(!empty($header_template_sticky)) :
		$header_attributes = array(
			'class' => array(
				'header-sticky-template',
				'header-wrapper',
			),
		);
		$header_attributes['class'][] = 'header-sticky';
		if($page_settings['header_builder_sticky_desktop']) {
			$header_attributes['class'][] = 'header-sticky-on-desktop';
			if($page_settings['header_builder_sticky_hide_desktop']) {
					$header_attributes['class'][] = 'header-hide-on-scroll-desktop';
			}
		}
		if($page_settings['header_builder_sticky_mobile']) {
			$header_attributes['class'][] = 'header-sticky-on-mobile';
			if($page_settings['header_builder_sticky_hide_mobile']) {
					$header_attributes['class'][] = 'header-hide-on-scroll-mobile';
			}
		}
		$header_attributes = apply_filters('thegem_header_builder_sticky_attributes', $header_attributes);
		$header_attributes_str = '';
		foreach($header_attributes as $key => $val) {
			if(is_string($val)) {
				$header_attributes_str .= ' '.sanitize_title($key).'="'.esc_attr($val).'"';
			} elseif(is_array($val)) {
				$header_attributes_str .= ' '.sanitize_title($key).'="'.esc_attr(implode(' ', $val)).'"';
			}
		}
		$header_template_sticky->post_content = str_replace(array('[vc_row ', '[vc_row]', '[vc_column ', '[vc_column template_flex="1"]', '[vc_column_inner template_flex="1"'), array('[vc_row template_fw="1" ', '[vc_row template_fw="1"]', '[vc_column template_flex="1" ', '[vc_column template_flex="1"]'), $header_template_sticky->post_content);
		setup_postdata($GLOBALS['post'] =& $header_template_sticky);
?>
<div<?php echo $header_attributes_str; ?>><div class="header-background">
	<div class="fullwidth-content">
		<div class="thegem-template-wrapper thegem-template-header thegem-template-<?php the_ID(); ?>">
			<?php if(!(defined('WPB_VC_VERSION') && (vc_is_frontend_editor() || vc_is_page_editable()))) : ?>
				<?php $GLOBALS['thegem_template_type'] = 'header'; the_content(); unset($GLOBALS['thegem_template_type']); ?>
			<?php endif; ?>
		</div>
	</div>
</div></div>
<?php
	endif;
	wp_reset_postdata();
}

function thegem_header_template_vc_styles($page_settings = array()) {
	if(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) == 'header') return ;
	if($page_settings['header_source'] != 'builder') return ;
	if(intval($page_settings['header_builder']) < 1) return ;
	$header_template = get_post(intval($page_settings['header_builder']));
	if(empty($header_template)) return ;
	$header_template_sticky = false;
	if(($page_settings['header_builder_sticky_desktop'] || $page_settings['header_builder_sticky_mobile']) && intval($page_settings['header_builder_sticky']) > 0) {
		$header_template_sticky = get_post(intval($page_settings['header_builder_sticky']));
	}
	if($header_template && $header_builder_inline_style = get_post_meta($header_template->ID, '_wpb_shortcodes_custom_css', true).get_post_meta($header_template->ID, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thegem-custom', strip_tags($header_builder_inline_style));
	}
	if($header_template_sticky && $header_template_sticky->ID != $header_template->ID && $header_builder_inline_style = get_post_meta($header_template_sticky->ID, '_wpb_shortcodes_custom_css', true).get_post_meta($header_template_sticky->ID, '_wpb_post_custom_css', true)) {
		wp_add_inline_style('thegem-custom', strip_tags($header_builder_inline_style));
	}
}
add_action('thegem_custom_header_scripts', 'thegem_header_template_vc_styles');

function thegem_custom_header_shortcodes_scripts($page_settings = array()) {
	if(is_singular('thegem_templates') && thegem_get_template_type(get_the_ID()) == 'header') return ;
	if($page_settings['header_source'] != 'builder') return ;
	if(intval($page_settings['header_builder']) < 1) return ;
	$header_template = get_post(intval($page_settings['header_builder']));
	if(empty($header_template)) return ;
	$header_template_sticky = false;
	if(($page_settings['header_builder_sticky_desktop'] || $page_settings['header_builder_sticky_mobile']) && intval($page_settings['header_builder_sticky']) > 0) {
		$header_template_sticky = get_post(intval($page_settings['header_builder_sticky']));
	}
	$header_template_sticky = empty($header_template_sticky) ? $header_template : $header_template_sticky;

	$content = $header_template->post_content;
	if(preg_match( '/vc_row/', $content)) {
		wp_enqueue_style('thegem_js_composer_front');
	}
	$shortcode_list = array();
	$head_scripts_shortcodes = apply_filters('head_scripts_shortcodes', array());
	thegem_parse_shortcodes_list($shortcode_list, array_keys($head_scripts_shortcodes), $content);

	if($header_template_sticky->ID != $header_template->ID) {
		$content = $header_template_sticky->post_content;
		if(preg_match( '/vc_row/', $content)) {
			wp_enqueue_style('thegem_js_composer_front');
		}
		$head_scripts_shortcodes = apply_filters('head_scripts_shortcodes', array());
		thegem_parse_shortcodes_list($shortcode_list, array_keys($head_scripts_shortcodes), $content);
	}
	foreach($shortcode_list as $shortcode) {
		call_user_func($head_scripts_shortcodes[$shortcode['tag']], $shortcode['attr']);
	}
}
add_action('thegem_custom_header_scripts', 'thegem_custom_header_shortcodes_scripts');

function thegem_header_template_content_scripts() {
	if(!is_singular('thegem_templates') || thegem_get_template_type(get_the_ID()) != 'header') return ;
	if(function_exists('vc_is_page_editable') && vc_is_page_editable()) return ;
	$template = get_post();

	$content = $template->post_content;
	if(preg_match( '/vc_row/', $content)) {
		wp_enqueue_style('thegem_js_composer_front');
	}
	$shortcode_list = array();
	$head_scripts_shortcodes = apply_filters('head_scripts_shortcodes', array());
	thegem_parse_shortcodes_list($shortcode_list, array_keys($head_scripts_shortcodes), $content);

	foreach($shortcode_list as $shortcode) {
		call_user_func($head_scripts_shortcodes[$shortcode['tag']], $shortcode['attr']);
	}
}
add_action('thegem_custom_header_scripts', 'thegem_header_template_content_scripts');

function thegem_parse_shortcodes_list(&$shortcode_list, $shortcode_tags, $content = null) {
	if( false === strpos( $content, '[' ) ) {
		return ;
	}
	if ( empty( $shortcode_tags ) || ! is_array( $shortcode_tags ) ) {
		return ;
	}
	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
	$tagnames = array_intersect( $shortcode_tags, $matches[1] );
	if ( empty( $tagnames ) ) {
		return ;
	}
	$content = do_shortcodes_in_html_tags( $content, false, $tagnames );
	$pattern = get_shortcode_regex( $tagnames );
	preg_match_all( "/$pattern/", $content, $shortcodes, PREG_SET_ORDER);
	foreach($shortcodes as $shortcode) {
		$tag = $shortcode[2];
		$attr = shortcode_parse_atts( $shortcode[3] );
		$content = isset( $shortcode[5] ) ? $shortcode[5] : null;
		$shortcode_list[] = array(
			'tag' => $tag,
			'attr' => $attr
		);
		if($content) {
			thegem_parse_shortcodes_list($shortcode_list, $content);
		}
	}
}

if (!function_exists('thegem_print_terms_list')) {
	function thegem_print_terms_list($terms, $is_child, $counts, $active_cat, $cat_args, $filter_by_categories_count, $filter_by_categories_hierarchy) {
		if ($is_child) {
			echo '<ul>';
		}
		foreach ($terms as $term) {
			$count = isset($counts[$term->term_id]) ? $counts[$term->term_id] : 0; ?>
			<li><a href="<?php echo esc_url(get_term_link($term)); ?>"
				   data-filter-type="category"
				   data-filter="<?php echo esc_attr($term->slug); ?>"
				   data-filter-id="<?php echo esc_attr($term->term_id); ?>"
				   class="<?php echo $active_cat == $term->slug ? 'active' : '';
				   if ($count == 0) {
					   echo ' disable';
				   } ?>"
				   rel="nofollow">
					<span class="title"><?php echo esc_html($term->name); ?></span>
					<?php if ($filter_by_categories_count) { ?>
						<span class="count"><?php echo esc_html($count); ?></span>
					<?php } ?>
				</a>

				<?php if ($filter_by_categories_hierarchy) {
					$cat_args['slug'] = [];
					$cat_args['parent'] = $term->term_id;
					$child_terms = get_terms('product_cat', $cat_args);

					if ($child_terms) {
						thegem_print_terms_list($child_terms, true, $counts, $active_cat, $cat_args, $filter_by_categories_count, $filter_by_categories_hierarchy);
					}
				} ?>
			</li>
			<?php
		}
		if ($is_child) {
			echo '</ul>';
		}
	}
}

if (!function_exists('thegem_heading_animation_init')) {
	function thegem_heading_animation_init() {
	    if (class_exists('TheGemHeadingAnimation') && is_plugin_active('thegem-elements/thegem-elements.php')) {
            TheGemHeadingAnimation::instance()->init();
        }
	}
}

add_action('wp_head', 'thegem_heading_animation_init', 0);


if (!function_exists('thegem_button_animation_init')) {
    function thegem_button_animation_init() {
        if (class_exists('TheGemButtonAnimation') && is_plugin_active('thegem-elements/thegem-elements.php')) {
            TheGemButtonAnimation::instance()->init();
        }
    }
}

add_action('wp_head', 'thegem_button_animation_init', 0);

function thegem_megamenu_template_callback() {

	$response = array(
		'status' => 'error',
		'data' => '',
	);

	if (class_exists('WPBMap'))
		WPBMap::addAllMappedShortcodes();

	if (isset($_POST['id'])) {
		$id = (int)$_POST['id'];
		$content = thegem_get_megamenu_html($id);
		if ($content) {
			$response['status'] = 'success';
			$response['data'] = $content;
		}
	}

	echo json_encode($response);

	die();
}

add_action('wp_ajax_get_megamenu_template', 'thegem_megamenu_template_callback');
add_action('wp_ajax_nopriv_get_megamenu_template', 'thegem_megamenu_template_callback');

if (!function_exists('thegem_get_megamenu_html')) {
	function thegem_get_megamenu_html($id) {
		$post = get_post($id);
		$content = '';

		if (!$post || $post->post_type != 'thegem_templates' || !$id || get_post_meta($id, 'thegem_template_type', true) !== 'megamenu') {
			return;
		}

		$content .= '<div class="container megamenu-template-container">'.do_shortcode($post->post_content).'</div>';

		$shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);

		if (!empty($shortcodes_custom_css)) {
			$content .= '<style data-type="vc_shortcodes-custom-css">';
			if (!empty($shortcodes_custom_css)) {
				$content .= $shortcodes_custom_css;
			}

			$content .= '</style>';
		}

		return $content;
	}
}

function thegem_add_additional_class_on_li($classes, $item, $args) {
	if(isset($args->li_class)) {
		$classes[] = $args->li_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'thegem_add_additional_class_on_li', 1, 3);

if (!function_exists('thegem_truncate_by_words')) {
	function thegem_truncate_by_words($phrase, $max_words) {
		$phrase_array = explode(' ',$phrase);
		if(count($phrase_array) > $max_words && $max_words > 0)
			$phrase = implode(' ',array_slice($phrase_array, 0, $max_words)).'...';
		return $phrase;
	}
}

function thegem_get_featured_image_for_bg() {
	if(is_singular()) {
		$pid = get_queried_object_id();
		if(thegem_get_template_type($pid) === 'single-product' || get_post_meta($pid, 'thegem_is_single_product', true)) {
			$product = thegem_templates_init_product();
			if(!empty($product)) {
				$pid = $product->get_id();
			}
			thegem_templates_close_product('', array('name' => ''), '');
		}
		if(has_post_thumbnail($pid)) {
			return get_the_post_thumbnail_url($pid, 'full');
		}
	}
	if(is_tax('product_cat')) {
		$tid = get_queried_object_id();
		$attachment_id = get_term_meta( $tid, 'thumbnail_id', true );
		if($attachment_id) {
			$image = wp_get_attachment_image_src( $attachment_id, 'full' );
			$image = $image[0];
			if ( $image ) {
				return $image;
			}
		}
	}
	if ( vc_is_page_editable() ) {
		return THEGEM_THEME_URI . '/images/dummy.png';
	}
	return false;
}