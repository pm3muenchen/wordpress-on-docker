<?php
/**
 * Displays the post header
 *
 * @package WordPress
 * @subpackage deep_free
 * @since 1.0.0
 */

$discussion = ! is_page() && deep_can_show_post_thumbnail() ? deep_get_discussion_data() : null; ?>

<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

<?php if ( ! is_page() ) : ?>
<div class="entry-meta">
	<?php deep_posted_by(); ?>
	<?php deep_posted_on(); ?>
	<span class="comment-count">
		<?php
		if ( ! empty( $discussion ) ) {
			deep_discussion_avatars_list( $discussion->authors );
		}
		?>
		<?php deep_comment_count(); ?>
	</span>
	<?php
	// Edit post link.
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'deep-free' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
	?>
</div><!-- .entry-meta -->
<?php endif; ?>
