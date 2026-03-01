<?php
/*
Template Name: Gnagare
*/
?>

<style>
<?php include 'base.css'; ?>
<?php include 'bunny.css'; ?>
</style>

<?php
$bunnies = array (
  'numberposts'	=> -1,
  'post_type'		=> 'gnagare',
);

$the_query = new WP_Query( $bunnies );
?>

<?php get_header(); ?>

<div class="bunnies">
  <div class="row header no-description">
    <h1>Gnagare tillgängliga för adoption</h1>
  </div>
  <div class="row">
      <?php if( $the_query->have_posts() ): ?>
          <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
          <div class="column column--3 column__tablet--4 column__mobile--12 animal-wrapper">
            <div class="card">
              <div class="image-container">
                <img src="<?= the_field('utvald_bild'); ?>" alt="">
                <a class="button" href="<?= get_the_permalink(); ?>">Se presentation</a>
              </div>
              <h3><?= get_the_title(); ?></h3>
              <p>Gnagare · <?= the_field('kon'); ?> · <?= the_field('stad'); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
</div>