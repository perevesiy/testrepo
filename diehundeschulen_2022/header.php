<?php

if($_SERVER['REQUEST_URI']=='/shop/' || $_SERVER['REQUEST_URI']=='/shop')
{
    header('Location: '.get_field('registration_url','option'));
    die();
}


$thegem_page_id = is_singular() ? get_the_ID() : 0;
$thegem_shop_page = 0;
if (is_404() && get_post(thegem_get_option('404_page'))) {
    $thegem_page_id = thegem_get_option('404_page');
}
if (is_post_type_archive('product') && function_exists('wc_get_page_id')) {
    $thegem_page_id = wc_get_page_id('shop');
    $thegem_shop_page = 1;
}
$thegem_header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_page_id);
if ((is_archive() || is_home()) && !$thegem_shop_page) {
    if (is_tax('product_cat') || is_tax('product_tag')) {
        $thegem_header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('product_categories'), 'product_category');
    } else {
        $thegem_header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('blog'), 'blog');
    }
}
if (is_tax() || is_category() || is_tag()) {
    $thegem_term_id = get_queried_object()->term_id;
    if (get_term_meta($thegem_term_id, 'thegem_taxonomy_custom_page_options', true)) {
        $thegem_header_params = $thegem_effects_params = thegem_get_output_page_settings($thegem_term_id, array(), 'term');
    }
}
if (is_search()) {
    $thegem_header_params = $thegem_effects_params = thegem_get_output_page_settings(0, thegem_theme_options_get_page_settings('search'), 'search');
}
if ($thegem_effects_params['effects_page_scroller']) {
    $thegem_header_params['header_hide_top_area'] = true;
    $thegem_header_params['header_hide_top_area_tablet'] = true;
    $thegem_header_params['header_hide_top_area_mobile'] = true;
    $thegem_header_params['header_transparent'] = true;
}
$thegem_header_light = $thegem_header_params['header_menu_logo_light'] ? '_light' : '';
$hide_top_area = $thegem_header_params['header_hide_top_area'] && $thegem_header_params['header_hide_top_area_tablet'] && $thegem_header_params['header_hide_top_area_mobile'];
if (thegem_get_option('header_layout') == 'vertical' || is_singular('thegem_templates')) {
    $thegem_header_params['header_transparent'] = false;
}
$logo_position = thegem_get_option('logo_position', 'left');
if (thegem_get_option('logo_position', 'left') == 'menu_center' && !((has_nav_menu('primary') || $thegem_header_params['header_custom_menu']) && $thegem_header_params['menu_show'])) {
    $logo_position = 'center';
}
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <script>
    var head = document.getElementsByTagName('head')[0];

// Save the original method
var insertBefore = head.insertBefore;

// Replace it!
head.insertBefore = function (newElement, referenceElement) {
    console.log(newElement.href);
    if (newElement.href && newElement.href.indexOf('googleapis') >0) {
        return;
    }

    insertBefore.call(head, newElement, referenceElement);
};
    </script>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
        <?php
//get_template_part('partials/test-head');
        ?>
        <?php
        if (thegem_get_option('font_preload_enabled')) {
            $fonts = thegem_get_option('font_preload_preloaded_fonts');
            $additionalFonts = thegem_additionals_fonts();
            $sysFontUri = THEGEM_THEME_URI . '/fonts/';

            $sysFonts = array(
                'Thegem Icons' => $sysFontUri . 'thegem-icons.woff',
                'Elegant Icons' => $sysFontUri . 'elegant/ElegantIcons.woff',
                'Materialdesign Icons' => $sysFontUri . 'material/materialdesignicons.woff',
                'Fontawesome Icons' => $sysFontUri . 'fontawesome/fontawesome-webfont.woff',
                'Header Icons' => $sysFontUri . 'thegem-header/thegem-header.woff',
                'Thegem Socials' => $sysFontUri . 'thegem-socials.woff',
            );

            foreach (explode(',', $fonts) as $font) {
                $url = isset($sysFonts[$font]) ? $sysFonts[$font] : '';
                if (!$url) {
                    foreach ($additionalFonts as $additionalFont) {
                        if ($additionalFont['font_name'] == $font && isset($additionalFont['font_url_woff'])) {
                            $url = $additionalFont['font_url_woff'];
                            break;
                        }
                    }
                }

                if ($url) {
                    echo '<link rel="preload" as="font" crossorigin="anonymous" type="font/woff" href="' . $url . "\">\n";
                }
            }
        }
        ?>	
    </head>

    <?php
    $thegem_preloader_data = $thegem_header_params;
    ?>

    <body <?php body_class(); ?> data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>" data-home-url="<?php echo get_home_url() ?>">
        <style>
           
        </style>
        <div id="entire-content">
            <?php do_action('gem_before_page_content'); ?>

            <?php if ($thegem_preloader_data && !empty($thegem_preloader_data['enable_page_preloader'])) : ?>
                <div id="page-preloader"><div class="page-preloader-spin"></div></div>
                <?php do_action('gem_after_page_preloader'); ?>
            <?php endif; ?>

            <?php if (thegem_get_option('header_layout') == 'perspective' && $thegem_header_params['menu_show']) : ?>
                <div id="thegem-perspective" class="thegem-perspective effect-moveleft">
                    <div class="thegem-perspective-menu-wrapper <?php echo ($thegem_header_params['header_menu_logo_light'] ? ' header-colors-light' : ''); ?> mobile-menu-layout-<?php echo esc_attr(thegem_get_option('mobile_menu_layout', 'default')); ?><?php echo thegem_get_option('hamburger_menu_cart_position') ? ' perspective-without-cart' : ''; ?>">
                        <nav id="primary-navigation" class="site-navigation primary-navigation perspective-navigation vertical right" role="navigation">
                            <?php do_action('thegem_before_perspective_nav_menu'); ?>
                            <?php if ($thegem_header_params['header_custom_menu']) : ?>
                                <?php wp_nav_menu(array('menu' => $thegem_header_params['header_custom_menu'], 'menu_id' => 'primary-menu', 'menu_class' => apply_filters('thegem_nav_menu_class', 'nav-menu styled no-responsive'), 'container' => false, 'walker' => new TheGem_Mega_Menu_Walker)); ?>
                            <?php else: ?>
                                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu', 'menu_class' => apply_filters('thegem_nav_menu_class', 'nav-menu styled no-responsive'), 'container' => false, 'walker' => new TheGem_Mega_Menu_Walker)); ?>
                            <?php endif; ?>
                            <?php do_action('thegem_after_perspective_nav_menu'); ?>
                        </nav>
                    </div>
                <?php endif; ?>

                <div id="page" class="layout-<?php echo esc_attr(thegem_get_option('page_layout_style', 'fullwidth')); ?><?php echo esc_attr(thegem_get_option('header_layout') == 'vertical' ? ' vertical-header' : ''); ?> header-style-<?php echo esc_attr(thegem_get_option('header_layout') == 'vertical' || thegem_get_option('header_layout') == 'fullwidth_hamburger' ? 'vertical' : thegem_get_option('header_style')); ?>">

                    <?php if (!thegem_get_option('disable_scroll_top_button')) : ?>
                        <a href="#page" class="scroll-top-button"></a>
                    <?php endif; ?>

                    <?php /* if(!$thegem_effects_params['effects_hide_header'] && $thegem_effects_params['header_source'] == 'default') : ?>

                      <?php if(!$hide_top_area && (thegem_get_option('header_layout') == 'vertical' || thegem_get_option('top_area_disable_fixed')) && !($thegem_header_params['header_transparent'] && $thegem_header_params['header_top_area_transparent'])) : ?>
                      <div class="top-area-background<?php echo thegem_get_option('top_area_disable_fixed') ? ' top-area-scroll-hide' : ''; ?>">
                      <?php get_template_part('top_area'); ?>
                      </div>
                      <?php endif; ?>

                      <?php
                      header here
                      ?>

                      <?php endif; */ ?>

                    <?php
                    wp_head();
                    get_template_part('partials/top-header');
                    ?>

                    <?php
                    if (!$thegem_effects_params['effects_hide_header'] && $thegem_effects_params['header_source'] == 'builder') :
                        thegem_header_builder($thegem_header_params);
                    endif;
                    ?>
 <style>
                    #entire-content .codespacing_progress_map_area img
                    {
                        transform: translate(-50%,-50%)!important;
                    }
                    
                    #entire-content .codespacing_progress_map_area .cluster img
                    {
                        transform: none!important;
                    }
                    
                    @media all and (min-width:1300px)
                    {
                    footer .container
                    {
                        width: 1230px;
                        max-width: 1230px;
                    }
                    }
                    
                </style>
                <?php
                get_template_part('partials/pricing-table');
                ?>
                    <div id="main" class="site-main page__top-shadow visible">
