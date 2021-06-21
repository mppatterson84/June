<?php
get_header();
?>

<?php if (is_home()) : ?>

    <div class="col-md-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'home'); ?>
            <?php endwhile;
        else : ?>
            <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>
    </div>

    <div class="order-4">
        <?php bs5_the_posts_pagination() ?>
    </div>

<?php else : ?>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/content', 'front-page'); ?>
        <?php endwhile;
    else : ?>
        <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
    <?php endif; ?>

<?php endif; ?>

<?php
get_footer();
?>