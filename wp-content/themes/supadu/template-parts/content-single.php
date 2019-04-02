<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Supadu
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php supadu_excerpt(); ?>

	<?php supadu_post_thumbnail(); ?>
	<div class="svg-slide">
	<svg xmlns="http://www.w3.org/2000/svg" width="482" height="231" viewBox="0 0 482 231">
	<g fill="#023233" fill-rule="evenodd">
    <path d="M60.0756,51.2 C53.0366,51.2 47.2756,56.96 47.2756,64 C47.2756,71.04 53.0366,76.8 60.0756,76.8 C67.1156,76.8 72.8766,71.04 72.8766,64 C72.8766,56.96 67.1156,51.2 60.0756,51.2"/>
    <path d="M413.9965 204.7996L292.4575 204.7996C284.0095 204.7996 277.0975 199.0396 277.0975 191.9996 277.0975 184.9596 284.0095 179.1996 292.4575 179.1996L294.9565 179.1996C303.4035 179.1996 310.3155 173.4406 310.3155 166.4006 310.3155 159.3606 303.4035 153.6006 294.9565 153.6006L234.8575 153.6006C226.4095 153.6006 219.4975 147.8396 219.4975 140.7996 219.4975 133.7596 226.4095 127.9996 234.8575 127.9996L345.5165 127.9996C353.9645 127.9996 360.8765 122.2396 360.8765 115.1996 360.8765 108.1596 353.9645 102.4006 345.5165 102.4006L221.0335 102.4006C212.5855 102.4006 205.6735 96.6406 205.6735 89.6006 205.6735 82.5606 212.5855 76.7996 221.0335 76.7996L283.4355 76.7996C291.8845 76.7996 298.7965 71.0396 298.7965 63.9996 298.7965 56.9596 291.8845 51.1996 283.4355 51.1996L284.1375 51.1996C275.6895 51.1996 268.7775 45.4406 268.7775 38.4006 268.7775 31.3606 275.6895 25.6006 284.1375 25.6006L365.3555 25.6006C373.8045 25.6006 380.7165 19.8396 380.7165 12.7996 380.7165 5.7596 373.8045-.0004 365.3555-.0004L181.6765-.0004C173.2275-.0004 166.3155 5.7596 166.3155 12.7996 166.3155 19.8396 173.2275 25.6006 181.6765 25.6006L228.3295 25.6006C236.7775 25.6006 243.6895 31.3606 243.6895 38.4006 243.6895 45.4406 236.7775 51.1996 228.3295 51.1996L106.1555 51.1996C97.7085 51.1996 90.7965 56.9596 90.7965 63.9996 90.7965 71.0396 97.7085 76.7996 106.1555 76.7996L106.3455 76.7996C114.7935 76.7996 121.7055 82.5606 121.7055 89.6006 121.7055 96.6406 114.7935 102.4006 106.3455 102.4006L15.8765 102.4006C7.4285 102.4006.5165 108.1596.5165 115.1996.5165 122.2396 7.4285 127.9996 15.8765 127.9996L179.0495 127.9996C187.4975 127.9996 194.4095 133.7596 194.4095 140.7996 194.4095 147.8396 187.4975 153.6006 179.0495 153.6006L175.2755 153.6006C166.8285 153.6006 159.9165 159.3606 159.9165 166.4006 159.9165 173.4406 166.8285 179.1996 175.2755 179.1996L236.6495 179.1996C245.0975 179.1996 252.0095 184.9596 252.0095 191.9996 252.0095 199.0396 245.0975 204.7996 236.6495 204.7996L115.9165 204.7996C107.4685 204.7996 100.5565 210.5606 100.5565 217.6006 100.5565 224.6406 107.4685 230.4006 115.9165 230.4006L413.9965 230.4006C422.4435 230.4006 429.3555 224.6406 429.3555 217.6006 429.3555 210.5606 422.4435 204.7996 413.9965 204.7996M466.476 204.7996L454.316 204.7996C445.868 204.7996 438.956 210.5606 438.956 217.6006 438.956 224.6406 445.868 230.4006 454.316 230.4006L466.476 230.4006C474.924 230.4006 481.836 224.6406 481.836 217.6006 481.836 210.5606 474.924 204.7996 466.476 204.7996"/>
    <path d="M323.1156,166.4002 C323.1156,173.4402 330.0276,179.2002 338.4756,179.2002 L391.5956,179.2002 C400.0446,179.2002 406.9566,173.4402 406.9566,166.4002 C406.9566,159.3602 400.0446,153.6002 391.5956,153.6002 L338.4756,153.6002 C330.0276,153.6002 323.1156,159.3602 323.1156,166.4002"/>
  </g>
</svg>
</div>
	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages(
				array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'supadu' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'supadu' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				)
			);

			if ( '' !== get_the_author_meta( 'description' ) ) {
				get_template_part( 'template-parts/biography' );
			}
			?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php supadu_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'supadu' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
