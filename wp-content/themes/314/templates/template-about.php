<?php
/* Template Name: O nas */
get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

      <article id="post-<?php the_ID(); ?>" <?php post_class('contact'); ?>>
        <div class="container" data-aos="fade-right">
          <h1 class="headline">
						<img class="headline__logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="Identique">
						<?php the_title(); ?>
					</h1>

          <div class="generic-content">

            <?php
            if (have_rows('services_elastic')):
              while (have_rows('services_elastic')) : the_row();

                if (get_row_layout() == 'txt_img'):
                    $photo = get_sub_field('photo'); ?>

                  <section class="txt-img">
                    <div class="row">
                      <div class="col-lg-6" data-aos="fade-right">
                        <p><?php the_sub_field('desc') ?></p>
                      </div>
                      <div class="col-lg-6" data-aos="fade-left">
                        <img class="txt-img__img" src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['url']; ?>">
                      </div>
                    </div>
                  </section>

                <?php
                elseif (get_row_layout() == 'img_txt'):
                  $photo = get_sub_field('photo');?>

                  <section class="img-txt">
                    <div class="row">
                      <div class="col-lg-6 order-lg-2" data-aos="fade-right">
                        <p><?php the_sub_field('desc') ?></p>
                      </div>

                      <div class="col-lg-6" data-aos="fade-left">
                        <img src="<?php echo $photo['url']; ?>" alt="<?php echo $photo['url']; ?>">
                      </div>

                    </div>
                  </section>

                <?php
                endif;
              endwhile;
            endif;
            ?>

          </div>


          <section class="oferta-ident" data-aos="fade-up">
            <h3 class="headline headline--mbp"> Oferta iDentique</h3>


            <?php
            $args = array(
            	'type' => 'post',
            	'post_type' => 'uslugi',
            	'posts_per_page' => -1,
              'order' => 'ASC'
            );

            $loop = new WP_Query( $args );

            if( $loop->have_posts() ): ?>

              <div id="owl-about-offer" class="owl-carousel owl-theme">

              <?php
            	while( $loop->have_posts() ): $loop->the_post(); ?>
              <div class="item">
                <div class="oferta-ident__item">
                  <div class="row">
                    <div class="col-md-5">
                      <?php $main_photo = get_field('main_photo'); ?>
                      <img class="oferta-ident__img" src="<?php echo $main_photo['url']; ?>" alt="<?php echo $main_photo['alt']; ?>">
                    </div>
                    <div class="col-md-7">
                      <h2 class="subheading subheading--mb-s subheading--sm"><?php the_title(); ?></h2>
                      <p> <?php echo my_excerpt(get_field('main_desc'), 100); ?></p>
                      <p><a href="<?php echo get_permalink(); ?>" class="link-bold">więcej...</a></p>
                    </div>
                  </div>
                </div>
              </div>

              <?php
              endwhile; ?>
              </div>
            <?php
          endif; ?>

          </section>

        </div>
      </article>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
