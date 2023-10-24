<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Nandan_Global
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<?php
	 global $current_user; wp_get_current_user();
?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site container">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nandanglobal' ); ?></a>

	<nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Eleventh navbar example">
      <div class="container-fluid">
	  	<?php
			if ( is_front_page() ) :
				?>
				<h1 class="site-title navbar-brand col-lg-3 justify-content-lg-end"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title navbar-brand col-lg-3 justify-content-lg-end"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
		?>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse d-lg-flex" id="navbarsExample09" style="">
			<?php
				wp_nav_menu(
					array(
						'menu_class' => 'navbar-nav col-lg-7 justify-content-lg-center',
						'container' => false,
						'theme_location' => 'main',
						'items_wrap' => '
								<ul class="%2$s">
									%3$s
								</ul>
								',
						'walker' => new NG_Nav_Menu_Walker_Simple
					)
				);
			?>
          	<?php if(is_user_logged_in()): ?>
				<div class="d-lg-flex col-lg-5 justify-content-lg-center">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
								<?php $avatar_url = get_avatar_url($current_user->ID, array('size' => 450)); ?>
								<img class="img-thumbnail rounded" src='<?php echo esc_url( $avatar_url ); ?>' width="32px" /><?php echo $current_user->display_name; ?>
							</a>
							<ul class="dropdown-menu">										
								<li><a class="dropdown-item" href="<?php echo wp_logout_url(); ?>">Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			<?php endif; ?>
        </div>
      </div>
    </nav>