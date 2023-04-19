<?php

/**
 * This file adds functions to the Frosty WordPress theme.
 *
 * @package Frosty Theme
 * @author  Curl Media
 * @license GNU General Public License v2 or later
 * @link    https://frostwp.com/
 */

if (!function_exists('frosty_theme_setup')) {

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since 0.8.0
     *
     * @return void
     */
    function frosty_theme_setup()
    {

        // Make theme available for translation.
        load_theme_textdomain('frosty-theme', get_template_directory() . '/languages');

        // Enqueue editor styles and fonts.
        add_editor_style(
            array(
                './style.css',
            )
        );

        // Remove core block patterns.
        remove_theme_support('core-block-patterns');
    }
}
add_action('after_setup_theme', 'frosty_theme_setup');

// Enqueue style sheet.
add_action('wp_enqueue_scripts', 'frosty_theme_enqueue_style_sheet');
function frosty_theme_enqueue_style_sheet()
{

    wp_enqueue_style('frosty-theme', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get('Version'));
}

/**
 * Register block styles.
 *
 * @since 0.9.2
 */
function frosty_theme_register_block_styles()
{

    $block_styles = array(
        'core/columns' => array(
            'columns-reverse' => __('Reverse', 'frosty-theme'),
        ),
        'core/list' => array(
            'no-disc' => __('No Disc', 'frosty-theme'),
        ),
        'core/navigation-link' => array(
            'outline' => __('Outline', 'frosty-theme'),
        ),
        'core/social-links' => array(
            'outline' => __('Outline', 'frosty-theme'),
        ),
    );

    foreach ($block_styles as $block => $styles) {
        foreach ($styles as $style_name => $style_label) {
            register_block_style(
                $block,
                array(
                    'name'  => $style_name,
                    'label' => $style_label,
                )
            );
        }
    }
}
add_action('init', 'frosty_theme_register_block_styles');
