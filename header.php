<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php
    wp_head();
    ?>

    <!-- title is inserted dynamically -->
    <!-- <title>Hello, world!</title> -->
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php if (get_theme_mod('custom_logo')) : ?>
                    <img class="logo" src="<?= wp_get_attachment_image_src(get_theme_mod('custom_logo'))[0] ?>" alt="Site Logo">
                <?php else : ?>
                    <?php bloginfo('name'); ?>
                <?php endif ?>
            </a>
            <button class="navbar-toggler hamburger hamburger--slider animate__animated animate__rubberBand" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <?php
                wp_nav_menu(array(
                    'menu' => 'primary',
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => '',
                    'fallback_cb' => '__return_false',
                    'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
                    'depth' => 2,
                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                ));
                ?>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-outline-success" type="submit">
                        Search
                    </button>
                </form>
                <!-- < ?php get_search_form(); ?> -->
            </div>
        </div>
    </nav>

    <div class="body-grid">
        <main class="container">