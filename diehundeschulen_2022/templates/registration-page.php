<?php
/*
 * Template Name: Registration Page
 */

$user = wp_get_current_user();
if($user->ID>0)
{
    header('Location: '.get_home_url());
    die();
}

get_header();
the_post();
if(isset($_POST['frm_action']))
{
    ?>
<script>
var frm_step_2 = true;
</script>
    <?php
}
?>
<div id="the-registration-page">
    <div id="main-content" class="main-content">
        <?php
        /* while (have_posts()) : the_post();
          get_template_part('content', 'page');
          endwhile; */
        ?>

        <div class="container-fluid">
            <div id="registration-top-text">
                <?php echo get_field('top_text'); ?>
            </div>
            <div id="single-page-content">
                <div id="the-table">
                    <p class="title-table">Wähle dein Paket</p>
                    <?php
                    global $showButtons;
                    $showButtons = true;
                    get_template_part('partials/pricing-table-itself');
                    $showButtons = false;
                    ?>
                    <p class="pricing-table-text-below">
                        <?php echo get_field('pricing_table_text_below','option'); ?>
                    </p>
                </div>
                <div id="registration-form-the">
                    <?php
                    the_content();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
get_footer();
