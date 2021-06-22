<?php define('WP_USE_THEMES', false);
get_header(); ?>

<main class="col-md-6">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>
</main>

<?php
get_footer();
?>