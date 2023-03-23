<!DOCTYPE html>
<!--[if lte IE 6]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-NG7J776');</script>
<!-- End Google Tag Manager -->
    <link rel="icon" href="<?php echo get_option('home'); ?>/favicon.ico" />
    <link rel="shortcut icon" href="<?php echo get_option('home'); ?>/favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--
    Powered by n-o-p.de
    -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="imagetoolbar" content="no">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
    <!-- make use of a custom build instead of this -->
    <script src="<?php echo get_template_directory_uri(); ?>/js/modernizr-2.6.2.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/nexle.js"> </script>
   <!--  <script data-ad-client="ca-pub-2723436893516907" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->

</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NG7J776"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="main" class="wrapper<?=is_front_page() ? ' frontPage' : ''?>">
        <div class="wrapper-shadow">
            <? if (is_active_sidebar('sidebar-banner')) : ?>
                <div class="adTop">
                    <? dynamic_sidebar( 'sidebar-banner' ); ?>
                </div>
            <? endif; ?>
            <header id="masthead" class="site-header" role="banner">
                    <div class="logoSite">
                        <a href="/"><img src="<?=get_template_directory_uri()?>/assets/logo_E2-1.png" alt="<?=esc_attr(get_bloginfo('name', 'display' ))?>" /></a>
                    </div>
					
					
					
					<!-- NEXLE erweitert START -->
					<div class="navSecond">
                        <div class="navSecondFirstRow navSecondRow">


                            <div class="fb-like" data-send="false" data-href="https://www.facebook.com/dieHundeschulen" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                            
							<?php
							if (!is_user_logged_in()) {
								?>
								<span>Hundeschuleninhaber? Jetzt kostenlos registrieren</span>
								<?php
							}
							?>
                        </div>
                        <div class="navSecondLastRow navSecondRow">
                            <span class="quicksearch">
                                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                    <input type="text" name="s" placeholder="Stichwortsuche"><button type="submit"><img src="<?=get_template_directory_uri()?>/assets/icon-search.png" alt="Suchen" /></button>
                                </form>
                            </span>
                            <ul class="loginRegisterButtons">
                                <li>
									<?php
									if (is_user_logged_in()) {
										?>
										<a href="<?php echo wp_logout_url( home_url() ); ?>" title="Logout">Logout</a>
										<?php
									} else {
										?>
										<div class="nexle_out_login" onclick="output_history_complete();">
											<a href="#">Login</a>
										</div>
										
										<div id="nxlLoginForm">
											<div style="float: left;  margin: 10px 30px 10px 30px;"><?php wp_login_form(array('remember' => false)); ?></div>
											<div style="float: right; margin-right: 30px;"  onclick="output_history_complete();">x</div>
											<div style="margin-right: 30px;">
												<a href="https://diehundeschulen.de/passwort" style="color: #a2c653;">Passwort vergessen?</a>
											</div>
										</div>
										
										<!-- <div class="loginForm"><?php wp_login_form(array('remember' => false)); ?></div> -->
										<?php
									}
									?>
									
                                    <!--
									<a href="#">Login</a>
                                    <div class="loginForm"><?php wp_login_form(array('remember' => false)); ?></div>
									-->
                                </li>
								
                                <li>
									<?php
									if (is_user_logged_in()) {
										?>
										<a href="/eintrag-bearbeiten">Mein Konto</a>
										<?php
									} else {
										?>
										<a href="/jetzt-anmelden">Registrieren</a>
										<?php
									}
									?>
									<!-- <a href="/jetzt-anmelden">Registrieren</a> -->
								</li>
                            </ul>
                        </div>
                    </div>
					<!-- NEXLE erweitert ENDE -->
					
					<?php
					// ORIGINAL auskommentiert
					/*
                    <div class="navSecond">
                        <div class="navSecondFirstRow navSecondRow">


                            <div class="fb-like" data-send="false" data-href="http://www.facebook.com/dieHundeschulen" data-layout="button_count" data-width="150" data-show-faces="false"></div>
                            <span>Hundeschuleninhaber? Jetzt kostenlos registrieren</span>
                        </div>
                        <div class="navSecondLastRow navSecondRow">
                            <span class="quicksearch">
                                <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
                                    <input type="text" name="s" placeholder="Stichwortsuche"><button type="submit"><img src="<?=get_template_directory_uri()?>/assets/icon-search.png" alt="Suchen" /></button>
                                </form>
                            </span>
                            <ul class="loginRegisterButtons">
                                <li>
                                    <a href="#">Login</a>
                                    <div class="loginForm"><?php wp_login_form(array('remember' => false)); ?></div>
                                </li>
                                <li><a href="/jetzt-anmelden">Registrieren</a></li>
                            </ul>
                        </div>
                    </div>
					*/
					?>
					
					
					
                    <nav role="navigation">
<?php wp_nav_menu( array( 'theme_location' => 'max_mega_menu_1' ) ); ?>                    </nav><!-- #site-navigation -->
                    <?php $header_image = get_header_image();
                    if ( ! empty( $header_image ) ) : ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                    <?php endif; ?>
            </header><!-- #masthead -->
            <div class="content">
			
			<?php
			$page_id = 16891;
			if (get_the_ID() == 16891) {
				?>
				<div style="margin: 15px 0 0 0; width: 100%">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
					<!-- DieHundeschulen Beitrag-oben -->
					<ins class="adsbygoogle" style="display:inline-block;width:468px;height:15px" data-ad-client="ca-pub-7541108365410151" data-ad-slot="2487252587"></ins>
					
					<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
					</script>
				</div>
				<?php
			}
			?>
