<?php /* Template Name: User Ratings Template */
/**
 * The template for displaying Homepage
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nandan_Global
 */

get_header();
?>

<div class="container-fuild p-4 rounded text-body-emphasis">
    <?php if(is_user_logged_in()): ?>
        <?php
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content', get_post_type() );

                the_post_navigation(
                    array(
                        'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'nandanglobal' ) . '</span> <span class="nav-title">%title</span>',
                        'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'nandanglobal' ) . '</span> <span class="nav-title">%title</span>',
                    )
                );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;

            endwhile; // End of the loop.
            ?>
    <?php else: ?>
        <div class="col-lg-12 px-0">
            Please Login to get the Point & Acheivements
        </div>
    <?php endif; ?>
</div>

<?php
get_footer();