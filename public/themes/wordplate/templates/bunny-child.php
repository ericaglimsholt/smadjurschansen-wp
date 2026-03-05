<?php
/*
Template Name: Kanin honor
*/
?>

<style>
<?php include 'base.css'; ?>
<?php include 'bunny.css'; ?>
</style>

<?php
$bunnies = array (
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'post_type'		=> 'kaniner-ungar',
);

$the_query = new WP_Query( $bunnies );


// Custom sort function to order by status priority
function sort_by_status_priority($a, $b) {
  $status_a = get_field('status', $a->ID);
  $status_b = get_field('status', $b->ID);
  
  // Define status priority order
  $priority = array(
    'Tillgänglig' => 1,
    'Under utredning' => 2,
    'Har intresse' => 3,
    'Bokad' => 4
  );
  
  $priority_a = isset($priority[$status_a]) ? $priority[$status_a] : 999;
  $priority_b = isset($priority[$status_b]) ? $priority[$status_b] : 999;
  
  return $priority_a - $priority_b;
}

// Sort the posts by status priority
if ($the_query->have_posts()) {
  usort($the_query->posts, 'sort_by_status_priority');
}
?>

<?php get_header(); ?>

<div class="bunnies">
  <div class="row header">
    <h1>Kaninungar tillgängliga för adoption</h1>
    <p>Alla kaniner adopteras ut vaccinerade, tandkollade och parasittestade. Här nedan presenterar vi de kaninungar som just nu söker hem.</p>
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
              <?php if (get_field('status')): ?>
                <?php 
                  $status = get_field('status');
                  $formatted_status = strtolower(str_replace([' ', 'å', 'ä', 'ö'], ['-', 'a', 'a', 'o'], $status));
                ?>
                <div class="status <?= $formatted_status; ?>">
                <?php if( $status == 'Tillgänglig' ): ?>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.99967 7.33333L7.33301 8.66667L10.333 5.66667M7.99514 3.42387C6.66221 1.8656 4.43951 1.44643 2.76947 2.87334C1.09943 4.30025 0.864321 6.686 2.17581 8.3736C3.1664 9.64827 5.98053 12.2073 7.29834 13.3833C7.54061 13.5994 7.66174 13.7075 7.80354 13.7501C7.92667 13.787 8.06354 13.787 8.18667 13.7501C8.32847 13.7075 8.44961 13.5994 8.69187 13.3833C10.0097 12.2073 12.8238 9.64827 13.8144 8.3736C15.1259 6.686 14.9195 4.28525 13.2207 2.87334C11.522 1.46144 9.32801 1.8656 7.99514 3.42387Z" stroke="#324D40" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                <?php endif; ?>
                <?php if( $status == 'Har intresse' ): ?>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.33301 2L1.33301 4M14.6663 4L12.6663 2M3.99967 12.6667L2.66634 14M11.9997 12.6667L13.333 14M5.99967 9L7.33301 10.3333L10.333 7.33333M7.99967 14C9.41414 14 10.7707 13.4381 11.7709 12.4379C12.7711 11.4377 13.333 10.0811 13.333 8.66667C13.333 7.2522 12.7711 5.89563 11.7709 4.89543C10.7707 3.89523 9.41414 3.33333 7.99967 3.33333C6.58519 3.33333 5.22863 3.89523 4.22844 4.89543C3.22824 5.89563 2.66634 7.2522 2.66634 8.66667C2.66634 10.0811 3.22824 11.4377 4.22844 12.4379C5.22863 13.4381 6.58519 14 7.99967 14Z" stroke="#324D40" stroke-width="1.33" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                <?php endif; ?>
                <?php if( $status == 'Bokad' ): ?>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.3337 6.66667V5.33333C11.3337 3.49239 9.84126 2 8.00033 2C6.15938 2 4.66699 3.49239 4.66699 5.33333V6.66667M8.00033 9.66667V11M5.86699 14H10.1337C11.2538 14 11.8138 14 12.2417 13.782C12.618 13.5903 12.9239 13.2843 13.1157 12.908C13.3337 12.4801 13.3337 11.9201 13.3337 10.8V9.86667C13.3337 8.74653 13.3337 8.18653 13.1157 7.75867C12.9239 7.38233 12.618 7.0764 12.2417 6.88467C11.8138 6.66667 11.2538 6.66667 10.1337 6.66667H5.86699C4.74689 6.66667 4.18683 6.66667 3.75901 6.88467C3.38269 7.0764 3.07673 7.38233 2.88498 7.75867C2.66699 8.18653 2.66699 8.74653 2.66699 9.86667V10.8C2.66699 11.9201 2.66699 12.4801 2.88498 12.908C3.07673 13.2843 3.38269 13.5903 3.75901 13.782C4.18683 14 4.74689 14 5.86699 14Z" stroke="#743E26" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                <?php endif; ?>
                <?php if( $status == 'Under utredning' ): ?>
                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.99967 12.3335H9.99967M4.39967 1.3335H11.5997C11.9731 1.3335 12.1597 1.3335 12.3023 1.40616C12.4278 1.47008 12.5297 1.57206 12.5937 1.6975C12.6663 1.84011 12.6663 2.0268 12.6663 2.40016V3.78318C12.6663 4.1093 12.6663 4.27236 12.6295 4.4258C12.5968 4.56186 12.5429 4.69192 12.4699 4.81121C12.3874 4.94576 12.2721 5.06106 12.0415 5.29167L10.0873 7.2459C9.82327 7.5099 9.69121 7.64196 9.64181 7.79416C9.59827 7.92803 9.59827 8.0723 9.64181 8.20616C9.69121 8.35836 9.82327 8.49043 10.0873 8.75443L12.0415 10.7086C12.2721 10.9392 12.3874 11.0546 12.4699 11.1891C12.5429 11.3084 12.5968 11.4385 12.6295 11.5745C12.6663 11.728 12.6663 11.891 12.6663 12.2172V13.6002C12.6663 13.9736 12.6663 14.1602 12.5937 14.3028C12.5297 14.4283 12.4278 14.5302 12.3023 14.5942C12.1597 14.6668 11.9731 14.6668 11.5997 14.6668H4.39967C4.02631 14.6668 3.83962 14.6668 3.69701 14.5942C3.57157 14.5302 3.46959 14.4283 3.40567 14.3028C3.33301 14.1602 3.33301 13.9736 3.33301 13.6002V12.2172C3.33301 11.891 3.33301 11.728 3.36985 11.5745C3.40251 11.4385 3.45638 11.3084 3.52949 11.1891C3.61194 11.0546 3.72724 10.9392 3.95785 10.7086L5.91209 8.75443C6.17611 8.49043 6.30811 8.35836 6.35757 8.20616C6.40107 8.0723 6.40107 7.92803 6.35757 7.79416C6.30811 7.64196 6.1761 7.5099 5.91209 7.2459L3.95785 5.29167C3.72725 5.06107 3.61194 4.94576 3.52949 4.81121C3.45638 4.69192 3.40251 4.56186 3.36985 4.4258C3.33301 4.27236 3.33301 4.1093 3.33301 3.78318V2.40016C3.33301 2.0268 3.33301 1.84011 3.40567 1.6975C3.46959 1.57206 3.57157 1.47008 3.69701 1.40616C3.83962 1.3335 4.02631 1.3335 4.39967 1.3335Z" stroke="#544A26" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                <?php endif; ?>
                <span class="status-indicator"></span>
                  <?= $status; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    <?php wp_reset_query(); ?>
  </div>
</div>