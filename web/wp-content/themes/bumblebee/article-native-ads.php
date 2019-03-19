<?php
/*
Template Name: Native Ads - Article
Template Post Type: Post
*/

require_once( 'functions.native.php' );

$hero_image = native_content_get_hero_section_image_data();
get_header( 'native' ); ?>
<style type="text/css">
	<?php require get_stylesheet_directory() . '/native.css'; ?>
</style>
<div class="hero" <?php echo ! empty( $hero_image ) ? 'style="background-image: url(\'' . $hero_image['url'] . '\'); background-size: cover;"' : ''; ?>>
	<div class="hero-content">
		<div class="sponsor-img">
			<?php $sponsor_img = native_content_get_field( 'hero_section_icon_logo' ); ?>
			<?php if ( ! empty( $sponsor_img ) ) : ?>
				<img src="<?php echo $sponsor_img['url']; ?>">
			<?php endif; ?>
		</div>
		<div class="sponsor-text">
			<span><?php echo native_content_get_field( 'hero_section_small_text' ); ?></span>
			<h4><?php echo native_content_get_field( 'hero_section_large_text' ); ?></h4>
		</div>
	</div>
</div> <!-- /.hero -->
<div class="container">
	<h1><?php the_title(); ?></h1>
	<div class="">
		<?php the_content(); ?>
	</div>
</div>

<?php get_footer( 'native' ); ?>
