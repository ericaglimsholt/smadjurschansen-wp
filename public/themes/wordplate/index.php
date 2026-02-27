<?php 
get_header();

if (have_posts()): while (have_posts()): the_post();
    if( have_rows('modules') ):
        while ( have_rows('modules') ) : the_row();
            if( get_row_layout() == 'text' ) {
                get_template_part('modules/text', 'page');
            }
        endwhile;
    endif;
endwhile; else: 
endif;

get_footer();