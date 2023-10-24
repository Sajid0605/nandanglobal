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
	 
	
	// Query the posts:
	
?>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site container">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nandanglobal' ); ?></a>

	<?php 

		$args = array(  
			'post_type' => 'daily-tip',
			'post_status' => 'publish',
			'posts_per_page' => -1, 
			'order' => 'ASC', 
		);
		$obituary_query = new WP_Query($args);
		

		if($obituary_query->found_posts): ?>
			<div class="owl-carousel owl-theme text-center owl-tip-of-the-day py-1">
				<?php while ($obituary_query->have_posts()) : $obituary_query->the_post();
					// Echo some markup
					$title = get_the_title();
					$tips_of_the_day = get_field('tips_of_the_day', $post->ID);
					$end_date = get_field('end_date', $post->ID);
					$dateTimestamp1 = strtotime($end_date); 
					$dateTimestamp2 = strtotime(date('Y-m-d'));
					
					echo '<div class="item d-inline-block text-center">';
						if($dateTimestamp1 < $dateTimestamp2 ){
							echo '<p>'. $title . ' : ' . $tips_of_the_day . '</p>';
						}
					echo '</div>'; // Markup closing tags.
				endwhile; ?>
			</div>
		<?php endif;
		// Reset Post Data
		wp_reset_postdata();
	?>

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