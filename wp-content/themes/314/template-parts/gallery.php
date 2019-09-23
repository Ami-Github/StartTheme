<div class="gallery" data-featherlight-gallery data-featherlight-filter="a">
  <div class="row">
    <?php
    $gallery = get_field('gallery');
    foreach( $gallery as $image ): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <a class="gallery__link-photo" href="<?php echo $image['sizes']['hd-half']; ?>" style="background-image: url('<?php echo $image['sizes']['mobile']; ?>');" >
          <img class="gallery__full-photo" alt="<?php echo $image['alt']; ?>" src="<?php echo $image['sizes']['hd-half']; ?>" />
        </a>
      </div>
    <?php
    endforeach; ?>
  </div>
</div>
