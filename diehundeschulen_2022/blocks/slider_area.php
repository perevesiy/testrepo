<?php
global $section;
$background_image = $section['background_image'];
$banner_image = $section['banner_image'];
$banner_url = $section['banner_url'];
$title = $section['title'];
$slider = $section['slider'];
$white_arrows = $section['white_arrows'];
$white_title = $section['white_title'];
$data_source = $section['data_source'];
$posts_and_pages = $section['posts_and_pages'];
$or_html_code = $section['or_html_code'];

if (!function_exists('getPidByUrl')) {

    function getPidByUrl($content) {
        $href = explode('href="', $content);
        $href = array_pop($href);
        $href = explode('"', $href);
        $href = $href[0];
        $href = str_replace(get_home_url(), '', $href);
        $pid = url_to_postid($href);
        return $pid;
    }

}

if ($data_source == 'schools') {
    $slider = get_posts([
        'posts_per_page' => 20,
        'meta_query' => [
            [
                'key' => 'top10',
                'value' => [1, true]
            ]
        ]
    ]);
    /* var_dump($top_10);
      $slider = get_posts([
      'posts_per_page' => 10,
      'orderby' => 'meta_value_num',
      'meta_key' => 'rating_average',
      'order' => 'desc',
      'tax_query' => [
      [
      'taxonomy' => 'category',
      'terms' => [2]
      ]
      ]
      ]); */

    usort($slider, function ($a, $b) {
        $premium1 = isPremiumSchool($a->ID);
        $premium2 = isPremiumSchool($b->ID);
        
        $pa = $a->post_title;
        $pb = $b->post_title;
        if(strpos($pa, 'Pfotentreff Olfen')!==false)
        {
            return -1;
        }
        if(strpos($pb, 'Pfotentreff Olfen')!==false)
        {
            return 1;
        }
        
        return $premium1 < $premium2;
    });
} elseif ($data_source == 'reviews') {
    $articles = do_shortcode('[display-frm-data id=2965 filter=limited]');
    $articles = explode('<article>', $articles);
    $p = [];
    foreach ($articles as $key => $art) {
        if ($key == 0) {
            continue;
        }
        $content = explode('</article>', $art);
        $content = $content[0];
        $content = str_replace('<br />', '', $content);

        $pid = getPidByUrl($content);

        if ($pid) {
            $the_post = get_post($pid);
            if (strpos($content, '<div class="the-review">') === false) {
                $content = str_replace('<div>', '<span class="post_title">' . $the_post->post_title . '</span><div>', $content);
            } else {
                $content = str_replace('<div class="the-review">', '<span class="post_title">' . $the_post->post_title . '</span><div class="the-review">', $content);
            }
        }

        $p[] = $content;
    }

    $slider = $p;
} elseif ($data_source == 'reviews-top') {

    $articles = do_shortcode('[display-frm-data id=2965 filter=limited]');
    $articles = explode('<article>', $articles);
    $p = [];
    foreach ($articles as $key => $art) {
        if ($key == 0) {
            continue;
        }

        if (strpos($art, '[check][/check]') > 0) {
            continue;
        }

        $content = explode('</article>', $art);
        $content = $content[0];
        $content = str_replace('<br />', '', $content);
        $pid = getPidByUrl($content);

        if ($pid) {
            $the_post = get_post($pid);

            if (strpos($content, '<div class="the-review">') === false) {
                $content = str_replace('<div>', '<span class="post_title">' . $the_post->post_title . '</span><div>', $content);
            } else {
                $content = str_replace('<div class="the-review">', '<span class="post_title">' . $the_post->post_title . '</span><div class="the-review">', $content);
            }
        }
        $p[] = $content;
    }

    $slider = $p;
} elseif ($data_source == 'manual-posts') {
    $slider = $posts_and_pages;
}

//var_dump($p);

if (!empty($slider) || $banner_image || $or_html_code):
    ?>
    <div id="home-slider-area" class="<?php if ($white_arrows): ?>white-arrows<?php endif ?> <?php if ($white_title): ?>white-title<?php endif ?>" <?php if ($background_image): ?>style="background: url('<?php echo $background_image['url'] ?>')!important;background-size:cover!important;"<?php endif ?>>
        <div class="container-fluid">
                <?php if (trim($or_html_code)): ?>
                <div id="b1">
                <?php echo $or_html_code ?>
                </div>
    <?php elseif ($banner_image): ?>
                <p id="b1">
                    <a href="<?php echo $banner_url ?>">
        <?php imgOrSvg($banner_image); ?>
                    </a>
                </p>
            <?php endif ?>
                <?php if ($slider): ?>
                <h2>
        <?php echo $title ?>
                </h2>
                <div class="home-slider <?php if ($data_source == 'reviews-top'): ?>sort-by-rating<?php endif ?> <?php if ($data_source): ?>schools-slider<?php endif ?>">
                    <?php
                    foreach ($slider as $key => $single_sa_slider) {
                        ?>
                        <div class="sort-it-now">
                            <?php
                            if ($data_source == 'manual-posts') {
                                ?>
                                <div class="one-home-slide">


                                    <p class="ohs-title">
                <?php echo $single_sa_slider->post_title ?>
                                    </p>


                                    <p class="ohs-text">
                <?php echo get_the_excerpt($single_sa_slider->ID) ?>
                                    </p>

                                    <p class="ohs-school-url">
                                        <a rel="nofollow" href="<?php echo get_permalink($single_sa_slider->ID) ?>">
                                            WEITERLESEN 
                <?php echo loadSvg('link-arrow.svg'); ?>
                                        </a>
                                    </p>

                                </div>
                                <?php
                            } else if ($data_source == 'schools') {
                                oneHundSchoolSlider($single_sa_slider);
                            } elseif ($data_source == 'reviews' || $data_source == 'reviews-top') {
                                if (strpos($single_sa_slider, '[check][/check]') > -1) {
                                    continue;
                                }
                                if (stripos($single_sa_slider, 'Zur') === false) {
                                    continue;
                                }


                                $single_sa_slider = str_replace('[check]Jetzt freigeben[/check]', '', $single_sa_slider);
                                /* $link = explode('href="',$single_sa_slider);
                                  $link = explode('"',$link[1]);
                                  $link = $link[0];
                                  $link = explode('/hundeschule',$link);
                                  $link = '/hundeschule'.$link[1]; */

                                $single_sa_slider = str_replace('<a', '<a rel="nofollow" ', $single_sa_slider);
                                ?>
                                <div>
                                    <div class="one-school one-review">
                <?php echo $single_sa_slider ?>                                        
                                    </div>
                                </div>
                                <?php
                            } else {

                                oneHomeSlide($single_sa_slider);
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
    <?php endif ?>
        </div>
    </div>
    <?php


                

        

        



            
 endif;