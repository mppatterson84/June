<?php
get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php get_template_part('template-parts/content', 'home'); ?>
    <?php endwhile;
else : ?>
    <p><?php esc_html_e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>

<?php
bs5_the_posts_pagination(
    array(
        'type' => 'list'
    )
)
?>

<?php
get_footer();
?>