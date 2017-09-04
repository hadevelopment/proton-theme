<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "proton-content" div.
 *
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
			<?php if ( is_home() ) : ?>
			<!--  Proton Site Contanier - Home -->
	<div class="site-inner proton-site-home" id="proton-site-inner" role="home">
			<!--  Proton Header -->
				<header id="proton-header" class="site-header" role="banner">
					<div id="proton-header-container" class="proton-flex">
						<div class="flex-child" id="content-menu">
							<?php
								if ( has_nav_menu( 'secundary' ) ) :
								     wp_nav_menu( array(
										'theme_location'  => 'social',
										'container_class' => 'social-links',
										'depth' 		  => 1,
										'link_before' 	  => '<span class="screen-reader-text">',
										'link_after' 	  => '</span>',
										) );
								endif;
							?>
						</div>
						<div class="flex-child" id="content-wigget-1">
		     	     		<?php if ( ! dynamic_sidebar( 'sidebar-header-1' ) ) : ?>             
               				<?php endif; // end footer widget area ?>    
						</div>
						<div class="flex-child proton-title-container " id="content-title">
							<h1 class="proton-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"">		<?php  bloginfo('name') ?></a></h1>
							<p class="proton-site-description"><?php  bloginfo('description') ?></p>
						</div>
						<div class="flex-child" id="content-wigget-2">
						<?php
	$args = array( 'numberposts' => '3' );
	$recent_posts = wp_get_recent_posts( $args );
	foreach( $recent_posts as $recent ){
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID = $recent["ID"]), 'full' );
		echo '<div class="blog-container" style="background: url('. $url.')no-repeat;"><a class="content-box" href="' . get_permalink($recent["ID"]) . '">' . '<h3 class="blog-container-title">' . $recent["post_title"] . '</h3>' .'</a> </div> ';
	}
	wp_reset_query();
?>
						</div>
					</div>
				</header>
				<!-- Proton Content -->
				<div class="content-site" id="proton-content">
			<?php else: ?>
			<!--  Proton Site Contanier - Single/Page/Content -->
		<div class="site-inner proton-site-single" id="proton-site-inner" role="single">
				<!--  Proton Header -->
				<header id="proton-header" class="site-header proton-header" role="banner">
					<div id="proton-header-container" class="proton-flex">
						<div class="flex-child proton-container" id="content-top">
							<!--  Proton Post Title -->
							<div class="on-title-post" id="proton-title-post">
								<?php the_title( '<h1 class="proton-entry-title">', '</h1>' ); ?>
								<p class="proton-reading" id="proton-quick-navigator"><a href="#post-<?php the_ID(); ?>">Continuar</a></p>
							</div>
							<!--  Proton Post Navigation -->
							<div class="on-navigation-post" id="proton-navigation-post">
								<?php the_post_navigation( array() );?>
							</div>
						</div>
					<div class="flex-child proton-title-container" id="content-title">
						<h1 class="proton-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home""><?php  bloginfo('name') ?></a></h1>
						<p class="proton-site-description"><?php  bloginfo('description') ?></p>
					</div>
				</header>
				<!-- Proton Content -->
				<div class="content" id="proton-content">
			<?php endif; ?>
