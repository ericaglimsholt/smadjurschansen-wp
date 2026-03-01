<style>
  <?php include 'templates/base.css'; ?>
  <?php include 'single.css'; ?>
</style>

<?php 
  $images = get_field('bilder');
?>

<?php get_header(); ?>

<div class="animal-page">
  <div class="row header">
    <div class="column column--12 column__tablet--12 column__mobile--12">
      <?php if( get_the_title() ): ?>
        <h1><?= get_the_title(); ?></h1>
      <?php endif; ?>
    </div>
  </div>

  <div class="row image-header">
    <?php if( $images && is_array($images) ): ?>
      <?php foreach( array_slice($images, 0, 3) as $index => $image ): ?>
        <?php if( $image ): ?>
          <div class="column column--4 column__tablet--6 column__mobile--12 
              <?php if($index == 2): ?>desktop-only<?php endif; ?>
              <?php if($index == 1): ?>tablet-desktop<?php endif; ?>">
                <div class="image-container">
                  <img src="<?= $image; ?>" alt="<?= get_the_title(); ?>">
                  <?php if($index == 0): ?>
                    <a class="button" href="#bilder">Visa alla bilder</a>
                  <?php endif; ?>
                </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="row">
    <div class="column column--7 column__tablet--6 column__mobile--12">
      <h2 class="fact">Snabbfakta</h2>

      <div class="facts-wrapper">
        <?php if( get_field('stad') ): ?>
          <div class="fact">
            <p class="title">Stad</p>
            <p><?= the_field('stad'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('alder') ): ?>
          <div class="fact">
            <p class="title">Ålder</p>
            <p><?= the_field('alder'); ?></p>
          </div> 
        <?php endif; ?>
        <?php if( get_field('kon') ): ?>
          <div class="fact">
            <p class="title">Kön</p>
            <p><?= the_field('kon'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('kastrerad') ): ?>
          <div class="fact">
            <p class="title">Kastrerad</p>
            <p><?= the_field('kastrerad'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('vaccinerad') ): ?>
          <div class="fact">
            <p class="title">Vaccinerad</p>
            <p><?= the_field('vaccinerad'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('rumsren') ): ?>
          <div class="fact">
            <p class="title">Rumsren</p>
            <p><?= the_field('rumsren'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('vill_bo') ): ?>
          <div class="fact">
            <p class="title">Vill bo</p>
            <p><?= the_field('vill_bo'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('djurslag') ): ?>
          <div class="fact">
            <p class="title">Djurslag</p>
            <p><?= the_field('djurslag'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('ras') ): ?>
          <div class="fact">
            <p class="title">Ras</p>
            <p><?= the_field('ras'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('kom_till_smadjurschansen') ): ?>
          <div class="fact">
            <p class="title">Kom till Smådjurschansen</p>
            <p><?= the_field('kom_till_smadjurschansen'); ?></p>
          </div>
        <?php endif; ?>
        <?php if( get_field('pris') ): ?>
          <div class="fact">
            <p class="title">Pris</p>
            <p><?= the_field('pris'); ?></p>
          </div>
        <?php endif; ?>
      </div>

      <hr>

      <?php if( get_field('bakgrund') ): ?>
        <div class="background">
          <h2>Bakgrund</h2>
          <?= the_field('bakgrund'); ?>
        </div>
        <hr>
      <?php endif; ?>

      <?php if( get_field('om_djuret') ): ?>
        <div class="about-animal">
          <h2>Om <?= get_the_title(); ?></h2>
          <?= the_field('om_djuret'); ?>
        </div>
        <hr>
      <?php endif; ?>

      <?php if( get_field('bra_att_veta') ): ?>
        <div class="good-to-know">
          <h2>Bra att veta</h2>
          <?= the_field('bra_att_veta'); ?>
        </div>
      <?php endif; ?>

    </div>
    <div class="column column--5 column__tablet--6 column__mobile--12 cta-column">
      <div class="cta-wrapper">
        <?php if( get_the_title() ): ?>
          <h3><?= get_the_title(); ?></h3>
        <?php endif; ?>
        <p>
          Kanin
          <?php if( get_field('kon') ): ?>
            · <?= the_field('kon'); ?>
          <?php endif; ?>
          <?php if( get_field('stad') ): ?>
            · <?= the_field('stad'); ?>
          <?php endif; ?>
        </p>

        <a class="button secondary" target="blank" href="https://www.smadjurschansen.se/soker-hem/om-adoption/">Läs om våra adoptionskrav</a>
        <a class="button primary" href="https://www.smadjurschansen.se/lamna-intresseanmalan/">Lämna en intresseanmälan</a>
      </div>
    </div>
  </div>

  <?php if( $images && is_array($images) ): ?>
    <div class="row all-image-header" id="bilder">
      <div class="all-image-wrapper">
        <?php foreach($images as $image ): ?>
          <?php if( $image ): ?>
            <img src="<?= $image; ?>" alt="<?= get_the_title(); ?>">
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>

  <div class="row cta-last">
    <div class="column column--12 column__tablet--12 column__mobile--12">
        <?php if( get_the_title() ): ?>
          <h3>Vill du adoptera <?= get_the_title(); ?>?</h3>
        <?php else: ?>
          <h3>Vill du adoptera detta djur?</h3>
        <?php endif; ?>
        <p>Lämna en intresseanmälan via länken nedan så kommer vi kontakta er via mail.</p>
        <a class="button primary" href="https://www.smadjurschansen.se/lamna-intresseanmalan/">Lämna en intresseanmälan</a>
    </div>
  </div>

</div>