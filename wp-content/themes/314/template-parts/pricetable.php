<?php
if (have_rows('pricetable')): ?>
  <div class="pricelist-section__wrapper">
    <h3><?php echo the_title(); ?></h3>

    <div class="pricetable">

    <?php
    while (have_rows('pricetable')) : the_row(); ?>
      <div class="pricetable__row">
        <div class="pricetable__service">
          <?php the_sub_field('service'); ?>
        </div>
        <div class="pricetable__price">
          <?php the_sub_field('price'); ?>
        </div>
      </div>
    <?php
    endwhile;?>
    </div> <!--  pricetable -->
  </div> <!--  pricetable-container -->
<?php
endif; ?>
