<?php
/*
Template Name: Native Ads - Article
Template Post Type: Post
*/

// require_once( 'functions.native.php' );
get_header( 'native' ); ?>

<div class="container">
	<h1><?php the_title(); ?></h1>
	<div class="">
		<?php the_content(); ?>
	</div>
</div>

<?php get_footer(); ?>
