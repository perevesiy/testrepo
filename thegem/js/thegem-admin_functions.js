function portfolio_add_item_type(elem) {
	if (jQuery('select[id^="portfolio_item_type_"]').not('select[id="portfolio_item_type_%INDEX%"]').length >= 4)
		return false;

	var index = jQuery('select[id^="portfolio_item_type_"]:last').attr('id').replace('portfolio_item_type_', '');
	index = parseInt(index) + 1;
	var $box = jQuery(elem).siblings('.portfolio-types');
	var template = jQuery('#add_portfolio_item_type_template').html();
	$box.append(template.replace(/%INDEX%/g, index));
	init_portfolio_settings();
	return false;
}

function fix_portfolio_remove_item_type_visible() {
	if (jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').length > 1)
		jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').show();
	else
		jQuery('div[id^="portfolio_item_remove_button_"]').not('div[id="portfolio_item_remove_button_%INDEX%_wrapper"]').hide();
}

function portfolio_remove_item_type(elem) {
	var index = jQuery(elem).parent().attr('id').replace('portfolio_item_remove_button_', '').replace('_wrapper', '');
	jQuery('.portfolio_item_element_' + index).remove();
	fix_portfolio_remove_item_type_visible();
	return false;
}

function init_portfolio_page_settings() {
	jQuery('#page_portfolio_position').on('change', function() {
		var position = jQuery(this).val();
		var origin_layouts = jQuery('#page_portfolio_layout').data('layouts') || '';
		if (!origin_layouts) {
			origin_layouts = jQuery('#page_portfolio_layout').html();
			jQuery('#page_portfolio_layout').data('layouts', origin_layouts);
		}
		if (position == 'above' || position == 'below') {
			jQuery('#page_portfolio_style').attr('disabled', 'disabled');
			jQuery('#page_portfolio_pagination').attr('disabled', 'disabled');
			jQuery('#page_portfolio_items_per_page').attr('disabled', 'disabled');
			jQuery('#page_portfolio_layout option').each(function() {
				if (jQuery(this).attr('value') != '3x' && jQuery(this).attr('value') != '100%')
					jQuery(this).remove();
			});
			jQuery('#portfolio_slider_effects_enabled').show();
		} else {
			jQuery('#page_portfolio_style').removeAttr('disabled');
			jQuery('#page_portfolio_pagination').removeAttr('disabled');
			jQuery('#page_portfolio_items_per_page').removeAttr('disabled');
			jQuery('#page_portfolio_layout').html(origin_layouts);
			jQuery('#portfolio_slider_effects_enabled').hide();
		}
	});
	jQuery('#page_portfolio_position').trigger('change');
}

function init_portfolio_settings() {
	jQuery('select[id^=portfolio_item_type_]').unbind('change');
	jQuery('select[id^=portfolio_item_type_]').on('change', function() {
		var item_type = jQuery(this).val();
		var index = jQuery(this).attr('id').replace('portfolio_item_type_', '');
		if (index == '%INDEX%')
			return false;
		if (item_type == 'self-link' || item_type == 'full-image') {
			jQuery('#portfolio_item_link_' + index + '_wrapper').hide();
		} else {
			jQuery('#portfolio_item_link_' + index + '_wrapper').show();
		}
		if (item_type == 'full-image') {
			jQuery('#portfolio_item_link_target_' + index + '_wrapper').hide();
		} else {
			jQuery('#portfolio_item_link_target_' + index + '_wrapper').show();
		}
	});
	jQuery('select[id^=portfolio_item_type_]').trigger('change');
	fix_portfolio_remove_item_type_visible();
}

function init_post_item_settings() {
	jQuery('#post_item_media_type').unbind('change');
	jQuery('#post_item_media_type').on('change', function() {
		var item_type = jQuery(this).val();
		if (item_type == 'default') {
			jQuery('#post_item_link_wrapper').hide();
		} else {
			jQuery('#post_item_link_wrapper').show();
		}
	});
	jQuery('#post_item_media_type').trigger('change');
}

function init_gallery_page_settings() {
	jQuery('#page_gallery_type').on('change', function() {
		var gtype = jQuery(this).val();
		if (gtype == 'slider') {
			jQuery('#page_gallery_layout').attr('disabled', 'disabled');
			jQuery('#page_gallery_style').attr('disabled', 'disabled');
			jQuery('#page_gallery_item_style').attr('disabled', 'disabled');
		} else {
			jQuery('#page_gallery_layout').removeAttr('disabled');
			jQuery('#page_gallery_style').removeAttr('disabled');
			jQuery('#page_gallery_item_style').removeAttr('disabled');
		}
	});
	jQuery('#page_gallery_type').trigger('change');
}

function metro_max_row_height_callback() {
	var $max_height_box = jQuery('input[name="metro_max_row_height"]', this.$content);

	var $style_box = jQuery('select[name="portfolio_style"]', this.$content);
	if ($style_box.length == 0) {
		$style_box = jQuery('select[name="gallery_style"]', this.$content);
	}
	if ($style_box.length == 0) {
		$style_box = jQuery('select[name="news_grid_style"]', this.$content);
	}

	var $layout_box = jQuery('select[name="portfolio_layout"]', this.$content);
	if ($layout_box.length == 0) {
		$layout_box = jQuery('select[name="gallery_layout"]', this.$content);
	}
	if ($layout_box.length == 0) {
		$layout_box = jQuery('select[name="news_grid_layout"]', this.$content);
	}

	if ($style_box.length == 0 || $max_height_box.length == 0 || $layout_box.length == 0) {
		return false;
	}

	var old_layout = $layout_box.val();

	function changeStyleEvent() {
		if ($style_box.val() != 'metro') {
			jQuery($max_height_box).closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
			return false;
		}
		jQuery($max_height_box).closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
	}

	function changeLayoutEvent() {
		var layout = $layout_box.val();

		if (old_layout == layout) {
			return;
		}

		old_layout = layout;

		var defaults = {
			'2x': 380,
			'3x': 380,
			'4x': 280,
			'100%': 380
		};
		var default_value = 380;
		if (defaults[layout] != undefined && defaults[layout] != null) {
			default_value = defaults[layout];
		}
		$max_height_box.val(default_value);
	}

	$style_box.bind('change', changeStyleEvent).trigger('change');
	$layout_box.bind('change', changeLayoutEvent);
}

function display_titles_hover_callback() {
	var self = this;

	var $display_titles_box = jQuery('select[name="grid_display_titles"]', this.$content);
	if (!$display_titles_box.length) {
		$display_titles_box = jQuery('select[name="slider_display_titles"]', this.$content);
	}
	if (!$display_titles_box.length) {
		$display_titles_box = jQuery('select[name="news_grid_display_titles"]', this.$content);
	}
	if (!$display_titles_box.length) {
		$display_titles_box = jQuery('select[name="portfolio_display_titles"]', this.$content);
	}

	var stype = $display_titles_box.attr('name').replace('_display_titles', '');

	var $background_style_box = jQuery('select[name="' + stype + '_background_style"]', this.$content);
	var $title_style_box = jQuery('select[name="' + stype + '_title_style"]', this.$content);
	var $hover_box = jQuery('select[name="' + stype + '_hover"]', this.$content);
	var $hover_title_on_page_box = jQuery('select[name="' + stype + '_hover_title_on_page"]', this.$content);

	function changeTitlesHoverEvent() {
		var display_titles = $display_titles_box.val(),
			hover = $hover_box.val();

		if (display_titles == 'page' && (stype == 'grid' || stype == 'slider')) {
			hover = $hover_title_on_page_box.val();
		}

		if (stype == 'news_grid') {
			if (display_titles == 'page') {
				$background_style_box.closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
				$title_style_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
			} else {
				$background_style_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');

				if (hover == 'gradient' || hover == 'circular') {
					$title_style_box.closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
				} else {
					$title_style_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
				}
			}
		} else {
			if (display_titles == 'page' && (hover == 'gradient' || hover == 'circular')) {
				$title_style_box.closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
				$background_style_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
			} else {
				$title_style_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
				$background_style_box.closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
			}
		}
	}

	$display_titles_box.bind('change', changeTitlesHoverEvent);
	$hover_box.bind('change', changeTitlesHoverEvent).trigger('change');
	if ($hover_title_on_page_box.length) {
		$hover_title_on_page_box.bind('change', changeTitlesHoverEvent);
	}
}

function news_grid_hover_callback() {
	var self = this;

	var $hover_box = jQuery('select[name="news_grid_hover"]', this.$content);
	var $display_titles_box = jQuery('select[name="news_grid_display_titles"]', this.$content);

	function changeTitlesHoverEvent() {
		var display_titles = $display_titles_box.val();

		if (display_titles == 'page') {
			jQuery('.gradient, .circular', $hover_box).hide();
		} else {
			jQuery('.gradient, .circular', $hover_box).show();
		}
	}

	$display_titles_box.bind('change', changeTitlesHoverEvent).trigger('change');
}

function item_separator_callback() {
	var self = this;

	var $display_titles_box = jQuery('select[name="grid_display_titles"]', this.$content);
	if (!$display_titles_box.length) {
		$display_titles_box = jQuery('select[name="slider_display_titles"]', this.$content);
	}

	var stype = $display_titles_box.attr('name').replace('_display_titles', '');
	var $hover_title_on_page_box = jQuery('select[name="' + stype + '_hover_title_on_page"]', this.$content);
	var $separator_box = jQuery('input[name="' + stype + '_item_separator"]', this.$content);

	function changeTitlesHoverEvent() {
		var display_titles = $display_titles_box.val(),
			hover = $hover_title_on_page_box.val();

		if (display_titles == 'hover' || (display_titles == 'page' && (hover == 'gradient' || hover == 'circular'))) {
			$separator_box.closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
		} else {
			$separator_box.closest('.vc_shortcode-param').addClass('vc_dependent-hidden');
		}
	}

	$display_titles_box.bind('change', changeTitlesHoverEvent);
	$hover_title_on_page_box.bind('change', changeTitlesHoverEvent).trigger('change');
}

function news_grid_colors_callback() {
	var $displayTitlesBox = jQuery('select[name="news_grid_display_titles"]', this.$content),
		$hoverBox = jQuery('select[name="news_grid_hover"]', this.$content);

	function changeTitlesHoverEvent() {
		var $colorsTab = jQuery('input[name="item_background_color"]', this.$el).closest('.vc_edit-form-tab'),
			colorsTabId = '#' + $colorsTab.attr('id'),
			displayTitles = $displayTitlesBox.val(),
			hover = $hoverBox.val();

		jQuery('.vc_ui-tabs-line button.vc_ui-tabs-line-trigger', this.$el).each(function() {
			if (jQuery(this).data('vc-ui-element-target') == colorsTabId) {
				if (displayTitles == 'hover') {
					jQuery(this).closest('.vc_edit-form-tab-control').css('display', 'none');
				} else {
					jQuery(this).closest('.vc_edit-form-tab-control').css('display', '');
				}
			}
		});
	}

	$displayTitlesBox.bind('change', changeTitlesHoverEvent);
	$hoverBox.bind('change', changeTitlesHoverEvent).trigger('change');
}

function extended_grid_skin_callback() {

	(function($, self){
		let presets;
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: thegem_admin_functions_data.ajax_url,
			data: { action: 'extended_products_get_preset_settings' },
			success: function (response) {
				if(response.status == "success") {
					presets = response.presets
				}
			}
		});

		let init_params = [
			'product_show_add_to_cart',
			'product_show_add_to_cart_mobiles',
			'cart_button_show_icon',
			'product_show_categories',
			'product_show_reviews',
			'social_sharing',
			'product_show_new',
			'product_show_sale',
			'product_show_out',
			'product_separator',
			'border_caption_container'
		];

		$.each( init_params, function( index, value ){
			let param = $('[data-vc-ui-element="panel-shortcode-param"][data-vc-shortcode-param-name="'+value+'"]');
			if (!param.data("vcInitParam")) {
				vc.atts.init.call(self, param.data("param_settings"), param);
				param.data("vcInitParam", !0)
			}
		});

		$('select[name="extended_grid_skin"]', self.$content).on('change', function () {
			let optionsList = presets[$(this).val()];
			for (const [key, value] of Object.entries(optionsList)) {
				let checked = value == 1 ? true : false;
				$('[name="'+key+'"]', self.$content).val(value).prop( "checked", checked ).change();
			}
		});

	})(jQuery, this);
}

function product_grid_categories_skin_callback() {
	(function($, self){
		let presets;
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: thegem_admin_functions_data.ajax_url,
			data: { action: 'product_grid_categories_get_preset_settings' },
			success: function (response) {
				if(response.status == "success") {
					presets = response.presets
				}
			}
		});

		let init_params = [
			'caption_separator',
		];

		$.each( init_params, function( index, value ){
			let param = $('[data-vc-ui-element="panel-shortcode-param"][data-vc-shortcode-param-name="'+value+'"]');
			if (!param.data("vcInitParam")) {
				vc.atts.init.call(self, param.data("param_settings"), param);
				param.data("vcInitParam", !0)
			}
		});

		$('select[name="product_grid_categories_skin"]', self.$content).on('change', function () {
			let optionsList = presets[$(this).val()];
			for (const [key, value] of Object.entries(optionsList)) {
				let checked = value == 1 ? true : false;
				$('[name="'+key+'"]', self.$content).val(value).prop( "checked", checked ).change();
			}
		});

	})(jQuery, this);
}

function filters_style_callback() {
	var sorting_bottom_spacing = jQuery('input[name="sorting_bottom_spacing"]', this.$content);
	var filters_style = jQuery('select[name="filters_style"]', this.$content);

	if (filters_style.length == 0 || sorting_bottom_spacing.length == 0 ) {
		return false;
	}

	function changeStyleEvent() {
		if (filters_style.val() == 'sidebar') {
			sorting_bottom_spacing.val(40);
		}
	}
	filters_style.on('change', changeStyleEvent);
}

function layout_type_callback() {
	var layout_type = jQuery('select[name="layout_type"]', this.$content);
	var columns_desktop = jQuery('select[name="columns_desktop"]', this.$content);
	var columns_100 = jQuery('select[name="columns_100"]', this.$content);

	function changeColumnsEvent() {
		jQuery('.layout_scheme', this.$content).addClass('vc_dependent-hidden');
		if (layout_type.val() == 'creative') {
			var columns;
			if (columns_desktop.val() == '100%') {
				columns = columns_100.val() + 'x';
			} else {
				columns = columns_desktop.val();
			}
			jQuery('select[name="layout_scheme_' + columns + '"]', this.$content).closest('.vc_shortcode-param').removeClass('vc_dependent-hidden');
			jQuery('select[name="layout_scheme_' + columns + '"]', this.$content).trigger('change');
		}
	}

	changeColumnsEvent();

	layout_type.on('change', changeColumnsEvent);
	columns_desktop.on('change', changeColumnsEvent);
	columns_100.on('change', changeColumnsEvent);
}

function thegem_templates_infotext_presets_callback() {

	let $presets = jQuery('select[name="preset"]', this.$content);

	function changeInfotextEvent() {
		let preset_val = $presets.val();
		let params = [];

		switch(preset_val) {
			case 'tiny':
				params = [
					{ name: 'pack', val: 'thegem-header', type: 'select' },
					{ name: 'size', val: 'custom', type: 'select' },
					{ name: 'shape', val: 'simple', type: 'select' },
					{ name: 'icon_position_to_text', val: 'left', type: 'select' },
					{ name: 'icon_thegem_header', val: 'e622', type: 'input' },
					{ name: 'icon_size', val: '16', type: 'input' },
					{ name: 'color', val: '', type: 'input'},
					{ name: 'background_color', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_right', val: '8', type: 'input'},
					{ name: 'icon_desktop_spacing_left', val: '', type: 'input' },
					{ name: 'icon_desktop_spacing_top', val: '-2', type: 'input' },
					{ name: 'title', val: '', type: 'textarea' },
					{ name: 'title_text_style', val: 'title-default', type: 'select' },
					{ name: 'title_text_color', val: thegem_admin_functions_data.to_main_menu_level1_color, type: 'input' },
					{ name: 'subtitle', val: '', type: 'textarea' },
					{ name: 'subtitle_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'description', val: '+1 916-85-2235', type: 'textarea' },
				];
				break;
			case 'highlighted':
				params = [
					{ name: 'pack', val: 'thegem-header', type: 'select' },
					{ name: 'size', val: 'custom', type: 'select' },
					{ name: 'shape', val: 'simple', type: 'select' },
					{ name: 'icon_position_to_text', val: 'left', type: 'select' },
					{ name: 'icon_thegem_header', val: 'e737', type: 'input' },
					{ name: 'icon_size', val: '48', type: 'input' },
					{ name: 'color', val: thegem_admin_functions_data.to_styled_elements_color_1, type: 'input'},
					{ name: 'background_color', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_right', val: '8', type: 'input'},
					{ name: 'icon_desktop_spacing_left', val: '', type: 'input' },
					{ name: 'icon_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'title', val: 'Call us now', type: 'textarea' },
					{ name: 'title_text_style', val: 'text-body-tiny', type: 'select' },
					{ name: 'title_text_color', val: thegem_admin_functions_data.to_button_background_basic_color, type: 'input' },
					{ name: 'subtitle', val: '+123 4567 890', type: 'textarea' },
					{ name: 'subtitle_desktop_spacing_top', val: '-7', type: 'input' },
					{ name: 'description', val: '', type: 'textarea' },
				];
				break;
			case 'classic':
				params = [
					{ name: 'pack', val: 'thegem-header', type: 'select' },
					{ name: 'size', val: 'custom', type: 'select' },
					{ name: 'shape', val: 'circle', type: 'select' },
					{ name: 'icon_position_to_text', val: 'left', type: 'select' },
					{ name: 'icon_thegem_header', val: 'e621', type: 'input' },
					{ name: 'icon_size', val: '30', type: 'input' },
					{ name: 'color', val: thegem_admin_functions_data.to_styled_elements_color_1, type: 'input'},
					{ name: 'background_color', val: thegem_admin_functions_data.to_styled_elements_background_color, type: 'input'},
					{ name: 'icon_desktop_spacing_right', val: '20', type: 'input'},
					{ name: 'icon_desktop_spacing_left', val: '', type: 'input' },
					{ name: 'icon_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'title', val: 'FREE SHIPPING & RETURN', type: 'textarea' },
					{ name: 'title_text_style', val: 'title-default', type: 'select' },
					{ name: 'title_text_color', val: thegem_admin_functions_data.to_main_menu_level1_color, type: 'input' },
					{ name: 'subtitle', val: '', type: 'textarea' },
					{ name: 'subtitle_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'description', val: 'Free shipping on all orders over $99', type: 'textarea' },
				];
				break;
			case 'right_icon_classic':
				params = [
					{ name: 'pack', val: 'thegem-header', type: 'select' },
					{ name: 'size', val: 'custom', type: 'select' },
					{ name: 'shape', val: 'simple', type: 'select' },
					{ name: 'icon_position_to_text', val: 'right', type: 'select' },
					{ name: 'icon_thegem_header', val: 'e621', type: 'input' },
					{ name: 'icon_size', val: '30', type: 'input' },
					{ name: 'color', val: '', type: 'input'},
					{ name: 'background_color', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_right', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_left', val: '75', type: 'input' },
					{ name: 'icon_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'title', val: 'FREE SHIPPING & RETURN', type: 'textarea' },
					{ name: 'title_text_style', val: 'title-default', type: 'select' },
					{ name: 'title_text_color', val: thegem_admin_functions_data.to_main_menu_level1_color, type: 'input' },
					{ name: 'subtitle', val: '', type: 'textarea' },
					{ name: 'subtitle_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'description', val: '', type: 'textarea' },
				];
				break;
			case 'right_icon_tiny':
				params = [
					{ name: 'pack', val: 'thegem-header', type: 'select' },
					{ name: 'size', val: 'custom', type: 'select' },
					{ name: 'shape', val: 'simple', type: 'select' },
					{ name: 'icon_position_to_text', val: 'right', type: 'select' },
					{ name: 'icon_thegem_header', val: 'e62c', type: 'input' },
					{ name: 'icon_size', val: '16', type: 'input' },
					{ name: 'color', val: '', type: 'input'},
					{ name: 'background_color', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_right', val: '', type: 'input'},
					{ name: 'icon_desktop_spacing_left', val: '8', type: 'input' },
					{ name: 'icon_desktop_spacing_top', val: '-6', type: 'input' },
					{ name: 'title', val: '', type: 'textarea' },
					{ name: 'title_text_style', val: 'title-default', type: 'select' },
					{ name: 'title_text_color', val: thegem_admin_functions_data.to_main_menu_level1_color, type: 'input' },
					{ name: 'subtitle', val: '', type: 'textarea' },
					{ name: 'subtitle_desktop_spacing_top', val: '', type: 'input' },
					{ name: 'description', val: 'Contact Us', type: 'textarea' },
				];
				break;
		}

		params.forEach(el => {
			jQuery('.wpb_vc_param_value[name='+el.name+']', this.$content).val(el.val).trigger('change');
		})
	}

	$presets.bind('change', changeInfotextEvent);
}

function thegem_templates_menu_split_callback() {
	let $menuType = jQuery('select[name="menu_layout_desktop"]', this.$content);
	let $splitLayout = jQuery('select[name="split_layout_type"]', this.$content);

	function changeSplitLayoutEvent() {
		let menu = $menuType.val();
		let value = $splitLayout.val();
		let $leftMargin = jQuery('input[name="split_logo_left_margin"]', this.$content);
		let $rightMargin = jQuery('input[name="split_logo_right_margin"]', this.$content);
		let $logoAbsolute = jQuery('input[name="split_logo_absolute"]', this.$content);
		let params = [
			{ name: 'desktop_menu_stretch'},
			{ name: 'tablet_landscape_menu_stretch'},
			{ name: 'tablet_portrait_menu_stretch'},
		];

		params.forEach(el => {
			if (menu === 'split' && value === 'full'){
				//jQuery('input[name='+el.name+']', this.$content).prop( "checked", true ).trigger('change');
				jQuery("div[data-vc-shortcode-param-name='" + el.name +"']").hide();
			} else {
				//jQuery('input[name='+el.name+']', this.$content).prop( "checked", false ).trigger('change');
				jQuery("div[data-vc-shortcode-param-name='" + el.name +"']").show();

				$logoAbsolute.on('change', function () {
					if ($logoAbsolute.is(':checked')) {
						$leftMargin.val() === '' ? $leftMargin.val('150') : false;
						$rightMargin.val() === '' ? $rightMargin.val('150') : false;
					}
				})
			}
		})
	}

	$splitLayout.on('change', changeSplitLayoutEvent);
}

function thegem_te_menu_skin_callback() {

	let $presets = jQuery('select[name="thegem_te_menu_skin"]', this.$content);
	let $menu_layout_mobile = jQuery('select[name="menu_layout_mobile"]', this.$content);

	function changeMenuSkinEvent() {
		let preset_val = $presets.val();
		let mobile_layout = $menu_layout_mobile.val();
		if (preset_val != 'inherit' && (mobile_layout === 'slide-horizontal' || mobile_layout === 'slide-vertical')) {
			preset_val += '-slide';
		}
		let params = [];

		switch(preset_val) {
			case 'inherit':
				params = [
					{ name: 'hamburger_icon_color', val: '', type: 'input' },
					{ name: 'close_icon_color', val: '', type: 'input' },
					{ name: 'background_color_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay', val: '', type: 'input' },
					{ name: 'color_menu_item', val: '', type: 'input' },
					{ name: 'color_menu_item_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_active', val: '', type: 'input' },
					{ name: 'background_color_menu_item', val: '', type: 'input' },
					{ name: 'background_color_menu_item_hover', val: '', type: 'input' },
					{ name: 'background_color_menu_item_active', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay_active', val: '', type: 'input' },
					{ name: 'menu_item_space_between', val: '', type: 'input' },
					{ name: 'menu_item_padding_top', val: '', type: 'input' },
					{ name: 'menu_item_padding_right', val: '', type: 'input' },
					{ name: 'menu_item_padding_bottom', val: '', type: 'input' },
					{ name: 'menu_item_padding_left', val: '', type: 'input' },
					{ name: 'text_color_level2', val: '', type: 'input' },
					{ name: 'text_color_level3', val: '', type: 'input' },
					{ name: 'background_color_level2', val: '', type: 'input' },
					{ name: 'background_color_level3', val: '', type: 'input' },
					{ name: 'text_color_level2_hover', val: '', type: 'input' },
					{ name: 'text_color_level3_hover', val: '', type: 'input' },
					{ name: 'background_color_level2_hover', val: '', type: 'input' },
					{ name: 'background_color_level3_hover', val: '', type: 'input' },
					{ name: 'submenu_hover_pointer_color', val: '', type: 'input' },
					{ name: 'text_color_level2_active', val: '', type: 'input' },
					{ name: 'text_color_level3_active', val: '', type: 'input' },
					{ name: 'background_color_level2_active', val: '', type: 'input' },
					{ name: 'background_color_level3_active', val: '', type: 'input' },
					{ name: 'submenu_active_pointer_color', val: '', type: 'input' },
					{ name: 'submenu_border', val: '1', type: 'checkbox' },
					{ name: 'submenu_level2_border_color', val: '', type: 'input' },
					{ name: 'submenu_level3_border_color', val: '', type: 'input' },
					{ name: 'submenu_padding_top', val: '', type: 'input' },
					{ name: 'submenu_padding_right', val: '', type: 'input' },
					{ name: 'submenu_padding_bottom', val: '', type: 'input' },
					{ name: 'submenu_padding_left', val: '', type: 'input' },
					{ name: 'hamburger_icon_color_mobile', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_1_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_1_border_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_2_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_2_border_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_3_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_3_border_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color_active', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile_overlay', val: '', type: 'input' },
					{ name: 'mobile_menu_overlay_background_color', val: '', type: 'input' },
					{ name: 'mobile_menu_overlay_color', val: '', type: 'input' },
					{ name: 'mobile_menu_overlay_color_active', val: '', type: 'input' },
					{ name: 'mobile_menu_social_icon_color', val: '', type: 'input' },
				];
				break;
			case 'light':
				params = [
					{ name: 'hamburger_icon_color', val: '', type: 'input' },
					{ name: 'close_icon_color', val: '#212331', type: 'input' },
					{ name: 'background_color_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay', val: '#ffffff', type: 'input' },
					{ name: 'color_menu_item', val: '', type: 'input' },
					{ name: 'color_menu_item_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_active', val: '', type: 'input' },
					{ name: 'background_color_menu_item', val: '', type: 'input' },
					{ name: 'background_color_menu_item_hover', val: '', type: 'input' },
					{ name: 'background_color_menu_item_active', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay', val: '#212331', type: 'input' },
					{ name: 'color_menu_item_overlay_hover', val: '#00bcd4', type: 'input' },
					{ name: 'color_menu_item_overlay_active', val: '#00bcd4', type: 'input' },
					{ name: 'menu_item_space_between', val: '', type: 'input' },
					{ name: 'menu_item_padding_top', val: '', type: 'input' },
					{ name: 'menu_item_padding_right', val: '', type: 'input' },
					{ name: 'menu_item_padding_bottom', val: '', type: 'input' },
					{ name: 'menu_item_padding_left', val: '', type: 'input' },
					{ name: 'text_color_level2', val: '#5f727f', type: 'input' },
					{ name: 'text_color_level3', val: '#5f727f', type: 'input' },
					{ name: 'background_color_level2', val: '#f4f6f7', type: 'input' },
					{ name: 'background_color_level3', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level2_hover', val: '#3c3950', type: 'input' },
					{ name: 'text_color_level3_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level2_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level3_hover', val: '#494c64', type: 'input' },
					{ name: 'submenu_hover_pointer_color', val: '', type: 'input' },
					{ name: 'text_color_level2_active', val: '#3c3950', type: 'input' },
					{ name: 'text_color_level3_active', val: '#00bcd4', type: 'input' },
					{ name: 'background_color_level2_active', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level3_active', val: '#ffffff', type: 'input' },
					{ name: 'submenu_active_pointer_color', val: '', type: 'input' },
					{ name: 'submenu_border', val: '1', type: 'checkbox' },
					{ name: 'submenu_level2_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'submenu_level3_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'submenu_padding_top', val: '', type: 'input' },
					{ name: 'submenu_padding_right', val: '', type: 'input' },
					{ name: 'submenu_padding_bottom', val: '', type: 'input' },
					{ name: 'submenu_padding_left', val: '', type: 'input' },
					{ name: 'hamburger_icon_color_mobile', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_1_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_1_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color', val: '#f4f6f7', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_2_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_2_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color', val: '#f4f6f7', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_3_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_3_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color', val: '#f4f6f7', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color_active', val: '#ffffff', type: 'input' },
					{ name: 'close_icon_color_mobile_overlay', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_overlay_background_color', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_overlay_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_overlay_color_active', val: '#00bcd4', type: 'input' },
				];
				break;
				case 'light-slide':
				params = [
					{ name: 'hamburger_icon_color', val: '', type: 'input' },
					{ name: 'close_icon_color', val: '#212331', type: 'input' },
					{ name: 'background_color_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay', val: '#ffffff', type: 'input' },
					{ name: 'color_menu_item', val: '', type: 'input' },
					{ name: 'color_menu_item_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_active', val: '', type: 'input' },
					{ name: 'background_color_menu_item', val: '', type: 'input' },
					{ name: 'background_color_menu_item_hover', val: '', type: 'input' },
					{ name: 'background_color_menu_item_active', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay', val: '#212331', type: 'input' },
					{ name: 'color_menu_item_overlay_hover', val: '#00bcd4', type: 'input' },
					{ name: 'color_menu_item_overlay_active', val: '#00bcd4', type: 'input' },
					{ name: 'menu_item_space_between', val: '', type: 'input' },
					{ name: 'menu_item_padding_top', val: '', type: 'input' },
					{ name: 'menu_item_padding_right', val: '', type: 'input' },
					{ name: 'menu_item_padding_bottom', val: '', type: 'input' },
					{ name: 'menu_item_padding_left', val: '', type: 'input' },
					{ name: 'text_color_level2', val: '#5f727f', type: 'input' },
					{ name: 'text_color_level3', val: '#5f727f', type: 'input' },
					{ name: 'background_color_level2', val: '#f4f6f7', type: 'input' },
					{ name: 'background_color_level3', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level2_hover', val: '#3c3950', type: 'input' },
					{ name: 'text_color_level3_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level2_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level3_hover', val: '#494c64', type: 'input' },
					{ name: 'submenu_hover_pointer_color', val: '', type: 'input' },
					{ name: 'text_color_level2_active', val: '#3c3950', type: 'input' },
					{ name: 'text_color_level3_active', val: '#00bcd4', type: 'input' },
					{ name: 'background_color_level2_active', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level3_active', val: '#ffffff', type: 'input' },
					{ name: 'submenu_active_pointer_color', val: '', type: 'input' },
					{ name: 'submenu_border', val: '1', type: 'checkbox' },
					{ name: 'submenu_level2_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'submenu_level3_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'submenu_padding_top', val: '', type: 'input' },
					{ name: 'submenu_padding_right', val: '', type: 'input' },
					{ name: 'submenu_padding_bottom', val: '', type: 'input' },
					{ name: 'submenu_padding_left', val: '', type: 'input' },
					{ name: 'hamburger_icon_color_mobile', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_1_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_1_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color_active', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_2_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_2_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color', val: '#f0f3f2', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color_active', val: '#f0f3f2', type: 'input' },
					{ name: 'mobile_menu_lvl_3_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_3_border_color', val: '#dfe5e8', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color', val: '#5f727f', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color_active', val: '#494c64', type: 'input' },
					{ name: 'close_icon_color_mobile_overlay', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_overlay_background_color', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_overlay_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_overlay_color_active', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_social_icon_color', val: '#99a9b5', type: 'input' },
				];
				break;
			case 'dark':
				params = [
					{ name: 'hamburger_icon_color', val: '', type: 'input' },
					{ name: 'close_icon_color', val: '#ffffff', type: 'input' },
					{ name: 'background_color_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay', val: '#212331', type: 'input' },
					{ name: 'color_menu_item', val: '', type: 'input' },
					{ name: 'color_menu_item_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_active', val: '', type: 'input' },
					{ name: 'background_color_menu_item', val: '', type: 'input' },
					{ name: 'background_color_menu_item_hover', val: '', type: 'input' },
					{ name: 'background_color_menu_item_active', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay', val: '#ffffff', type: 'input' },
					{ name: 'color_menu_item_overlay_hover', val: '#00bcd4', type: 'input' },
					{ name: 'color_menu_item_overlay_active', val: '#00bcd4', type: 'input' },
					{ name: 'menu_item_space_between', val: '', type: 'input' },
					{ name: 'menu_item_padding_top', val: '', type: 'input' },
					{ name: 'menu_item_padding_right', val: '', type: 'input' },
					{ name: 'menu_item_padding_bottom', val: '', type: 'input' },
					{ name: 'menu_item_padding_left', val: '', type: 'input' },
					{ name: 'text_color_level2', val: '#99a9b5', type: 'input' },
					{ name: 'text_color_level3', val: '#99a9b5', type: 'input' },
					{ name: 'background_color_level2', val: '#393d50', type: 'input' },
					{ name: 'background_color_level3', val: '#212331', type: 'input' },
					{ name: 'text_color_level2_hover', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level3_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level2_hover', val: '#212331', type: 'input' },
					{ name: 'background_color_level3_hover', val: '#131121', type: 'input' },
					{ name: 'submenu_hover_pointer_color', val: '', type: 'input' },
					{ name: 'text_color_level2_active', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level3_active', val: '#00bcd4', type: 'input' },
					{ name: 'background_color_level2_active', val: '#212331', type: 'input' },
					{ name: 'background_color_level3_active', val: '#212331', type: 'input' },
					{ name: 'submenu_active_pointer_color', val: '', type: 'input' },
					{ name: 'submenu_border', val: '1', type: 'checkbox' },
					{ name: 'submenu_level2_border_color', val: '#494c64', type: 'input' },
					{ name: 'submenu_level3_border_color', val: '#494c64', type: 'input' },
					{ name: 'submenu_padding_top', val: '', type: 'input' },
					{ name: 'submenu_padding_right', val: '', type: 'input' },
					{ name: 'submenu_padding_bottom', val: '', type: 'input' },
					{ name: 'submenu_padding_left', val: '', type: 'input' },
					{ name: 'hamburger_icon_color_mobile', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_1_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_1_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color_active', val: '#181828', type: 'input' },
					{ name: 'mobile_menu_lvl_2_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_2_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color_active', val: '#181828', type: 'input' },
					{ name: 'mobile_menu_lvl_3_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_3_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color_active', val: '#181828', type: 'input' },
					{ name: 'close_icon_color_mobile_overlay', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_overlay_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_overlay_color', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_overlay_color_active', val: '#00bcd4', type: 'input' },
				];
				break;
			case 'dark-slide':
				params = [
					{ name: 'hamburger_icon_color', val: '', type: 'input' },
					{ name: 'close_icon_color', val: '#ffffff', type: 'input' },
					{ name: 'background_color_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay_hamburger', val: '', type: 'input' },
					{ name: 'background_color_overlay', val: '#212331', type: 'input' },
					{ name: 'color_menu_item', val: '', type: 'input' },
					{ name: 'color_menu_item_hover', val: '', type: 'input' },
					{ name: 'color_menu_item_active', val: '', type: 'input' },
					{ name: 'background_color_menu_item', val: '', type: 'input' },
					{ name: 'background_color_menu_item_hover', val: '', type: 'input' },
					{ name: 'background_color_menu_item_active', val: '', type: 'input' },
					{ name: 'color_menu_item_overlay', val: '#ffffff', type: 'input' },
					{ name: 'color_menu_item_overlay_hover', val: '#00bcd4', type: 'input' },
					{ name: 'color_menu_item_overlay_active', val: '#00bcd4', type: 'input' },
					{ name: 'menu_item_space_between', val: '', type: 'input' },
					{ name: 'menu_item_padding_top', val: '', type: 'input' },
					{ name: 'menu_item_padding_right', val: '', type: 'input' },
					{ name: 'menu_item_padding_bottom', val: '', type: 'input' },
					{ name: 'menu_item_padding_left', val: '', type: 'input' },
					{ name: 'text_color_level2', val: '#99a9b5', type: 'input' },
					{ name: 'text_color_level3', val: '#99a9b5', type: 'input' },
					{ name: 'background_color_level2', val: '#393d50', type: 'input' },
					{ name: 'background_color_level3', val: '#212331', type: 'input' },
					{ name: 'text_color_level2_hover', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level3_hover', val: '#ffffff', type: 'input' },
					{ name: 'background_color_level2_hover', val: '#212331', type: 'input' },
					{ name: 'background_color_level3_hover', val: '#131121', type: 'input' },
					{ name: 'submenu_hover_pointer_color', val: '', type: 'input' },
					{ name: 'text_color_level2_active', val: '#ffffff', type: 'input' },
					{ name: 'text_color_level3_active', val: '#00bcd4', type: 'input' },
					{ name: 'background_color_level2_active', val: '#212331', type: 'input' },
					{ name: 'background_color_level3_active', val: '#212331', type: 'input' },
					{ name: 'submenu_active_pointer_color', val: '', type: 'input' },
					{ name: 'submenu_border', val: '1', type: 'checkbox' },
					{ name: 'submenu_level2_border_color', val: '#494c64', type: 'input' },
					{ name: 'submenu_level3_border_color', val: '#494c64', type: 'input' },
					{ name: 'submenu_padding_top', val: '', type: 'input' },
					{ name: 'submenu_padding_right', val: '', type: 'input' },
					{ name: 'submenu_padding_bottom', val: '', type: 'input' },
					{ name: 'submenu_padding_left', val: '', type: 'input' },
					{ name: 'hamburger_icon_color_mobile', val: '', type: 'input' },
					{ name: 'close_icon_color_mobile', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_1_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_1_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_lvl_1_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_1_background_color_active', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_lvl_2_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_2_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color', val: '#393d4f', type: 'input' },
					{ name: 'mobile_menu_lvl_2_color_active', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_lvl_2_background_color_active', val: '#393d4f', type: 'input' },
					{ name: 'mobile_menu_lvl_3_border', val: '1', type: 'checkbox' },
					{ name: 'mobile_menu_lvl_3_border_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color', val: '#99a9b5', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color', val: '#494c64', type: 'input' },
					{ name: 'mobile_menu_lvl_3_color_active', val: '#3c3950', type: 'input' },
					{ name: 'mobile_menu_lvl_3_background_color_active', val: '#00bcd4', type: 'input' },
					{ name: 'close_icon_color_mobile_overlay', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_overlay_background_color', val: '#212331', type: 'input' },
					{ name: 'mobile_menu_overlay_color', val: '#ffffff', type: 'input' },
					{ name: 'mobile_menu_overlay_color_active', val: '#00bcd4', type: 'input' },
					{ name: 'mobile_menu_social_icon_color', val: '#99a9b5', type: 'input' },
				];
				break;
		}

		params.forEach(el => {
			if (el.type === 'input') {
				jQuery('input[name='+el.name+']', this.$content).val(el.val).trigger('change');
			}
			if (el.type === 'checkbox') {
				let checked = el.val == 1 ? true : false;
				jQuery('input[name='+el.name+']', this.$content).prop( "checked", checked ).trigger('change');
			}
		})
	}

	$presets.on('change', changeMenuSkinEvent);
}

function thegem_templates_switcers_callback() {
	let $type = jQuery('select[name="type"]', this.$content);
	let $flag = jQuery('input[name="flag"]', this.$content);
	let $currencyNativeName = jQuery('input[name="currency_native_name"]', this.$content);
	let $currencyTranslatedName = jQuery('input[name="currency_translated_name"]', this.$content);

	if ($flag.is(':checked')) {
		jQuery("div[data-vc-shortcode-param-name='list_arrow_prefix']").hide();
	}

	$currencyNativeName.on('change', function () {
		if ($currencyNativeName.is(':checked')) {
			$currencyTranslatedName.prop( "checked", false ).trigger('change');
		}
	});

	$currencyTranslatedName.on('change', function () {
		if ($currencyTranslatedName.is(':checked')) {
			$currencyNativeName.prop( "checked", false ).trigger('change');
		}
	});

	function changeSwitcherTypeEvent() {
		let type = $type.val();

		$flag.on('change', function () {
			if ($flag.is(':checked')) {
				jQuery("div[data-vc-shortcode-param-name='list_arrow_prefix']").hide();
			} else {
				jQuery("div[data-vc-shortcode-param-name='list_arrow_prefix']").show();
			}
		});

		if (type === 'dropdown'){
			jQuery('.thegem-param-delimeter-heading.param--dropdown').show();
			jQuery('.thegem-param-delimeter-heading.param--list').hide();
		} else {
			jQuery('.thegem-param-delimeter-heading.param--dropdown').hide();
			jQuery('.thegem-param-delimeter-heading.param--list').show();
		}
	}

	$type.on('change', changeSwitcherTypeEvent).trigger('change');
}

function thegem_te_product_tabs_style_callback() {
	let $style = jQuery('select[name="tabs_style"]', this.$content);
	let $align = jQuery('select[name="tabs_align"]', this.$content);

	function changeTabsStyleEvent() {
		let styleVal = $style.val();

		if (styleVal === 'vertical'){
			jQuery('option[value="center"]', $align).prop('disabled', true);
			jQuery('option[value="stretch"]', $align).prop('disabled', true);
		} else {
			jQuery('option[value="center"]', $align).prop('disabled', false);
			jQuery('option[value="stretch"]', $align).prop('disabled', false);
		}
	}

	$style.on('change', changeTabsStyleEvent);
}

function thegem_te_product_add_to_cart_callback() {
	let $button = jQuery('input[name="add_to_cart_btn"]', this.$content);
	let $wishlist = jQuery('input[name="add_to_wishlist_btn"]', this.$content);
	let $amount = jQuery('input[name="amount_control"]', this.$content);

	function changeButtonEvent() {
		if ($button.is(':checked')) {
			jQuery("div[data-vc-shortcode-param-name='layout_delim_head_wishlist']").show();
			$wishlist.prop('checked', true).val(1);
			jQuery("div[data-vc-shortcode-param-name='layout_delim_head_amount']").show();
			$amount.prop('checked', true).val(1);
		} else {
			jQuery("div[data-vc-shortcode-param-name='layout_delim_head_wishlist']").hide();
			$wishlist.prop('checked', false).val(0);
			jQuery("div[data-vc-shortcode-param-name='layout_delim_head_amount']").hide();
			$amount.prop('checked', false).val(0);
		}
	}

	$button.on('change', changeButtonEvent);
}

(function($){
	$(function() {
		$('input.color-select').each(function(){
			$('<span class="color-select-button"></span>')
				.insertAfter($(this))
				.css('backgroundColor', $(this).val());
			$(this).ColorPicker({
				onSubmit: function(hsb, hex, rgb, el) {
					$(el).val('#' + hex);
					$(el).ColorPickerHide();
					$(el).change();
				},
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(this.value);
				}
			});
		});
		$('body').on('change', 'input.color-select', function(){
			$(this).next('.color-select-button').css('backgroundColor', $(this).val());
		});
		$('input.color-select + .color-select-button').click(function(){
			$(this).prev('input').ColorPickerShow();
		});
	});
})(jQuery);

(function($){
	$(function() {
		$('input.picture-select-id, input.picture-select, input.video-select, input.audio-select').each(function() {
			if ($(this).nextAll('.picture-select-button').length == 0) {
				$('<button class="picture-select-button">Select</button>').insertAfter(this);
			}
		});
		var media_selector_frame;
		$('body').on('click', 'input.picture-select-id + button, input.picture-select + button, input.video-select + button, input.audio-select + button', function(event) {
				var $this = $(this);
				event.preventDefault();
				var mediaType = 'image';
				var mediaTypeTitle = 'Image';
				var $formfield = $(this).prev('input.picture-select-id, input.picture-select, input.video-select, input.audio-select');

				if($formfield.hasClass('video-select')) {
					var mediaType = 'video';
					var mediaTypeTitle = 'Video';
				}
				if($formfield.hasClass('audio-select')) {
					var mediaType = 'audio';
					var mediaTypeTitle = 'Audio';
				}

				// Create the media frame.
				media_selector_frame = wp.media.frames.mediaSelector = wp.media({
					// Set the title of the modal.
					title: 'Select '+mediaTypeTitle,
					button: {
						text: 'Insert '+mediaTypeTitle,
					},
					library: {
						type: mediaType
					}
				});
				// When an image is selected, run a callback.
				media_selector_frame.on( 'select', function() {
					var attachment = media_selector_frame.state().get('selection').first();
					attachment = attachment.toJSON();
					if(attachment.id) {
						if($formfield.hasClass('picture-select-id')) {
							$formfield.val(attachment.id).trigger('change');
						} else {
							$formfield.val(attachment.url).trigger('change');
						}
					}
				});
					// Finally, open the modal.
				media_selector_frame.open();
		});
	});
})(jQuery);

(function($){
	$(function() {
		$('#shortcode-generator').each(function() {
			var $scg = $(this);
			var $scgSelect = $('.shortcodes-select select', $scg);
			var $scgItems = $('.shortcode-item', $scg);
			var $scgInsert = $('.shortcode-insert-button button', $scg);
			var $scgResult = $('.shortcode-result textarea', $scg);

			$scgItems.each(function() {
				var $scgItem = $(this);
				$(':input', $scgItem).change(function() {
					var paramsSting = $.map($(':input', $scgItem).serializeArray(), function(a) {
						if(a.name != 'scg_content' && a.value != '') {
							return a.name.replace('scg_', '')+'="'+a.value+'"';
						}
						return null;
					}).join(' ');
					var shortcodeString = '['+$scgItem.data('name')+' '+paramsSting+']';
					if($scgItem.data('is_container') === 1) {
						if($('[name="scg_content"]:input', $scgItem).length ) {
							shortcodeString = shortcodeString + $('[name="scg_content"]:input', $scgItem).val();
						}
						shortcodeString = shortcodeString + '[/'+$scgItem.data('name')+']';
					}
					$scgResult.val(shortcodeString);
				});
			});

			$scgSelect.change(function() {
				$scgItems.hide();
				$scgInsert.parent().hide();
				$scgResult.parent().hide();
				if($('#' + $(this).val()).length) {
					$('#' + $(this).val()).show();
					$('#' + $(this).val() + ' :input').eq(0).trigger('change');
					$scgInsert.parent().show();
					$scgResult.parent().show();
				}
			}).trigger('change');

			$scgInsert.click(function(e) {
				e.preventDefault();
				if(tinymce.editors.content !== undefined && !$('textarea#content').is(':visible')) {
					var selectionText = tinymce.editors.content.selection.getContent();
					var replaceString = $scgResult.val();
					tinymce.editors.content.selection.setContent(replaceString);
				} else if($('textarea#content').length > 0) {
					var textareaText = $('textarea#content').val();
					var selectionStart = $('textarea#content').get(0).selectionStart;
					var selectionEnd = $('textarea#content').get(0).selectionEnd;
					var selectionText = textareaText.substr(selectionStart, selectionEnd-selectionStart);
					var replaceString = $scgResult.val();;
					$('textarea#content').val(textareaText.substr(0, selectionStart) + replaceString + textareaText.substr(selectionEnd));
				}
			});

		});
	});
})(jQuery);

(function($) {
	$(function() {
		$('#portfoliosets_icon_pack').change(function() {
			var $form = $(this).closest('form');
			$('.gem-icon-info', $form).hide();
			$('.gem-icon-info-' + $(this).val(), $form).show();
		}).trigger('change');
	});
})(jQuery);

(function($) {
	$(function() {
		if(window.adminpage == 'update-core-php') {
			$('form[name="upgrade-themes"]').on('submit', function(e) {
				var $form = $(this);
				if($(':input[name="checked[]"][value="thegem"]', $form).is(':checked')) {
					e.preventDefault();
					$.fancybox.open({
						src: thegem_admin_functions_data.ajax_url +'?'+ $.param({action:'thegem_theme_update_confirm'}),
						type: 'ajax',
						smallBtn : true
					})
					$(document).on('change', '#thegem-update-confirm-checkbox', function() {
						$('#thegem-update-confirm-button').prop('disabled', !$(this).is(':checked'));
					});
					$(document).on('click', '#thegem-update-confirm-button', function(e) {
						e.preventDefault();
						$('form[name="upgrade-themes"]').off('submit');
						$form.submit();
					});
				}
			});
		}

		if(window.adminpage == 'themes-php') {
			var themes = window.wp.themes;
			themes.view.Theme = themes.view.Theme.extend({
				events: {
					'click': themes.isInstall ? 'preview': 'expand',
					'keydown': themes.isInstall ? 'preview': 'expand',
					'touchend': themes.isInstall ? 'preview': 'expand',
					'keyup': 'addFocus',
					'touchmove': 'preventExpand',
					'click .theme-install': 'installTheme',
					'click .update-message': 'updateThegemTheme'
				},

				expand: function( event ) {
					var self = this;

					event = event || window.event;

					// 'enter' and 'space' keys expand the details view when a theme is :focused
					if ( event.type === 'keydown' && ( event.which !== 13 && event.which !== 32 ) ) {
						return;
					}

					// Bail if the user scrolled on a touch device
					if ( this.touchDrag === true ) {
						return this.touchDrag = false;
					}

					// Prevent the modal from showing when the user clicks
					// one of the direct action buttons
					if ( $( event.target ).is( '.theme-actions a' ) ) {
						return;
					}

					// Prevent the modal from showing when the user clicks one of the direct action buttons.
					if ( $( event.target ).is( '.theme-actions a, .update-message, .update-message p, .button-link, .notice-dismiss' ) ) {
						return;
					}

					// Set focused theme to current element
					themes.focusedTheme = this.$el;

					this.trigger( 'theme:expand', self.model.cid );
				},

				updateThegemTheme: function( event ) {
					if(this.model.get( 'id' ) == 'thegem') {
						var _this = this;
						$.fancybox.open({
							src: thegem_admin_functions_data.ajax_url +'?'+ $.param({action:'thegem_theme_update_confirm'}),
							type: 'ajax',
							smallBtn : true
						})

						$(document).on('change', '#thegem-update-confirm-checkbox', function() {
							$('#thegem-update-confirm-button').prop('disabled', !$(this).is(':checked'));
						});
						$(document).on('click', '#thegem-update-confirm-button', function(e) {
							e.preventDefault();
							_this.updateTheme(event);
							$.fancybox.close();
						});
					} else {
						this.updateTheme(event);
					}
				}
			});

			themes.view.Details = themes.view.Details.extend({
				events: {
					'click': 'collapse',
					'click .delete-theme': 'deleteTheme',
					'click .left': 'previousTheme',
					'click .right': 'nextTheme',
					'click #update-theme': 'updateThegemTheme'
				},

				updateThegemTheme: function( event ) {
					var _this = this;
					event.preventDefault();
					if(this.model.get( 'id' ) == 'thegem') {
						var _this = this;
						event.preventDefault();
						$.fancybox.open({
							src: thegem_admin_functions_data.ajax_url +'?'+ $.param({action:'thegem_theme_update_confirm'}),
							type: 'ajax',
							smallBtn : true
						})

						$(document).on('change', '#thegem-update-confirm-checkbox', function() {
							$('#thegem-update-confirm-button').prop('disabled', !$(this).is(':checked'));
						});
						$(document).on('click', '#thegem-update-confirm-button', function(e) {
							e.preventDefault();
							_this.updateTheme(event);
							$.fancybox.close();
						});
					} else {
						_this.updateTheme(event);
					}
				}
			});
		}

		$('.thegem-update-notice').each(function() {
			var $notice = $(this);
			$('.thegem-view-details-link', $notice).fancybox({
				type: 'iframe',
				toolbar: false,
				smallBtn : true
			});
			$('.thegem-update-link', $notice).on('click', function(e) {
				e.preventDefault();
				var $link = $(this);
				$.fancybox.open({
					src: thegem_admin_functions_data.ajax_url +'?'+ $.param({action:'thegem_theme_update_confirm'}),
					type: 'ajax',
					smallBtn : true
				})
				$(document).on('change', '#thegem-update-confirm-checkbox', function() {
					$('#thegem-update-confirm-button').prop('disabled', !$(this).is(':checked'));
				});
				$(document).on('click', '#thegem-update-confirm-button', function(e) {
					e.preventDefault();
					window.location.href = $link.attr('href');
				});
			});
		});

	});
})(jQuery);

thegem_set_editor_content = function( html ) {
	var editor,
		hasTinymce = typeof tinymce !== 'undefined',
		hasQuicktags = typeof QTags !== 'undefined';

	if ( ! wpActiveEditor ) {
		if ( hasTinymce && tinymce.activeEditor ) {
			editor = tinymce.activeEditor;
			window.wpActiveEditor = editor.id;
		} else if ( ! hasQuicktags ) {
			return false;
		}
	} else if ( hasTinymce ) {
		editor = tinymce.get( wpActiveEditor );
	}

	if ( editor && ! editor.isHidden() ) {
		editor.execCommand( 'mceSetContent', false, html );
	} else {
		document.getElementById( wpActiveEditor ).value = html;
	}

};

thegem_get_editor_content = function() {
	var editor, html,
		hasTinymce = typeof tinymce !== 'undefined',
		hasQuicktags = typeof QTags !== 'undefined';

	if ( ! wpActiveEditor ) {
		if ( hasTinymce && tinymce.activeEditor ) {
			editor = tinymce.activeEditor;
			window.wpActiveEditor = editor.id;
		} else if ( ! hasQuicktags ) {
			return false;
		}
	} else if ( hasTinymce ) {
		editor = tinymce.get( wpActiveEditor );
	}

	if ( editor && ! editor.isHidden() ) {
		html = editor.getContent();
	} else {
		html = document.getElementById( wpActiveEditor ).value;
	}

	return html;
};

(function($) {
	thegem_show_elementor_conflict_popup = function() {
		var $popupContent = $('#thegem-elementor-conflict-popup');
		if($popupContent.length) {
			$.fancybox.open({
				src : '#thegem-elementor-conflict-popup',
				type : 'inline',
				modal: true
			});
		}
	}
})(jQuery);


(function($) {
	$(function() {
		let $videoBox = $('.product-video-box');

		$('button', $videoBox).addClass('preview button');

		$('#remove-product-video').on('click', function (e) {
			e.preventDefault();

			$('input', $videoBox).val('');
			$('select', $videoBox).val('').change();
		});

		let initType = $('#thegem_product_video_type').val();
		typeSwitcher(initType);

		$('#thegem_product_video_type').on('change', function () {
			let changeType = this.value;
			typeSwitcher(changeType);
		});
		
		function typeSwitcher(type) {
			switch (type) {
				case 'youtube':
					$('.product-video-box').show();
					$('#product-video-self').hide();
					break;
				case 'vimeo':
					$('.product-video-box').show();
					$('#product-video-self').hide();
					break;
				case 'self':
					$('.product-video-box').show();
					$('#product-video-id').hide();
					break;
				default:
					$('.product-video-box:not(.visible)').hide();
			}
		}
	});
})(jQuery);


(function($) {
	$(function() {
		function addBtn(html){
			return '<button type="button" aria-pressed="true" class="widgets-chooser-button" aria-label="Add to: '+html+'">'+html+'</button>';
		}

		let $pageWidgetsLink = $('#pw-widgets .widget-top');

		$pageWidgetsLink.on('click', function () {
			let $widgetsChooser = $(this).siblings('.widgets-chooser');
			let $elArr = $('li', $widgetsChooser);

			$.each($elArr, function( index, value ) {
				$elArr.eq(index).html(addBtn(value.innerText));
			});
		});
	});
})(jQuery);
