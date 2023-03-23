<?php
/**
 * THE NEXT LEVEL -START
 * 
 * @author		Juri Oll
 * @copyright	Copyright (c) 2013, Juri Oll | The Next Level - nexle.de | http://nexle.de
 * @version		1.0.0
 */

/* 
 * 'REQUEST_URI'
 * Der URI, der angegeben wurde, um auf die aktuelle Seite zuzugreifen, beispielsweise '/index.html'.
 */
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri_trim = trim($request_uri, '/');

if (is_numeric($request_uri_trim)) {
	// echo "YES: ".$request_uri_trim;
	
	?>
	<form style="display: none;" name="hundeschule_rating" method="POST" action="/hundeschule-bewerten">
		<input type="text" name="ref_key" value="<?php echo $request_uri_trim; ?>" />
		<input type="submit" value="Jetzt Bewerten" />
	</form>
	
	<script type="text/javascript">
		document.hundeschule_rating.submit();
	</script>
	<?php
}
/**
 * THE NEXT LEVEL - END
 */



/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header();

?>


	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<br />
			
			<header class="page-header">
				<h2 class="page-title"><?php _e( '404 - Seite nicht gefunden', 'twentyfourteen' ); ?></h2>
			</header>

			<div class="page-content">
				<img alt="dieHundeschulen 404 Seite" src="wp-content/uploads/2014/05/404.jpg">
				<p style="font-size: 8px;">&copy; DoraZett - Fotolia.com</p>
				<br />
				<p><?php _e( 'Ihre Seite kann nicht gefunden werden. Vielleicht hilft Ihnen die Stichwortsuche weiter!', 'twentyfourteen' ); ?></p>

				<?php get_search_form(); ?>
			</div><!-- .page-content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php

get_sidebar( 'content' );
get_sidebar();
get_footer();
