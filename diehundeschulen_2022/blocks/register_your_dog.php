<?php

global $section;
$title = $section['title'];
$text = $section['text'];
$button_label = $section['button_label'];
$button_url = $section['button_url'];
?>
<div id="register-your-dog">
    <div class="container-fluid">
        <h3>
            <?php echo $title ?>
        </h3>
        <p>
            <?php echo $text ?>
        </p>
        <p>
            <a href="<?php echo $button_url ?>">
                <?php echo $button_label ?>
            </a>
        </p>
    </div>
</div>