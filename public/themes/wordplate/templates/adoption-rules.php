<?php
/*
Template Name: Adoptionskrav
*/
?>

<style>
<?php include 'base.css'; ?>
<?php include 'adoption-rules.css'; ?>
</style>

<?php get_header(); ?>

<div class="adoption-rules">
  <div class="hero">
    <div class="row">
      <div class="column column--12 column__tablet--12 column__mobile--12">
        <h1><?= the_title(); ?></h1>
        <p><?= the_field('short_description'); ?></p>
      </div>
    </div>
  </div>

  <div class="row second-row">
    <div class="column column--12 column__tablet--12 column__mobile--12">
      <h2>Våra krav per djurart</h2>
    </div>
  </div>

  <div class="row">
    <div class="requirements-full-wrapper">
      <?php if(get_field('bunny_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Kanin</h3>
            <?php foreach(get_field('bunny_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('guinea_pig_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Marsvin</h3>
            <?php foreach(get_field('guinea_pig_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('bird_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Fågel</h3>
            <?php foreach(get_field('bird_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('hamter_duprasi_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Hamster / Duprasi</h3>
            <?php foreach(get_field('hamter_duprasi_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('mouse_gerbil_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Mus / Gerbil</h3>
            <?php foreach(get_field('mouse_gerbil_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('chinchilla_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Chinchilla</h3>
            <?php foreach(get_field('chinchilla_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('rats_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Råtta</h3>
            <?php foreach(get_field('rats_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>

      <?php if(get_field('land_turtle_requirements')): ?>
        <!-- <div class="column column--6 column__tablet--6 column__mobile--12"> -->
          <div class="requirements-wrapper">
            <h3>Landsköldpadda</h3>
            <?php foreach(get_field('land_turtle_requirements')['requirements'] as $requirements): ?>
              <div class="requirement">
                <div class="icon">
                  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <mask id="mask0_2182_14488" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
                      <rect width="24" height="24" fill="#D9D9D9"/>
                    </mask>
                    <g mask="url(#mask0_2182_14488)">
                    <path d="M9.5501 17.9996L3.8501 12.2996L5.2751 10.8746L9.5501 15.1496L18.7251 5.97461L20.1501 7.39961L9.5501 17.9996Z" fill="#1C1B1F"/>
                    </g>
                  </svg>
                </div>
                <p><?= $requirements['requirement']; ?></p>
              </div>
            <?php endforeach; ?>
          </div>
        <!-- </div> -->
      <?php endif; ?>
    </div>    
  </div>

</div>

<?php get_footer(); ?>