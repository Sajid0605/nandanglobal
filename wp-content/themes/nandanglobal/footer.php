<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nandan_Global
 */

?>
	<footer id="colophon" class="site-footer py-3 text-center text-body-secondary bg-body-tertiary">
		<div class="site-info d-block justify-content-between p-4">
			<p>
				<?php printf( esc_html__( 'Proudly powered by ', 'nandanglobal' ), 'WordPress' ); ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'nandanglobal' ) ); ?>"> WordPress</a>
			</p>
			<p>© 2023 
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Made with %1$s by %2$s.', 'nandanglobal' ),
					'<strong><img draggable="false" role="img" class="emoji" alt="❤️" src="https://s.w.org/images/core/emoji/14.0.0/svg/2764.svg"></strong>',
					'<a href="https://iamsajidansari.com/">Sajid Ansari</a>' );
				?>
			</p>
		</div><!-- .site-info -->
  	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

<script>
		var owl = jQuery('.owl-carousel');
		owl.owlCarousel({
			items:1,
			loop:true,
			margin:10,
			autoplay:true,
			autoplayTimeout:2500,
			autoplayHoverPause:true
		});
		jQuery('.play').on('click',function(){
			owl.trigger('play.owl.autoplay',[1000])
		})
		jQuery('.stop').on('click',function(){
			owl.trigger('stop.owl.autoplay')
		})
	</script>

</body>
</html>
