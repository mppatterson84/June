<?php define('WP_USE_THEMES', false);
get_header(); ?>

<aside class="col-md-3 order-2 order-md-first">
    <?php get_sidebar('primary-left') ?>
</aside>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php the_content(); ?>
    <?php endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<aside class="col-md-3 order-3">
    <?php get_sidebar('primary-right') ?>
</aside>

<?php
get_footer();
?>