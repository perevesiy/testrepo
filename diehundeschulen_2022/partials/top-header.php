<?php
$logo = get_field('logo', 'option');
$mobile_logo = get_field('mobile_logo', 'option');
?>
<?php
$registration_url = get_field('registration_url', 'option');
$login_url = get_field('login_url', 'option');
$my_account_url = get_field('my_account_url', 'option');
$user = wp_get_current_user();
ob_start();
?>
<span></span>
<div id="menu-column-buttons">
    <?php if ($user->ID == 0): ?>
        <a class="the-button" href="<?php echo $registration_url ?>">Hundeschule eintragen</a>
        <a href="<?php echo $login_url ?>">Einloggen</a>
    <?php else: ?>
        <a class="the-button" href="<?php echo $my_account_url ?>">Mein Konto</a>
        <a href="<?php echo get_home_url() ?>?logout=true">Logout</a>
    <?php endif ?>
</div>
<?php
$menu_buttons = ob_get_clean();
ob_start();
?>
<form action="<?php echo get_search_url() ?>" method="get">
    <input type="text" value="<?php if (isset($_GET['s'])) echo $_GET['s'] ?>" name="s" placeholder="Name, Ort, Postleitzahl?" />
    <button type="submit">
        <?php echo loadSvg('search.svg'); ?>
    </button>
</form>
<?php
$form = ob_get_clean();
?>
<div id="desktop-delimiter"></div>
<div id="mobile-delimeter"></div>
<div id="mobile-header" class="mobile">
    <div id="top-mobile-row">
        <?php if ($mobile_logo): ?>
            <a id="ml" href="<?php echo get_home_url() ?>">

                <?php
                imgOrSvg($mobile_logo,false);
                ?> 
            </a>
        <?php endif ?>

        <?php
        $mobile_phone_in_header = get_field('mobile_phone_in_header', 'option');
        if (trim($mobile_phone_in_header)) {
            ?>
            <a href="tel:<?php echo $mobile_phone_in_header ?>" id="mobile-phone"><i class="fa fa-phone" ></i></a>
            <?php
        }
        ?>

        <a class="loke-menu-icon" id="menu-toggle" href="#">
            <span></span>
            <span></span>
            <span></span>
        </a>
    </div>
    <div id="mobile-menu-wrapper">
        <div>
            <div id="mobile-menu-form-wrapper">
                <?php
                echo $form;
                ?>
            </div>
            <div id="mobile-menu-the">
                <?php wp_nav_menu(array('theme_location' => 'top-menu')) ?>
            </div>
            <div id="mobile-menu-buttons">
                <?php
                echo $menu_buttons;
                ?>
            </div>
        </div>
    </div>
</div>
<header id="main-nav">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 align-middle" id="logo-column">
                <div>
                    <?php if ($logo): ?>
                        <a href="<?php echo get_home_url() ?>" id="dla">
                            <?php
                            imgOrSvg($logo,false);
                            ?>                                            
                        </a>
                    <?php endif ?>
                </div>
            </div>
            <div class="col-sm-3 align-middle" id="search-column">
                <?php
                echo $form;
                ?>
            </div>
            <div class="col-sm-9 align-middle" id="menu-column">
                <div id="menu-right-col">
                    <?php wp_nav_menu(array('theme_location' => 'top-menu')) ?>
                    <?php
                    echo $menu_buttons;
                    ?>
                </div>
            </div>
        </div>
    </div>
</header>
