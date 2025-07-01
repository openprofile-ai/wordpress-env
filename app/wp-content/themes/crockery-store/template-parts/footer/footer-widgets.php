<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Crockery Store
 * @subpackage crockery_store
 */
?>
<?php

// Determine the number of columns dynamically for the footer (you can replace this with your logic).
$crockery_store_no_of_footer_col = get_theme_mod('crockery_store_footer_columns', 4); // Change this value as needed.

// Calculate the Bootstrap class for large screens (col-lg-X) for footer.
$crockery_store_col_lg_footer_class = 'col-lg-' . (12 / $crockery_store_no_of_footer_col);

// Calculate the Bootstrap class for medium screens (col-md-X) for footer.
$crockery_store_col_md_footer_class = 'col-md-' . (12 / $crockery_store_no_of_footer_col);
?>
<div class="container">
    <aside class="widget-area row py-2 pt-3" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'crockery-store' ); ?>">
        <?php
        $crockery_store_default_widgets = array(
            1 => 'search',
            2 => 'archives',
            3 => 'meta',
            4 => 'categories'
        );

        for ($crockery_store_i = 1; $crockery_store_i <= $crockery_store_no_of_footer_col; $crockery_store_i++) :
            $crockery_store_lg_class = esc_attr($crockery_store_col_lg_footer_class);
            $crockery_store_md_class = esc_attr($crockery_store_col_md_footer_class);
            echo '<div class="col-12 ' . $crockery_store_lg_class . ' ' . $crockery_store_md_class . '">';

            if (is_active_sidebar('footer-' . $crockery_store_i)) {
                dynamic_sidebar('footer-' . $crockery_store_i);
            } else {
                // Display default widget content if not active.
                switch ($crockery_store_default_widgets[$crockery_store_i] ?? '') {
                    case 'search':
                        ?>
                        <aside class="widget" role="complementary" aria-label="<?php esc_attr_e('Search', 'crockery-store'); ?>">
                            <h3 class="widget-title"><?php esc_html_e('Search', 'crockery-store'); ?></h3>
                            <?php get_search_form(); ?>
                        </aside>
                        <?php
                        break;

                    case 'archives':
                        ?>
                        <aside class="widget" role="complementary" aria-label="<?php esc_attr_e('Archives', 'crockery-store'); ?>">
                            <h3 class="widget-title"><?php esc_html_e('Archives', 'crockery-store'); ?></h3>
                            <ul><?php wp_get_archives(['type' => 'monthly']); ?></ul>
                        </aside>
                        <?php
                        break;

                    case 'meta':
                        ?>
                        <aside class="widget" role="complementary" aria-label="<?php esc_attr_e('Meta', 'crockery-store'); ?>">
                            <h3 class="widget-title"><?php esc_html_e('Meta', 'crockery-store'); ?></h3>
                            <ul>
                                <?php wp_register(); ?>
                                <li><?php wp_loginout(); ?></li>
                                <?php wp_meta(); ?>
                            </ul>
                        </aside>
                        <?php
                        break;

                    case 'categories':
                        ?>
                        <aside class="widget" role="complementary" aria-label="<?php esc_attr_e('Categories', 'crockery-store'); ?>">
                            <h3 class="widget-title"><?php esc_html_e('Categories', 'crockery-store'); ?></h3>
                            <ul><?php wp_list_categories(['title_li' => '']); ?></ul>
                        </aside>
                        <?php
                        break;
                }
            }

            echo '</div>';
        endfor;
        ?>
    </aside>
</div>