<?php
$footer_logo = get_field('footer_logo', 'option');
$left_column_content = get_field('left_column_content', 'option');
$middle_column_title = get_field('middle_column_title', 'option');
$middle_column_content = get_field('middle_column_content', 'option');

$last_column_title = get_field('last_column_title', 'option');
$last_column_content = get_field('last_column_content', 'option');

$copyright = get_field('copyright', 'option');
$facebook_url = get_field('facebook_url', 'option');
$instagram_url = get_field('instagram_url', 'option');
$twitter_url = get_field('twitter_url', 'option');
?>
<footer id="main-footer">
    <div id="footer-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <?php if($footer_logo):?>
                    <div id="main-footer-logo">
                        <?php echo imgOrSvg($footer_logo); ?>
                    </div>
                    <?php endif ?>
                    <div id="footer-main-content">
                        <?php echo $left_column_content ?>
                    </div>
                </div>
                <div class="col-md-4">
                    <p class="footer-title">
                        <?php echo $middle_column_title ?>
                    </p>
                    <?php
                    footerAccordion($middle_column_content);
                    ?>
                </div>
                <div class="col-md-4">
                    <p class="footer-title">
                        <?php echo $middle_column_title ?>
                    </p>
                    <?php
                    footerAccordion($last_column_content);
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div id="footer-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4 align-middle">
                    <?php
                    wp_nav_menu(['theme_location'=>'privacy-policy-menu']);
                    ?>
                </div>
                <div class="col-sm-4 align-middle">
                    <?php echo $copyright ?>
                </div>
                <div class="col-sm-4 align-middle" id="footer-social">
                    <?php
                    socialIcon($facebook_url,'facebook.svg');
                    socialIcon($instagram_url,'instagram.svg');
                    socialIcon($twitter_url,'twitter.svg');
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
