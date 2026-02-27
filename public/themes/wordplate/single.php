<style>
<?php include 'templates/base.css'; ?>
<?php include 'single.css'; ?>
</style>

<div class="animal-page">
  <div class="row header">
    <div class="column column--12 column__tablet--12 column__mobile--12">
      <h1><?= get_the_title(); ?></h1>
    </div>
  </div>
  <div class="row">
    <div class="column column--7 column__tablet--4 column__mobile--12">
      <h2>Snabbfakta</h2>
      
      <div class="facts">
        <div class="facts-left">
          <div class="fact">
            <p class="title">Stad</p>
            <p><?= the_field('stad'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Kön</p>
            <p><?= the_field('kon'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Vaccinerad</p>
            <p><?= the_field('vaccinerad'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Vill bo</p>
            <p><?= the_field('vill_bo'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Kom till Smådjurschansen</p>
            <p><?= the_field('kom_till_smadjurschansen'); ?></p>
          </div>
        </div>
  
        <div class="facts-right">
          <div class="fact">
            <p class="title">Ålder</p>
            <p><?= the_field('alder'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Kastrerad</p>
            <p><?= the_field('kastrerad'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Rumsren</p>
            <p><?= the_field('rumsren'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Ras</p>
            <p><?= the_field('ras'); ?></p>
          </div>
          <div class="fact">
            <p class="title">Pris</p>
            <p><?= the_field('pris'); ?></p>
          </div>
        <div>
      </div>
    </div>

    <div class="column column--5 column__tablet--8 column__mobile--12">
      <div class="cta-wrapper">
        <h3><?= get_the_title(); ?></h3>
        <p>Kanin · <?= the_field('kon'); ?> · <?= the_field('stad'); ?></p>

        <a class="button-secondary" href="https://www.smadjurschansen.se/soker-hem/om-adoption/">Läs om våra adoptionskrav</a>
        <a class="button-primary" href="https://www.smadjurschansen.se/lamna-intresseanmalan/">Lämna en intresseanmälan</a>
      </div>

    </div>

  <hr>

  <div class="background">
    <h2>Bakgrund</h2>
    <?= the_field('bakgrund'); ?>
  </div>

  <hr>

  <div class="about-animal">
    <h2>Om <?= get_the_title(); ?></h2>
    <?= the_field('om_djuret'); ?>
  </div>

  <hr>

  <div class="good-to-know">
    <h2>Bra att veta</h2>
    <?= the_field('bra_att_veta'); ?>
  </div>

</div>