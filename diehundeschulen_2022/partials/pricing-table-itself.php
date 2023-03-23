<?php
$pricing_table = get_field('pricing_table', 'option');

$pricing_table_text_below = get_field('pricing_table_text_below', 'option');
global $showButtons;
?>
<div class="the-pricing-table">
    <div class="row row-spaced">
        <?php
        foreach ($pricing_table as $key => $single_pricing_table) {
            $name = $single_pricing_table['name'];
            $best_seller = $single_pricing_table['best_seller'];
            $content = $single_pricing_table['content'];
            $price = $single_pricing_table['price'];
            $per = $single_pricing_table['per'];
            ?>
            <div class="col-sm-6">
                <div class="one-pricing">
                    <div class="op-name">
                        <?php echo $name ?>
                    </div>
                    <div class="op-content">
                        <?php echo $content ?>
                    </div>
                    <div class="op-price">
                        <span class="op-price-value"><?php echo $price ?></span> <span class="op-price-per"><?php echo $per ?></span>
                    </div>
                    <div class="op-button-wrapper">
                        <?php
                        if ($showButtons):

                            $linked_product = $single_pricing_table['linked_product'];
                            if ($linked_product) {
                                ?>
                                <a href="#" data-product-id="<?php echo $linked_product->ID ?>" class="change-subscription the-button the-empty-button">
                                    Weiter
                                </a>
                                <?php
                            } else {
                                ?>
                                <a href="#" id="open-registration-simple" class="the-button the-empty-button">
                                    Registrieren
                                </a>
                                <?php
                            }
                            ?>

                        <?php endif ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>