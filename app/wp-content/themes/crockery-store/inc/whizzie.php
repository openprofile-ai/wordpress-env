<?php 
if (isset($_GET['import-demo']) && $_GET['import-demo'] == true) {

    // Function to install and activate plugins
    function crockery_store_import_demo_content() {

         // Display the preloader only for plugin installation
        echo '<div id="plugin-loader" style="display: flex; align-items: center; justify-content: center; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8); z-index: 9999;">
                <img src="' . esc_url(get_template_directory_uri()) . '/assets/images/loader.png" alt="Loading..." width="60" height="60" />
              </div>';

        // Define the plugins you want to install and activate
        $plugins = array(
            array(
                'slug' => 'woocommerce',
                'file' => 'woocommerce/woocommerce.php',
                'url'  => 'https://downloads.wordpress.org/plugin/woocommerce.latest-stable.zip'
            ),
             array(
                'slug' => 'yith-woocommerce-wishlist',
                'file' => 'yith-woocommerce-wishlist/init.php',
                'url'  => 'https://downloads.wordpress.org/plugin/yith-woocommerce-wishlist.latest-stable.zip'
            ),
            array(
                'slug' => 'woocommerce-currency-switcher',
                'file' => 'woocommerce-currency-switcher/woocommerce-currency-switcher.php',
                'url'  => 'https://downloads.wordpress.org/plugin/woocommerce-currency-switcher.latest-stable.zip'
            ),
            array(
                'slug' => 'gtranslate',
                'file' => 'gtranslate/gtranslate.php',
                'url'  => 'https://downloads.wordpress.org/plugin/gtranslate.latest-stable.zip' // Correct GTranslate URL
            ),
        );

        // Include required files for plugin installation
        include_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
        include_once(ABSPATH . 'wp-admin/includes/file.php');
        include_once(ABSPATH . 'wp-admin/includes/misc.php');
        include_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');

        // Loop through each plugin
        foreach ($plugins as $plugin) {
            $plugin_file = WP_PLUGIN_DIR . '/' . $plugin['file'];

            // Check if the plugin is installed
            if (!file_exists($plugin_file)) {
                // If the plugin is not installed, download and install it
                $upgrader = new Plugin_Upgrader();
                $result = $upgrader->install($plugin['url']);

                // Check for installation errors
                if (is_wp_error($result)) {
                    error_log('Plugin installation failed: ' . $plugin['slug'] . ' - ' . $result->get_error_message());
                    echo 'Error installing plugin: ' . esc_html($plugin['slug']) . ' - ' . esc_html($result->get_error_message());
                    continue;
                }
            }

            // If the plugin exists but is not active, activate it
            if (file_exists($plugin_file) && !is_plugin_active($plugin['file'])) {
                $result = activate_plugin($plugin['file']);

                // Check for activation errors
                if (is_wp_error($result)) {
                    error_log('Plugin activation failed: ' . $plugin['slug'] . ' - ' . $result->get_error_message());
                    echo 'Error activating plugin: ' . esc_html($plugin['slug']) . ' - ' . esc_html($result->get_error_message());
                }
            }
        }

        // Hide the preloader after the process is complete
        echo '<script type="text/javascript">
                document.getElementById("plugin-loader").style.display = "none";
              </script>';

        // Add filter to skip WooCommerce setup wizard after activation
        add_filter('woocommerce_prevent_automatic_wizard_redirect', '__return_true');
    }

    // Call the import function
    crockery_store_import_demo_content();

    // ------- Create Nav Menu --------
$crockery_store_menuname = 'Main Menus';
$crockery_store_bpmenulocation = 'primary-menu';
$crockery_store_menu_exists = wp_get_nav_menu_object($crockery_store_menuname);

if (!$crockery_store_menu_exists) {
    $crockery_store_menu_id = wp_create_nav_menu($crockery_store_menuname);

    // Create Home Page
    $crockery_store_home_title = 'Home';
    $crockery_store_home = array(
        'post_type' => 'page',
        'post_title' => $crockery_store_home_title,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'home'
    );
    $crockery_store_home_id = wp_insert_post($crockery_store_home);

    // Assign Home Page Template
    add_post_meta($crockery_store_home_id, '_wp_page_template', 'page-template/front-page.php');

    // Update options to set Home Page as the front page
    update_option('page_on_front', $crockery_store_home_id);
    update_option('show_on_front', 'page');

    // Add Home Page to Menu
    wp_update_nav_menu_item($crockery_store_menu_id, 0, array(
        'menu-item-title' => __('Home', 'crockery-store'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url('/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $crockery_store_home_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create About Us Page with Dummy Content
    $crockery_store_about_title = 'About Us';
    $crockery_store_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $crockery_store_about = array(
        'post_type' => 'page',
        'post_title' => $crockery_store_about_title,
        'post_content' => $crockery_store_about_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'about-us'
    );
    $crockery_store_about_id = wp_insert_post($crockery_store_about);

    // Add About Us Page to Menu
    wp_update_nav_menu_item($crockery_store_menu_id, 0, array(
        'menu-item-title' => __('About Us', 'crockery-store'),
        'menu-item-classes' => 'about-us',
        'menu-item-url' => home_url('/about-us/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $crockery_store_about_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Services Page with Dummy Content
    $crockery_store_services_title = 'Services';
    $crockery_store_services_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $crockery_store_services = array(
        'post_type' => 'page',
        'post_title' => $crockery_store_services_title,
        'post_content' => $crockery_store_services_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'services'
    );
    $crockery_store_services_id = wp_insert_post($crockery_store_services);

    // Add Services Page to Menu
    wp_update_nav_menu_item($crockery_store_menu_id, 0, array(
        'menu-item-title' => __('Services', 'crockery-store'),
        'menu-item-classes' => 'services',
        'menu-item-url' => home_url('/services/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $crockery_store_services_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Pages Page with Dummy Content
    $crockery_store_pages_title = 'Pages';
    $crockery_store_pages_content = '<h2>Our Pages</h2>
    <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>';
    $crockery_store_pages = array(
        'post_type' => 'page',
        'post_title' => $crockery_store_pages_title,
        'post_content' => $crockery_store_pages_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'pages'
    );
    $crockery_store_pages_id = wp_insert_post($crockery_store_pages);

    // Add Pages Page to Menu
    wp_update_nav_menu_item($crockery_store_menu_id, 0, array(
        'menu-item-title' => __('Pages', 'crockery-store'),
        'menu-item-classes' => 'pages',
        'menu-item-url' => home_url('/pages/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $crockery_store_pages_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Contact Page with Dummy Content
    $crockery_store_contact_title = 'Contact';
    $crockery_store_contact_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $crockery_store_contact = array(
        'post_type' => 'page',
        'post_title' => $crockery_store_contact_title,
        'post_content' => $crockery_store_contact_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'contact'
    );
    $crockery_store_contact_id = wp_insert_post($crockery_store_contact);

    // Add Contact Page to Menu
    wp_update_nav_menu_item($crockery_store_menu_id, 0, array(
        'menu-item-title' => __('Contact', 'crockery-store'),
        'menu-item-classes' => 'contact',
        'menu-item-url' => home_url('/contact/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $crockery_store_contact_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Set the menu location if it's not already set
    if (!has_nav_menu($crockery_store_bpmenulocation)) {
        $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
        if (empty($locations)) {
            $locations = array();
        }
        $locations[$crockery_store_bpmenulocation] = $crockery_store_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}
        //---Header--//
        set_theme_mod('crockery_store_topbar_visibility', true);
        set_theme_mod('crockery_store_discount_text_top', 'Crockery Year End Sales Discount 50% OFF');
        set_theme_mod('crockery_store_currency_switcher', 'true');
        set_theme_mod('crockery_store_cart_language_translator', 'true');
        set_theme_mod('crockery_store_help_center_text', 'Help?');
        set_theme_mod('crockery_store_help_center_link', '#');
        set_theme_mod('crockery_store_order_tracking_text', 'Track Order?');
        set_theme_mod('crockery_store_order_tracking_link', '#');

        set_theme_mod('crockery_store_linkedin_url', '#');
        set_theme_mod('crockery_store_twitter_url', '#');
        set_theme_mod('crockery_store_facebook_url', '#');
        set_theme_mod('crockery_store_instagram_url', '#');
        set_theme_mod('crockery_store_youtube_url', '#');


         // Slider Section
        set_theme_mod('crockery_store_slider_arrows', true);
        set_theme_mod('crockery_store_slider_short_heading', 'Crockery for Every Home');

        for ($i = 1; $i <= 4; $i++) {
            $crockery_store_title = 'Find the Perfect Crockery for Your Home and Table';
            $crockery_store_content = 'Timeless Designs, Exceptional Quality – Explore Our Crockery Collection.Curated Collections of Elegant Crockery for Every Home';

            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($crockery_store_title),
                'post_content'  => $crockery_store_content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
            );

            /// Insert the post into the database
            $post_id = wp_insert_post($my_post);

            if ($post_id) {
                // Set the theme mod for the slider page
                set_theme_mod('crockery_store_slider_page' . $i, $post_id);

                $image_url = get_template_directory_uri() . '/assets/images/slider-img.png';
                $image_id = media_sideload_image($image_url, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }

        // Best Seller Section
        set_theme_mod('crockery_store_our_products_show_hide_section', true);
        set_theme_mod('crockery_store_product_short_heading', 'Special Deals');
        set_theme_mod('crockery_store_our_products_heading_section', 'Todays exclusive deal');
        set_theme_mod('crockery_store_product_clock_timer_end', 'June 30, 2025 11:00:00');
        set_theme_mod('crockery_store_our_product_product_category', 'productcategory1');
        set_theme_mod('crockery_store_product_social_link1', 'https://facebook.com');
        set_theme_mod('crockery_store_product_social_link2', 'https://twitter.com');
        set_theme_mod('crockery_store_product_social_link3', 'https://instagram.com');

        // Define product category names and product titles
        $crockery_store_category_names = array('productcategory1');
        $crockery_store_title_array = array(
            array("White Tea Cup And Saucer", "Red Coffee Mug", "Spoon Set for Home", "Bowl Set"),
        );

        foreach ($crockery_store_category_names as $crockery_store_index => $crockery_store_category_name) {
            // Create or retrieve the product category term ID
            $crockery_store_term = term_exists($crockery_store_category_name, 'product_cat');
            if ($crockery_store_term === 0 || $crockery_store_term === null) {
                // If the term does not exist, create it
                $crockery_store_term = wp_insert_term($crockery_store_category_name, 'product_cat');
            }

            if (is_wp_error($crockery_store_term)) {
                error_log('Error creating category: ' . $crockery_store_term->get_error_message());
                continue; // Skip to the next iteration if category creation fails
            }

            $crockery_store_term_id = is_array($crockery_store_term) ? $crockery_store_term['term_id'] : $crockery_store_term;

            // Loop to create 4 products for each category
            for ($crockery_store_i = 0; $crockery_store_i < 4; $crockery_store_i++) {
                // Create product content
                $crockery_store_title = $crockery_store_title_array[$crockery_store_index][$crockery_store_i];

                // Create product post object
                $crockery_store_my_post = array(
                    'post_title' => wp_strip_all_tags($crockery_store_title),
                    'post_status' => 'publish',
                    'post_type' => 'product', // Post type set to 'product'
                );

                // Insert the product into the database
                $crockery_store_post_id = wp_insert_post($crockery_store_my_post);

                if (is_wp_error($crockery_store_post_id)) {
                    error_log('Error creating product: ' . $crockery_store_post_id->get_error_message());
                    continue; // Skip to the next product if creation fails
                }

                // Assign the category to the product
                wp_set_object_terms($crockery_store_post_id, (int)$crockery_store_term_id, 'product_cat');

                // Add product meta (price, etc.)
                update_post_meta($crockery_store_post_id, '_regular_price', '$454'); // Regular price
                update_post_meta($crockery_store_post_id, '_sale_price', '$453'); // Sale price
                update_post_meta($crockery_store_post_id, '_price', '$453'); // Active price

                // Handle the featured image using media_sideload_image
                $crockery_store_image_url = get_template_directory_uri() . '/assets/images/product-img' . ($crockery_store_i + 1) . '.png';
                $crockery_store_image_id = media_sideload_image($crockery_store_image_url, $crockery_store_post_id, null, 'id');

                if (is_wp_error($crockery_store_image_id)) {
                    error_log('Error downloading image: ' . $crockery_store_image_id->get_error_message());
                    continue; // Skip to the next product if image download fails
                }

                // Assign featured image to product
                set_post_thumbnail($crockery_store_post_id, $crockery_store_image_id);
            }
        }


    }
?>