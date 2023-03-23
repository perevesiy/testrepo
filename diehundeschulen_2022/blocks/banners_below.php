<?php
global $section;
$banners = $section['banners'];

if (!empty($banners)) {
    ?>
    <div id="home-banners-below">
        <div class="container-fluid">
            <div class="row">
                <?php
                foreach ($banners as $key => $single_banners_below) {
                    $picture = $single_banners_below['picture'];
                    $url = $single_banners_below['url'];
                    $or_html_code = $single_banners_below['or_html_code'];
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6">
                        <?php
                        if ($or_html_code) {
                            echo $or_html_code;
                        } else {
                            ?>

                            <a href="<?php echo $url ?>">
                                <?php imgOrSvg($picture); ?>
                            </a>
                        <?php } ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
