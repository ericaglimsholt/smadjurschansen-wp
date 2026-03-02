<?php
/*
Template Name: Kanin hanar
*/
?>

<style>
<?php include 'base.css'; ?>
<?php include 'bunny.css'; ?>
</style>

<?php
$bunnies = array (
  'posts_per_page' => -1,
  'post_type'		=> 'kaniner-hanar',
  'post_status'    => 'publish'
);

$the_query = new WP_Query( $bunnies );
?>

<?php get_header(); ?>

<div class="bunnies">
  <div class="row header">
    <h1>Kanin hanar tillgängliga för adoption</h1>
    <p>Alla kaniner adopteras ut kastrerade (om kaninen har åldern inne), vaccinerade, tandkollade och parasittestade. Här nedan presenterar vi dem kanin hanar som just nu söker hem.</p>
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
              <p>Kanin · <?= the_field('kon'); ?> · <?= the_field('stad'); ?></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
</div>