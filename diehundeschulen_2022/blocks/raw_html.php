<?php
global $section;
$use_container = $section['use_container'];
$css_class = $section['css_class'];
$html = $section['html'];
?>
<div class="raw-html <?php echo $css_class ?>">
    <?php if ($use_container): ?>
        <div class="container-fluid">
        <?php endif ?>
            
            
            
            
            
            
            
            <?php echo do_shortcode($html); //echo do_shortcode($html); ?>
        <?php if ($use_container): ?>
        </div>
    <?php endif ?>
</div>