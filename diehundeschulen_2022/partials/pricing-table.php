<?php
$pricing_table = get_field('pricing_table', 'option');

$pricing_table_text_below = get_field('pricing_table_text_below', 'option');
?>
<?php if (!empty($pricing_table)): ?>
    <div id="pricing-table-source">
        <?php
            get_template_part('partials/pricing-table-itself');
        ?>
    </div>
    <?php
 endif;