<?php
/**
 * Crockery Store Theme Page
 *
 * @package Crockery Store
 */

function crockery_store_admin_scripts() {
	wp_dequeue_script('crockery-store-custom-scripts');
}
add_action( 'admin_enqueue_scripts', 'crockery_store_admin_scripts' );

if ( ! defined( 'CROCKERY_STORE_FREE_THEME_URL' ) ) {
	define( 'CROCKERY_STORE_FREE_THEME_URL', 'https://www.themespride.com/products/free-crockery-wordpress-theme' );
}
if ( ! defined( 'CROCKERY_STORE_PRO_THEME_URL' ) ) {
	define( 'CROCKERY_STORE_PRO_THEME_URL', 'https://www.themespride.com/products/crockery-store-wordpress-theme' );
}
if ( ! defined( 'CROCKERY_STORE_DEMO_THEME_URL' ) ) {
	define( 'CROCKERY_STORE_DEMO_THEME_URL', 'https://page.themespride.com/crockery-store-pro/' );
}
if ( ! defined( 'CROCKERY_STORE_DOCS_THEME_URL' ) ) {
    define( 'CROCKERY_STORE_DOCS_THEME_URL', 'https://page.themespride.com/demo/docs/crockery-store-lite/' );
}
if ( ! defined( 'CROCKERY_STORE_RATE_THEME_URL' ) ) {
    define( 'CROCKERY_STORE_RATE_THEME_URL', 'https://wordpress.org/support/theme/crockery-store/reviews/#new-post' );
}
if ( ! defined( 'CROCKERY_STORE_CHANGELOG_THEME_URL' ) ) {
    define( 'CROCKERY_STORE_CHANGELOG_THEME_URL', get_template_directory() . '/readme.txt' );
}
if ( ! defined( 'CROCKERY_STORE_SUPPORT_THEME_URL' ) ) {
    define( 'CROCKERY_STORE_SUPPORT_THEME_URL', 'https://wordpress.org/support/theme/crockery-store/' );
}
if ( ! defined( 'CROCKERY_STORE_THEME_BUNDLE' ) ) {
    define( 'CROCKERY_STORE_THEME_BUNDLE', 'https://www.themespride.com/products/wordpress-theme-bundle' );
}
/**
 * Add theme page
 */
function crockery_store_menu() {
	add_theme_page( esc_html__( 'About Theme', 'crockery-store' ), esc_html__( 'Begin Installation - Import Demo', 'crockery-store' ), 'edit_theme_options', 'crockery-store-about', 'crockery_store_about_display' );
}
add_action( 'admin_menu', 'crockery_store_menu' );


/**
 * Display About page
 */
function crockery_store_about_display() {
	$crockery_store_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $crockery_store_theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$crockery_store_description = explode( '. ', $crockery_store_theme->get( 'Description' ) );

					array_pop( $crockery_store_description );

					$crockery_store_description = implode( '. ', $crockery_store_description );

					echo esc_html( $crockery_store_description . '.' );
				?></p>
				<p class="actions">
					<a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_FREE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'crockery-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_DEMO_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'crockery-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_DOCS_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'crockery-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_RATE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'crockery-store' ); ?></a>

					<a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_PRO_THEME_URL ); ?>" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'crockery-store' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $crockery_store_theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'crockery-store' ); ?>">

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'crockery-store-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'crockery-store-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'One Click Demo Import', 'crockery-store' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'crockery-store-about', 'tab' => 'about_theme' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'about_theme' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'crockery-store' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'crockery-store-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Compare free Vs Pro', 'crockery-store' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'crockery-store-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'crockery-store' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'crockery-store-about', 'tab' => 'get_bundle' ), 'themes.php' ) ) ); ?>" class="blink wp-bundle nav-tab<?php echo ( isset( $_GET['tab'] ) && 'get_bundle' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Get WordPress Theme Bundle', 'crockery-store' ); ?></a>

		</nav>

		<?php
			crockery_store_demo_import();

			crockery_store_main_screen();

			crockery_store_changelog_screen();

			crockery_store_free_vs_pro();

			crockery_store_get_bundle();

		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'crockery-store' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'crockery-store' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'crockery-store' ) : esc_html_e( 'Go to Dashboard', 'crockery-store' ); ?></a>
		</div>
	</div>
	<?php
}


/**
 * Output the Demo Import screen.
 */

function crockery_store_demo_import() {
    if ( isset( $_GET['page'] ) && 'crockery-store-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {

         // Path to whizzie.php in child theme
	    $child_whizzie_path = get_stylesheet_directory() . '/inc/whizzie.php';
	    
	    // Path to whizzie.php in parent theme
	    $parent_whizzie_path = get_template_directory() . '/inc/whizzie.php';

	    // Check if the child theme is active and if whizzie.php exists in the child theme
	    if ( file_exists( $child_whizzie_path ) ) {
	        require_once $child_whizzie_path;
	    } else {
	        // Fallback to parent theme if child theme does not have whizzie.php
	        require_once $parent_whizzie_path;
	    }

        if ( isset( $_GET['import-demo'] ) && $_GET['import-demo'] == true ) { ?>
            <div class="col card success-demo" style="text-align: center;">
                <p class="imp-success"><?php echo esc_html__('Imported Successfully', 'crockery-store'); ?></p><br>
                <a class="button" href="<?php echo esc_url(home_url('/')); ?>" target="_blank">
                    <?php echo esc_html__('View Site', 'crockery-store'); ?>
                </a>
            </div>

            <!-- Modal Popup -->
            <div id="demo-success-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999;">
                <div style="background: #fff; padding: 30px; max-width: 400px; margin: 15% auto; text-align: center; border-radius: 8px;">
                    <h2 style="margin-bottom: 15px;"><?php echo esc_html__('Demo import completed successfully. You can now customize your website or view the imported content.', 'crockery-store'); ?></h2>
                    <button onclick="document.getElementById('demo-success-modal').style.display='none'">
                       <a class="view-demo-btn" href="<?php echo esc_url(home_url('/')); ?>" target="_blank">
                    		<?php echo esc_html__('View Site', 'crockery-store'); ?>
                	</a>
                    </button>
                </div>
            </div>

            <script type="text/javascript">
                window.onload = function () {
                    // Show the popup modal after load
                    document.getElementById('demo-success-modal').style.display = 'block';
                };
            </script>
        <?php } else { ?>
            <div class="col card demo-btn text-center">
                <form id="demo-importer-form" action="<?php echo esc_url(home_url()); ?>/wp-admin/themes.php" method="POST">
                    <p class="demo-title"><?php echo esc_html__('Demo Importer', 'crockery-store'); ?></p>
                    <p class="demo-des"><?php echo esc_html__('This theme supports importing demo content with a single click. Use the button below to quickly set up your site. You can easily customize or deactivate the imported content later through the Customizer.', 'crockery-store'); ?></p>
                    <i class="fas fa-long-arrow-alt-down"></i>

                    <button type="submit" class="button with-icon" id="begin-install-btn">
                        <?php echo esc_html__('Begin Installation - Import Demo', 'crockery-store'); ?>
                    </button>

                    <!-- Loader area shown in page content -->
                    <div id="page-loader" style="display:none; margin-top: 20px; text-align: center;">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/loader.png" alt="Loading..." width="40" height="40" />
                        <p style="margin-top:10px;"><?php echo esc_html__('Importing demo, please wait...', 'crockery-store'); ?></p>
                    </div>
                </form>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#demo-importer-form').on('submit', function(e) {
                        e.preventDefault();

                        if (confirm("Are you sure you want to proceed with the demo import?")) {
                            $('#page-loader').show(); // Show loader
                            
                            // Redirect to same page with import-demo param
                            var url = new URL(window.location.href);
                            url.searchParams.append('import-demo', 'true');
                            window.location.href = url;
                        } else {
                            return false;
                        }
                    });
                });
            </script>
        <?php }
    }
}


/**
 * Output the main about screen.
 */
function crockery_store_main_screen() {
	if ( isset( $_GET['tab'] ) && 'about_theme' === $_GET['tab'] ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'crockery-store' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'crockery-store' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'crockery-store' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'crockery-store' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'crockery-store' ) ?></p>
				<p><a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_SUPPORT_THEME_URL ); ?>" class="button button-primary"><?php esc_html_e( 'Support Forum', 'crockery-store' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Upgrade To Premium With Straight 20% OFF.', 'crockery-store' ); ?></h2>
				<p><?php esc_html_e( 'Get our amazing WordPress theme with exclusive 20% off use the coupon', 'crockery-store' ) ?>"<input type="text" value="GETPro20" id="myInput">".</p>
				<button class="button button-primary"><?php esc_html_e( 'GETPro20', 'crockery-store' ); ?></button>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function crockery_store_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'crockery-store' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'crockery_store_changelog_file', CROCKERY_STORE_CHANGELOG_THEME_URL );
				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = crockery_store_parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}
}

/**
 * Parse changelog from readme file.
 * @param  string $content
 * @return string
 */
function crockery_store_parse_changelog( $content ) {
	// Explode content with ==  to juse separate main content to array of headings.
	$content = explode ( '== ', $content );

	$changelog_isolated = '';

	// Get element with 'Changelog ==' as starting string, i.e isolate changelog.
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}

	// Now Explode $changelog_isolated to manupulate it to add html elements.
	$changelog_array = explode( '= ', $changelog_isolated );

	// Unset first element as it is empty.
	unset( $changelog_array[0] );

	$changelog = '<pre class="changelog">';

	foreach ( $changelog_array as $value) {
		// Replace all enter (\n) elements with </span><span> , opening and closing span will be added in next process.
		$value = preg_replace( '/\n+/', '</span><span>', $value );

		// Add openinf and closing div and span, only first span element will have heading class.
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div>';

		// Remove empty <span></span> element which newr formed at the end.
		$changelog .= str_replace( '<span></span>', '', $value );
	}

	$changelog .= '</pre>';

	return wp_kses_post( $changelog );
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function crockery_store_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'crockery-store' ); ?></p>
			<div class="vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'crockery-store' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'crockery-store' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'Theme Demo Set Up', 'crockery-store' ); ?></span></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Templates, Color options and Fonts', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Included Demo Content', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Section Ordering', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Multiple Sections', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Plugins', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Premium Technical Support', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Access to Support Forums', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Free updates', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Unlimited Domains', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Responsive Design', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Live Customizer', 'crockery-store' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a class="sidebar-button single-btn" href="<?php echo esc_url(CROCKERY_STORE_PRO_THEME_URL);?>" target="_blank"><?php esc_html_e( 'Go For Premium', 'crockery-store' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}

function crockery_store_get_bundle() {
	if ( isset( $_GET['tab'] ) && 'get_bundle' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'Get WordPress Theme Bundle', 'crockery-store' ); ?></p>
			<div class="col card">
				<h2 class="title"><?php esc_html_e( ' WordPress Theme Bundle of 100+ Themes At 15% Discount. ', 'crockery-store' ); ?></h2>
				<p><?php esc_html_e( 'Spring Offer Is To Get WP Bundle of 100+ Themes At 15% Discount use the coupon', 'crockery-store' ) ?>"<input type="text" value=" TPRIDE15 "  id="myInput">".</p>
				<p><a target="_blank" href="<?php echo esc_url( CROCKERY_STORE_THEME_BUNDLE ); ?>" class="button button-primary"><?php esc_html_e( 'Theme Bundle', 'crockery-store' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}