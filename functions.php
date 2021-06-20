<?php

// Include custom navwalker
require_once(get_template_directory() . '/inc/bs5navwalker.php');

// Include custom pagination
require_once(get_template_directory() . '/inc/bs5pagination.php');

// Theme support
function june_theme_support()
{
    // add dynamic title tag support
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'june_theme_support');

// Navigation
function june_menus()
{
    $locations = array(
        'primary' => 'Main Navigation Menu',
        'footer' => 'Footer Navigation Menu'
    );

    register_nav_menus($locations);
}

add_action('init', 'june_menus');

// CSS
function june_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('june-animate.css', get_template_directory_uri() . '/assets/css/lib/animate.custom.min.css', array(), '4.1.1', 'all');
    wp_enqueue_style('june-bootstrap', get_template_directory_uri() . '/assets/css/lib/bootstrap.custom.min.css', array(), '5.0.1', 'all');
    wp_enqueue_style('june-bootstrap-icons', get_template_directory_uri() . '/assets/css/lib/bootstrap-icons.custom.min.css', array(), '1.5.0', 'all');
    wp_enqueue_style('june-hamburgers', get_template_directory_uri() . '/assets/css/lib/hamburgers.custom.min.css', array(), '1.1.3', 'all');
    wp_enqueue_style('june-main-css', get_template_directory_uri() . '/style.css', array('june-bootstrap'), $version, 'all');
}

add_action('wp_enqueue_scripts', 'june_register_styles');

// JavaScript
function june_register_scripts()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script('june-bootstrap-js', get_template_directory_uri() . '/assets/js/lib/bootstrap.bundle.min.js', array(), '5.0.1', true);
    wp_enqueue_script('june-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), $version, true);
}

add_action('wp_enqueue_scripts', 'june_register_scripts');

//register sidebars
function june_register_sidebars()
{
    register_sidebar(
        array(
            'id'            => 'primary-left',
            'name'          => __('Left Primary Sidebar'),
            'description'   => __('The left primary sidebar for the theme.'),
            'before_widget' => '<div id="%1$s" class="widget py-4 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    register_sidebar(
        array(
            'id'            => 'primary-right',
            'name'          => __('Right Primary Sidebar'),
            'description'   => __('The right primary sidebar for the theme.'),
            'before_widget' => '<div id="%1$s" class="widget py-4 %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
}

add_action('widgets_init', 'june_register_sidebars');
