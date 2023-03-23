<?php
/**
 * The template for displaying the footer.
 */
?>

            </div><!-- .content -->

            <footer>
					<div class="inner">
						<? if (is_active_sidebar('sidebar-footer')) : ?>
							<? dynamic_sidebar( 'sidebar-footer' ); ?>
						<? endif; ?>
					</div>
            </footer>
        </div><!-- .wrapper-shadow -->
   
   
   
        <? if (is_active_sidebar('sidebar-skyscraper')) : ?>
			<div class="adSky">
                <? dynamic_sidebar( 'sidebar-skyscraper' ); ?>
            </div>
        <? endif; ?>
   
	</div><!-- #main .wrapper -->

<?php wp_footer(); ?>





<!-- THE NEXT LEVEL - Branchenbuch - START -->

<script type="text/javascript">
	// Branchenbuch Bild verlinken
	var current_request_url = document.URL;
	
	if (current_request_url.indexOf("branche") > -1) {
		// alert("YES");
		var wpbdp_listing = document.getElementsByClassName("wpbdp-listing");
		
		for (i=0; i<wpbdp_listing.length; i++) {
			var element = wpbdp_listing[i];
			
			var element_website = element.getElementsByClassName("wpbdp-field-website")[0];
			var element_website_link = element_website.getElementsByTagName("a")[0];
			
			var element_listing_thumbnail = element.getElementsByClassName("listing-thumbnail")[0];
			var element_listing_thumbnail_link = element_listing_thumbnail.getElementsByTagName("a")[0];
			
			element_listing_thumbnail_link.target = "_blank";
			element_listing_thumbnail_link.href = element_website_link;
		}
	}
</script>

<!-- THE NEXT LEVEL - Branchenbuch - END -->





<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.js"></script>
</body>
</html>