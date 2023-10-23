<?php /* Template Name: Homepage Template */
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

    <?php if ( have_rows( 'heading_section' ) ) : ?>
        <div class="col-lg-12 px-0">
            <?php while ( have_rows( 'heading_section' ) ) :
                the_row(); ?>
                <?php if ( $header = get_sub_field( 'header' ) ) : ?>
                    <h2><?php echo esc_html( $header ); ?></h2>
                <?php endif; ?>
                <?php if ( $description = get_sub_field( 'description' ) ) : ?>
                    <?php echo $description; ?>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>

    <?php if ( have_rows( 'blog_area' ) ) : ?>
        <div class="row mb-2">
            <div class="col-lg-12 px-0 mt-5">
                <div class="row rounded h-md-250 position-relative">
                    <ul class="profile-information">
                        <li></li>
                        <?php while ( have_rows( 'blog_area' ) ) :
                            the_row();                             
                            $image = get_sub_field( 'image' );
                            $title = get_sub_field( 'title' );
                            $description = get_sub_field( 'description' );
                            $link = get_sub_field( 'button' );
                            ?>
                            <li>
                                <div class="row">
                                    <div class="col-auto d-block">
                                        <?php if ( $image ) : ?>
                                            <img src="<?php echo esc_url( $image['sizes']['thumbnail'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" class="img-thumbnail float-start" />
                                        <?php else: ?>
                                            <img src="<?php echo get_the_post_thumbnail_url() ?>" class="img-thumbnail float-start" />
                                        <?php endif; ?>                                        
                                    </div>
                                    <div class="col p-4 d-flex flex-column position-static">
                                        <div class="row align-middle">
                                            <div class="col-lg-10">
                                                <?php if ( $title = get_sub_field( 'title' ) ) : ?>
                                                    <h4><?php echo esc_html( $title ); ?></h4>
                                                <?php endif; ?>
                                                <?php if ( $description = get_sub_field( 'description' ) ) : ?>
                                                    <?php echo $description; ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-lg-2">
                                                <?php if ( $link ) :
                                                    $link_url = $link['url'];
                                                    $link_title = $link['title'];
                                                    $link_target = $link['target'] ? $link['target'] : '_self';
                                                    ?>
                                                    <a class="btn btn-warning" href="<?php echo esc_url( $link_url ); ?>" 
                                                        target="<?php echo esc_attr( $link_target ); ?>">
                                                        <?php echo esc_html( $link_title ); ?> <i class="bi bi-chevron-right"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
                <div class="ng-footer container-fuild"></div>
            </div>
        </div>
    <?php endif; ?>
    
</div>

<?php
// get_sidebar();
get_footer();