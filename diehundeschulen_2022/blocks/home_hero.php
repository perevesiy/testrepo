<?php
global $section;
$title = $section['title'];
$text = $section['text'];
$background = $section['background'];
$background_mobile = $section['background_mobile'];


if ($background) {
    ?>
    <div id="home-hero">
        <style>
            #home-hero
            {
                background: url('<?php echo $background['url'] ?>') center;
                background-size: cover;
            }
            <?php if($background_mobile):?>
            @media all and (max-width:575px)
            {
                #home-hero
                {
background: url('<?php echo $background_mobile['url'] ?>') center;
                background-size: cover;
                }
            }
            <?php endif ?>
        </style>
        <div class="container-fluid">
            <h1>
                <?php echo nl2br($title); ?>
            </h1>
            <p>
                <?php echo $text ?>
            </p>
            <form action="<?php echo get_search_url() ?>" method="get">
                <input type="text" value="<?php if(isset($_GET['s'])) echo $_GET['s'] ?>" name="s" placeholder="Name, Ort, Postleitzahl?" />
                <button type="submit">
                    <?php echo loadSvg('search.svg'); ?>
                </button>
            </form>
        </div>
    </div>
    <?php
}