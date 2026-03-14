<?php
/*
Template Name: Text sida
*/
?>

<style>
<?php include 'base.css'; ?>
</style>

<?php get_header(); ?>

<div class="text-page">
  <div class="hero">
    <div class="row">
      <div class="column column--12 column__tablet--12 column__mobile--12">
        <h1><?= the_title(); ?></h1>
      </div>
    </div>
  </div>

  <div class="row second-row">
    <div class="column column--12 column__tablet--12 column__mobile--12">
      <?php the_content(); ?>
    </div>
  </div>
</div>