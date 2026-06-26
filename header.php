<?php
/**
 * Header template.
 *
 * @package P2
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<script>(function(){var s=localStorage.getItem('p2-color-scheme');if(s==='dark'||(s===null&&window.matchMedia('(prefers-color-scheme: dark)').matches)){document.documentElement.classList.add('dark-mode');}})();</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div id="header">
<?php do_action( 'before' ); ?>

	<div class="sleeve">
		<h1><a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php if ( get_bloginfo( 'description' ) ) : ?>
			<small><?php bloginfo( 'description' ); ?></small>
		<?php endif; ?>
		<a class="secondary" href="<?php echo home_url( '/' ); ?>"></a>

		<?php if ( current_user_can( 'publish_posts' ) ) : ?>
			<a href="" id="mobile-post-button" style="display: none;"><?php _e( 'Post', 'p2' ) ?></a>
		<?php endif; ?>
		<button id="p2-color-scheme-toggle" aria-pressed="false">Dark mode</button>
	</div>

	<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<div role="navigation" class="site-navigation main-navigation">
		<h1 class="assistive-text"><?php _e( 'Menu', 'p2' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#main" title="<?php esc_attr_e( 'Skip to content', 'p2' ); ?>"><?php _e( 'Skip to content', 'p2' ); ?></a></div>

		<?php wp_nav_menu( array(
			'theme_location' => 'primary',
			'fallback_cb'    => '__return_false',
		) ); ?>
	</div>
	<?php endif; ?>
</div>

<div id="wrapper">

	<?php get_sidebar(); ?>