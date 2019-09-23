<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<div class="gallery-section section">
				<div class="container">
					<h5> Galeria </h5>
					<?php get_template_part('template-parts/gallery') ?>
				</div>
			</div>

			<div class="pricelist-section section">
				<div class="container">
					<h5> Cennik </h5>
					<?php
					$args = array(
					  'type' => 'post',
					  'post_type' => 'uslugi',
					  'posts_per_page' => -1,
					);

					$loop = new WP_Query( $args );

					if( $loop->have_posts() ):
						while( $loop->have_posts() ): $loop->the_post();

							get_template_part('template-parts/pricetable');

						endwhile;
					endif;
					wp_reset_postdata(); ?>
				</div> <!-- container -->
			</div> <!-- pricetable-section -->


			<div class="book-online-section section">
				<div class="container">
					<div class="book-online">
						<h5> Rejestracja online </h5>
						<?php echo do_shortcode('[contact-form-7 id="48" title="Rejestracja online"]'); ?>
					</div>
				</div>
			</div>



			<?php get_template_part('template-parts/map'); ?>





		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer();
