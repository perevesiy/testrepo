<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentytwelve_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() )
	return;
?>

<?php if ( comments_open() ) : /* ?>
    <div class="comments-link">
        <?php comments_popup_link('<span class="leave-reply">Kommentar hinzufügen</span>', "1 Antwort",'% Antworten'); ?>
        <?php //<a href="#" onclick="document.getElementById('respond').style.display='block'; return false;">Kommentar hinzufügen</a>?>
    </div><!-- .comments-link -->
<?php */ endif; // comments_open() ?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
                printf("%s Kommentare zu %s", number_format_i18n(get_comments_number()), get_the_title());
			?>
		</h2>

		<ol class="commentlist">
			<?php wp_list_comments(); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading">Comment navigation</h1>
			<div class="nav-previous"><?php previous_comments_link('&larr; Ältere Kommentare'); ?></div>
			<div class="nav-next"><?php next_comments_link('Neuere Kommentare &rarr;'); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>
	<?php endif; // have_comments() ?>
	<?php comment_form(); ?>

</div><!-- #comments .comments-area -->