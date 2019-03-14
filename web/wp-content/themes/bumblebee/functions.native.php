<?php
/**
 * Functions for Native templates.
 */
// --- Native Ads --- //
// Native Header
add_action(
	'header_after_logo',
	function() {
		$header_logo = native_content_get_field( 'header_logo' );
		?>
	<div id="header-sponsor-logo">
		<?php if ( ! empty( $header_logo ) ) : ?>
			<img src="<?php echo $header_logo['url']; ?>">
		<?php endif; ?>
	</div>
		<?php
	},
	10,
	1
);

add_action(
	'header_after_main_menu',
	function() {
		if ( is_single() ) :
			?>
	<a href="<?php echo get_sponsor_link(); ?>" id="sponsor_view_all">See All</a>
			<?php
	endif;
	},
	10,
	1
);

add_filter(
	'has_nav_menu',
	function( $has_nav_menu, $location ) {
		if ( $location === 'desktop-focus-menu' ) {
			$has_nav_menu = false;
		}
		return $has_nav_menu;
	},
	10,
	2
);
// Remove the entry header elements.
remove_action( 'genesis_entry_header', 'toh_render_byline', 10 ); // Byline
remove_action( 'genesis_after_header', 'tmbi_v3_banner', 1 ); // Banner

function native_header() {
	?>
	<header class="native-header">
		<div class="wrap">
			<a data-analytics-metrics='{"link_name":"home logo","link_module":"header","link_pos":"secondary navigation"}' href="<?php echo site_url(); ?>" class="header-logo">
				<span class="screen-reader-text"><?php echo __( 'Home', 'tmbi-theme-v3' ); ?></span>
			</a>


			<div class="sponsored-logo">
				<?php $header_logo = native_content_get_field( 'sponsor_byline_logo' ); ?>
				<?php if ( ! empty( $header_logo ) ) : ?>
					<img src="<?php echo $header_logo['url']; ?>">
				<?php endif; ?>
			</div>
			<div class="subscribe">
				<a href="#" class="nl-sign-up">Newsletter Sign Up</a>
				<a href="#" class="mag-cover">
					<img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/native-static/tfhcover.jpg">
				</a>
				<div class="btn-container">
					<button class="primary">Subscribe</button>
					<button class="secondary">Give a gift</button>
				</div>
			</div>
		</div>
	</header>
	<div class="nav-bar">
		<div class="wrap">
			<button id="toh-menu-toggle" class="toh-menu-toggle" aria-expanded="false" aria-controls="toh-menu-wrapper">
				<div class="toh-menu-icon" aria-hidden="true">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="menu-close"><?php echo __( 'Menu', 'tmbi-theme-v3' ); ?></div>
				<div class="menu-open"><?php echo __( 'Close', 'tmbi-theme-v3' ); ?></div>
			</button>
			<nav><a href="#">See All</a></nav>
			<button class="toh-search-button" id="toh-search-toggle">
				<span class="screen-reader-text">Toggle Search</span>
			</button>
		</div>
	</div>
	<?php
}

// Banner
function native_banner() {
	?>
	<div class="header-banner-container">
		<span><?php echo native_content_get_field( 'paid_post_notice' ); ?></span>
	</div>
	<?php
}

// Hero CTA (Single)
function hero_cta() {
	$hero_image = native_content_get_hero_section_image_data();
	?>
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
	<?php
}

// Hero CTA (Video)
function hero_cta_video() {
	$hero_video_image = native_content_get_field( 'hero_video_background_image' );
	?>
	<div class="hero-video" <?php echo ! empty( $hero_video_image ) ? 'style="background-image: url(\'' . $hero_video_image['url'] . '\'); background-size: cover;"' : ''; ?>>
		<div class="video-container">
			<?php echo do_shortcode( native_content_get_field( 'hero_video_featured_video' ) ); ?>
		</div>
	</div> <!-- /.hero-video -->
	<?php
}

// Hero CTA (Project)
function hero_cta_project() {
	$hero_video_image = native_content_get_field( 'hero_video_background_image' );
	$hero_video = native_content_get_field( 'hero_video_featured_video' );
	if ( ! empty( $hero_video_image ) && ! empty( $hero_video ) ) :
		?>
		<style type="text/css">body.native-ads .site-inner{ margin: 215px auto 0; }</style>
		<?php
		hero_cta_video();
	else :
		hero_cta();
	endif;
}

// Sponsor Byline & Logo (After Title)
function native_sponsor_byline() {
	?>
	<div class="byline-container">
		<div class="title">
			<?php echo native_content_get_field( 'byline_text' ); ?>
		</div>
		<div class="image">
			<?php $byline_logo = native_content_get_field( 'byline_logo' ); ?>
			<?php if ( ! empty( $byline_logo ) ) : ?>
				<img src="<?php echo $byline_logo['url']; ?>">
			<?php endif; ?>
		</div>
	</div>
	<?php
}

// Contributors
function contributors() {
	?>
	<?php $contributors = native_content_get_field( 'contributors' ); ?>
	<?php if ( ! empty( $contributors ) ) : ?>
	<div class="contributors">
		<div class="heading">
			<div class="title">Contributors</div>
			<span></span>
		</div>
		<ul>
		<?php foreach ( $contributors as $contributor ) : ?>
			<li>
				<span class="name"><?php echo $contributor['sponsor_contributors_name']; ?></span>
				<span class="title"><?php echo $contributor['sponsor_contributors_role']; ?></span>
			</li>
		<?php endforeach; ?>
		</ul>
	</div> <!-- /.contributors -->
	<?php endif; ?>
	<?php
}

// Footer CTA (Single)
function footer_cta() {
	$footer_cta_image = native_content_get_field( 'large_bottom_cta_hero_image' );
	if ( empty( $footer_cta_image ) ) {
		return;
	}
	?>
	<div class="footer-cta" <?php echo ! empty( $footer_cta_image ) ? 'style="background-image: url(\'' . $footer_cta_image['url'] . '\'); background-size: cover;"' : ''; ?>>
		<div class="footer-content">
			<div class="sponsor-img">
				<?php $sponsor_img = native_content_get_field( 'large_bottom_cta_icon_logo' ); ?>
				<?php if ( ! empty( $sponsor_img ) ) : ?>
					<img src="<?php echo $sponsor_img['url']; ?>">
				<?php endif; ?>
			</div>
			<div class="sponsor-text">
				<span><?php echo native_content_get_field( 'large_bottom_cta_small_text' ); ?></span>
				<h4><?php echo native_content_get_field( 'large_bottom_cta_large_text' ); ?></h4>
				<a class="button primary" href="<?php echo native_content_get_field( 'large_bottom_cta_cta_url' ); ?>">
					<?php echo native_content_get_field( 'large_bottom_cta_cta' ); ?> <span class="chev-right"></span>
				</a>
			</div>
		</div>
	</div> <!-- /.footer-cta -->
	<?php
}

// After Footer CTA Banner
function native_footer_banner() {
	?>
	<div class="footer-banner-container">
		<span><?php echo native_content_get_field( 'disclaimer' ); ?></span>
	</div>
	<?php
}

// Native Footer
function native_footer() {
	?>
	<footer class="site-footer">
		<div class="wrap">
			<div class="footer-logo-social native-logo">
				<a href="/" class="footer-logo"></a>
			</div>

			<div class="footer-logo-social native-social">
				<?php
				if ( has_nav_menu( 'v2-footer-social-links' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'v2-footer-social-links',
							'menu_class'     => 'footer-social-links',
							'container'      => false,
							'walker'         => new TMBI_Social_Profiles(),
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</div>
		</div> <!-- /.wrap -->
		<div class="wrap native-bottom-footer">
			<div class="footer-left-bottom">
				<?php

				if ( has_nav_menu( 'v2-footer-global-links' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'v2-footer-global-links',
							'menu_class'     => 'footer-global-links',
							'container'      => false,
							'walker'         => new Menu_Links(),
							'fallback_cb'    => false,
						)
					);
				}
				?>
			</div> <!-- /.footer-left-bottom -->
			<div class="native-copyright">
				<?php
				$copyright_year = date( 'Y' );
				$footer_copyright = 'RDA Enthusiast Brands, LLC';
				if ( WP_Base::is_toh() ) {
					$footer_copyright = 'RDA Enthusiast Brands, LLC';
				} elseif ( WP_Base::is_fhm() ) {
					$footer_copyright = 'Home Service Publications, Inc.';
				}
				?>
				<div class="footer-copyright">&copy; <?php echo $copyright_year; ?> <?php echo __( $footer_copyright, 'tmbi-theme-v3' ); ?></div>
			</div>
		</div> <!-- /.wrap -->
	</footer>
	<?php
}

// Re-Circ Module (Bottom of Posts)
function native_recirc_module() {
	$recirc_post = native_content_get_recirc_post();
	if ( empty( $recirc_post ) ) {
		return;
	}
	$recirc_hero_image = native_content_get_field( 'hero_section_hero_image', $recirc_post );
	$recirc_title = $recirc_post->post_title;
	$recirc_link = get_permalink( $recirc_post );
	?>
<a href="<?php echo $recirc_link; ?>" class="recirc" <?php echo ! empty( $recirc_hero_image ) ? 'style="background-image: url(\'' . $recirc_hero_image['url'] . '\'); background-size: cover; min-height: 300px;"' : ''; ?>>
	<div class="read-next">
		<span>Next Article:</span>
	</div>
	<div class="read-next-title">
		<h4><?php echo $recirc_title; ?></h4>
	</div>
	
</a>
	<?php
}

add_filter( 'render_taboola_for_post', '__return_false' );

// Inline CTA (FHM Projects)
function inline_cta() {
	$inline_cta_image = native_content_get_field( 'project_inline_cta_hero_image' );
	?>
	<?php if ( ! empty( $inline_cta_image ) ) : ?>
	<div class="in-content-full-width"  <?php echo ! empty( $inline_cta_image ) ? 'style="background-image: url(\'' . $inline_cta_image['url'] . '\'); background-size: cover;"' : ''; ?>>
		<div class="inline-cta">
			<div class="native-ad-text">ADVERTISEMENT</div>
			<div class="inline-content">
				<div class="sponsor-img">
					<?php $sponsor_img = native_content_get_field( 'project_inline_cta_icon_logo' ); ?>
					<?php if ( ! empty( $sponsor_img ) ) : ?>
						<img src="<?php echo $sponsor_img['url']; ?>">
					<?php endif; ?>
				</div>
				<div class="sponsor-text">
					<span><?php echo native_content_get_field( 'project_inline_cta_small_text' ); ?></span>
					<h4><?php echo native_content_get_field( 'project_inline_cta_large_text' ); ?></h4>
					<a class="button primary" href="<?php echo native_content_get_field( 'project_inline_cta_cta_url' ); ?>">
						<?php echo native_content_get_field( 'project_inline_cta_cta' ); ?> <span class="chev-right"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php
}

function render_project_intro() {
	echo '<div class="project-intro">';
		echo native_content_get_field( 'project_introduction' );
	echo '</div>';
}

function render_project_tools() {
	?>
<div class="tools">
	<div class="required-tools">
		<h3>Required Tools</h3>
		<?php $tools = native_content_get_field( 'project_required_tools' ); ?>
		<ol>
		<?php foreach ( $tools as $tool ) : ?>
			<li><?php echo $tool['sponsor_project_required_tools_name']; ?></li>
		<?php endforeach; ?>
		</ol>
	</div>
	<div class="sponsored-tools">
		<h3>Sponsored Tools</h3>
		<?php $tools = native_content_get_field( 'project_sponsored_tools' ); ?>
		<div class="sponsored-tool-list">
			<ol>
			<?php foreach ( $tools as $tool ) : ?>
				<li>
					<?php echo $tool['sponsor_project_sponsored_tools_name']; ?>
					<p>
						<img src="<?php echo $tool['sponsor_project_sponsored_tools_image']['url']; ?>" />
					</p>
					<span class="sponsored-tool-disclaimer">SPONSORED TOOL</span>
					<?php echo $tool['sponsor_project_sponsored_tools_detail']; ?>
				</li>
			<?php endforeach; ?>
			</ol>
		</div>
	</div>
</div>
	<?php
}

function render_project_first_step() {
	$steps = native_content_get_field( 'project_steps' );
	$first_step = $steps[0];
	?>
<div class="card">
	<div class="card-number">
		<span>Step </span><span>1</span>
	</div>
	<?php echo $first_step['sponsor_project_steps_step_content']; ?>
</div>
	<?php
}

function render_project_remaining_steps() {
	$steps = native_content_get_field( 'project_steps' );
	array_shift( $steps );
	?>
	<?php if ( ! empty( $steps ) ) : ?>
		<?php foreach ( $steps as $index => $step ) : ?>
			<div class="card">
				<div class="card-number">
					<span>Step </span><span><?php echo ( $index + 2 ); ?></span>
				</div>
				<?php echo $step['sponsor_project_steps_step_content']; ?>
			</div>
			<?php if ( $index === 1 ) : ?>
				<div id="native-inine-project" data-batch="0" class="adunit-lazy full-width-ad" style="text-align: center; padding: 1em; margin-left: calc( -50vw - 8px ); width: calc( 100vw - 16px )" data-ad="native_inline_project"></div>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php
}

function filter_ptags_on_images( $content ) {
	$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	return preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
}
add_filter( 'the_content', 'filter_ptags_on_images' );
add_filter( 'acf_the_content', 'filter_ptags_on_images' );

remove_action( 'genesis_after_entry', 'render_newsletter_signup_content_widget', 5 );
remove_action( 'genesis_entry_footer', 'render_author_card', 9 );
wp_dequeue_script( 're-circ-slider' );
remove_action( 'genesis_entry_footer', array( 'TMBI_Recirc_Content	', 'render_similar_module' ), 10 );
remove_action( 'tmbi_below_the_content_recirc', array( 'TMBI_Recirc_Content', 'render_similar_module' ) );
add_filter( 'tmbi_recirc_module_content', '__return_empty_array', 99 );

function hardcoded_intro() {
	echo '<h4>Introduction</h4>';
}

