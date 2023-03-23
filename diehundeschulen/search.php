
<?php get_header(); ?>
	<section class="post-search post-list" role="main">
        <div>
        <script>
            (function() {
                var cx = '008243504267731507147:pt5kzmsek_i';
                var gcse = document.createElement('script');
                gcse.type = 'text/javascript';
                gcse.async = true;
                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//www.google.com/cse/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(gcse, s);
            })();
        </script>
        <gcse:search queryParameterName="s"></gcse:search>
        </div>

        <?/*
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		        	<? the_content(); ?>
			</article>
			<?php endwhile; ?>
			<?php get_contentNav(); ?>
		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title">Nichts gefunden</h1>
				</header>

				<div class="entry-content">
					<p>Entschuldige, aber es konnte nichts gefunden werden. Versuche es mit anderen Schlüsselwörtern erneut.</p>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

        */?>
        </section>
		<?php /*
        <section class="secondary" role="complementary">
            <? if (is_active_sidebar('sidebar-global-right')): ?>
                <?php dynamic_sidebar( 'sidebar-global-right' ); ?>
            <? endif ?>
        </section>
		*/?>
<?php get_footer(); ?>

