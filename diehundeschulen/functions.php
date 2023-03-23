<?php





/* The Next Level | nexle.de - START */



/*
Juliane Krause Webdesign und Programmierung - START
http://www.krause-webkonzepte.de/wordpress-kategorien-ausschliessen/
http://www.krause-webkonzepte.de/wordpress-kategorien-aus-sidebar-ausschliessen/

eMail: 24.07.2014 Mischa Kolibius
*/
function the_category_filter($thelist, $separator=' ') {
	if(!defined('WP_ADMIN')) {
		// IDs der Kategorien, die Ihr auschließen wollt
		$exclude = array(1);
		
		$exclude2 = array();
		foreach($exclude as $c) {
			$exclude2[] = get_cat_name($c);
		}

		$cats = explode($separator, $thelist);
		$newlist = array();
		
		foreach($cats as $cat) {
			$catname = trim(strip_tags($cat));
			
			if(!in_array($catname, $exclude2)) {
				$newlist[] = $cat;
			}
		}
		
		return implode($separator, $newlist);
	}
	else {
		return $thelist;
	}
}
add_filter('the_category','the_category_filter', 10, 2);

function widget_categories_args_filter($cat_args) {
	// IDs der Kategorien, die Ihr auschließen wollt
	$cat_list = array(1);
	
	if ( $cat_args['exclude'] ) {
		$cat_args['exclude'] = implode(',', $cat_list);
	}
	
	return $cat_args;
}
add_filter('widget_categories_args', 'widget_categories_args_filter', 10, 1);
/*
Juliane Krause Webdesign und Programmierung - END
*/



// Quiz Master Next
if (isset($_POST['complete_quiz'])) {
	try {
		$postData = "name=".$_POST['mlwUserName'];
		$postData .= "&email=".$_POST['mlwUserEmail'];
		$postData .= "&INXMAIL_HTTP_REDIRECT=%23";
		$postData .= "&INXMAIL_HTTP_REDIRECT_ERROR=%23";
		$postData .= "&INXMAIL_SUBSCRIPTION=FZS_dieHundeschulen_Quizz";
		$postData .= "&INXMAIL_CHARSET=utf8";
		$postData .= "&company_id=5";
		$postData .= "&security_key=dhdf%21gfgt.7f4%2Cgh9";
		
		$curlInit = curl_init();
		
		curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curlInit, CURLOPT_URL, "http://login.inxmail.com/forum-zeitschriften/subscription/servlet");
		curl_setopt($curlInit, CURLOPT_POST, true);
		
		if (isset($n) and $n) {
			curl_setopt($curlInit, CURLOPT_FOLLOWLOCATION, true);
		}
		
		curl_setopt($curlInit, CURLOPT_POSTFIELDS, $postData);
		
		$success = curl_exec($curlInit);
		$errorMessage = curl_error($curlInit);
		
		if(empty($errorMessage) != true) {
			$act_date = date("d-m-Y H:i:s");
			$error = curl_error($curlInit).var_export($success,true);
			
			$nexle_log = "ERROR => ".$act_date." - Quiz Master Next:\n".$error;
			file_put_contents('nelxe_log/nexle_log.txt', $nexle_log."\n\n", FILE_APPEND);
		}
		
		curl_close($curlInit);
	}
	catch(Exception $e) {
		$act_date = date("d-m-Y H:i:s");
		$error = $e->getMessage();
		
		$nexle_log = "ERROR => ".$act_date." - Quiz Master Next:\n".$error;
		file_put_contents('nelxe_log/nexle_log.txt', $nexle_log."\n\n", FILE_APPEND);
	}
}

// include files via shortcode
function include_file($atts) {
	extract(shortcode_atts(array('filepath' => 'NULL'), $atts));
	
	if ($filepath!='NULL' && file_exists(TEMPLATEPATH.$filepath)) {
		ob_start();
		include(TEMPLATEPATH.$filepath);
		$content = ob_get_clean();
		return $content;
	}
}
add_shortcode('include', 'include_file');


add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}


add_filter('frm_validate_field_entry', 'your_custom_validation', 20, 3);
function your_custom_validation($errors, $field, $value) {
	// echo var_dump($errors);
	// change 31 to the ID of the confirmation field (second field)
	if ($field->id == 815) {
		//change 30 to the ID of the first field
		$first_value = $_POST['item_meta'][813];
		
		if ($first_value != $value) {
			$errors['field'. $field->id] = 'Die Passwörter stimmen nicht überein';//Customize your error message
		}
		else {
			// if it matches, this clears the second field so it won't be saved
			$_POST['item_meta'][$field->id] = '';
		}
	}
	
	return $errors;
}

function login_with_email_address($username) {
        $user = get_user_by('email',$username);
        if(!empty($user->user_login))
                $username = $user->user_login;
        return $username;
}
add_action('wp_authenticate', 'login_with_email_address');
/* The Next Level | nexle.de - END */





/**
 * Registers our main widget area and the front page widget areas.
 */
function diehundeschulen_widgets_init() {
    register_sidebar( array(
        'name' => 'Hundeschulen Übersicht',
        'id' => 'sidebar-school-overview',
        'description' => "Rechten Spalte bei der Übersicht der Hundeschulen",
        'before_widget' => '<aside id="%1$s" class="widget schoolListSidebar %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => 'Hundeschulen Kartenübersicht',
        'id' => 'sidebar-school-overview-map',
        'description' => "Rechten Spalte bei der Kartenübersicht der Hundeschulen",
        'before_widget' => '<aside id="%1$s" class="widget schoolListSidebar %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar( array(
        'name' => 'Hundeschulen Eintrag',
        'id' => 'sidebar-school-entry',
        'description' => "Rechten Spalte bei einem Hundeschulen Eintrag",
        'before_widget' => '<aside id="%1$s" class="widget schoolDetailSidebar %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Kategorie Sidebar',
        'id' => 'sidebar-category',
        'description' => "Auf allen Beitragsübersichtsseiten wie z.B. Blog",
        'before_widget' => '<aside id="%1$s" class="widget blogSidebar %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar( array(
        'name' => 'Gobale rechte Spalte',
        'id' => 'sidebar-global-right',
        'description' => "Rechten Spalte auf jeder Seite",
        'before_widget' => '<aside id="%1$s" class="widget globalSidebar %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Footer',
        'id' => 'sidebar-footer',
        'description' => "Inhalt in der Fußzeile",
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4>',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => 'Banner',
        'id' => 'sidebar-banner',
        'description' => "Banner über der Seite",
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Skyscraper',
        'id' => 'sidebar-skyscraper',
        'description' => "Skyscraper am rechten Rand",
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => 'Bugfix Sidebar 9',
        'id' => 'sidebar-bugfix',
        'description' => "Diese Sidebar existiert nur, weil die Startseite nich läd wenn 8 Sidebars registriert sind. Stand 09.10.2013",
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action( 'widgets_init', 'diehundeschulen_widgets_init' );
/*
function diehundeschulen_add_shortcodes() {
    $nop_modules['slogan_2'] = array(
        'name' => 'Slogan2',
        'options' => array(
            'slogan_content' => array(
                'title' => 'Slogan text',
                'type' => 'wp_editor',
                'is_content' => true
            ),
            'css_class' => array(
                'title' => 'Additional css class',
                'type' => 'text'
            )
        )
    );
    $nop_modules = apply_filters( 'nop_modules', $nop_modules);
}
add_action('init','diehundeschulen_add_shortcodes');

*/


function diehundeschulen_scripts_styles() {
    /*
    * Adds JavaScript
    */
    //wp_enqueue_script( 'dh-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );

    /*
    * Loads style.css
    */
    wp_enqueue_style('diehundeschulen', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'diehundeschulen_scripts_styles' );


/**
 * Remove some items from the search
 */
/*
function diehundeschulen_search_filter( $query ) {
	if  ( $query->is_search ) {
		//$query->set('post__not_in', array(1,2,3) );
		//$query->set('post__not_in', array(1,2,3) );
		$query->set('post_type', 'post');
	}
        return $query;

}
add_action('pre_get_posts', 'diehundeschulen_search_filter');
*/

/*
add_shortcode('nop_slogan', 'nop_slogan');
function nop_slogan($atts, $content = null) {
    //$attributes = et_lb_get_attributes( $atts, "nop_slogan" );
    $attributes = array('class' => 'nop', 'inline_styles' => '');
    var_dump($atts);
    var_dump($content);

    $output = 	"<div {$attributes['class']}{$attributes['inline_styles']}>
					<div class='et_lb_module_content clearfix'>"
        . do_shortcode( nop_fix_shortcodes($content) )
        . "<span class='right-quote'></span>" .
        "</div> <!-- end .et_lb_module_content -->
    </div> <!-- end .et_lb_slogan -->";

    return $output;
}

if ( ! function_exists('nop_fix_shortcodes') ){
    function nop_fix_shortcodes($content){
        $replace_tags_from_to = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );

        return strtr( $content, $replace_tags_from_to );
    }
}
*/


function get_breadcrumb() {
    global $post;

    $delimiter = ' &gt; ';


    if (!is_front_page()) {
        //bloginfo('name');
        printf('<a href="%s">%s</a>', get_option('home'), 'Startseite');

        if ($post->post_parent !== 0) {
            echo $delimiter;
            $id = $post->post_parent;
            $title = get_the_title($id);
            $link = get_page_link($id);
            printf('<a href="%s">%s</a>', $link, $title);
        }

        if (is_category() || is_single()) {
            echo $delimiter;
            the_category('title_li=');
            if (is_single()) {
                echo $delimiter;
                the_title();
            }
        } elseif (is_page()) {
            echo $delimiter;
            echo the_title();
        }

        /*
        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            echo single_cat_title('', false);


	    }
        //global $wp_query;
        global $post;
        //var_dump($wp_query->get_queried_object());
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        var_dump($cat);
        var_dump(get_the_category($post->ID));
        */
    }
}

function get_contentNav() {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="contentNavigation">
			<div class="nav-previous"><?php previous_posts_link('Vorherige Beiträge'); ?></div>
			<div class="nav-next"><?php next_posts_link('Weitere Beiträge'); ?></div>
		</nav>
	<?php endif;
}

function is_schoolEntry() {
    $result = false;
    if (is_page_template('page-templates/school-detail.php')) {
        $result = true;
    }
    /* or */
    if (!$result) {
        $categories = get_the_category();
        foreach ($categories as $cat) {
            if ($cat->cat_name == "Hundeschulen") {
                $result = true;
            }
        }
    }
    return $result;
}


function search_form_shortcode( ) {
    get_search_form( );
}
add_shortcode('search_form', 'search_form_shortcode');

/**
 * Allow FZS_Admin WP Rocket capabilities
 */
function wprocket_add_purge_posts_to_fzsadmin()
{
        $role = get_role('fzs_admin');

        $role->add_cap('rocket_purge_cache');
        $role->add_cap('rocket_purge_posts');
        $role->add_cap('rocket_purge_terms');
        $role->add_cap('rocket_purge_opcache');
        $role->add_cap('rocket_purge_cloudflare_cache');
        $role->add_cap('rocket_purge_sucuri_cache');
        $role->add_cap('rocket_purge_users');
        $role->add_cap('rocket_manage_options');
        update_option('fzs_admin', 'granted');
}

add_action('init', 'wprocket_add_purge_posts_to_fzsadmin', 12);
