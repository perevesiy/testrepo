<?php
/**
 * The template for displaying the footer.
 */
?>

            </div><!-- .content -->
        </div><!-- .wrapper-shadow -->
        <? if (is_active_sidebar('sidebar-skyscraper')) : ?>
            <div class="adSky">
                <? dynamic_sidebar( 'sidebar-skyscraper' ); ?>
            </div>
        <? endif; ?>
	</div><!-- #main .wrapper -->
	<footer>
			<div class="footer-content">
				<div class="inner">
					<? if (is_active_sidebar('sidebar-footer')) : ?>
						<? dynamic_sidebar( 'sidebar-footer' ); ?>
					<? endif; ?>
				</div>
			</div>
	</footer>
<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
</body>
</html>