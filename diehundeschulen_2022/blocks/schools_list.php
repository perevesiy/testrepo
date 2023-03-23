<?php
global $section;
$map_shortcode = $section['map_shortcode'];
?>

<div class="schools-list">
    <div class="row row-0">
        <div class="col-sm-6">
            <?php
            echo do_shortcode($map_shortcode);
            ?>
        </div>
        <?php
        $lands = explode("\n", get_field('lands', 'option'));
        $kursangebot = get_field('kursangebot', 'option');
        ?>

        <div class="col-sm-6">
            <form action="<?php echo get_search_url() ?>" method="get" id="s-list-form">
                <input type="hidden" name="s" value="<?php if (isset($_GET['s'])) echo $_GET['s'] ?>">
                <div class="schools-top-filters">
                    <div class="select-wrapper">
                        <select name="land">
                            <option value="">
                                Bundesland
                            </option>
                            <?php
                            foreach ($lands as $land):

                                if (trim($land) == "") {
                                    continue;
                                }
                                ?>
                                <option <?php if (isset($_GET['land']) && $_GET['land'] == trim($land)): ?>selected="selected"<?php endif ?> value="<?php echo trim($land) ?>">
                                    <?php echo trim($land) ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                       
                    </div>
                     <div class="select-wrapper">
                            <select name="kursangebot">
                                <option value="">
                                    Kursangebot
                                </option>
                                <?php
                                foreach ($kursangebot as $kurs):

                                    //$kurs = get_term_by('ID', $kurs['tag'], 'post_tag');
                                    ?>
                                    <option <?php if (isset($_GET['kursangebot']) && $_GET['kursangebot'] == $kurs['name']): ?>selected="selected"<?php endif ?> value="<?php echo $kurs['name'] ?>"><?php echo $kurs['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    <?php
                    $km = [10,20,50,100,200,300,400,500,1000];
                    ?>
                   <!--  <div class="select-wrapper" id="range-input-wrapper">
                        <select name="range">
                            <option value="">
                                Umkreis
                            </option>
                            <?php foreach($km as $kmm):?>
                            <option <?php if(isset($_GET['range']) && $_GET['range']==$kmm):?>selected="selected"<?php endif ?> value="<?php echo $kmm ?>"><?php echo $kmm ?> km</option>
                            <?php endforeach ?>
                        </select>
                        <input type="hidden" name="user_lat" value="" />
                        <input type="hidden" name="user_lng" value="" />
                    </div> -->
                    <?php /* if (!empty($kursangebot)):
                      ?>

                      <?php endif */ ?>
                </div>
                <?php
                global $wp_query;
                ?>
                <div class="schools-middle-filters">
                    <div class="smf-results-number">
                        <?php echo $wp_query->found_posts ?> Ergebnisse
                    </div>
                    <div>
                        <div class="select-wrapper">
                            <select name="order-by">
                                <option value="">
                                    Sortierung
                                </option>
                                <option <?php if (isset($_GET['order-by']) && $_GET['order-by'] == 'a-z'): ?>selected="selected"<?php endif ?> value="a-z">
                                    A-Z
                                </option>
                                <option <?php if (isset($_GET['order-by']) && $_GET['order-by'] == 'z-a'): ?>selected="selected"<?php endif ?>  value="z-a">
                                    Z-A
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="the-schools-list">
                    <?php
                    
                    if(!have_posts())
                    {
                        ?>
                    <p class="no-results-found">
                        Leider konnten wir keine Hundeschulen mit diesen Such-Parametern finden. Bitte versuchen Sie eine andere Suche oder Filterung.
                    </p>
                    <?php
                    }
                    
                    while (have_posts()) {
                        the_post();
                        /* var_dump(get_the_ID());
                          var_dump(get_post_meta(get_the_ID())); */
                        $formidable = getFrmEntryPerPost(get_the_ID());

                        $address = getAddress(get_the_ID());
                        $premium = isPremiumSchool(get_the_ID());
                        //var_dump($formidable);
                        ?>
                        <div class="one-school">
                            <div class="row row-spaced">
                                <div class="col-sm-3 logo-wrapper">
                                    <a href="<?php echo get_permalink() ?>">
                                         <?php
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'full');
                } else {
                    ?>
                    <img src="<?php echo get_url() ?>/images/hund-placeholder.jpg" alt="" class="img-fluid" />
                    <?php
                }
                ?>
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <p class="one-school-name">
                                        <a href="<?php the_permalink() ?>">
                                            <?php the_title() ?>
                                        </a>
                                    </p>
                                    <p class="os-address">
                                        <?php echo $address['street'] ?>
                                        <br /><?php echo $address['plz'] ?> <?php echo $address['ort'] ?>
                                    </p>
                                </div>
                                <div class="col-sm-3 ver-sp-btqw">
                                    <div>
                                        <?php if ($premium): ?>
                                            <div class="badge-premium">
                                                Premium
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <div>
                                        <a rel="nofollow" class="zum-hund-link" href="<?php echo get_permalink() ?>">
                                            zum Eintrag
                                            <?php echo loadSvg('pagination-right.svg'); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                    <div class="paginate-links">
                        <?php
                        $pagination_the = paginate_links([
                            'prev_text' => '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.375 10.6562C6.5625 10.9062 6.55208 11.1458 6.34375 11.375C6.09375 11.5625 5.85417 11.5521 5.625 11.3438L1.125 6.34375C0.958333 6.11458 0.958333 5.88542 1.125 5.65625L5.625 0.6875C5.85417 0.479167 6.09375 0.46875 6.34375 0.65625C6.55208 0.885417 6.5625 1.125 6.375 1.375L2.1875 6L6.375 10.6562Z" fill="#E3000B"/></svg>',
                            'next_text' => '<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.875 6.34375L1.375 11.3438C1.14583 11.5521 0.90625 11.5625 0.65625 11.375C0.447917 11.1458 0.4375 10.9062 0.625 10.6562L4.84375 6L0.625 1.34375C0.4375 1.09375 0.447917 0.854167 0.65625 0.625C0.90625 0.4375 1.14583 0.447917 1.375 0.65625L5.875 5.625C6.04167 5.875 6.04167 6.11458 5.875 6.34375Z" fill="#E3000B"/></svg>'
                        ]);

                        $pagination_the = str_replace('category/hundeschule/', 'hundeschule/', $pagination_the);
                        $pagination_the = str_replace('hundeschule/', 'category/hundeschule/', $pagination_the);

                        echo $pagination_the;
                        ?>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
