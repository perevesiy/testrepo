<?php
//var_dump(get_post_meta(get_the_ID()));
//die();

get_header();
the_post();

$entry = getFrmEntryPerPost(get_the_ID());
//var_dump($entry);
global $wpdb;
$post_id = get_the_ID();
$item = $wpdb->get_row('select * from ' . esc_sql($wpdb->prefix) . 'frm_items where post_id="' . esc_sql($post_id) . '"');

$premium = isPremiumSchool(get_the_ID());

$e = FrmEntry::getOne($item->id, true);

$photos_metas = [106, 887, 889, 891, 893];
$photos = [];

$logo = false;

foreach ($entry->metas as $meta) {

    //var_dump($meta->field_id);;
    //var_dump($meta->meta_value);;

    if (in_array($meta->field_id, $photos_metas)) {
        $photos[] = $meta->meta_value;
    }
    //echo '<br /><br />';
    
    
    
    if ($meta->field_id == 103) {

        $description = $meta->meta_value;
    }

    if ($meta->field_id == 105) {

        $logo = $meta->meta_value;
    }
    if ($meta->field_id == 99) {

        $activities = $meta->meta_value;
    }

    $pictures = [];
    $ids = [106, 887, 889, 891, 893];

    foreach ($ids as $id) {
        if (in_array($meta->field_id, $ids)) {
            $pictures[] = $meta->meta_value;
        }
    }

    if ($meta->field_id == 123) {
        $title = $meta->meta_value;
    }

    if ($meta->field_id == 121) {
        $first_name = $meta->meta_value;
    }

    if ($meta->field_id == 122) {
        $last_name = $meta->meta_value;
    }

    if ($meta->field_id == 109) {
        $type = $meta->meta_value;
    }
    if ($meta->field_id == 84) {
        $street = $meta->meta_value;
    }
    if ($meta->field_id == 85) {
        $plz = $meta->meta_value;
    }
    if ($meta->field_id == 86) {
        $ort = $meta->meta_value;
    }

    if ($meta->field_id == 188) {
        $phone = $meta->meta_value;
    }

    if ($meta->field_id == 100) {
        $email = $meta->meta_value;
    }

    if ($meta->field_id == 98) {
        $www = $meta->meta_value;
    }

    if ($meta->field_id == 1193) {
        $facebook_url = $meta->meta_value;
    }

    if ($meta->field_id == 1192) {
        $instagram_url = $meta->meta_value;
    }

    if ($meta->field_id == 1194) {
        $tiktok_url = $meta->meta_value;
    }

    if ($meta->field_id == 135) {
        $ref = $meta->meta_value;
    }
    
    if ($meta->field_id == 188) {
        $phone1 = $meta->meta_value;
    }
    if ($meta->field_id == 189) {
        $phone2 = $meta->meta_value;
    }
    if ($meta->field_id == 190) {
        $phone3 = $meta->meta_value;
    }
    if ($meta->field_id == 1331) {
        $event = $meta->meta_value;
    }

    //echo '<br /><br /><br />';
}

if (has_post_thumbnail() && !$logo) {
    $logo = get_post_thumbnail_id(get_the_ID());
}

if($logo)
{
    $photos = array_merge([$logo],$photos);
}

$artiv = [];
if ($activities) {
    $artiv = unserialize($activities);
}

$entries = [];

if (trim($ref)) {
    $_GET['ref_key'] = $ref;

    global $wpdb;
    $comments = $wpdb->get_results('select * from ' . $wpdb->prefix . 'frm_item_metas where field_id=126 and meta_value=' . $ref);

    foreach ($comments as $comment) {
        $entries[] = $comment->item_id;
    }

    $entries = array_unique($entries);
}


$count = 0;
$sum = 0;
$average = 0;

$grades = [
    1 => 0,
    2 => 0,
    3 => 0,
    4 => 0,
    5 => 0
];

if (!empty($entries)) {
    $comments = do_shortcode('[display-frm-data id=2965 entry_id="' . implode(',', $entries) . '"]');

    $reviews = explode('the-number-of-the-stars">', $comments);

    foreach ($reviews as $key => $rev) {
        if ($key == 0) {
            continue;
        }

        if (strpos($rev, '[check][/check]') > 0) {
            continue;
        }




        $p = explode('<', $rev);
        $p = $p[0];
        
        

        if (trim($p) && $p>=1 ) {
            
            if(isset($grades[(int) $p]))
            {            
                $count += 1;
                $sum += (int) $p;
                $grades[(int) $p]++;
            }
        }
    }


    if ($count > 0) {
        $average = $sum / $count;
        //var_dump(get_the_ID());
    } else {
        //var_dump(get_the_ID());
        $average = 0;
    }
}

$comments = str_replace('[check]Jetzt freigeben[/check]', '', $comments);

update_post_meta(get_the_ID(), 'rating_sum', $sum);
update_post_meta(get_the_ID(), 'rating_count', $count);
update_post_meta(get_the_ID(), 'rating_average', $average);

//var_dump($logo);
//var_dump($pictures);


$content = get_the_content();

$content = explode('Mobil:',$content);

if(count($content)>1)
{
    //echo 'testtest';
    $p = explode("\n",$content[1]);
    $ph = trim($p[0]);
    if(trim($ph)!="")
    {
        $phone = $ph;
        
    }
    
}

if($phone1 && $phone2 && $phone3)
{
    $phone = '('.$phone1.') '.$phone2.$phone3;
}

?>
<div id="single-school-top">
    <div class="container-fluid">

        <div id="breacrumbs-the">
            <a href="<?php echo get_field('search_page', 'option') ?>">Hundeschulen</a>
            <span>/</span>
            <a href="<?php echo get_permalink() ?>"><?php the_title() ?></a>


        </div>

        <div class="row row-spaced">
            <div class="col-sm-4" id="single-school-picture">
                <?php
                if (!empty($photos) && $premium) {
                    //var_dump($photos);
                    ?>
                    <div class="hund-photos-gallery">
                        <?php
                        foreach ($photos as $key=>$photo) {

                            $src = wp_get_attachment_image_src($photo, 'full');
                            
                            $size = 'cover';
                            if($key==0 && $logo)
                            {
                                $size = 'contain';
                            }
                            
                            ?>
                            <div>
                                <a href="<?php echo $src[0] ?>" data-fancybox="gallery">
                                    <span style="background: url('<?php echo $src[0] ?>') center;background-size:<?php echo $size ?>;"></span>
                                </a>
                            </div>
                        <?php }
                        ?>
                    </div>
                <?php if(count($photos)>1):?>
                    <div class="row-gallery">
                        <div class="row row-hund-gallery">
                            <?php
                            foreach ($photos as $key=>$photo) {

                                $src = wp_get_attachment_image_src($photo, 'full');
                                ?>
                                <div class="col-4">
                                    <a data-key='<?php echo $key ?>' class="set-slide-photo" href="<?php echo $src[0] ?>" >
                                        <span style="background: url('<?php echo $src[0] ?>');background-size:cover;"></span>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php endif ?>
                    <?php
                } else {
                    ?>
                    <img src="<?php echo get_url() ?>/images/hund-placeholder.jpg" alt="" class="img-fluid" />
                    <?php
                }
                ?>
            </div>
            <div class="col-sm-4">
                <?php
                if ($premium):
                    ?>
                    <div class="badge-premium">
                        Premium
                    </div>
                <?php endif ?>

                <?php
                $top10 = get_field('top10');

                if ($top10) {
                    ?>
                    <div class="top-10-wrapper">
                        <div>
                            <h1><?php the_title() ?></h1>
                        </div>
                        <div>
                            <?php echo loadSvg('top10.svg'); ?>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>

                    <h1><?php the_title() ?></h1>
                    <?php
                }
                ?>

                <?php if ($sum > 0): ?>
                    <div id="single-top-reviews">
                        <div>
                            <p class="rating-stars-wrapper">
                                <?php
                                displayStar(1, $average);
                                displayStar(2, $average);
                                displayStar(3, $average);
                                displayStar(4, $average);
                                displayStar(5, $average);
                                ?>
                            </p>
                        </div>
                        <div>
                            (<?php echo $count ?>)
                        </div>
                        <div>
                            <a href="#write-a-review">
                                Jetzt bewerten
                            </a>
                        </div>
                    </div>
                <?php endif ?>

                <p>
                    <?php //echo $title  ?> <?php echo $first_name ?> <?php echo $last_name ?>
                    <br /><?php echo $street ?>
                    <br /><?php echo $plz ?> <?php echo $ort ?>
                </p>
                <?php if (!$premium): ?>
                    <!-- Revive Adserver Asynchronous JS Tag - Generated with Revive Adserver v5.4.0 -->
                    <ins data-revive-zoneid="73" data-revive-id="1d5b67a2884d3da9bbfc0c94c11ce164"></ins>
                    <script async src="//adserver.forum-media.eu/www/delivery/asyncjs.php"></script>
                <?php endif ?>

                <?php
                if ($premium):

                    $locations = get_post_meta(get_the_ID(), '_cspm_location', true);
                    if (!empty($locations) && $locations['codespacing_progress_map_address']):
                        ?>

                        <div id="single-hund-locations">
                            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo urlencode($locations['codespacing_progress_map_address']) ?>" target="_blank">
                                <span>
                                    <?php echo loadSvg('location.svg'); ?>
                                </span>
                                Zur Hundeschule navigieren</a>
                        </div>
                    <?php endif ?>

                    <div id="single-hund-phones">
                        <?php if (isset($phone)): ?>
                            <p>
                                <a href="tel:<?php echo $phone ?>">
                                    <span>
                                        <?php echo loadSvg('phone.svg'); ?>
                                    </span>
                                    <?php echo $phone ?>
                                </a>
                            </p>
                        <?php endif ?>
                        <?php if (isset($email)): ?>
                            <p>
                                <a href="mailto:<?php echo $email ?>">
                                    <span>
                                        <?php echo loadSvg('email.svg'); ?>
                                    </span>
                                    <?php echo $email ?>
                                </a>
                            </p>
                        <?php endif ?>
                        <?php if (isset($www)): ?>
                            <p>
                                <a target="_blank"  href="<?php echo $www ?>">
                                    <span>
                                        <?php echo loadSvg('www.svg'); ?>
                                    </span>
                                    <?php echo $www ?>
                                </a>
                            </p>
                        <?php endif ?>
                        <?php if (isset($facebook_url)): ?>
                            <p>
                                <a target="_blank"  href="<?php echo $facebook_url ?>">
                                    <span>
                                        <?php echo loadSvg('facebook-2.svg'); ?>
                                    </span>
                                    <?php echo getHandle($facebook_url, 'facebook.com/') ?>
                                </a>
                            </p>
                        <?php endif ?>
                        <?php if (isset($instagram_url)): ?>
                            <p>
                                <a target="_blank"  href="<?php echo $instagram_url ?>">
                                    <span>
                                        <?php echo loadSvg('instagram-2.svg'); ?>
                                    </span>
                                    <?php echo getHandle($instagram_url, 'instagram.com/') ?>
                                </a>
                            </p>
                        <?php endif ?>
                        <?php if (isset($tiktok_url)): ?>
                            <p>
                                <a target="_blank" href="<?php echo $tiktok_url ?>">
                                    <span>
                                        <?php echo loadSvg('tiktok.svg'); ?>
                                    </span>
                                    <?php echo getHandle($tiktok_url, 'tiktok.com/') ?>
                                </a>
                            </p>
                        <?php endif ?>
                    </div>
                <?php endif ?>
            </div>
            <div class="col-sm-4">
                <div id="sst-form-wrapper" <?php if (!$premium): ?>class="hide-the-form"<?php endif ?>>
                    <?php if (!$premium): ?>
                        <div class="hide-the-form-overlay">
                            <div>
                                <p class="">
                                    Dies ist ein Basiseintrag, darum könnt ihr nicht mehr sehen. Dir gehört die Hundeschule und du willst das ändern?
                                </p>
                                <p>
                                    <a href="<?php echo get_field('registration_url', 'option') ?>" class="the-empty-button">
                                        Jetzt upgraden
                                    </a>
                                </p>
                            </div>
                        </div>
                    <?php endif ?>
                    <div id="sst-form-wrapper-top">
                        <?php
                        echo get_field('contact_form_text', 'option');
                        ?>
                    </div>
                    <?php
                    echo do_shortcode('[formidable id=8]');
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (($artiv && $premium) || ($event && $premium)): ?>
    <div id="single-hund-activities">
        <div class="container-fluid">
            <div class="row row-spaced">
                <?php if(isset($event) && trim($event)):?>
                <div class="col-sm-3">
                    <div class="hund-act-box">
                        <p>
                            <strong>Anstehende Events der Hundeschule</strong>
                        </p>
                        <p>
                            <?php echo $event ?>
                        </p>
                    </div>
                </div>
                <?php endif ?>
                <?php if(isset($artiv) && !empty($artiv)):?>
                <div class="<?php if(isset($event) && trim($event)):?>col-sm-9<?php else: ?>col-sm-12<?php endif ?>">
                    <div class="hund-act-box">
                        <p class="text-center">
                            <strong>
                                Kursangebot dieser Hundeschule
                            </strong>
                        </p>
                        <div class="row row-spaced">
                            <?php
                            foreach ($artiv as $a):

                                $url = '/kurse/' . sanitize_title($a);
                                ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="one-hund-act" data-url="<?php echo $url ?>">
                                        <div class="coursesBox <?php echo sanitize_title($a) ?>">

                                        </div>
                                        <div class="att-name">
                                            <span>
                                                <?php echo $a ?>
                                            </span>
                                            <span>
                                                <?php echo loadSvg('ok-attr.svg'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
<?php endif ?>
<?php ?>
<a id="write-a-review"></a>
<div id="single-hund-reviews">
    <div class="container-fluid">
        <?php if($description)
        {
            ?>
        <div class="h-description">
            <h2>Beschreibung</h2>
            <?php echo $description; ?>
        </div>
        <?php
        }?>
       
        <h2>
            Kunden Bewertungen
        </h2>
        <?php if (empty($entries)): ?>          
            <p class="text-center" id="no-reviews-yet">
                Diese Hundeschule hat noch keine Bewertungen.
            </p>
        <?php endif ?>

        <?php if ($sum > 0): ?>
            <div id="reviews-top-section-ratings">
                <div class="row row-spaced row-reviews-single-hund">
                    <div class="col-sm-4">
                        <p class="rating-stars-wrapper">
                            <?php
                            displayStar(1, $average);
                            displayStar(2, $average);
                            displayStar(3, $average);
                            displayStar(4, $average);
                            displayStar(5, $average);
                            ?>
                        </p>
                        <p>
                            Basierend auf <?php echo $count ?> Bewertungen
                        </p>
                    </div>
                    <div class="col-sm-4">
                        <?php
                        for ($i = 5; $i >= 1; $i--) {
                            $percent = ($grades[$i] / $count) * 100;
                            ?>
                            <div class="one-rating-score">
                                <div class="rating-stars-wrapper">
                                    <?php
                                    displayStars($i)
                                    ?>
                                </div>
                                <div>
                                    <div class="one-stars-plot">
                                        <div style="width:<?php echo $percent ?>%"></div>
                                    </div>
                                </div>
                                <div>
                                    <?php echo number_format($percent, 0, '', '') ?>%
                                </div>
                                <div>
                                    (<?php echo $grades[$i] ?>)
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-sm-4 text-right-on-desktop">
                        <a href="#" id="show-write-form" class="the-button">Bewertung schreiben</a>
                    </div>

                </div>
            </div>

        <?php else: ?>

            <p class="text-center">
                <a href="#" id="show-write-form" class="the-button">Bewertung schreiben</a>
            </p>
        <?php endif ?>

        <div id="write-review-form" <?php if(isset($_POST['frm_action']) && $_POST['form_id']=='7'):?>style="display:block"<?php endif ?>>
            <div>
                <?php echo do_shortcode('[formidable id=7]'); ?>
            </div>
        </div>
        <?php if (!empty($entries)): ?>
            <div id="the-comments-list">
                <?php
                echo $comments;
                ?>
            </div>
        <?php endif ?>
    </div>
</div>
<?php
$other_schools_background = get_field('other_schools_background', 'option');
$other_schools_title = get_field('other_schools_title', 'option');
$other_schools_button_label = get_field('other_schools_button_label', 'option');
$other_schools_button_url = get_field('other_schools_button_url', 'option');

$nearby = getNearbySchools(get_the_ID());

if (empty($nearby)) {
    $nearby = get_posts([
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
    ]);
}

if (!empty($nearby)):
    ?>
    <div id="home-slider-area" class="white-arrows white-title" <?php if ($other_schools_background): ?>style="background: url('<?php echo $other_schools_background['url'] ?>')!important;background-size:cover!important;"<?php endif ?>>
        <div class="container-fluid">   
            <h2>
                <?php echo $other_schools_title ?>
            </h2>
            <?php if ($nearby): ?>
                <div class="home-slider">
                    <?php
                    foreach ($nearby as $key => $p) {
                        oneHundSchoolSlider($p);
                    }
                    ?>
                </div>
            <?php endif ?>
            <?php if ($other_schools_button_label): ?>
                <p class="text-center home-slider-area-top">
                    <a href="<?php echo $other_schools_button_url ?>" class="the-button"><?php echo $other_schools_button_label ?></a>
                </p>
            <?php endif ?>

        </div>
    </div>
    <?php
endif;
$home_page_id = getSettingsPageId();
$flexible_content = get_field('flexible_content', $home_page_id);

if (!empty($flexible_content)) {
    global $section;
    foreach ($flexible_content as $s) {
        $section = $s;
        if ($section['acf_fc_layout'] == 'der_hund_club') {
            get_template_part('blocks/' . $section['acf_fc_layout']);
        }
    }
}



get_footer();
