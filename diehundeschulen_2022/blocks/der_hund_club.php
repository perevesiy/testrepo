<?php
global $section;

$logo = $section['logo'];
$title = $section['title'];
$features = $section['features'];

$button_label = $section['button_label'];
$button_url = $section['button_url'];

if ($button_url == '' || $button_url == '#') {
    $button_url = '/jetzt-anmelden';
}

$blog = get_posts([
    'posts_per_page' => 3,
    'tax_query' => [
        [
            'taxonomy' => 'category',
            'terms' => [1]
        ]
    ]
        ]);
?>
<div id="der-hund-club">
    <div class="container-fluid">
        <?php if ($logo): ?>
            <p class="der-hund-club-logo">
                <?php
                imgOrSvg($logo);
                ?>
            </p>
        <?php endif ?>
        <?php if (trim($title)): ?>
            <p class="der-hund-title">
                <?php echo $title ?>
            </p>
        <?php endif ?>
        <?php if (!empty($features)): ?>
            <p class="der-hund-features">
                <?php
                foreach ($features as $key => $single_features) {
                    $text = $single_features['text'];
                    ?>
                    <span>
                        <?php echo loadSvg('ok.svg'); ?>
                        <?php echo $text ?>
                    </span>
                    <?php
                }
                ?>
            </p>
        <?php endif ?>
        <?php if ($button_label): ?>
            <p>
                <a href="<?php echo $button_url ?>" class="the-button">
                    <?php echo $button_label ?>
                </a>
            </p>
        <?php endif ?> 

        <?php if ($blog): ?>
            <div id="home-blog">
                <div class="row">
                    <?php
                    foreach ($blog as $p):
                        $url = get_permalink($p->ID);
                        ?>
                        <div class="col-sm-6 col-md-4">
                            <?php
                            oneBlogPost($p);
                            ?>                      
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        <?php endif ?>

    </div>
</div>